<?php get_header();
get_template_part('partials/navbar'); ?>

<div class="container">
  <div class="columns is-centered">
    <div class="column is-two-thirds">
    	<?php 
      if( have_rows('layout') ):
    		while ( have_rows('layout') ) : the_row();
    			if( get_row_layout() == 'kopvillkor' ): 
      ?>
          <h1 class="title"> <?php the_sub_field('title');?> </h1>
    			<p>	<?php the_sub_field('text');?></p>
      <?php
          endif;
        endwhile;
      endif;
      ?>
    </div>
  </div>
</div>

<?php get_footer(); ?>
