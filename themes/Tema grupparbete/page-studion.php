<!-- Yasmine -->
<?php get_header();?>
<div class="naven-no-opacity">
  <?php get_template_part('partials/navbar');?>
</div>
<section>
<div class="first-text" data-aos="fade-up">  <!-- data-aos som gör att innehållet glider upp på sidan-->
  <!-- "introtexten" på sidan, centrerad och tre femtedelar stor -->
  <div class="columns is-centered">
    <div class="column is-three-fifths">
      <?php
            if( have_rows('layout') ):
              while ( have_rows('layout') ) : the_row();
                if( get_row_layout() == 'first_text' ):
          ?>
      <p>
        <?php the_sub_field('text');?>
      </p>
      <?php
                endif;
              endwhile;
            endif;
          ?>
    </div>
  </div>
</div>
</section>

  <section class="hero is-fullheight has-carousel"> <!-- fullskärms-hero som stilsätts till fixed med z-index -1 för att finnas under och visas om det kommer "hål" i innehållet -->
    <div id="fixed-thing" class="hero-carousel carousel-animated carousel-animate-fade">
      <div class='carousel-container'>
        <?php
            if( have_rows('layout') ):
              while ( have_rows('layout') ) : the_row();
                if( get_row_layout() == 'first_image' ):
          ?>
        <?php $firstimage = get_sub_field('img');?>
        <?php $secondimage = get_sub_field('2_img');?>
        <div class='carousel-item has-background is-active'>
          <img class="is-background" src="<?php echo $firstimage['url']; ?>" alt="" />
        </div>
        <div class='carousel-item has-background'>
          <img class="is-background" src="<?php echo $secondimage['url']; ?>" alt="" />
        </div>
      </div>
      <?php
              endif;
            endwhile;
          endif;
        ?>
    </div>
  </section>

<section class="hero is-fullheight studio"> <!-- fullskärms-hero med centrerad text -->
  <div class="hero-body">
    <div class="container">
      <div class="columns is-centered">
        <div class="column is-half">
          <?php
              if( have_rows('layout') ):
                while ( have_rows('layout') ) : the_row();
                  if( get_row_layout() == 'about_studio' ):
                    if( have_rows('the_studio') ):
                      while ( have_rows('the_studio') ) : the_row();
             ?>
          <h1 class="title">
            <?php the_sub_field('title'); ?>
          </h1>
          <p>
            <?php the_sub_field('text'); ?>
          </p>
          <?php
                      endwhile;
                    endif;
                  endif;
                endwhile;
                else :
                // no layouts found
              endif;
            ?>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="gallery"> <!-- karusell som med loop tar fram och visar galleri, snabba byten -->
  <div class="columns is-centered">
    <div class="column is-two-thirds">
      <div class='carousel carousel-animated carousel-animate-fade' data-autoplay="true" data-delay="800">
        <div class='carousel-container'>
          <?php
  if( have_rows('layout') ):
      while ( have_rows('layout') ) : the_row();
      if( get_row_layout() == 'gallery' ):
  $images = get_sub_field('gallery');
  $size = 'full'; // (thumbnail, medium, large, full or custom size)
  if( $images ): ?>
          <?php foreach( $images as $image ): ?>
          <div class='carousel-item has-background is-active'>
            <img class="is-background" src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
          </div>
          <?php endforeach; ?>
          <?php endif; ?>
          <?php
            endif;
            endwhile;
            endif;
            ?>
        </div>
      </div>
    </div>
  </div>
</section>

<?php
  if( have_rows('layout') ):
      while ( have_rows('layout') ) : the_row();
          if( get_row_layout() == '4_things' ): ?>
