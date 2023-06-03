<?php get_header() ?>

<main class="main">
    <div class="wrapper details">
        <div class="astra-nav">
            <h1 style="text-transform: uppercase; margin-bottom:20px;"><?php single_cat_title(); ?></h1>

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
                <div class="form-wrapper animated wow slideInLeft animate__animated animate__delay-1s animate__fadeInTopLeft">
                    <form action="<?php get_permalink() ?> " method="GET" role="form">
                        <input type="text" name='s' class="form-control" id="search" placeholder="Nhập từ khóa ">
                        <button class="btn" id="submit" type="submit" style="border:1px solid #ccc">Tìm kiếm</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="astra">
            <section class="list-top">
                <div class="left wow slideInRight animate__animated animate__delay-1s animate__backInLeft">
                    <?php
                    $args = array(
                        'post_status' => 'publish',
                        'showposts' => 1,
                    );
                    ?>
                    <?php $getposts = new WP_query($args); ?>
                    <?php global $wp_query;
                    $wp_query->in_the_loop = true; ?>
                    <?php while ($getposts->have_posts()) : $getposts->the_post(); ?>
                        <a href="<?php the_permalink(); ?>"><?php echo get_the_post_thumbnail(get_the_id(), 'full', array('class' => 'thumnail')); ?></a>
                        <p class="name">Tin tức</p>
                        <h2 class="title"><?php the_title(); ?></h2>
                        <p class="desc">
                            <?php the_excerpt();
                            ?>
                        </p>
                        <p class="time"><?php echo get_the_date('d - m - Y'); ?></p>
                    <?php endwhile;
                    wp_reset_postdata(); ?>
                </div>

                <div class="right wow slideInRight animate__animated animate__delay-1s animate__backInRight">
                    <?php
                    $args = array(
                        'post_status' => 'publish',
                        'showposts' => 2,
                        'offset' => 1
                    );
                    ?>
                    <?php $getposts = new WP_query($args); ?>
                    <?php
                    global $wp_query;
                    $wp_query->in_the_loop = true;
                    ?>
                    <?php while ($getposts->have_posts()) : $getposts->the_post(); ?>
                        <?php include wp2023_path . "/template-parts/item-content.php"; ?>
                    <?php endwhile;
                    wp_reset_postdata(); ?>
                </div>

            </section>

            <section class="list-bottom">
                <div class="list">
                    <?php if (have_posts()) : ?>
                        <?php while (have_posts()) : the_post(); ?>
                            <?php include wp2023_path . "/template-parts/item-content.php"; ?>
                        <?php endwhile; ?>
                    <?php endif; ?>
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
            </section>
        </div>
        <?php get_template_part('contact'); ?>
    </div>
</main>

<?php get_footer() ?>