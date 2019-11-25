<!-- Annika -->

<?php get_header();
get_template_part('partials/navbar');?>

<!-- Slider med Bulma Carousel -->
<!-- Valde en slider här istället för klassisk blogginläggslook då vi ville ha
det lite renare och mer lättöverskådligt. Det är en vanlig loop som hämtar
poster från custom post type 'Tjänster/services' där man givetvis kan redigera
och lägga till innehåll i wp-admin. Hade lite bekymmer med att få rätt storlek
på den men laborerade mig fram till det via Bulmas dokumentation -->
<section class="service-slide">
  <div class="columns is-mobile is-centered">
    <div class="column is-half">
      <div class='carousel carousel-animated carousel-animate-fade'>
        <div class='carousel-container'>
          <?php
            while (have_posts()) {
              the_post();
              ?>
                <div class='carousel-item has-background is-active'>
                  <img class="is-background" src="<?php the_post_thumbnail_url(); ?>"
                  alt="" width="640" height="310" />
                  <div class="title"><h1><?php the_title(); ?></h1>
                    <p class="BreadText"><?php the_content(); ?></p>
                  </div>
                </div>
                <?php
              }
              ?>
            </div>
            <!-- Pilar för bildbyte -->
            <div class="carousel-navigation">
              <div class="carousel-nav-left">
                <i class="fa fa-chevron-left" aria-hidden="true"></i>
              </div>
              <div class="carousel-nav-right">
                <i class="fa fa-chevron-right" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
</section>

<!-- Script Bulma Carousel -->
<?php get_template_part('partials/carousel'); ?>

<?php get_footer(); ?>
