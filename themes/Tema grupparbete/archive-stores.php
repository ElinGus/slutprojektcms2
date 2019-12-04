<!-- Annika -->

<?php get_header();
get_template_part('partials/navbar');?>

<section class="service-slide">
    <div class="container">
      <div class="columns">
        <div class="column is-three-fifths is-offset-one-fifth">
        <h1 class="title"><?php wp_title(''); ?></h1>
                  <ul>
              <?php
                while (have_posts()) {
                    the_post();
                    //the_post_thumbnail_url();
                    ?>
                    <li class="is-size-5" style="padding-bottom:.6rem"><a href="<?php the_permalink(); ?>"><?php the_title(); ?> &nbsp; <i class="fa fa-angle-double-right"></i></a></li>
                    <?php
                  }
                  ?>
                  </ul>
        </div>
      </div>
    </div>              
</section>

<?php get_footer(); ?>
