<?php
// Tablas personalizadas y otras funciones 
require get_template_directory() . '/inc/database.php';
// Funciones para las reservaciones
require get_template_directory() . '/inc/reservaciones.php';


function bitdevelopertech_setup(){
    add_theme_support('post-thumbnails');
    add_image_size('nosotros', 437, 291, true);
    add_image_size('Trabajadores', 768, 515, true);
    }
add_action('after_setup_theme', 'bitdevelopertech_setup');
function bitdevelopertech_styles(){
    //Registro de estilos
        wp_register_style('normalize', get_template_directory_uri() . '/css/normalize.css', array(), '8.0.1');
        wp_register_style('google_fonts', 'https://fonts.googleapis.com/css?family=Poppins:400,700,900|Roboto', array(), '1.0.0');
        wp_register_style('fontawesome', get_template_directory_uri() . '/css/font-awesome.min.css', array('normalize'), '4.7.0');
        wp_register_style('style', get_template_directory_uri() . '/style.css', array('normalize'), '1.0');
    
    //Llamada de estilos
        wp_enqueue_style('normalize');
        wp_enqueue_style('fontawesome');
        wp_enqueue_style('style');
    
    //Registro de JavaScript
        wp_register_script('scripts', get_template_directory_uri() . '/js/scripts.js', array(), '1.0.0', true);
        wp_enqueue_script('jquery');
        wp_enqueue_script('scripts');
}
add_action('wp_enqueue_scripts', 'bitdevelopertech_styles');
// Creación de menus
function bitdevelopertech_menus(){
    register_nav_menus(array(
        'header-menu' => __('Header Menu', 'bitdevelopertech'),
        'social-menu' => __('Social Menu', 'bitdevelopertech')
    ));
}
add_action('init', 'bitdevelopertech_menus');
//Custom POST_TYPE
add_action( 'init', 'bitdevelopertech_equipotrabajo' );
function bitdevelopertech_equipotrabajo() {
	$labels = array(
		'name'               => _x( 'Trabajadores', 'bitdevelopertech' ),
		'singular_name'      => _x( 'Trabajadores', 'post type singular name', 'bitdevelopertech' ),
		'menu_name'          => _x( 'Trabajadores', 'admin menu', 'bitdevelopertech' ),
		'name_admin_bar'     => _x( 'Trabajadores', 'add new on admin bar', 'bitdevelopertech' ),
		'add_new'            => _x( 'Add New', 'book', 'bitdevelopertech' ),
		'add_new_item'       => __( 'Add New Trabajador', 'bitdevelopertech' ),
		'new_item'           => __( 'New Trabajadores', 'bitdevelopertech' ),
		'edit_item'          => __( 'Edit Trabajadores', 'bitdevelopertech' ),
		'view_item'          => __( 'View Trabajadores', 'bitdevelopertech' ),
		'all_items'          => __( 'All Trabajadores', 'bitdevelopertech' ),
		'search_items'       => __( 'Search Trabajadores', 'bitdevelopertech' ),
		'parent_item_colon'  => __( 'Parent Trabajadores:', 'bitdevelopertech' ),
		'not_found'          => __( 'No Trabajadors found.', 'bitdevelopertech' ),
		'not_found_in_trash' => __( 'No Trabajadors found in Trash.', 'bitdevelopertech' )
	);
	$args = array(
		'labels'             => $labels,
    'description'        => __( 'Description.', 'bitdevelopertech' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'equipotrabajo' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 6,
		'supports'           => array( 'title', 'editor', 'thumbnail' ),
        'taxonomies'          => array( 'category' ),
	);
	register_post_type( 'equipotrabajo', $args );
}


/************************************************************************** 11/02/2019 ***************************************************************************/


// Widgets

function bitdevelopertech_widgets() {
    register_sidebar( array(
        'name' => 'Blog Sidebar',
        'id' => 'blog_sidebar',
        'before_widget' =>  '<div class="widget">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>' 
    );)
}

add_action('widgets_init', 'bitdevelopertech_widgets');