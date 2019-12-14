<!--- Yasmine --->
<?php get_header(); ?>
<!-- karusell med bulma extension, i en hero som tar upp hela skärmen både width och height-->

<section class="hero is-fullheight has-carousel">
  <div class="naven">
    <?php get_template_part('partials/navbar'); ?>
  </div>
  <div id="carousel-campaign" class="hero-carousel">


      <?php /* loop som hämtar gallerit som läggs upp i acf-field och sedan visar dessa bilder */
      if( have_rows('campaign') ):
        while ( have_rows('campaign') ) : the_row();
          $images = get_sub_field('gallery_images');
          $size = 'full'; // (thumbnail, medium, large, full or custom size)
          if( $images ): ?>
      <?php foreach( $images as $image ): ?>
      <div id="campaign-container" class="carousel-item has-background">
        <img class="is-background" src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
        <span class="campaign-info"><?php the_sub_field('campaign_text'); ?></span>
      </div>
      <?php endforeach; ?>
      <?php endif; ?>
      <?php
      endwhile;
      endif;
      ?>


  </div>
</section>
<?php get_template_part('partials/carousel'); ?>

<!-- VISAR PRODUKTER (VIA SHORTCODE) -->
<br>
<section>
  <div class="container">
    <div class="columns is-centered">
      <div class="column is-two-thirds">
        <?php
          if ( have_posts() ) {
          	while ( have_posts() ) {
          		the_post();
              the_content();
          	} // end while
          } // end if
        ?>
        <?php
        // check if the repeater field has rows of data
        if( have_rows('produkter_startsida') ):
         	// loop through the rows of data
            while ( have_rows('produkter_startsida') ) : the_row();
                // display a sub field value
                the_sub_field('startsida_rubrik');
                echo do_shortcode(get_sub_field('produkts_shortcode'));
            endwhile;
        else :
            // no rows found
        endif;
        ?>
      </div>
    </div>
  </div>
</section>

<!-- VISAR SENASTE INLÄGGEN -->
<section>
  <div class="container">
    <div class="columns is-centered">
      <div class="column is-two-thirds">
        <h1>Recent Posts</h1>
        <ul>
          <?php // Define Query Parameters
          $the_query = new WP_Query( 'posts_per_page=3' );
          // Do the query loop
          while( $the_query->have_posts() ): $the_query->the_post();
            // Display the Post Title with Hyperlink ?>
            <div class="col">
            <li><br>
              <?php the_title(); ?>
              <img src=<?php the_post_thumbnail_url(); ?> />
              <?php the_excerpt(); ?>
            </li><br>
            </div>
          <?php endwhile; ?>
        </ul>
      </div>
    </div>
  </div>
</section>

<?php wp_footer(); ?>
