<?php
define('wp2023_path', plugin_dir_path(__FILE__));

function theme_settup()
{
    register_nav_menu('topmenu', __('Menu chính'));
    add_theme_support('post-thumbnails');
    add_theme_support('title-tag');
    add_theme_support('editor-styles');

    $args = array(
        'default-color' => 'fff',
    );
    add_theme_support('custom-background', $args);


    if (function_exists('register_sidebar')) {
        register_sidebar(array(
            'name' => 'cột bên sidebar',
            'id' => 'sidebar'
        ));
    }
}
add_action('init', 'theme_settup');


function the_breadcrumb()
{
    echo '<ul id="crumbs">';
    if (!is_home()) {
        echo '<a href="';
        echo get_option('home');
        echo '">';
        echo '<img src=""/>Home';
        echo "</a> >> ";
        if (is_category() || is_single()) {
            the_category(' >> ');
            if (is_single()) {
                '<strong style="color:red;">' . the_title(' >> ') . '</strong>';
            }
        } elseif (is_page()) {
            echo the_title(' >> ');
        }
    } elseif (is_tag()) {
        single_tag_title();
    } elseif (is_day()) {
        echo "<li>Archive for ";
        the_time('F jS, Y');
        echo '</li>';
    } elseif (is_month()) {
        echo "<li>Archive for ";
        the_time('F, Y');
        echo '</li>';
    } elseif (is_year()) {
        echo "<li>Archive for ";
        the_time('Y');
        echo '</li>';
    } elseif (is_author()) {
        echo "<li>Author Archive";
        echo '</li>';
    } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {
        echo "<li>Blog Archives";
        echo '</li>';
    } elseif (is_search()) {
        echo "<li>Search Results";
        echo '</li>';
    }
    echo '</ul>';
}

function themename_custom_logo_setup()
{
    $defaults = array(
        'height'               => 100,
        'width'                => 400,
        'flex-height'          => true,
        'flex-width'           => true,
        'header-text'          => array('site-title', 'site-description'),
        'unlink-homepage-logo' => true,
    );
    add_theme_support('custom-logo', $defaults);
}
add_action('after_setup_theme', 'themename_custom_logo_setup');





//yêu cầu plugin cần thiết 
function showAdminMessages()
{
    $plugins_requires = array(

        'Advanced Custom Field' => 'advanced-custom-fields/advanced-custom-fields.php'
    );

    $plugin_messages = array();

    include_once(ABSPATH . 'wp-admin/includes/plugin.php');

    foreach ($plugins_requires as $name => $active_file) {
        $result = validate_plugin($active_file);

        if (is_wp_error($result)) {
            $plugin_messages[] = 'This theme requires you to <strong>install</strong> the <strong>' . $name . '</strong> plugin';
        } else {
            if (!is_plugin_active($active_file)) {
                $plugin_messages[] = 'This theme requires you to <strong>active</strong> the <strong>' . $name . '</strong> plugin';
            }
        }
    }

    if (count($plugin_messages) > 0) {
        echo '<div id="message" class="error">';

        foreach ($plugin_messages as $message) {
            echo '<p>' . $message . '</p>';
        }
        echo '<p><strong><a href="' . admin_url('plugins.php') . '" class="button">Check Now</a></strong></p>';

        echo '</div>';
    }
}
add_action('admin_notices', 'showAdminMessages');




function truongnguyen_meta_box()
{
    add_meta_box('thong_tin', 'Thông tin ứng dụng', 'truongnguyen_thongtin_output', 'page');
}
add_action('add_meta_boxes', 'truongnguyen_meta_box');

function truongnguyen_thongtin_output($post)
{
?>
        <?php include_once wp2023_path . "/template-parts/templateThongTin.php"; ?>
    <?php
}

function truongnguyen_thongtin_save($post_id)
{
    if ($_REQUEST['post_type'] == 'page') {
        $companyName = sanitize_text_field($_POST['companyName']);
        $descriptCompany = sanitize_text_field($_POST['descriptCompany']);
    }
    update_post_meta($post_id, 'companyName', $companyName);
    update_post_meta($post_id, 'descriptCompany', $descriptCompany);
}
add_action('save_post', 'truongnguyen_thongtin_save');




