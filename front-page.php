<?php get_header()?>
    <?php if ( is_front_page() ) : get_template_part('template-parts/content-page'); 
          elseif ( is_page(  ) ) : get_template_part('page'); endif;?>
    <?php the_field('homepage'); ?>
 <?php get_footer()?>