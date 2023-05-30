<?php 
define('wp2023_path',plugin_dir_path(__FILE__));

function theme_settup(){
    register_nav_menu('topmenu',__( 'Menu chính' ));
    add_theme_support('post-thumbnails');
    add_theme_support('title-tag');

    $args = array(
        'default-color' => 'fff',
    );
    add_theme_support( 'custom-background', $args );


    if(function_exists('register_sidebar')){
        register_sidebar(array(
            'name' => 'cột bên sidebar',
            'id' => 'sidebar'
        ));
    }

   
}
add_action('init', 'theme_settup');


function the_breadcrumb() {
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
                   '<strong style="color:red;">'.the_title(' >> ').'</strong>' ;
            }
    } elseif (is_page()) {
            echo the_title(' >> ');
    }
    }
    elseif (is_tag()) {single_tag_title();}
    elseif (is_day()) {echo"<li>Archive for "; the_time('F jS, Y'); echo'</li>';}
    elseif (is_month()) {echo"<li>Archive for "; the_time('F, Y'); echo'</li>';}
    elseif (is_year()) {echo"<li>Archive for "; the_time('Y'); echo'</li>';}
    elseif (is_author()) {echo"<li>Author Archive"; echo'</li>';}
    elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {echo "<li>Blog Archives"; echo'</li>';}
    elseif (is_search()) {echo"<li>Search Results"; echo'</li>';}
    echo '</ul>';
}

function themename_custom_logo_setup() {
	$defaults = array(
		'height'               => 100,
		'width'                => 400,
		'flex-height'          => true,
		'flex-width'           => true,
		'header-text'          => array( 'site-title', 'site-description' ),
		'unlink-homepage-logo' => true, 
	);
	add_theme_support( 'custom-logo', $defaults );
}
add_action( 'after_setup_theme', 'themename_custom_logo_setup' );





//yêu cầu plugin cần thiết 
function showAdminMessages()
{
    $plugins_requires = array(
        
        'Advanced Custom Field' => 'advanced-custom-fields/advanced-custom-fields.php'
    );

    $plugin_messages = array();

    include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

    foreach ($plugins_requires as $name => $active_file) {
        $result = validate_plugin( $active_file );

        if(is_wp_error( $result )){
            $plugin_messages[] = 'This theme requires you to <strong>install</strong> the <strong>'.$name.'</strong> plugin';
        }else{
            if(!is_plugin_active( $active_file ))
            {
                $plugin_messages[] = 'This theme requires you to <strong>active</strong> the <strong>'.$name.'</strong> plugin';
            }
        }
    }

    if(count($plugin_messages) > 0)
    {
        echo '<div id="message" class="error">';

            foreach($plugin_messages as $message)
            {
                echo '<p>'.$message.'</p>';
            }
            echo '<p><strong><a href="' . admin_url( 'plugins.php' ) .'" class="button">Check Now</a></strong></p>';

        echo '</div>';
    }
}
add_action('admin_notices', 'showAdminMessages');




function truongnguyen_meta_box(){
    add_meta_box('thong_tin','Thông tin ứng dụng','truongnguyen_thongtin_output','page');
}
add_action('add_meta_boxes', 'truongnguyen_meta_box');

function truongnguyen_thongtin_output($post){
    ?>
        <?php include_once wp2023_path."/template-parts/templateThongTin.php"; ?>
    <?php
}

function truongnguyen_thongtin_save($post_id){
    if($_REQUEST['post_type']=='page'){
        $companyName =sanitize_text_field($_POST['companyName']);
        $descriptCompany =sanitize_text_field($_POST['descriptCompany']);
    }
    update_post_meta($post_id,'companyName',$companyName);
    update_post_meta($post_id,'descriptCompany',$descriptCompany);
}
add_action('save_post','truongnguyen_thongtin_save');




//Custom Headers
function themename_custom_header_setup() {
	$args = array(
		'default-image'      => get_template_directory_uri().'/images/hero-bg.png',
		'default-text-color' => '000',
		'width'              => 1000,
		'height'             => 250,
		'flex-width'         => true,
		'flex-height'        => true,
	);
	add_theme_support( 'custom-header', $args );
}
add_action( 'after_setup_theme', 'themename_custom_header_setup' );
add_theme_support( 'custom-header' );


if( function_exists('acf_add_options_page') ) {
	acf_add_options_page(array(
		'page_title' 	=> 'Theme options', 
		'menu_title'	=> 'Theme options', 
		'menu_slug' 	=> 'theme-settings',
		'capability'	=> 'edit_posts',
		'redirect'	=> false
	));
}



if( function_exists('acf_add_options_page') ) {
    
    acf_add_options_page();
    
}


// function my_skip_mail($f){
//     $submission = WPCF7_Submission::get_instance();
//     return true; // DO NOT SEND E-MAIL    
// }
// add_filter('wpcf7_skip_mail','my_skip_mail');
