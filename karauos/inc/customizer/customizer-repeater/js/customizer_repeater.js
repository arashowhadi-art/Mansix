/* global jQuery */
/* global wp */
function media_upload(button_class,type) {
    'use strict';
    

    jQuery(function($){

        // Set all variables to be used in scope
        var frame
        
        // ADD IMAGE LINK
        jQuery('body').on( 'click', button_class, function( event ){
        var display_field = jQuery(this).parent().children('input:text');
          event.preventDefault();
          
          // If the media frame already exists, reopen it.
          if ( frame ) {
            frame.open();
            return;
          }
          
          // Create a new media frame
          frame = wp.media({
            frame: 'select',
            library: {
                order: 'DESC',
                type: type,
            },
            multiple: false  // Set to true to allow multiple files to be selected
          });
      
          
          // When an image is selected in the media frame...
          frame.on( 'select', function() {
            // Get media attachment details from the frame state
            var attachment = frame.state().get('selection').first().toJSON();
            display_field.val(attachment.url);
            display_field.trigger('change');
          });
      
          // Finally, open the modal on click
          frame.open(button_class);
        });
      
      });

}

/********************************************
 *** Generate unique id ***
 *********************************************/
function customizer_repeater_uniqid(prefix, more_entropy) {
    'use strict';
    if (typeof prefix === 'undefined') {
        prefix = '';
    }

    var retId;
    var php_js;
    var formatSeed = function (seed, reqWidth) {
        seed = parseInt(seed, 10)
            .toString(16); // to hex str
        if (reqWidth < seed.length) { // so long we split
            return seed.slice(seed.length - reqWidth);
        }
        if (reqWidth > seed.length) { // so short we pad
            return new Array(1 + (reqWidth - seed.length))
                .join('0') + seed;
        }
        return seed;
    };

    // BEGIN REDUNDANT
    if (!php_js) {
        php_js = {};
    }
    // END REDUNDANT
    if (!php_js.uniqidSeed) { // init seed with big random int
        php_js.uniqidSeed = Math.floor(Math.random() * 0x75bcd15);
    }
    php_js.uniqidSeed++;

    retId = prefix; // start with prefix, add current milliseconds hex string
    retId += formatSeed(parseInt(new Date()
        .getTime() / 1000, 10), 8);
    retId += formatSeed(php_js.uniqidSeed, 5); // add seed hex string
    if (more_entropy) {
        // for more entropy we add a float lower to 10
        retId += (Math.random() * 10)
            .toFixed(8)
            .toString();
    }

    return retId;
}


/********************************************
 *** General Repeater ***
 *********************************************/
function customizer_repeater_refresh_social_icons(th) {
    'use strict';
    var icons_repeater_values = [];
    th.find('.customizer-repeater-social-repeater-container').each(function () {
        var icon = jQuery(this).find('.icp').val();
        var link = jQuery(this).find('.customizer-repeater-social-repeater-link').val();
        var id = jQuery(this).find('.customizer-repeater-social-repeater-id').val();

        if (!id) {
            id = 'customizer-repeater-social-repeater-' + customizer_repeater_uniqid();
            jQuery(this).find('.customizer-repeater-social-repeater-id').val(id);
        }

        if (icon !== '' && link !== '') {
            icons_repeater_values.push({
                'icon': icon,
                'link': link,
                'id': id
            });
        }
    });

    th.find('.social-repeater-socials-repeater-colector').val(JSON.stringify(icons_repeater_values));
    customizer_repeater_refresh_general_control_values();
}


function customizer_repeater_refresh_general_control_values() {
    'use strict';
    jQuery('.customizer-repeater-general-control-repeater').each(function () {
        var values = [];
        var th = jQuery(this);
        th.find('.customizer-repeater-general-control-repeater-container').each(function () {
            var font_weight = jQuery(this).find('.customizer-repeater-font-weight').val();
            var EOT_url = jQuery(this).find('.custom-eot-url').val();
            var TTF_url = jQuery(this).find('.custom-ttf-url').val();
            var WOFF_url = jQuery(this).find('.custom-woff-url').val();
            var WOFF2_url = jQuery(this).find('.custom-woff2-url').val();
            var SVG_url = jQuery(this).find('.custom-svg-url').val();

            if (font_weight !== '' || EOT_url !== '' || TTF_url !== '' || WOFF_url !== '' || WOFF2_url !== '' || SVG_url !== '' ) {
                values.push({
                    'font_weight': font_weight,
                    'EOT_url': EOT_url,
                    'TTF_url': TTF_url,
                    'WOFF_url': WOFF_url,
                    'WOFF2_url': WOFF2_url,
                    'SVG_url': SVG_url,
                });
            }
        });
        th.find('.customizer-repeater-colector').val(JSON.stringify(values));
        th.find('.customizer-repeater-colector').trigger('change');
    });
}


