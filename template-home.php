<?php
  if ( ! function_exists( 'add_action' ) ) exit;

  /* Template Name: Home */

  get_header();
?>

<div id="fullpage">
<?php
  require_once  get_template_directory() . '/components/home/banner-mobile.php';
  require_once  get_template_directory() . '/components/home/banner.php';
?>

  <?php
    require_once  get_template_directory() . '/components/home/results.php';
    require_once  get_template_directory() . '/components/home/question.php';
  ?>
<?php
  require_once  get_template_directory() . '/components/home/clients.php';
  require_once  get_template_directory() . '/components/home/portfolio.php';
  require_once  get_template_directory() . '/components/home/services.php';
  require_once  get_template_directory() . '/components/home/google.php';
  require_once  get_template_directory() . '/components/home/blog.php';
?>

<?php
  get_footer();
?>
</div>