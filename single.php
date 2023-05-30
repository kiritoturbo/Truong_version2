<?php get_header() ;
global $wp_query;
?>
<main class="main" data-page="<?php echo get_query_var('paged') ? get_query_var('paged'):1; ?>"
    data-max="<?php echo $wp_query->max_num_pages;?>"
    >
    <div class="wrapper details">
        <div class="astra-details-nav">
            <div class="list">
                <?php the_breadcrumb(); ?>
            </div>
        </div>
        <div class="astra-details-content">
            <?php if (have_posts()) : ?>
                <?php while (have_posts()) : the_post(); ?>
                    <h1 class="heading">
                        <?php the_title(); ?>
                    </h1>
                    <div class="child">
                        <div class="name green">tin tức</div>
                        <div class="time">
                            <span><svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_101_270)">
                                        <path d="M10.8506 9.41291L8.61975 7.73979V4.3316C8.61975 3.98891 8.34275 3.71191 8.00006 3.71191C7.65737 3.71191 7.38037 3.98891 7.38037 4.3316V8.04966C7.38037 8.24485 7.47209 8.42891 7.62825 8.54541L10.1069 10.4044C10.2185 10.4881 10.3486 10.5284 10.4781 10.5284C10.6671 10.5284 10.853 10.4435 10.9745 10.2799C11.1803 10.0066 11.1245 9.61804 10.8506 9.41291Z" fill="#8F8F8F" />
                                        <path d="M8 0C3.58853 0 0 3.58853 0 8C0 12.4115 3.58853 16 8 16C12.4115 16 16 12.4115 16 8C16 3.58853 12.4115 0 8 0ZM8 14.7607C4.27266 14.7607 1.23934 11.7273 1.23934 8C1.23934 4.27266 4.27266 1.23934 8 1.23934C11.728 1.23934 14.7607 4.27266 14.7607 8C14.7607 11.7273 11.7273 14.7607 8 14.7607Z" fill="#8F8F8F" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_101_270">
                                            <rect width="16" height="16" fill="white" />
                                        </clipPath>
                                    </defs>
                                </svg>
                            </span>
                            <span><?php echo get_the_date('d/m/Y'); ?></span>
                        </div>
                    </div>
                    <article class='post-content'>
                        <?php the_content(); ?>
                    </article>
                <?php endwhile;
            else : ?>
            <?php endif; ?>
            <div class="list-bottom">
                <div class="head">
                    <h1 class="title">đọc thêm</h1>
                </div>
                <div class="list">
                    <?php
                        $args = array(
                            'post_status' => 'publish',
                            'showposts' => 3,
                            'offset' =>3
                        );
                    ?>
                    <?php $getposts = new WP_query($args); ?>
                    <?php global $wp_query;
                    $wp_query->in_the_loop = true; ?>
                    <?php while ($getposts->have_posts()) : $getposts->the_post(); ?>
                        <?php  include wp2023_path."/template-parts/item-content.php";?>
                    <?php endwhile;
                    wp_reset_postdata(); ?>
                </div>
            </div>
        </div>
        <?php get_template_part('contact'); ?>
    </div>
</main>

<?php get_footer() ?>