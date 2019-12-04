<!-- yasmine -->
<?php get_header();
get_template_part('partials/navbar'); ?>

<div class="container login-register">
  <div class="columns is-centered">
    <div class="column">
      <?php
        if ( have_posts() ) {
        	while ( have_posts() ) {
            echo '<h1 class="myaccount-title">';
            the_title();
            echo'</h1>';
        		the_post();
            the_content();
        	} // end while
        } // end if
      ?>
    </div>
  </div>
</div>



<?php get_footer(); ?>
