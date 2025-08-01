<?php
  if ( ! function_exists( 'add_action' ) ) exit;


  add_action( 'after_setup_theme', 'dio_setup_theme' );

  function dio_setup_theme() {
    add_action( 'the_generator', '__return_false' );
    add_filter( 'show_admin_bar', '__return_false' );
    add_action( 'wp_enqueue_scripts', 'add_theme_scripts' );
    refi_includes();
  }

  function refi_includes() {
    require_once get_template_directory() . '/includes/admin/options.php';
    require_once get_template_directory() . '/includes/security/configs.php';
    require_once get_template_directory() . '/includes/cpt.php';
    add_theme_support( 'post-thumbnails' );
  }

  function add_theme_scripts() {
    $version_date_modified = date( 'YmdHi', time() );

    $stylesheet_url = get_stylesheet_directory_uri() . '/assets/css/style.css?v='.$version_date_modified;
    wp_enqueue_style( 'theme', $stylesheet_url, false, $version_date_modified, 'all');

    $scripts_url = get_stylesheet_directory_uri() . '/assets/js/main.min.js?v='.$version_date_modified;
    wp_enqueue_script( 'theme', $scripts_url, false, $version_date_modified, true);
  }

  function cleanString($string){
    $string = str_replace(array('[\', \']'), '', $string);
    $string = preg_replace('/\[.*\]/U', '', $string);
    $string = preg_replace('/&(amp;)?#?[a-z0-9]+;/i', '-', $string);
    $string = htmlentities($string, ENT_COMPAT, 'utf-8');
    $string = preg_replace('/&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig|quot|rsquo);/i', '\\1', $string );
    $string = preg_replace(array('/[^a-z0-9]/i', '/[-]+/') , '', $string);
    return strtolower(trim($string, ''));
  }

  add_filter('wpcf7_autop_or_not', '__return_false');

  function post_remove () {
    remove_menu_page('edit.php');
  }

  // Removes from admin menu
  add_action( 'admin_menu', 'my_remove_admin_menus' );
  function my_remove_admin_menus() {
    remove_menu_page( 'edit-comments.php' );
  }
  // Removes from post and pages
  add_action('init', 'remove_comment_support', 100);

  function remove_comment_support() {
      remove_post_type_support( 'page', 'comments' );
  }


  // Allow SVG
  add_filter( 'wp_check_filetype_and_ext', function($data, $file, $filename, $mimes) {

    global $wp_version;
    if ( $wp_version !== '4.7.1' ) {
      return $data;
    }

    $filetype = wp_check_filetype( $filename, $mimes );

    return [
        'ext'             => $filetype['ext'],
        'type'            => $filetype['type'],
        'proper_filename' => $data['proper_filename']
    ];

  }, 10, 4 );

  function cc_mime_types( $mimes ){
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
  }
  add_filter( 'upload_mimes', 'cc_mime_types' );

  function fix_svg() {
    echo '<style type="text/css">
          .attachment-266x266, .thumbnail img {
              width: 100% !important;
              height: auto !important;
          }
          </style>';
  }
  
  add_action( 'admin_head', 'fix_svg' );

  add_filter('wpcf7_autop_or_not', '__return_false');

  add_filter( 'wpcf7_form_autocomplete', function ( $autocomplete ) {
    $autocomplete = 'off';
    return $autocomplete;
  }, 10, 1 );

  function my_mce_buttons_2( $buttons ) {	
    $buttons[] = 'superscript';
    $buttons[] = 'subscript';
  
    return $buttons;
  }
  
  add_filter( 'mce_buttons_2', 'my_mce_buttons_2' );


  function custom_cf7_submit_button_html( $html, $tag ) {
    if ( $tag->type === 'submit' ) {
        $value = isset( $tag->values[0] ) ? $tag->values[0] : __( 'Send', 'contact-form-7' );

        $atts = '';
        foreach ( $tag->options as $option ) {
            if ( preg_match( '%^id:([_a-zA-Z0-9-]+)$%', $option, $matches ) ) {
                $atts .= ' id="' . esc_attr( $matches[1] ) . '"';
            } elseif ( preg_match( '%^class:([_a-zA-Z0-9-]+)$%', $option, $matches ) ) {
                $atts .= ' class="' . esc_attr( $matches[1] ) . '"';
            }
            // You can add more attributes here if needed, e.g., for data-attributes
        }

        // Add default CF7 classes for styling
        $atts .= ' class="wpcf7-form-control wpcf7-submit"';

        $html = sprintf( '<button type="submit"%1$s>%2$s</button>', $atts, esc_html( $value ) );
    }
    return $html;
}
add_filter( 'wpcf7_form_tag_submit', 'custom_cf7_submit_button_html', 10, 2 );

function custom_excerpt_length( $length ) {
    return 20; // Substitua 20 pelo número de caracteres desejados
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );