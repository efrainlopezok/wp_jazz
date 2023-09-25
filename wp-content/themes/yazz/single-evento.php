<?php
/**
* Description: Used as a page template to show page contents, followed by a loop 
* through the "Single Blog"
*/

add_filter( 'genesis_pre_get_option_site_layout', 'custom_set_single_posts_layout' );
/**
 * Apply Content Sidebar content layout to single posts.
 * 
 * @return string layout ID.
 */
function custom_set_single_posts_layout() {
    if (is_single('evento') || is_singular('evento')) {
        return 'content-sidebar';
    }
    
}

// Add our custom loop

remove_action ('genesis_loop', 'genesis_do_loop'); // Remove the standard loop
add_action( 'genesis_loop', 'test_do_loop' ); // Add custom loop
function test_do_loop() {
    while ( have_posts() ) : the_post();
            echo '<section class="single-blog">';
                echo '<div class="container">';
                    echo '<div class="row">';
                        $thumb_url_top = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()),'full');
                        echo '<div class="top-single">';
                            echo "<img src=".$thumb_url_top[0].">";
                            echo '<div class="separator">';
                                echo '<h3>'.get_the_title().'</h3><hr />';
                            echo '</div>';
                            echo '<div class="content-single">';
                                echo the_content();
                            echo '</div>';
                            
                            echo "<hr />";

                            ?>
                            <?php
                            
                            if (is_single ()) comments_template (); 
                                echo "<div class='content-single comments_single'>";
                                    genesis_list_comments();
                                echo "</div>";

                        echo '</div>';
                echo '</div>';
            echo '</section>';
        endwhile;

}
    
/** Remove Post Info */
remove_action('genesis_before_post_content','genesis_post_info');
remove_action('genesis_after_post_content','genesis_post_meta');
 
genesis();