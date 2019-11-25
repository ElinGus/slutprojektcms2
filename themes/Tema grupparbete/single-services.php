<!-- Annika -->

<?php get_header();
get_template_part('partials/navbar');?>

<!-- Vanliga loopen som hämtar specifik post under 'Tjänster'. Thumbnail, titel
och innehåll. -->
<div class="container">
  <div class="columns">
    <div class="column is-three-fifths is-offset-one-fifth">
      <?php
    	   while (have_posts()) {
    		     the_post();
             ?>
              <article class="blogarticle">
                <img src=<?php the_post_thumbnail_url(); ?> />
                <p class="title">
                  <?php the_title(); ?>
                </p>
                <p> <?php the_content(); ?></p>
              </article>
        <?php
    	   }
         ?>
    </div>
  </div>
</div>
<!-- Slider med Bulma Carousel, bildgalleri mha acf repeater -->
<!-- Nedan kod är ett bildgalleri på en slider. Denna redigeras i wp-admin på
inlägget med hjälp av en repeater i acf. Kändes bäst att ha det som en repeater
eftersom det ska kunna gå att lägga in endast bilder och hur många man vill -->
<div class='carousel carousel-animated carousel-animate-slide' data-size="2">
  <div class='carousel-container'>
    <?php
      if (have_rows('bildgalleri')) {
        while (have_rows('bildgalleri')) {
          the_row();
          ?>
            <div class='carousel-item'>
              <figure class="image is-3by2">
                <img src="<?php the_sub_field('bild'); ?>">
              </figure>
            </div>
            <?php
        }
        ?>
  </div>
<!-- Pilar för bildbyte om det finns ett bildgalleri inlagt-->
<!-- Nedan kod är pilarna som gör att man kan byta bild i galleriet. Bekymret
här var att jag ville att pilarna endast ska visas när man faktiskt lagt in ett
bildgalleri i wp-admin. Efter många om och men fick jag till det med en else.
-->
    <div class="carousel-navigation is-centered">
      <div class="carousel-nav-left">
        <i class="fa fa-chevron-left" aria-hidden="true"></i>
      </div>
      <div class="carousel-nav-right">
        <i class="fa fa-chevron-right" aria-hidden="true"></i>
      </div>
    </div>
    <?php
      }else {
        echo '';
      }
      ?>
</div>

<!-- Script Bulma Carousel -->
<?php get_template_part('partials/carousel'); ?>

<?php get_footer(); ?>
