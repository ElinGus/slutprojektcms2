<!-- Annika -->

<?php get_header();
get_template_part('partials/navbar');?>

<!-- Vanliga loopen för att hämta sökresultat -->
<div class="container">
  <div class="columns">
    <div class="column is-four-fifths">
      <h1><?php wp_title(); ?></h1>
        <?php
    	   while (have_posts()) {
    		     the_post();
             ?>
             <article class="blogarticle">
               <p class="title">
                 <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
               </p>
               <p> <?php the_content(); ?></p>
             </article>
             <?php
    	      }
            ?>
    </div>
  </div>
</div>

<?php get_footer(); ?>
