<?php wp_head(); ?>

<div id="pageNotFound">
  <section class="hero is-fullheight">
    <div class="hero-body">
      <div class="container has-text-centered">
      <h1 class="big404"> 404 </h1>
      <h1 class="404"> Oops! </h1>
      <h1 class="404"> Här finns inget att se. </h1>
      <h2 class="sub404"> Du hittade en ofungerande länk </h2>
      
      <div class="columns is-centered">
        <div class="column  is-one-fifth">
          
          <form role="search" method="get" id="searchform"
            class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
            <div>
              <label class="screen-reader-text" for="s"><?php _x( 'Search for:', 'label' ); ?>
              </label>
              
              <p class="control has-icons-left">
                <input type="text" class="input is-info" value="
                <?php echo get_search_query(); ?>" placeholder="Sök här" />
                <span class="icon is-small is-left">
                  <i class="fa fa-search"></i> 
                </span>
              </p>

              <input type="submit" class="button is-small is-rounded" id="searchsubmit"
                value="<?php echo esc_attr_x( 'Sök', 'submit button' ); ?>" />
            </div>
          </form>
          
      	   <a class="home" href="<?php echo home_url(); ?>">
             Gå till startsidan 
           </a>
           
        </div>
      </div>
      
      </div>
    </div>
  </section>
</div>

<?php wp_footer(); ?>
