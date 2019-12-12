<!--- Yasmine --->
<?php get_header(); ?>
<!-- karusell med bulma extension, i en hero som tar upp hela skärmen både width och height-->

<section class="hero is-fullheight has-carousel">
  <div class="naven">
    <?php get_template_part('partials/navbar'); ?>
  </div>
  <div class="hero-carousel carousel-animated carousel-animate-fade" data-autoplay="true" data-delay="3000">
    <div class='carousel-container'>

      <?php // Layout för kampanjtext
      if( have_rows('layout') ):
        while ( have_rows('layout') ) : the_row();
        if( get_row_layout() == 'campaign_text' ):
          $campaign_text = get_sub_field('campaign_text');
          ?>
          <h1 class="campaign-text"> <?php echo ($campaign_text); ?></h1>
          <?php
        endif;
        endwhile;
      endif;
      ?>

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



<!-- TEST: REPEATER FÖR KAMPANJ -->
<!-- <section class="hero is-fullheight has-carousel">
  <div class="naven">
    <?php get_template_part('partials/navbar'); ?>
  </div>
<div class="hero-carousel carousel-animated carousel-animate-fade" data-autoplay="true" data-delay="3000">
  <div class="carousel-container">

    <?php
				// check if the repeater field has rows of data
		if( have_rows('campaign') ):
		 	// loop through the rows of data
		    while ( have_rows('campaign') ) : the_row();
		        // display a sub field value
            $campaign_text = get_sub_field('campaign_text');
		        $images = get_sub_field('gallery_images');
				if( $images ): ?>
        <?php foreach( $images as $image ): ?>
        <div class='carousel-item has-background is-active'>
          <img class="is-background" src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
        </div>
        <h1 class="campaign-text"> <?php echo ($campaign_text); ?> </h1>
            </li>
        <?php endforeach;
        endif;?>
		   <?php endwhile;
		else :
		    // no rows found
		endif;
		?>

  </div>
</div>
</section>
<?php get_template_part('partials/carousel'); ?> -->



<!-- VISAR PRODUKTER (VIA SHORTCODE) -->
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
            <li>
              <?php the_title(); ?>
              <img src=<?php the_post_thumbnail_url(); ?> />
              <?php the_excerpt(); ?>
            </li>
          <?php endwhile; ?>
        </ul>
      </div>
    </div>
  </div>
</section>

<?php wp_footer(); ?>
