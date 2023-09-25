<?php
/**
 * Genesis Sample.
 *
 * This file adds the default theme settings to the Genesis Sample Theme.
 *
 * @package Genesis Sample
 * @author  StudioPress
 * @license GPL-2.0+
 * @link    http://www.studiopress.com/
 */

add_filter( 'genesis_theme_settings_defaults', 'genesis_sample_theme_defaults' );
/**
* Updates theme settings on reset.
*
* @since 2.2.3
*/
function genesis_sample_theme_defaults( $defaults ) {

	$defaults['blog_cat_num']              = 6;
	$defaults['content_archive']           = 'full';
	$defaults['content_archive_limit']     = 0;
	$defaults['content_archive_thumbnail'] = 0;
	$defaults['posts_nav']                 = 'numeric';
	$defaults['site_layout']               = 'content-sidebar';

	return $defaults;

}

add_action( 'after_switch_theme', 'genesis_sample_theme_setting_defaults' );
/**
* Updates theme settings on activation.
*
* @since 2.2.3
*/
function genesis_sample_theme_setting_defaults() {

	if ( function_exists( 'genesis_update_settings' ) ) {

		genesis_update_settings( array(
			'blog_cat_num'              => 6,
			'content_archive'           => 'full',
			'content_archive_limit'     => 0,
			'content_archive_thumbnail' => 0,
			'posts_nav'                 => 'numeric',
			'site_layout'               => 'content-sidebar',
		) );

	}

	update_option( 'posts_per_page', 6 );

}

/*********************************************
*	Register Custom Post Type
*********************************************/
function custom_post_type1() {

	$labels = array(
		'name'                  => _x( 'Testimonios', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Testimonios', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Testimonios', 'text_domain' ),
		'name_admin_bar'        => __( 'Testimonio', 'text_domain' ),
		'archives'              => __( 'Item Testimonios', 'text_domain' ),
		'attributes'            => __( 'Item Testimonio', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
		'all_items'             => __( 'All Items', 'text_domain' ),
		'add_new_item'          => __( 'Add New Item', 'text_domain' ),
		'add_new'               => __( 'Add New', 'text_domain' ),
		'new_item'              => __( 'New Item', 'text_domain' ),
		'edit_item'             => __( 'Edit Item', 'text_domain' ),
		'update_item'           => __( 'Update Item', 'text_domain' ),
		'view_item'             => __( 'View Item', 'text_domain' ),
		'view_items'            => __( 'View Items', 'text_domain' ),
		'search_items'          => __( 'Search Item', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
		'items_list'            => __( 'Items list', 'text_domain' ),
		'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( 'Testimonio', 'text_domain' ),
		'description'           => __( 'Testimonios', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'thumbnail','editor', 'excerpt' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'menu_icon'           	=> 'dashicons-editor-quote',
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'Testimonio', $args );

}
add_action( 'init', 'custom_post_type1', 0 );

function custom_post_type2() {

	$labels = array(
		'name'                  => _x( 'Eventos', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Eventos', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Eventos', 'text_domain' ),
		'name_admin_bar'        => __( 'Evento', 'text_domain' ),
		'archives'              => __( 'Item Eventos', 'text_domain' ),
		'attributes'            => __( 'Item Evento', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
		'all_items'             => __( 'All Items', 'text_domain' ),
		'add_new_item'          => __( 'Add New Item', 'text_domain' ),
		'add_new'               => __( 'Add New', 'text_domain' ),
		'new_item'              => __( 'New Item', 'text_domain' ),
		'edit_item'             => __( 'Edit Item', 'text_domain' ),
		'update_item'           => __( 'Update Item', 'text_domain' ),
		'view_item'             => __( 'View Item', 'text_domain' ),
		'view_items'            => __( 'View Items', 'text_domain' ),
		'search_items'          => __( 'Search Item', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
		'items_list'            => __( 'Items list', 'text_domain' ),
		'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( 'Evento', 'text_domain' ),
		'description'           => __( 'Eventos', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'thumbnail','editor', 'excerpt' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'menu_icon'           	=> 'dashicons-calendar-alt',
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'Evento', $args );

}
add_action( 'init', 'custom_post_type2', 0 );

function custom_post_type_cursos() {

	$labels = array(
		'name'                  => _x( 'Cursos', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Cursos', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Cursos', 'text_domain' ),
		'name_admin_bar'        => __( 'Cursos', 'text_domain' ),
		'archives'              => __( 'Item Cursos', 'text_domain' ),
		'attributes'            => __( 'Item Cursos', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
		'all_items'             => __( 'All Items', 'text_domain' ),
		'add_new_item'          => __( 'Add New Item', 'text_domain' ),
		'add_new'               => __( 'Add New', 'text_domain' ),
		'new_item'              => __( 'New Item', 'text_domain' ),
		'edit_item'             => __( 'Edit Item', 'text_domain' ),
		'update_item'           => __( 'Update Item', 'text_domain' ),
		'view_item'             => __( 'View Item', 'text_domain' ),
		'view_items'            => __( 'View Items', 'text_domain' ),
		'search_items'          => __( 'Search Item', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
		'items_list'            => __( 'Items list', 'text_domain' ),
		'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( 'Cursos', 'text_domain' ),
		'description'           => __( 'Cursos', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'thumbnail','editor', 'excerpt' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'menu_icon'           	=> 'dashicons-welcome-learn-more',
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'Cursos', $args );

}
add_action( 'init', 'custom_post_type_cursos', 0 );
/*********************************************
*	default option submenu
*********************************************/
add_action('genesis_after_header', 'submenu_pages');
function submenu_pages() {
	if ( !is_page( 'home' ) ) {
		?>
		<div class="content-submenu">
			<div class="wrap">
				<div class="row">
					<?php
					$menu_items = wp_get_nav_menu_items( 'main-menu' );
					$this_item = current( wp_filter_object_list( $menu_items, array( 'object_id' => get_queried_object_id() ) ) );

					$pages = wp_filter_object_list( $wp_query->posts, array('post_type' => 'page'));

					// print_r($page);
					?>
					<div class="col-8 col-sm-8 col-md-8 top-left">
						<!-- <a href="<?php echo get_home_url() ?>">HOME</a>
						<span><?php echo $this_item->title ?></span> -->
						<div class="breadcrumbs" typeof="BreadcrumbList" vocab="http://schema.org/">
						    <?php 
						    if (is_singular('post')){
							  	the_breadcrumb();
							}
						    elseif(!is_singular('post') && !is_category()){
						    	if(function_exists('bcn_display')){
							        bcn_display();
							    }
						    } elseif(is_category()){
						    	the_breadcrumb();
						    }
						    
						    ?>
						</div>
					</div>
					<div class="col-4 col-sm-4 col-md-4 top-right">
						<a href="https://www.facebook.com/yazzcontla/"><i class="fab fa-facebook-f"></i></a>
						<a href="https://www.instagram.com/yazzcontla/"><i class="fab fa-instagram"></i></a>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
}
