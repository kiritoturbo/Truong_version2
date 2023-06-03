<div class="item animated wow slideInRight animate__animated animate__delay-1s animate__slideInRight">
    <a href="<?php the_permalink(); ?>"><?php echo get_the_post_thumbnail(get_the_id(), 'full', array('class' => 'thumnail')); ?></a>
    <p class="name"><?php single_tag_title(); ?></p>
    <h2 class="title">
        <?php the_title(); ?>
    </h2>
    <p class="desc">
        <?php the_excerpt(); ?>
    </p>
    <p class="time"><?php echo get_the_date('d - m - Y'); ?></p>
    <div class="line"></div>
</div>