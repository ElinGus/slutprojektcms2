<!-- Annika -->

<?php get_header();
get_template_part('partials/navbar');?>

<!-- Slider med Bulma Carousel -->
<!-- Valde en slider här istället för klassisk blogginläggslook då vi ville ha
det lite renare och mer lättöverskådligt. Det är en vanlig loop som hämtar
poster från custom post type 'Tjänster/services' där man givetvis kan redigera
och lägga till innehåll i wp-admin. Hade lite bekymmer med att få rätt storlek
på den men laborerade mig fram till det via Bulmas dokumentation -->
<section>
    <div class="container">
      <div class="columns">
        <div class="column is-three-fifths is-offset-one-fifth">
        <h1><?php wp_title(''); ?></h1>
              <?php
                while (have_posts()) {
                    the_post();
                    //the_post_thumbnail_url();
                    ?>
                    <p><a href="<?php the_permalink(); ?>"><?php the_title(); ?> &nbsp; <i class="fa fa-angle-double-right"></i></a></p>
                    <?php
                  }
                  ?>
        </div>
      </div>
    </div>              
</section>

<?php get_footer(); ?>
