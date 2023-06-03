<section class="news">
    <h2 class=" title animated wow animate__animated animate__delay-1s animate__flipInX">tin tức và sự kiện</h2>
    <h1 class="container-heading heading animated wow animate__animated animate__delay-1s animate__lightSpeedInRight" style="position: relative;z-index: 10000;">các tin tức và sự kiện mới của <?php bloginfo('name'); ?>
        <div class="progress-bar wow slideInLeft animate__delay-2s" id="progress" style="position: absolute;top:20px;left:50%;transform: translateX(-40%);z-index:-1;height: 72%;width: 58%;"></div>
    </h1>

    <div class="news-list animated wow animate__animated  animate__lightSpeedInLeft">
        <?php
        $args = array(
            'post_status' => 'publish',
            'showposts' => 3,
        );
        ?>
        <?php $getposts = new WP_query($args); ?>
        <?php global $wp_query;
        $wp_query->in_the_loop = true; ?>
        <?php while ($getposts->have_posts()) : $getposts->the_post(); ?>
            <div class="news-item">
                <a href="<?php the_permalink(); ?>"><?php echo get_the_post_thumbnail(get_the_id(), 'full', array('class' => 'thumnail')); ?></a>
                <div class="news-item-title">
                    <?php the_title(); ?>
                </div>
                <p class="desc">
                    <?php the_excerpt() ?>
                </p>
                <p class="time"><?php echo get_the_date('d - m -Y'); ?></p>
                <div class="line"></div>
            </div>
        <?php endwhile;
        wp_reset_postdata(); ?>

    </div>

    <div class="see-more animated animate__animated  animate__slideInRight">
        <a href="<?php get_the_permalink() ?>" class="link">Xem thêm</a>
    </div>
    <div style="display:flex;max-width:900px;margin:0 auto;list-style:none;gap:50px;">
        <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar')) : ?><?php endif; ?>
    </div>
</section>