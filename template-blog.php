<?php
  if ( ! function_exists( 'add_action' ) ) exit;

  /* Template Name: Blog */

  get_header();
?>

<?php require_once  get_template_directory() . '/components/insights/blog.php'; ?>

<?php
  get_footer();
?>