<!-- Annika -->

<?php get_header();
get_template_part('partials/navbar');?>

<!-- Vanliga loopen för att hämta blogginläggen och dess innehåll. Vi har en
sidebar där man enkelt kan hitta arkiv och kategorier, samt söka på sidan.
Sidebaren satte vi på fixed så att den följer med när man scrollar så att det
ska bli smidigare att navigera. I wp-admin kan man lägga till en read more-
avskiljare och hade lite bekymmer med att hitta hur man kunde få den översatt
till 'Läs mer', men kunde googla mig fram till det så småningom. Sök-formet
ville vi styla om så det gjorde vi via Bulma men det resulterade i att det
slutade fungera. Vi fick istället styla om det 'vanliga' formet som kommer
ifrån widgeten i wp-admin. Det fanns dokumentation på wp codex om det. -->
<div class="container">
  <div class="columns">
    <div class="column is-three-fifths is-offset-one-fifth" data-aos="fade-up">
      <?php
    	   while (have_posts()) {
    		     the_post();
             ?>
              <article class="blogarticle">
                <img src=<?php the_post_thumbnail_url(); ?> />
                <p class="title">
                  <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
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
