<footer class="footer">
  <div class="wrap">
    <div class="footer-navbar">
      <img class="logo" src="<?php bloginfo('template_directory') ?>/images/logo-outline.png" alt="" />
      <?php wp_nav_menu(
        array(
          'theme_location' => 'topmenu',
          'container' => 'false',
          'menu_id' => 'nav-list',
          'menu_class' => 'nav-list'
        )
      ); ?>
    </div>
    <div class="footer-content">
      <h2 class="heading">
        <?php
        global $post;
        $value = get_post_meta($post->ID, 'companyName', true);
        echo $value;
        ?>
      </h2>
      <div class="item">
        <p class="text">Mã số doanh nghiệp:</p>
        <p class="text"><?php echo get_field('ma_so_doanh_nghiep', 'option'); ?></p>
      </div>
      <div class="item">
        <p class="text">Đại diện doanh nghiệp:</p>
        <p class="text"><?php echo get_field('dai_dien_doanh_nghiep', 'option'); ?></p>
      </div>
      <div class="item">
        <p class="text">Chức vụ:</p>
        <p class="text"><?php echo get_field('chuc_vu', 'option'); ?></p>
      </div>
    </div>
    <div class="line"></div>
    <div class="footer-bottom">
      <p class="text"><?php echo get_field('copy_right', 'option'); ?></p>
      <div class="list">
        <div class="item">
          <img src="<?php echo get_field('logo_facebook', 'option'); ?>" alt="">
        </div>
        <div class="item">
          <img src="<?php echo get_field('logo_ins', 'option'); ?>" alt="">
        </div>
        <div class="item">
          <img src="<?php echo get_field('logo_tw', 'option'); ?>" alt="">
        </div>
      </div>
    </div>
  </div>
</footer>
<?php wp_footer(); ?>
</body>

</html>