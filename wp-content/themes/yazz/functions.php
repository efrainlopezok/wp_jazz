<?php
/**
 * Yazz
 *
 * This file adds functions to the Yazz.
 * @package Yazz
 * @author  Yazz
 * @license GPL-2.0+
 * @link    http://www.yazz.com/
 */

// Start the engine.
include_once( get_template_directory() . '/lib/init.php' );

//* Start plugins
include_once( get_stylesheet_directory() . '/plugins/init.php' );


// Setup Theme.
include_once( get_stylesheet_directory() . '/lib/theme-defaults.php' );

//* Shortcodes Theme
include_once( get_stylesheet_directory() . '/lib/shortcodes.php' );

// Set Localization (do not remove).
add_action( 'after_setup_theme', 'genesis_sample_localization_setup' );
function genesis_sample_localization_setup(){
	load_child_theme_textdomain( 'genesis-sample', get_stylesheet_directory() . '/languages' );
}

// Add the helper functions.
include_once( get_stylesheet_directory() . '/lib/helper-functions.php' );

// Add Image upload and Color select to WordPress Theme Customizer.
require_once( get_stylesheet_directory() . '/lib/customize.php' );

// Include Customizer CSS.
include_once( get_stylesheet_directory() . '/lib/output.php' );

// Add WooCommerce support.
include_once( get_stylesheet_directory() . '/lib/woocommerce/woocommerce-setup.php' );

// Add the required WooCommerce styles and Customizer CSS.
include_once( get_stylesheet_directory() . '/lib/woocommerce/woocommerce-output.php' );

// Add the Genesis Connect WooCommerce notice.
include_once( get_stylesheet_directory() . '/lib/woocommerce/woocommerce-notice.php' );

// Child theme (do not remove).
define( 'CHILD_THEME_NAME', 'Yazz' );
define( 'CHILD_THEME_URL', 'http://www.yazz.com/' );
define( 'CHILD_THEME_VERSION', '2.3.0' );

// Enqueue Scripts and Styles.
add_action( 'wp_enqueue_scripts', 'genesis_sample_enqueue_scripts_styles' );
function genesis_sample_enqueue_scripts_styles() {
	
	wp_enqueue_style( 'genesis-sample-fonts', '//fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,700', array(), CHILD_THEME_VERSION );
	wp_enqueue_style( 'genesis-caveat-fonts', 'https://fonts.googleapis.com/css?family=Caveat', array(), CHILD_THEME_VERSION );
	wp_enqueue_style( 'dashicons' );
	wp_enqueue_style( 'font-awesome-free', '//use.fontawesome.com/releases/v5.0.12/css/all.css' );
	wp_enqueue_style( 'grid-boostrap', get_stylesheet_directory_uri() .'/css/grid.min.css', array(), '20130608');
	wp_enqueue_style( 'slick-css', get_stylesheet_directory_uri() .'/css/slick.css', array());
	wp_enqueue_style( 'magnific-popup', get_stylesheet_directory_uri() .'/css/magnific-popup.css', array());
	wp_enqueue_style( 'custom-css', get_stylesheet_directory_uri() .'/css/custom.css', array(), '20130609');

	wp_enqueue_style( 'animate-css', 'https://unpkg.com/aos@2.3.1/dist/aos.css', array(), '20130610');
	   
	$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
	wp_enqueue_script( 'genesis-sample-responsive-menu', get_stylesheet_directory_uri() . "/js/responsive-menus{$suffix}.js", array( 'jquery' ), CHILD_THEME_VERSION, true );
	wp_localize_script(
		'genesis-sample-responsive-menu',
		'genesis_responsive_menu',
		genesis_sample_responsive_menu_settings()
	);
	wp_enqueue_script( 'jquery-slick', get_stylesheet_directory_uri() . "/js/slick.min.js", array( 'jquery' ), CHILD_THEME_VERSION, true );
	wp_enqueue_script( 'magnific-popup-js', get_stylesheet_directory_uri() . "/js/jquery.magnific-popup.min.js", array( 'jquery' ), CHILD_THEME_VERSION, true );
	wp_enqueue_script( 'js-common', get_stylesheet_directory_uri() . "/js/common.js", array( 'jquery' ), CHILD_THEME_VERSION, true );

	wp_enqueue_script( 'js-scrollreveal', get_stylesheet_directory_uri() . "/js/scrollreveal.min.js", array( 'jquery' ), CHILD_THEME_VERSION, true );

	wp_enqueue_script( 'js-aos', "https://unpkg.com/aos@2.3.1/dist/aos.js", array( 'jquery' ), CHILD_THEME_VERSION, true );
}

