<?php get_header() ?>
<main class="main" <?php body_class(); ?>>
<div class="wrapper details">
      <div class="list-bottom">
        <div class="list">
            <?php 
            $args = array(
              'post_status' => 'publish', // Chỉ lấy những bài viết được publish
              'showposts' => 12, // số lượng bài viết
            );
            ?>
            <?php $getposts = new WP_query($args); ?>
            <?php global $wp_query; $wp_query->in_the_loop = true; ?>
            <?php while ($getposts->have_posts()) : $getposts->the_post(); ?>
              <?php  include wp2023_path."/template-parts/item-content.php";?>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
      </div>

      <?php if (paginate_links() != '') { ?>
      <div class="quatrang" style="margin:38px auto">
        <?php
        global $wp_query;
        $big = 999999999;
        echo paginate_links(array(
          'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
          'format' => '?paged=%#%',
          'prev_text'    => __('« Mới hơn'),
          'next_text'    => __('Tiếp theo »'),
          'current' => max(1, get_query_var('paged')),
          'total' => $wp_query->max_num_pages
        ));
        ?>
      </div>
    <?php } ?>
</div>

</main>

<?php get_footer() ?>