<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php bloginfo('name'); ?></title>
    <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/animate.min.css">
    <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/styles.css" />

    <?php wp_head(); ?>
</head>

<body <?php body_class() ?>>
    <header class="header ">
        <div class="wrapper">
            <label for="menu-input" class="menu-icon">
                <img src="<?php bloginfo('template_directory') ?>/images/menu-icon.png" alt="" />
            </label>
            <input type="checkbox" hidden class="menu-input" id="menu-input" />
            <div class="nav-mobile">
                <div class="wrap">
                    <div class="logo">
                        <a href="<?php bloginfo('url') ?>"><img style="max-width: 150px;height: 64px;object-fit:cover;" src="<?php echo ((get_field('image_logo'))['url']); ?>" alt="" /></a>
                    </div>
                    <label for="menu-input">
                        <img src="<?php bloginfo('template_directory') ?>/images/close-icon.png" alt="" />
                    </label>
                </div>
                <?php wp_nav_menu(
                    array(
                        'theme_location' => 'topmenu',
                        'container' => 'false',
                        'menu_id' => 'nav-list',
                        'menu_class' => 'nav-list'
                    )
                ); ?>
            </div>
            <div class="logo">
                <a href="<?php bloginfo('url') ?>">
                    <?php
                    $custom_logo_id = get_theme_mod('custom_logo');
                    $logo = wp_get_attachment_image_src($custom_logo_id, 'full');
                    if (has_custom_logo()) {
                        echo '<img style="max-width: 150px;height: 64px;object-fit:cover;" src="' . esc_url($logo[0]) . '" alt="' . get_bloginfo('name') . '">';
                    } else {
                        $logoCustom = ((get_field('image_logo'))['url']);
                        echo '<img class="animate__bounce"  style="max-width: 150px;height: 64px;object-fit:cover;" src="' . $logoCustom . ' ?>" alt="" />';
                    }
                    ?>
                </a>
            </div>
            <div class="nav">
                <?php wp_nav_menu(
                    array(
                        'theme_location' => 'topmenu',
                        'container' => 'false',
                        'menu_id' => 'nav-list',
                        'menu_class' => 'nav-list'
                    )
                ); ?>
            </div>
            <div class="language">
                <img class="language-flag" src="<?php bloginfo('template_directory') ?>/images/vietnam-flag.png" alt="" />
                <span class="language-name">Vietnamese</span>
                <span><svg width="7" height="5" viewBox="0 0 7 5" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 1.31472L3.68528 4L6.37056 1.31472" stroke="black" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </span>
            </div>
        </div>
    </header>