// Define our responsive menu settings.
function genesis_sample_responsive_menu_settings() {

	$settings = array(
		'mainMenu'          => __( 'Menu', 'genesis-sample' ),
		'menuIconClass'     => 'dashicons-before dashicons-menu',
		'subMenu'           => __( 'Submenu', 'genesis-sample' ),
		'subMenuIconsClass' => 'dashicons-before dashicons-arrow-down-alt2',
		'menuClasses'       => array(
			'combine' => array(
				'.nav-primary',
				'.nav-header',
			),
			'others'  => array(),
		),
	);

	return $settings;

}

// Add HTML5 markup structure.
add_theme_support( 'html5', array( 'caption', 'comment-form', 'comment-list', 'gallery', 'search-form' ) );

// Add Accessibility support.
add_theme_support( 'genesis-accessibility', array( '404-page', 'drop-down-menu', 'headings', 'rems', 'search-form', 'skip-links' ) );

// Add viewport meta tag for mobile browsers.
add_theme_support( 'genesis-responsive-viewport' );

// Add support for custom header.
add_theme_support( 'custom-header', array(
	'width'           => 600,
	'height'          => 160,
	'header-selector' => '.site-title a',
	'header-text'     => false,
	'flex-height'     => true,
) );

// Add support for custom background.
add_theme_support( 'custom-background' );

// Add support for after entry widget.
add_theme_support( 'genesis-after-entry-widget-area' );

// Add support for 3-column footer widgets.
add_theme_support( 'genesis-footer-widgets', 3 );

// Add Image Sizes.
add_image_size( 'featured-image', 720, 400, TRUE );

// Rename primary and secondary navigation menus.
add_theme_support( 'genesis-menus', array( 'primary' => __( 'After Header Menu', 'genesis-sample' ), 'secondary' => __( 'Footer Menu', 'genesis-sample' ) ) );

// Reposition the secondary navigation menu.
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'genesis_footer', 'genesis_do_subnav', 5 );

// Reduce the secondary navigation menu to one level depth.
add_filter( 'wp_nav_menu_args', 'genesis_sample_secondary_menu_args' );
function genesis_sample_secondary_menu_args( $args ) {

	if ( 'secondary' != $args['theme_location'] ) {
		return $args;
	}

	$args['depth'] = 1;

	return $args;

}

// Modify size of the Gravatar in the author box.
add_filter( 'genesis_author_box_gravatar_size', 'genesis_sample_author_box_gravatar' );
function genesis_sample_author_box_gravatar( $size ) {
	return 90;
}

// Modify size of the Gravatar in the entry comments.
add_filter( 'genesis_comment_list_args', 'genesis_sample_comments_gravatar' );
function genesis_sample_comments_gravatar( $args ) {

	$args['avatar_size'] = 60;

	return $args;

}

/* Before footer
------------------------------*/
add_action( 'genesis_before_footer', 'rtug_after_footer_widgets' );
function rtug_after_footer_widgets() {
	?>
	<div id="contact_popup" class="contact-popup mfp-hide">
		<?php 
		echo do_shortcode('[contact-form-7 id="278" title="Contacto"]');
		?>
	</div>

	<div id="book_popup" class="book_popup mfp-hide">
		<div class="content-book">
			<div class="container">
				<div class="row">
					<div class="col-md-4">
						<img src="<?php echo get_stylesheet_directory_uri()?>/images/book.png" alt="book">
					</div>
					<div class="col-md-8">
						<h3>¡DESCARGA EL PDF!</h3>
						<h4>LOS TRUCOS MÁS USADOS EN FACEBOOK  E INSTAGRAM PARA CRECER TUS SEGUIDORES</h4>
						<form action="">
							<input type="text" placeholder="Su correo electrónico aquí">
							<button class="btn-purple">¡AQUIÉRELO AHORA!</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
	
}

/* Register Sidebar
------------------------------*/
function function_register_sidebar() {
    register_sidebar(
        array (
            'name' => __( 'Sidebar Cursos', 'yazz' ),
            'id' => 'cursos-side-bar',
            'description' => __( 'Sidebar Cursos Sidebar', 'yazz' ),
            'before_widget' => '<div class="widget-content">',
            'after_widget' => "</div>",
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        )
    );
}
add_action( 'widgets_init', 'function_register_sidebar' );

