<?php
  if ( ! function_exists( 'add_action' ) ) exit;

  /* Template Name: Portfolio */

  get_header();
?>

<section class="PortfolioPage">
  <div class="PortfolioPage__text">
    <span class="PortfolioPage__text--subtitle">( <?php the_title(); ?> )</span>

    <?php the_content(); ?>
  </div>

  <div class="PortfolioPage__list">
    <?php
      $args = array(
        'post_type'      => 'portfolio',
        'posts_per_page' => -1,
      );

      $the_query = new WP_Query( $args );
    ?>

    <?php
      if ( $the_query->have_posts() ):
        while ( $the_query->have_posts() ):
        
          $the_query->the_post();
    ?>
      <div class="PortfolioPage__list--box">
        <a href="<?php the_permalink(); ?>" class="item">
          <?php
            if( have_rows( 'informacoes_do_card' ) ):
              while( have_rows( 'informacoes_do_card' ) ): the_row();
          ?>
        
            <div class="crop">
              <div class="overlay"></div>
              <div class="image" style="background-image:url(<?php the_sub_field( 'imagem' ); ?>)"></div>
            </div>
        
            <div class="text">
      
              <div class="text__description">
                <p><?php the_title(); ?></p>
                <ul>
                  <li>Branding</li>
                  <li>Web Design</li>
                  <li>UI | UX</li>
                </ul>
              </div>
            </div>
        
        <?php
            endwhile;
          endif;
        ?>
        </a>
      </div>
    <?php
        endwhile;
        wp_reset_postdata();
      endif;
    ?>
  </div>
</section>

<?php
  get_footer();
?>