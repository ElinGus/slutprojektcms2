<!--- Yasmine --->
<?php get_header(); ?>
<!-- karusell med bulma extension, i en hero som tar upp hela skärmen både width och height-->
<section class="hero is-fullheight has-carousel">
  <div class="naven">
    <?php get_template_part('partials/navbar'); ?>
  </div>
  <div class="hero-carousel carousel-animated carousel-animate-fade" data-autoplay="true" data-delay="3000">
    <div class='carousel-container'>
      <?php /* loop som hämtar gallerit som läggs upp i acf-field och sedan visar dessa bilder */
      if( have_rows('layout') ):
        while ( have_rows('layout') ) : the_row();
        if( get_row_layout() == 'indexgallery' ):
          $images = get_sub_field('indexgallery');
          $size = 'full'; // (thumbnail, medium, large, full or custom size)
          if( $images ): ?>
      <?php foreach( $images as $image ): ?>
      <div class='carousel-item has-background is-active'>
        <img class="is-background" src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
      </div>
      <?php endforeach; ?>
      <?php endif; ?>
      <?php
          endif;
          endwhile;
          endif;
          ?>
    </div>
  </div>
</section>
<?php get_template_part('partials/carousel'); ?>

<?php wp_footer(); ?>