<section class="four-info"> <!-- fyra info-texter där rubriken ("h1 class="title") är en länk -->
  <div class="columns is-centered">
    <div class="column is-narrow is-one-quarter">
      <div class="info">
        <?php
                  if( have_rows('first_row') ):
                  while ( have_rows('first_row') ) : the_row(); ?>
        <?php
                  $link = get_sub_field('link_1');
                    	$link_url = $link['url'];
                    	?>
        <a href="<?php echo $link_url;?>">
          <h1 class="title">
            <?php the_sub_field('title_1'); ?>
          </h1>
        </a><br>
        <p>
          <?php the_sub_field('text_1'); ?>
        </p>
        <?php
  endwhile;
  endif;
  ?>
      </div>
    </div>
    <div class="column is-narrow is-one-quarter">
      <div class="info">
        <?php
        if( have_rows('first_row') ):
        while ( have_rows('first_row') ) : the_row(); ?>
        <?php
        $link = get_sub_field('link_2');
            $link_url = $link['url'];
            ?>
        <a href="<?php echo $link_url;?>">
          <h1 class="title">
            <?php the_sub_field('title_2'); ?>
          </h1>
        </a><br>
        <p>
          <?php the_sub_field('text_2'); ?>
        </p>
        <?php
  endwhile;
  endif;
  ?>
      </div>
    </div>
  </div>
  <div class="columns is-centered">
    <div class="column is-narrow is-one-quarter">
      <div class="info">
        <?php
              if( have_rows('second_row') ):
              while ( have_rows('second_row') ) : the_row(); ?>
        <?php
              $link = get_sub_field('link_1');
                  $link_url = $link['url'];
                  ?>
        <a href="<?php echo $link_url;?>">
          <h1 class="title">
            <?php the_sub_field('title_1'); ?>
          </h1>
        </a><br>
        <p>
          <?php the_sub_field('text_1'); ?>
        </p>
        <?php
        endwhile;
        endif;
        ?>
      </div>
    </div>
    <div class="column is-narrow is-one-quarter">
      <div class="info">
        <?php
        if( have_rows('second_row') ):
        while ( have_rows('second_row') ) : the_row(); ?>
        <?php
        $link = get_sub_field('link_2');
            $link_url = $link['url'];
            ?>
        <a href="<?php echo $link_url;?>">
          <h1 class="title">
            <?php the_sub_field('title_2'); ?>
          </h1>
        </a><br>
        <p>
          <?php the_sub_field('text_2'); ?>
        </p>
        <?php
  endwhile;
  endif;
  ?>
      </div>
    </div>
  </div>
</section>
<?php
  endif;
  endwhile;
  else :
  // no layouts found
  endif;
  ?>

<section class="hero is-fullheight has-carousel"><!-- karusell i hero med två bilder, automatisk start med 2sek mellanrum mellan bilderna -->
  <div class="hero-carousel carousel-animated carousel-animate-fade" data-autoplay="true" data-delay="2000">
    <div class='carousel-container'>
      <?php if( have_rows('layout') ):
    while ( have_rows('layout') ) : the_row();
    if( get_row_layout() == 'last_image' ): ?>
      <?php $first_image = get_sub_field('img');?>
      <?php $second_image = get_sub_field('2_img');?>
      <div class='carousel-item has-background is-active'>
        <img class="is-background" src="<?php echo $first_image['url']; ?>" alt="" />
      </div>
      <div class='carousel-item has-background'>
        <img class="is-background" src="<?php echo $second_image['url']; ?>" alt="" />
      </div>
    </div>
    <?php
                 endif;
             endwhile;
         endif;
         ?>
  </div>
</section>

<section class="photographers hero is-fullheight"> <!-- hero med två kolumner där en loop hämtar och visar fält ur repeaters -->
  <div class="hero-body">
    <div class="container">
      <?php if( have_rows('layout') ):
          while ( have_rows('layout') ) : the_row();
          if( get_row_layout() == 'photographers' ): ?>
      <h1 class="title">
        <?php the_sub_field('headline'); ?>
      </h1>
      <div class="columns is-centered">
        <div class="column ">
          <div class="photograpers-info">
            <?php
            if( have_rows('photographer_1') ):
            while ( have_rows('photographer_1') ) : the_row(); ?>
            <h2 class="photograph-name">
              <?php the_sub_field('name'); ?>
              </h1>
              <p>
                <?php the_sub_field('about'); ?>
              </p>
          </div>
          <?php $image = get_sub_field('image'); if ($image) { ?>
          <img src="<?php echo $image['url']; } ?>" />
          <?php
      endwhile;
      endif;
      ?>
        </div>
        <div class="column">
          <?php
            if( have_rows('photographer_2') ):
            while ( have_rows('photographer_2') ) : the_row(); ?>
          <div class="photograpers-info">
            <h2 class="photograph-name">
              <?php the_sub_field('name'); ?>
              </h1>
              <p>
                <?php the_sub_field('about'); ?>
              </p>
          </div>
          <?php $image = get_sub_field('image'); if ($image) { ?>
          <img src="<?php echo $image['url']; } ?>" />

          <?php
      endwhile;
      endif;
      ?>
          <?php
      endif;
      endwhile;
      else :
      // no layouts found
      endif;
      ?>
        </div>
      </div>
    </div>
  </div>
</section>

<?php get_template_part('partials/carousel'); ?>
<?php get_footer(); ?>