jQuery(document).ready(function () {
    'use strict';
    var theme_conrols = jQuery('#customize-theme-controls');
    theme_conrols.on('click', '.customizer-repeater-customize-control-title', function () {
        jQuery(this).next().slideToggle('medium', function () {
            if (jQuery(this).is(':visible')){
                jQuery(this).prev().addClass('repeater-expanded');
                jQuery(this).css('display', 'block');
            } else {
                jQuery(this).prev().removeClass('repeater-expanded');
            }
        });
    });

    theme_conrols.on('change', '.icp',function() {
        customizer_repeater_refresh_general_control_values();
        return false;
    });


    jQuery('.customizer-repeater-font-weight').on('change', function () {
        customizer_repeater_refresh_general_control_values();
        return false;
    });
    
    media_upload('.customizer-repeater-custom-eot-button','application/vnd.ms-fontobject');
    jQuery('.custom-eot-url').on('change', function () {
        customizer_repeater_refresh_general_control_values();
        return false;
    });

    media_upload('.customizer-repeater-custom-ttf-button','application/x-font-ttf');
    jQuery('.custom-ttf-url').on('change', function () {
        customizer_repeater_refresh_general_control_values();
        return false;
    });

    media_upload('.customizer-repeater-custom-woff-button','application/x-font-woff');
    jQuery('.custom-woff-url').on('change', function () {
        customizer_repeater_refresh_general_control_values();
        return false;
    });

    media_upload('.customizer-repeater-custom-woff2-button','application/x-font-woff2');
    jQuery('.custom-woff2-url').on('change', function () {
        customizer_repeater_refresh_general_control_values();
        return false;
    });

    media_upload('.customizer-repeater-custom-svg-button','image/svg+xml');
    jQuery('.custom-svg-url').on('change', function () {
        customizer_repeater_refresh_general_control_values();
        return false;
    });

    var color_options = {
        change: function(event, ui){
            customizer_repeater_refresh_general_control_values();
        }
    };

    /**
     * This adds a new box to repeater
     *
     */
    theme_conrols.on('click', '.customizer-repeater-new-field', function () {
        var th = jQuery(this).parent();
        var id = 'customizer-repeater-' + customizer_repeater_uniqid();
        if (typeof th !== 'undefined') {

            /* Clone the first box*/
            var field = th.find('.customizer-repeater-general-control-repeater-container:first').clone( true, true );

            if (typeof field !== 'undefined') {

                field.find('.customizer-repeater-font-weight').val('normal');

                /*Show delete box button because it's not the first box*/
                field.find('.social-repeater-general-control-remove-field').show();

                /* Empty control for icon */
                field.find('.input-group-addon').find('.fa').attr('class', 'fa');


                /*Remove all repeater fields except first one*/
                field.find('.customizer-repeater-social-repeater').find('.customizer-repeater-social-repeater-container').not(':first').remove();
                field.find('.customizer-repeater-social-repeater-link').val('');
                field.find('.social-repeater-socials-repeater-colector').val('');

                /*Remove value from eot field*/
                field.find('.custom-eot-url').val('');

                /*Remove value from ttf field*/
                field.find('.custom-ttf-url').val('');

                /*Remove value from woff field*/
                field.find('.custom-woff-url').val('');

                /*Remove value from woff2 field*/
                field.find('.custom-woff2-url').val('');

                /*Remove value from svg field*/
                field.find('.custom-svg-url').val('');


                /*Append new box*/
                th.find('.customizer-repeater-general-control-repeater-container:first').parent().append(field);

                /*Refresh values*/
                customizer_repeater_refresh_general_control_values();
            }

        }
        return false;
    });


    theme_conrols.on('click', '.social-repeater-general-control-remove-field', function () {
        if (typeof    jQuery(this).parent() !== 'undefined') {
            jQuery(this).parent().hide(500, function(){
                jQuery(this).parent().remove();
                customizer_repeater_refresh_general_control_values();
            });
        }
        return false;
    });


    theme_conrols.on('keyup', '.customizer-repeater-title-control', function () {
        customizer_repeater_refresh_general_control_values();
    });

    /*Drag and drop to change icons order*/

    jQuery('.customizer-repeater-general-control-droppable').sortable({
        axis: 'y',
        update: function () {
            customizer_repeater_refresh_general_control_values();
        }
    });


    /*----------------- Socials Repeater ---------------------*/
    theme_conrols.on('click', '.social-repeater-add-social-item', function (event) {
        event.preventDefault();
        var th = jQuery(this).parent();
        var id = 'customizer-repeater-social-repeater-' + customizer_repeater_uniqid();
        if (typeof th !== 'undefined') {
            var field = th.find('.customizer-repeater-social-repeater-container:first').clone( true, true );
            if (typeof field !== 'undefined') {
                field.find( '.icp' ).val('');
                field.find( '.input-group-addon' ).find('.fa').attr('class','fa');
                field.find('.social-repeater-remove-social-item').show();
                field.find('.customizer-repeater-social-repeater-link').val('');
                field.find('.customizer-repeater-social-repeater-id').val(id);
                th.find('.customizer-repeater-social-repeater-container:first').parent().append(field);
            }
        }
        return false;
    });

    theme_conrols.on('click', '.social-repeater-remove-social-item', function (event) {
        event.preventDefault();
        var th = jQuery(this).parent();
        var repeater = jQuery(this).parent().parent();
        th.remove();
        customizer_repeater_refresh_social_icons(repeater);
        return false;
    });

    theme_conrols.on('keyup', '.customizer-repeater-social-repeater-link', function (event) {
        event.preventDefault();
        var repeater = jQuery(this).parent().parent();
        customizer_repeater_refresh_social_icons(repeater);
        return false;
    });

    theme_conrols.on('change', '.customizer-repeater-social-repeater-container .icp', function (event) {
        event.preventDefault();
        var repeater = jQuery(this).parent().parent().parent();
        customizer_repeater_refresh_social_icons(repeater);
        return false;
    });

});

var entityMap = {
    '&': '&amp;',
    '<': '&lt;',
    '>': '&gt;',
    '"': '&quot;',
    '\'': '&#39;',
    '/': '&#x2F;'
};

function escapeHtml(string) {
    'use strict';
    //noinspection JSUnresolvedFunction
    string = String(string).replace(new RegExp('\r?\n', 'g'), '<br />');
    string = String(string).replace(/\\/g, '&#92;');
    return String(string).replace(/[&<>"'\/]/g, function (s) {
        return entityMap[s];
    });

}