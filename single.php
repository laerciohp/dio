<?php
  if ( ! function_exists( 'add_action' ) ) exit;
  get_header();
?>

<section class="Single">
  <section class="container">
    <?php
        if ( has_post_thumbnail() ):
          $thumbnail_url = get_the_post_thumbnail_url( get_the_ID(), 'full' );
      ?>
      <div class="Single__thumb" style="background-image:url(<?php echo esc_url( $thumbnail_url )?>)"></div>
    <?php
      endif;
    ?>

    <div class="Single__title">
      <h1><?php the_title(); ?></h1>
    </div>

    <div class="Single__content">
      <?php the_content(); ?>
    </div>
  </section>
</section>

<?php
  get_footer();
?>