<!-- Annika -->

<?php get_header();
get_template_part('partials/navbar');?>

<!-- Vanliga loopen som hämtar specifik post med dess innehåll -->
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
                <p class="subtitle">
                  <i class="fa fa-user"></i> <a href=
                  "<?php echo get_author_posts_url( get_the_author_meta( 'ID' ),
                  get_the_author_meta( 'user_nicename' ) ); ?>">
                  <?php the_author(); ?></a> <i class="fa fa-calendar"></i>
                  <?php the_date(); ?>
                  <i class="fa fa-tag"></i> <?php the_category( ', ' ); ?>
                </p>
                <p> <?php the_content(); ?></p>
                <br>
        <?php
    	   }
         ?>
<!-- Dela inlägg mha acf flexible content -->
<!-- Lagt in 'Dela inlägg' som flexible content i acf. Den har en rubrik, en
ikon och en länk. -->

            <?php the_field('rubrik_dela_inlagg'); ?>
            <br>
            <?php
            while (have_rows('dela_inlagg')) {
              the_row();
                if (get_row_layout() == 'dela_inlagg_ikon_lank') {
                  the_sub_field('ikon');
                  $link = get_sub_field('lank');
                  	$link_url = $link['url'];
                  	$link_title = $link['title'];
                  	$link_target = $link['target'] ? $link['target'] : 'self';
                  	?>
                  	<a href="<?php echo esc_url($link_url); ?>"
                      target="<?php echo esc_attr($link_target); ?>">
                      <?php echo esc_html($link_title); ?></a>
                      <br>
                  
                  <?php
                }
            }
          ?>
              </article>
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