//Custom Headers
function themename_custom_header_setup()
{
    $args = array(
        'default-image'      => get_template_directory_uri() . '/images/hero-bg.png',
        'default-text-color' => '000',
        'width'              => 1000,
        'height'             => 250,
        'flex-width'         => true,
        'flex-height'        => true,
    );
    add_theme_support('custom-header', $args);
}
add_action('after_setup_theme', 'themename_custom_header_setup');
add_theme_support('custom-header');


if (function_exists('acf_add_options_page')) {
    acf_add_options_page(array(
        'page_title'     => 'Theme options',
        'menu_title'    => 'Theme options',
        'menu_slug'     => 'theme-settings',
        'capability'    => 'edit_posts',
        'redirect'    => false
    ));
}



if (function_exists('acf_add_options_page')) {

    acf_add_options_page();
}


// function my_skip_mail($f){
//     $submission = WPCF7_Submission::get_instance();
//     return true; // DO NOT SEND E-MAIL    
// }
// add_filter('wpcf7_skip_mail','my_skip_mail');


// add_action('customize_register', 'add_second_tagline');
// function add_second_tagline($wp_customize)
// {

//     $wp_customize->add_setting('second_tagline', array(
//         'default' => '',
//         'capability' => 'edit_theme_options'
//     ));

//     $wp_customize->add_control('second_tagline', array(
//         'label' => 'Second Tagline',
//         'section' => 'title_tagline',
//         'type' => 'text'
//     ));
// }



