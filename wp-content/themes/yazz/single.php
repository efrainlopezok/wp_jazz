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
    if (is_single('post') || is_singular('post')) {
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
                            echo "<div class='blog-image'><img src=".$thumb_url_top[0]."></div>";
                            echo '<div class="separator">';
                                echo '<h3>'.get_the_title().'</h3><hr />';
                            echo '</div>';
                            echo '<div class="content-single">';
                                echo the_content();
                            echo '</div>';
                            
                            echo "<hr />";

                            ?>
                            <section class="get-book-bio">
                                <div class="wrap">
                                    <div class="get-book">
                                        <img src="<?php echo get_stylesheet_directory_uri()?>/images/book.png" alt="book">
                                        <div class="content-contact">
                                            <!-- <div class="cont-form"> -->
                                                <div class="cont-title">
                                                    <h4>LOS TRUCOS MÁS USADOS EN FACEBOOK E INSTAGRAM PARA CRECER TUS SEGUIDORES</h4>
                                                    <p>Descarga este PDF y aprende trucos que usan los expertos para crecer sus redes sociales.</p>
                                                </div>
                                                <div class="item-btn open-book">
                                                    <a href="#book_popup" class="btn-white">Adquiérelo ahora</a>
                                                </div>
                                                
                                            <!-- </div> -->
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <?php
                            
                            if (is_single ()) comments_template (); 
                                echo "<div class='content-single comments_single'>";
                                    genesis_list_comments();
                                echo "</div>";

                        echo '</div>';



                        echo '<div class="related-blog">';
                            echo '<h3>Related Articles</h3>';
                            $settings = array(
                                'posts_per_page' => 4, 
                                'post_type' => 'post', 
                                'orderby' => 'date', 
                                'order' => 'DESC', 
                            );
                        
                            $list = '<div class="blog-related">';
                                $list .= '<div class="row">';
                                $loop = new WP_Query( $settings );
                                if($loop->have_posts()):
                                    while ( $loop->have_posts() ) : $loop->the_post();
                                        $thumb_url = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()),'blog-list');
                                        $img_thumb = '';
                                        if (has_post_thumbnail()) {
                                            $img_thumb = $thumb_url[0];
                                        }else{
                                            $img_thumb = get_stylesheet_directory_uri()."/images/default-img.jpg";
                                        }
                                        $list .= '
                                        <div class="col-md-6">
                                            <div class="blog-item">
                                                <a href="'.get_the_permalink().'"><div class="blog-image"><img src="'.$img_thumb.'" class="thumbnail-post"></div></a>
                                                <a href="'.get_the_permalink().'"><h3>'.get_the_title().'</h3></a>
                                            </div>
                                        </div>';
                                    endwhile;
                                endif;
                                wp_reset_query();
                                $list.= '</div>';
                            $list.= '</div>';
                            echo $list;
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
            echo '</section>';
        endwhile;

}
    
/** Remove Post Info */
remove_action('genesis_before_post_content','genesis_post_info');
remove_action('genesis_after_post_content','genesis_post_meta');
 
genesis();