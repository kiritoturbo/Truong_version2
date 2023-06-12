<?php
/* Template Name: Page phụ  */
?>
<main class="main">
  <section class="hero">
    <div class="hero-content">
      <h1 class="heading animated wow slideInLeft animate__animated  animate__fadeInTopLeft">
        <?php echo esc_html(get_field('dong_so_1_chu_to', 'option')); ?>
      </h1>
      <p class=" description animate__animated animate__lightSpeedInLeft">
        <?php echo esc_html(get_field('dong_so_2_chu_to', 'option')); ?>
      </p>
      <a href="" class="link animate__animated animate__zoomInUp"><?php echo get_field('button_tim_hieu_them', 'option'); ?></a>
      <a href="" class="link-arrow">
        <svg width="16" height="19" viewBox="0 0 16 19" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M7.29289 18.7071C7.68342 19.0976 8.31658 19.0976 8.70711 18.7071L15.0711 12.3431C15.4616 11.9526 15.4616 11.3195 15.0711 10.9289C14.6805 10.5384 14.0474 10.5384 13.6569 10.9289L8 16.5858L2.34315 10.9289C1.95262 10.5384 1.31946 10.5384 0.928933 10.9289C0.538408 11.3195 0.538408 11.9526 0.928933 12.3431L7.29289 18.7071ZM7 4.37114e-08L7 18L9 18L9 -4.37114e-08L7 4.37114e-08Z" fill="white" />
        </svg>
      </a>
    </div>
    <div class="hero-img animate__animated  animate__fadeInDown ">
      <img src="<?php bloginfo('template_directory') ?>/images/hero-img.png" alt="" />
    </div>
  </section>
  <section class="about">
    <div class="about-img">
      <img src="<?php bloginfo('template_directory') ?>/images/about-img.png" alt="" />
    </div>
    <div class="about-content">
      <h2 class="slogan"><?php echo get_field('slogan'); ?></h2>
      <div class="wrap">
        <h2 class="heading"><?php echo get_field('heading_about'); ?></h2>
        <div class="content-item">
          <h2 class="title"><?php echo get_field('title_about'); ?></h2>
          <p class="description">
            <?php echo get_field('description_about'); ?>
          </p>
        </div>
        <div class="content-item">
          <h2 class="title"><?php echo get_field('title_about_2'); ?></h2>
          <p class="description">
            <?php echo get_field('descripton_about_2'); ?>
          </p>
        </div>
      </div>
    </div>
  </section>
  <section class="activity">
    <div class="circle">
      <img src="<?php bloginfo('template_directory') ?>/images/activity-circle.png" alt="" />
    </div>
    <div class="line-first">
      <img src="<?php bloginfo('template_directory') ?>/images/activity-line-first.png" alt="" />
    </div>
    <div class="line-second">
      <img src="<?php bloginfo('template_directory') ?>/images/activity-line-second.png" alt="" />
    </div>
    <h2 class="title"><?php echo get_field('title_action'); ?></h2>
    <h1 class="heading"> <?php echo get_field('heading_action'); ?></h1>

    <div class="activity-list">
      <div id="testprogressbar" class="activity-item animated wow slideInLeft animate__animated animate__fadeInTopLeft">
        <div class="wrapper">
          <div class="item-top">
            <img src="<?php bloginfo('template_directory') ?>/images/activity-connect.png" alt="" />
            <div class="wrap">
              <h2 class="name"><?php echo get_field('name_action_1'); ?></h2>
            </div>
          </div>
          <div class="item-bottom">
            <p class="desc">
              <?php echo get_field('content_action_1'); ?>
            </p>
          </div>
        </div>
      </div>
      <div class="activity-item animated wow slideInLeft animate__animated animate__fadeInTopRight">
        <div class="wrapper">
          <div class="item-top">
            <img src="<?php bloginfo('template_directory') ?>/images/activity-study.png" alt="" />
            <div class="wrap">
              <h2 class="name"><?php echo get_field('name_action_2'); ?></h2>
            </div>
          </div>
          <div class="item-bottom">
            <p class="desc">
              <?php echo get_field('content_action_2'); ?>
            </p>
          </div>
        </div>
      </div>
      <div class="activity-item animated wow slideInLeft animate__animated  animate__fadeInBottomLeft">
        <div class="wrapper">
          <div class="item-top">
            <img src="<?php bloginfo('template_directory') ?>/images/activity-book.png" alt="" />
            <div class="wrap">
              <h2 class="name"><?php echo get_field('name_action_3'); ?></h2>
            </div>
          </div>
          <div class="item-bottom">
            <p class="desc">
              <?php echo get_field('content_action_3'); ?>
            </p>
          </div>
        </div>
      </div>

      <div class="activity-item animated wow slideInLeft animate__animated   animate__fadeInBottomRight">
        <div class="wrapper">
          <div class="item-top">
            <img src="<?php bloginfo('template_directory') ?>/images/activity-medal.png" alt="" />
            <div class="wrap">
              <h2 class="name"><?php echo get_field('name_action_4'); ?></h2>
            </div>
          </div>
          <div class="item-bottom">
            <p class="desc">
              <?php echo get_field('content_action_4'); ?>
            </p>
          </div>
        </div>
      </div>

    </div>
  </section>
  <?php get_template_part('event'); ?>
  <?php get_template_part('contact'); ?>
</main>