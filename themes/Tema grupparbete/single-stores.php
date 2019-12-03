<!-- Annika -->

<?php get_header();
get_template_part('partials/navbar');?>

<div class="container">
  <div class="columns">
    <div class="column is-three-fifths is-offset-one-fifth">
      <?php
        if (have_posts()) {
    	   while (have_posts()) {
    		     the_post();
             ?>
              <article class="blogarticle">
                <img src=<?php the_post_thumbnail_url(); ?> />
                <p class="title">
                  <?php the_title(); ?>
                </p>
                <p> <?php the_content(); ?></p>
                <?php while (have_rows('address_and_map')) {
                    the_row();
                      if (get_row_layout() == 'address&map') {?>
                        <p> <?php the_sub_field('address');?> </p>
                        <p> <?php echo do_shortcode(get_sub_field('map')); ?> </p>
                        <?php
                      }
                  }
                  ?>
              </article>
        <?php
           }
        }
         ?>
    </div>
  </div>
</div>

<?php get_footer(); ?>
