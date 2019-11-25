<footer>
  <div class="container">
    <div class="columns is-centered">
      <div class="column is-half">
        <div class="social-media">
          <?php the_field('footer', 'option'); ?>
        </div>
      </div>
    </div>
  </div>
   <?php wp_footer(); ?>
 </footer>
    <script>
     AOS.init({
       easing: 'ease-in-quad',
     });
    </script>
  </body>
</html>
