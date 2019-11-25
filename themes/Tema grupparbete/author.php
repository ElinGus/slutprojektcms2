<!-- Annika -->

<?php get_header();
get_template_part('partials/navbar');?>

<!-- Vanliga loopen för att hämta inlägg från specifik författare -->
<div class="container">
  <div class="columns">
    <div class="column is-four-fifths">
      <h1><?php wp_title(); ?></h1>
        <?php
    	   while (have_posts()) {
    		     the_post();
             ?>
              <article class="blogarticle">
                <img src=<?php the_post_thumbnail_url(); ?> />
                <p class="title">
                  <?php the_title(); ?>
                </p>
                <p class="subtitle">
                  <i class="fa fa-user"></i> <a href=
                  "<?php echo get_author_posts_url( get_the_author_meta( 'ID' ),
                  get_the_author_meta( 'user_nicename' ) ); ?>">
                  <?php the_author(); ?></a> <i class="fa fa-calendar"></i>
                  <?php the_date(); ?>
                  <i class="fa fa-tag"></i> <?php the_category( ', ' ); ?>
                </p>
                <p> <?php the_content(); ?></p>
              </article>
        <?php
    	   }
        ?>
    </div>
      <?php get_template_part('partials/sidebar') ?>
  </div>
</div>

<?php get_footer(); ?>
