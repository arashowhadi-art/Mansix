<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Karauos
 * @since 4.0.0
 */

?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php the_content(); ?>
</div>
