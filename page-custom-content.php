<?php
    /* Template Name: Page Primany  */
?>
<?php get_header() ?>
<!-- get feild   -->
<main class="main" <?php body_class(); ?>>
  <section class="page-primary">
        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
                <h1><?php the_title();?></h1>
                <div class="page-content">
                    <?php the_content(); ?>
                </div>
            <?php endwhile;
            else : ?>
            <?php endif; ?> 
  <?php get_template_part('contact'); ?>
        
  </section>
</main>
<?php get_footer() ?>