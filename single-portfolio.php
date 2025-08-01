<?php
  if ( ! function_exists( 'add_action' ) ) exit;
  get_header();
?>

<section class="Portfolio">
  <section class="container container--large">

    <div class="Portfolio__title">
      <h1 class="wow fadeIn" data-wow-duration=".3s" data-wow-delay="1.1s"><?php the_title(); ?></h1>

      <span>( Portfólio )</span>
    </div>
  </section>

  <div class="Portfolio__content">
    
    <?php
      if( have_rows( 'conteudo' ) ):
        while( have_rows( 'conteudo' ) ): the_row();
    ?>
      
      <?php if( get_row_layout() == 'imagem_full' ): ?>
        <div class="fullImage wow fadeIn" style="background-image:url(<?php the_sub_field( 'arquivo' ); ?>)" data-wow-duration=".5s" data-wow-delay="1s"></div>
      <?php endif; ?>

      <?php if( get_row_layout() == 'demanda' ): ?>
        <div class="container container--large">
          <div class="demanda">
            <div class="demanda__text wow fadeIn" data-wow-duration=".5s" data-wow-delay="1s">
              <h2>
                <?php the_sub_field( 'titulo' ); ?>
              </h2>
  
              <?php the_sub_field( 'descricao' ); ?>
            </div>
  
            <div class="demanda__image">
              <img src="<?php the_sub_field( 'imagem' ); ?>" alt="">
            </div>
          </div>
        </div>
      <?php endif; ?>

      <?php if( get_row_layout() == 'texto_imagem' ): ?>
        <div class="double">
          <?php if( get_sub_field( 'alinhamento_imagem' ) == 'esquerda' ): ?>
            <div class="double__image" style="background-image:url(<?php the_sub_field( 'imagem' ); ?>);"></div>
          <?php endif; ?>

          <div class="double__text wow fadeIn" data-wow-duration=".5s" data-wow-delay="1s">
            <?php the_sub_field( 'conteudo' ); ?>
          </div>

          <?php if( get_sub_field( 'alinhamento_imagem' ) == 'direita' ): ?>
            <div class="double__image" style="background-image:url(<?php the_sub_field( 'imagem' ); ?>);"></div>
          <?php endif; ?>
        </div>
      <?php endif; ?>

      <?php if( get_row_layout() == 'imagem_com_espacamento' ): ?>
        <div class="fullImage padding wow fadeIn" data-wow-duration=".5s" data-wow-delay="1s">
          <img src="<?php the_sub_field( 'arquivo' ); ?>" alt="">
        </div>
      <?php endif; ?>
        
    <?php
        endwhile;
      endif;
    ?>
  
  </div>
</section>

<?php
  get_footer();
?>