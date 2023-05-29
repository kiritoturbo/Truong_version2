<?php get_header() ?>

<main class="main">
    <div class="wrapper details">
        <div class="astra-nav">
            <h1 style="margin-bottom:30px">KẾT QUẢ TÌM KIẾM</h1>
            <ul class="list">
                <?php $test = get_term_by('id', get_queried_object_id(), 'category'); ?>

                <li class="item">
                    <a href="<?php echo get_term_link($test->slug, 'category'); ?>" class="item-link"><?php echo $test->name; ?></a>
                </li>
                <?php
                $args = array(
                    'type'      => 'post',
                    'child_of'  => 0,
                    'parent'    => $test->term_id,
                    'hide_empty' => 0,
                    'taxonomy' => 'category',
                    'number' => 3
                );
                $categories = get_categories($args);
                foreach ($categories as $category) { ?>
                    <li class="item">
                        <a href="<?php echo get_term_link($category->slug, 'category'); ?>" class="item-link"><?php echo $category->name; ?></a>
                    </li>
                <?php } ?>
            </ul>
            <div class="widget">
                <div class="form-wrapper">
                    <form action="<?php get_permalink() ?> " method="GET" role="form">
                        <input type="text" name='s' class="form-control" id="search" placeholder="Nhập từ khóa ">
                        <button class="btn" id="submit" type="submit" style="border:1px solid #ccc">Tìm kiếm</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="astra">
            <section class="list-bottom">
                <div class="list">
                    <?php if (have_posts()) : ?>
                        <?php while (have_posts()) : the_post(); ?>
                            <div class="item">
                                <a href="<?php the_permalink(); ?>"><?php echo get_the_post_thumbnail(get_the_id(), 'full', array('class' => 'thumnail')); ?></a>
                                <p class="name">Sự kiện</p>
                                <h2 class="title">
                                    <?php the_title(); ?>
                                </h2>
                                <p class="desc">
                                    <?php the_excerpt(); ?>
                                </p>
                                <p class="time"><?php echo get_the_date('d - m - Y'); ?></p>
                                <div class="line"></div>
                            </div>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>
            </section>
        </div>
        <?php get_template_part('contact'); ?>
    </div>
</main>

<?php get_footer() ?>