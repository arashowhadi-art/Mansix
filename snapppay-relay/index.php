<?php
/**
 * Snapp Pay relay — put this on the IRANIAN host (subdomain, e.g. snp.example.com).
 * Forwards /api/online/* requests from the WordPress site to api.snapppay.ir.
 */

// ---- CONFIG ----------------------------------------------------------------
const RELAY_KEY = 'CHANGE_ME_TO_A_LONG_RANDOM_STRING';   // same value in plugin settings
const UPSTREAM  = 'https://api.snapppay.ir';
// ----------------------------------------------------------------------------

function fail($code, $msg) {
    http_response_code($code);
    header('Content-Type: application/json');
    echo json_encode(['relay_error' => $msg]);
    exit;
}

$sent = $_SERVER['HTTP_X_RELAY_KEY'] ?? '';
if (RELAY_KEY === 'CHANGE_ME_TO_A_LONG_RANDOM_STRING' || !hash_equals(RELAY_KEY, $sent)) {
    fail(403, 'forbidden');
}

$uri  = $_SERVER['REQUEST_URI'] ?? '';
$path = parse_url($uri, PHP_URL_PATH) ?: '';
$qs   = parse_url($uri, PHP_URL_QUERY);
$path = '/' . ltrim(preg_replace('#^.*?(/api/online/)#', '$1', $path), '/');

if (strpos($path, '/api/online/') !== 0 || strpos($path, '..') !== false) {
    fail(404, 'path not allowed');
}

$method = $_SERVER['REQUEST_METHOD'];
if (!in_array($method, ['GET', 'POST'], true)) {
    fail(405, 'method not allowed');
}

$headers = [];
foreach (['HTTP_AUTHORIZATION' => 'Authorization', 'CONTENT_TYPE' => 'Content-Type', 'HTTP_USER_AGENT' => 'User-Agent'] as $k => $name) {
    if (!empty($_SERVER[$k])) $headers[] = "$name: " . $_SERVER[$k];
}
// Some shared hosts strip Authorization; recover it.
if (empty($_SERVER['HTTP_AUTHORIZATION']) && function_exists('getallheaders')) {
    foreach (getallheaders() as $n => $v) {
        if (strcasecmp($n, 'Authorization') === 0) $headers[] = "Authorization: $v";
    }
}

$ch = curl_init(UPSTREAM . $path . ($qs ? '?' . $qs : ''));
curl_setopt_array($ch, [
    CURLOPT_CUSTOMREQUEST  => $method,
    CURLOPT_HTTPHEADER     => $headers,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_CONNECTTIMEOUT => 8,
    CURLOPT_TIMEOUT        => 25,
    CURLOPT_FOLLOWLOCATION => false,
]);
if ($method === 'POST') {
    curl_setopt($ch, CURLOPT_POSTFIELDS, file_get_contents('php://input'));
}

$body = curl_exec($ch);
if ($body === false) {
    $err = curl_error($ch);
    curl_close($ch);
    fail(502, 'upstream: ' . $err);
}
$status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$ctype  = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
curl_close($ch);

http_response_code($status);
header('Content-Type: ' . ($ctype ?: 'application/json'));
echo $body;