add_action('acf/include_fields', function () {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }

    acf_add_local_field_group(
        array(
            'key' => 'group_647558a047ed9',
            'title' => 'About Wed',
            'fields' => array(
                array(
                    'key' => 'field_647558a00ffe4',
                    'label' => 'About Content',
                    'name' => 'about_content',
                    'aria-label' => '',
                    'type' => 'repeater',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'layout' => 'row',
                    'pagination' => 0,
                    'min' => 1,
                    'max' => 1,
                    'collapsed' => '',
                    'button_label' => 'Add Row',
                    'rows_per_page' => 20,
                    'sub_fields' => array(
                        array(
                            'key' => 'field_6475590212221',
                            'label' => 'About Image',
                            'name' => 'about_image',
                            'aria-label' => '',
                            'type' => 'image',
                            'instructions' => '',
                            'required' => 0,
                            'conditional_logic' => 0,
                            'wrapper' => array(
                                'width' => '',
                                'class' => '',
                                'id' => '',
                            ),
                            'return_format' => 'array',
                            'library' => 'all',
                            'min_width' => '',
                            'min_height' => '',
                            'min_size' => '',
                            'max_width' => '',
                            'max_height' => '',
                            'max_size' => '',
                            'mime_types' => '',
                            'preview_size' => 'medium',
                            'parent_repeater' => 'field_647558a00ffe4',
                        ),
                        array(
                            'key' => 'field_6475592d12222',
                            'label' => 'About Title',
                            'name' => 'about_title',
                            'aria-label' => '',
                            'type' => 'text',
                            'instructions' => '',
                            'required' => 0,
                            'conditional_logic' => 0,
                            'wrapper' => array(
                                'width' => '',
                                'class' => '',
                                'id' => '',
                            ),
                            'default_value' => '',
                            'maxlength' => '',
                            'placeholder' => '',
                            'prepend' => '',
                            'append' => '',
                            'parent_repeater' => 'field_647558a00ffe4',
                        ),
                        array(
                            'key' => 'field_6475594712223',
                            'label' => 'About Heading',
                            'name' => 'about_heading',
                            'aria-label' => '',
                            'type' => 'text',
                            'instructions' => '',
                            'required' => 0,
                            'conditional_logic' => 0,
                            'wrapper' => array(
                                'width' => '',
                                'class' => '',
                                'id' => '',
                            ),
                            'default_value' => '',
                            'maxlength' => '',
                            'placeholder' => '',
                            'prepend' => '',
                            'append' => '',
                            'parent_repeater' => 'field_647558a00ffe4',
                        ),
                        array(
                            'key' => 'field_6475595512224',
                            'label' => 'About Description',
                            'name' => 'about_description',
                            'aria-label' => '',
                            'type' => 'repeater',
                            'instructions' => '',
                            'required' => 0,
                            'conditional_logic' => 0,
                            'wrapper' => array(
                                'width' => '',
                                'class' => '',
                                'id' => '',
                            ),
                            'layout' => 'row',
                            'pagination' => 0,
                            'min' => 0,
                            'max' => 2,
                            'collapsed' => '',
                            'button_label' => 'Add Row',
                            'rows_per_page' => 20,
                            'sub_fields' => array(
                                array(
                                    'key' => 'field_6475599412225',
                                    'label' => 'Desctiption Heading',
                                    'name' => 'desctiption_heading',
                                    'aria-label' => '',
                                    'type' => 'text',
                                    'instructions' => '',
                                    'required' => 0,
                                    'conditional_logic' => 0,
                                    'wrapper' => array(
                                        'width' => '',
                                        'class' => '',
                                        'id' => '',
                                    ),
                                    'default_value' => '',
                                    'maxlength' => '',
                                    'placeholder' => '',
                                    'prepend' => '',
                                    'append' => '',
                                    'parent_repeater' => 'field_6475595512224',
                                ),
                                array(
                                    'key' => 'field_647559b912226',
                                    'label' => 'Dectiption Content',
                                    'name' => 'dectiption_content',
                                    'aria-label' => '',
                                    'type' => 'text',
                                    'instructions' => '',
                                    'required' => 0,
                                    'conditional_logic' => 0,
                                    'wrapper' => array(
                                        'width' => '',
                                        'class' => '',
                                        'id' => '',
                                    ),
                                    'default_value' => '',
                                    'maxlength' => '',
                                    'placeholder' => '',
                                    'prepend' => '',
                                    'append' => '',
                                    'parent_repeater' => 'field_6475595512224',
                                ),
                            ),
                            'parent_repeater' => 'field_647558a00ffe4',
                        ),
                    ),
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'page_type',
                        'operator' => '==',
                        'value' => 'front_page',
                    ),
                ),
            ),
            'menu_order' => 0,
            'position' => 'normal',
            'style' => 'default',
            'label_placement' => 'top',
            'instruction_placement' => 'label',
            'hide_on_screen' => '',
            'active' => true,
            'description' => '',
            'show_in_rest' => 0,
        )
    );

    acf_add_local_field_group(
        array(
            'key' => 'group_647479f950832',
            'title' => 'Contact Form',
            'fields' => array(
                array(
                    'key' => 'field_647479f9dadb1',
                    'label' => 'Contact Info',
                    'name' => 'contact_info',
                    'aria-label' => '',
                    'type' => 'repeater',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'layout' => 'row',
                    'pagination' => 0,
                    'min' => 3,
                    'max' => 3,
                    'collapsed' => '',
                    'button_label' => 'Add Row',
                    'rows_per_page' => 20,
                    'sub_fields' => array(
                        array(
                            'key' => 'field_64747a6bdadb2',
                            'label' => 'Contact Icon',
                            'name' => 'contact_icon',
                            'aria-label' => '',
                            'type' => 'image',
                            'instructions' => '',
                            'required' => 0,
                            'conditional_logic' => 0,
                            'wrapper' => array(
                                'width' => '',
                                'class' => '',
                                'id' => '',
                            ),
                            'return_format' => 'array',
                            'library' => 'all',
                            'min_width' => '',
                            'min_height' => '',
                            'min_size' => '',
                            'max_width' => '',
                            'max_height' => '',
                            'max_size' => '',
                            'mime_types' => '',
                            'preview_size' => 'medium',
                            'parent_repeater' => 'field_647479f9dadb1',
                        ),
                        array(
                            'key' => 'field_64747b46dadb3',
                            'label' => 'Contact Title',
                            'name' => 'contact_title',
                            'aria-label' => '',
                            'type' => 'text',
                            'instructions' => '',
                            'required' => 0,
                            'conditional_logic' => 0,
                            'wrapper' => array(
                                'width' => '',
                                'class' => '',
                                'id' => '',
                            ),
                            'default_value' => '',
                            'maxlength' => '',
                            'placeholder' => '',
                            'prepend' => '',
                            'append' => '',
                            'parent_repeater' => 'field_647479f9dadb1',
                        ),
                        array(
                            'key' => 'field_64747b62dadb4',
                            'label' => 'Contact Description',
                            'name' => 'contact_description',
                            'aria-label' => '',
                            'type' => 'text',
                            'instructions' => '',
                            'required' => 0,
                            'conditional_logic' => 0,
                            'wrapper' => array(
                                'width' => '',
                                'class' => '',
                                'id' => '',
                            ),
                            'default_value' => '',
                            'maxlength' => '',
                            'placeholder' => '',
                            'prepend' => '',
                            'append' => '',
                            'parent_repeater' => 'field_647479f9dadb1',
                        ),
                    ),
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'options_page',
                        'operator' => '==',
                        'value' => 'akadon-settings',
                    ),
                ),
            ),
            'menu_order' => 0,
            'position' => 'normal',
            'style' => 'default',
            'label_placement' => 'top',
            'instruction_placement' => 'label',
            'hide_on_screen' => '',
            'active' => true,
            'description' => '',
            'show_in_rest' => 0,
        )
    );

    acf_add_local_field_group(
        array(
            'key' => 'group_64742e1600300',
            'title' => 'Home Page Settings',
            'fields' => array(
                array(
                    'key' => 'field_64742e16d5e29',
                    'label' => 'Hero Title',
                    'name' => 'hero_title',
                    'aria-label' => '',
                    'type' => 'text',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => 'Nền tảng kết nối gia sư và học viên hàng đầu Hiện nay!',
                    'maxlength' => '',
                    'placeholder' => '',
                    'prepend' => '',
                    'append' => '',
                ),
                array(
                    'key' => 'field_6474457162542',
                    'label' => 'Hero Description',
                    'name' => 'hero_description',
                    'aria-label' => '',
                    'type' => 'text',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Odio vitae cum fermentum vivamus elit dui tempus. Pharetra id bibendum lorem consectetur venenatis. At felis egestas faucibus tincidunt pulvinar nibh quam eu. Mattis congue donec phasellus adipiscing faucibus massa turpis vel, nam.',
                    'maxlength' => '',
                    'placeholder' => '',
                    'prepend' => '',
                    'append' => '',
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'page_type',
                        'operator' => '==',
                        'value' => 'front_page',
                    ),
                ),
            ),
            'menu_order' => 0,
            'position' => 'normal',
            'style' => 'default',
            'label_placement' => 'top',
            'instruction_placement' => 'label',
            'hide_on_screen' => '',
            'active' => true,
            'description' => '',
            'show_in_rest' => 0,
        )
    );

    acf_add_local_field_group(
        array(
            'key' => 'group_6474522ac1fc5',
            'title' => 'Options',
            'fields' => array(
                array(
                    'key' => 'field_647561f38ef97',
                    'label' => 'Tên Công Ty',
                    'name' => 'ten_cong_ty',
                    'aria-label' => '',
                    'type' => 'text',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '',
                    'maxlength' => '',
                    'placeholder' => '',
                    'prepend' => '',
                    'append' => '',
                ),
                array(
                    'key' => 'field_6474522a91e14',
                    'label' => 'Mã số doanh nghiệp',
                    'name' => 'ma_so_doanh_nghiep',
                    'aria-label' => '',
                    'type' => 'text',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '0107979500',
                    'maxlength' => '',
                    'placeholder' => '',
                    'prepend' => '',
                    'append' => '',
                ),
                array(
                    'key' => 'field_6474525991e15',
                    'label' => 'Đại diện doanh nghiệp',
                    'name' => 'dai_dien_doanh_nghiep',
                    'aria-label' => '',
                    'type' => 'text',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => 'Văn Thị Thu Nhiên',
                    'maxlength' => '',
                    'placeholder' => '',
                    'prepend' => '',
                    'append' => '',
                ),
                array(
                    'key' => 'field_6474527791e16',
                    'label' => 'Chức vụ',
                    'name' => 'chuc_vu',
                    'aria-label' => '',
                    'type' => 'text',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => 'Giám đốc điều hành',
                    'maxlength' => '',
                    'placeholder' => '',
                    'prepend' => '',
                    'append' => '',
                ),
                array(
                    'key' => 'field_6474528f91e17',
                    'label' => 'Facebook',
                    'name' => 'facebook',
                    'aria-label' => '',
                    'type' => 'url',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '',
                    'placeholder' => '',
                ),
                array(
                    'key' => 'field_647452a091e18',
                    'label' => 'Instagram',
                    'name' => 'instagram',
                    'aria-label' => '',
                    'type' => 'url',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '',
                    'placeholder' => '',
                ),
                array(
                    'key' => 'field_647452d291e19',
                    'label' => 'Twitter',
                    'name' => 'twitter',
                    'aria-label' => '',
                    'type' => 'url',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '',
                    'placeholder' => '',
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'options_page',
                        'operator' => '==',
                        'value' => 'akadon-settings',
                    ),
                ),
            ),
            'menu_order' => 0,
            'position' => 'normal',
            'style' => 'default',
            'label_placement' => 'top',
            'instruction_placement' => 'label',
            'hide_on_screen' => '',
            'active' => true,
            'description' => '',
            'show_in_rest' => 0,
        )
    );

    acf_add_local_field_group(
        array(
            'key' => 'group_64755dd0e7b89',
            'title' => 'Service Wed',
            'fields' => array(
                array(
                    'key' => 'field_64755dd1fc74d',
                    'label' => 'Service Heading',
                    'name' => 'service_heading',
                    'aria-label' => '',
                    'type' => 'text',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '',
                    'maxlength' => '',
                    'placeholder' => '',
                    'prepend' => '',
                    'append' => '',
                ),
                array(
                    'key' => 'field_64755dfefc74e',
                    'label' => 'Service Title',
                    'name' => 'service_title',
                    'aria-label' => '',
                    'type' => 'text',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '',
                    'maxlength' => '',
                    'placeholder' => '',
                    'prepend' => '',
                    'append' => '',
                ),
                array(
                    'key' => 'field_64755e11fc74f',
                    'label' => 'Service Item',
                    'name' => 'service_item',
                    'aria-label' => '',
                    'type' => 'repeater',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'layout' => 'row',
                    'pagination' => 0,
                    'min' => 4,
                    'max' => 4,
                    'collapsed' => '',
                    'button_label' => 'Add Row',
                    'rows_per_page' => 20,
                    'sub_fields' => array(
                        array(
                            'key' => 'field_64755fb6aae5d',
                            'label' => 'Service Item Icon',
                            'name' => 'service_item_icon',
                            'aria-label' => '',
                            'type' => 'image',
                            'instructions' => '',
                            'required' => 0,
                            'conditional_logic' => 0,
                            'wrapper' => array(
                                'width' => '',
                                'class' => '',
                                'id' => '',
                            ),
                            'return_format' => 'array',
                            'library' => 'all',
                            'min_width' => '',
                            'min_height' => '',
                            'min_size' => '',
                            'max_width' => '',
                            'max_height' => '',
                            'max_size' => '',
                            'mime_types' => '',
                            'preview_size' => 'medium',
                            'parent_repeater' => 'field_64755e11fc74f',
                        ),
                        array(
                            'key' => 'field_64755e32fc750',
                            'label' => 'Service Item Title',
                            'name' => 'service_item_title',
                            'aria-label' => '',
                            'type' => 'text',
                            'instructions' => '',
                            'required' => 0,
                            'conditional_logic' => 0,
                            'wrapper' => array(
                                'width' => '',
                                'class' => '',
                                'id' => '',
                            ),
                            'default_value' => '',
                            'maxlength' => '',
                            'placeholder' => '',
                            'prepend' => '',
                            'append' => '',
                            'parent_repeater' => 'field_64755e11fc74f',
                        ),
                        array(
                            'key' => 'field_64755e65fc751',
                            'label' => 'Service Item Description',
                            'name' => 'service_item_description',
                            'aria-label' => '',
                            'type' => 'wysiwyg',
                            'instructions' => '',
                            'required' => 0,
                            'conditional_logic' => 0,
                            'wrapper' => array(
                                'width' => '',
                                'class' => '',
                                'id' => '',
                            ),
                            'default_value' => '',
                            'tabs' => 'all',
                            'toolbar' => 'full',
                            'media_upload' => 1,
                            'delay' => 0,
                            'parent_repeater' => 'field_64755e11fc74f',
                        ),
                    ),
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'page_type',
                        'operator' => '==',
                        'value' => 'front_page',
                    ),
                ),
            ),
            'menu_order' => 0,
            'position' => 'normal',
            'style' => 'default',
            'label_placement' => 'top',
            'instruction_placement' => 'label',
            'hide_on_screen' => '',
            'active' => true,
            'description' => '',
            'show_in_rest' => 0,
        )
    );
});