/* pagination
------------------------------*/
function wpbeginner_numeric_posts_nav() {
 
    if( is_singular() )
        return;
 
    global $wp_query;
 
    /** Stop execution if there's only 1 page */
    if( $wp_query->max_num_pages <= 1 )
        return;
 
    $paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
    $max   = intval( $wp_query->max_num_pages );
 
    /** Add current page to the array */
    if ( $paged >= 1 )
        $links[] = $paged;
 
    /** Add the pages around the current page to the array */
    if ( $paged >= 3 ) {
        $links[] = $paged - 1;
        $links[] = $paged - 2;
    }
 
    if ( ( $paged + 2 ) <= $max ) {
        $links[] = $paged + 2;
        $links[] = $paged + 1;
    }
 
    echo '<div class="navigation"><ul>' . "\n";
 
    /** Previous Post Link */
    if ( get_previous_posts_link() )
        printf( '<li>%s</li>' . "\n", get_previous_posts_link('<') );
 
    /** Link to first page, plus ellipses if necessary */
    if ( ! in_array( 1, $links ) ) {
        $class = 1 == $paged ? ' class="active"' : '';
 
        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );
 
        if ( ! in_array( 2, $links ) )
            echo '<li>…</li>';
    }
 
    /** Link to current page, plus 2 pages in either direction if necessary */
    sort( $links );
    foreach ( (array) $links as $link ) {
        $class = $paged == $link ? ' class="active"' : '';
        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
    }
 
    /** Link to last page, plus ellipses if necessary */
    if ( ! in_array( $max, $links ) ) {
        if ( ! in_array( $max - 1, $links ) )
            echo '<li>…</li>' . "\n";
 
        $class = $paged == $max ? ' class="active"' : '';
        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
    }
 
    /** Next Post Link */
    if ( get_next_posts_link() )
        printf( '<li>%s</li>' . "\n", get_next_posts_link('>') );
 
    echo '</ul></div>' . "\n";
}

// Get day
function get_day($day) {
    $days = array('Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado');
    $date = $days[date('N', strtotime($day))];
        return $date;
}
/*=============================================
=            BREADCRUMBS			            =
=============================================*/
//  to include in functions.php
function the_breadcrumb() {
    $sep = '/';
    if (!is_front_page()) {
	
	// Start the breadcrumb with a link to your homepage
        echo '<div class="breadcrumbs">';
        // echo '<a href="';
        // echo get_option('home');
        // echo '">';
        echo '<a href="'.get_site_url().'">HOME</a>';
        echo '</a>';
	
	// Check if the current page is a category, an archive or a single page. If so show the category or archive name.
        if (is_category()){
        	// echo $sep;
         	// the_category($sep);

            $categories = get_the_category();
			$category_name = $categories[0]->cat_name;
			$category_link = get_category_link( $categories[0]->cat_ID );

			echo $sep."<a href='".$category_link."'><span>".$category_name."</span></a>";
        } 
	
	// If the current page is a single post, show its title with the separator
        if (is_single()) {
            echo $sep.'&nbsp;<a href="'.get_site_url().$sep.'blog">&nbsp; <span>BLOG</span></a>'.$sep.'&nbsp;';
            echo '<span>'.get_the_title().'</span>';
        }
	
	// If the current page is a static page, show its title.
        if (is_page()) {
            echo the_title();
        }
	
	// if you have a static page assigned to be you posts list page. It will find the title of the static page and display it. i.e Home >> Blog
        if (is_home()){
            global $post;
            $page_for_posts_id = get_option('page_for_posts');
            if ( $page_for_posts_id ) { 
                $post = get_page($page_for_posts_id);
                setup_postdata($post);
                the_title();
                rewind_posts();
            }
        }
        echo '</div>';
    }
}
/*
* Credit: http://www.thatweblook.co.uk/blog/tutorials/tutorial-wordpress-breadcrumb-function/
*/

/**
* Add new rewrite for post type
* Add permalink structure
*/
// function _post_type_rewrite() {
//     global $wp_rewrite;
 
//     // Set the query arguments used by WordPress
//     $queryarg = 'post_type=cursos&p=';
 
//     // Concatenate %cpt_id% to $queryarg (eg.. &p=123)
//     $wp_rewrite->add_rewrite_tag( '%cpt_id%', '([^/]+)', $queryarg );
 
//     // Add the permalink structure
//     $wp_rewrite->add_permastruct( 'cursos', '/cursos/%cpt_id%/', false );
// }
// add_action( 'init', '_post_type_rewrite' );
 
// /**
//  * Replace permalink segment with post ID
//  *
//  */
// function _post_type_permalink( $post_link, $id = 0, $leavename ) {
//     global $wp_rewrite;
//     $post = get_post( $id );
//     if ( is_wp_error( $post ) )
//         return $post;
 
//         // Get post permalink (should be something like /cursos/%cpt_id%/
//         $newlink = $wp_rewrite->get_extra_permastruct( 'cursos' );
 
//         // Replace %cpt_id% in permalink structure with actual post ID
//         $newlink = str_replace( '%cpt_id%', $post->ID, $newlink );
//         $newlink = home_url( user_trailingslashit( $newlink ) );
//     return $newlink;
// }
// add_filter('post_type_link', '_post_type_permalink', 1, 3);







