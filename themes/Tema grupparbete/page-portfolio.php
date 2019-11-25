<!-- Portfoliosida: av Elin -->

<?php get_header();
get_template_part('partials/navbar');?>

<div class="content" data-aos="fade-up">
<div class="columns is-gapless is-multiline">
  
  <!-- Kolumn 1 i bildgalleri. -->
  <div class="column">
     
    <!-- Sidan är sakapd med ett ACF-galleri där varje kolumn har sitt eget gralleri.  -->
    <?php
    $images = get_field('bildgalleri_kol_1'); 
    $size = 'full'; 

    if( $images ): ?>
      <?php foreach( $images as $image ): ?>
        <div class="kolumn">
          
          <!-- Image-tagg med en class som tar bort mellanrummet mellan billderna i galleriet och skiver ut bilderna. -->
          <img class="no-space image" src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
          
          <!-- Class middle skriver ut utrymmet där texten på bilden syns. Classen text skriver ut texten som dels plockar text ur caption från varje bild i Wordpress-->
          <div class="middle">
            <div class="text">
              <?php echo 'Fotograf: '; echo $image['caption']; ?>
            </div>
          </div>
          
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>
  
  <!-- Kolumn 2 i bildgalleri. -->
  <!-- Samma kod används för bildgalleriet i kolumn 2 och 3. -->
  <div class="column">
    
    <?php
    $images = get_field('bildgalleri_kol_2');
    $size = 'full'; 

    if( $images ): ?>
      <?php foreach( $images as $image ): ?>
        <div class="kolumn">
          <img class="no-space image" src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
            
          <div class="middle">
            <div class="text">
              <?php echo 'Fotograf: '; echo $image['caption']; ?>
            </div>
          </div>
          
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>
  
  <!-- kolumn 3 i bildgalleri. -->
  <div class="column">
    <?php
    $images = get_field('bildgalleri_kol_3');
    $size = 'full'; 

    if( $images ): ?>
      <?php foreach( $images as $image ): ?>
        <div class="kolumn">
          <img class="no-space image" src="<?php echo $image['url']; ?>"        alt="<?php echo $image['alt']; ?>" />
              
          <div class="middle">
            <div class="text">
              <?php echo 'Fotograf: '; echo $image['caption']; ?>
            </div>
          </div>
            
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>
</div>
</div>

<?php get_footer(); ?>
