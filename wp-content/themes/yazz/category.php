<?php
/**
* Description: Used as a page template to show page contents, followed by a loop 
* through the "Single Category"
*/

add_filter( 'genesis_pre_get_option_site_layout', 'custom_set_single_posts_layout' );
/**
 * Apply Content Sidebar content layout to single posts.
 * 
 * @return string layout ID.
 */
function custom_set_single_posts_layout() {
    if (is_category()) {
        return 'content-sidebar';
    }
    
}
// Add our custom loop

remove_action ('genesis_loop', 'genesis_do_loop'); // Remove the standard loop
add_action( 'genesis_loop', 'test_do_loop' ); // Add custom loop
function test_do_loop() {
   if (have_posts()):
        $i = 1;
        $j = 0;
        $first = ''; 
        $numOfCols = 2;
        $bootstrapColWidth = 12 / $numOfCols;

        ?>
        <div class="site-inner">
            <div class="blog-wrap">
                <div class="wrap">
                <?php

                $bodyclasses = get_body_class();

                if (in_array("paged", $bodyclasses)) {
                    echo '<div class="row">';
                     while (have_posts() ) :the_post();
                        
                        ?>
                          <div class="blog-item blog_bottom  col-sm-6 col-md-6" style="cursor: pointer;" onclick="window.location='<?php echo get_permalink(); ?>';">
                              <div class="blog-image">
                                <a href="<?php esc_url(the_permalink()); ?>">
                                  <img src="<?php echo get_the_post_thumbnail_url( $post_id, 'thumb-featured-blog' ) ?>" />
                                </a>
                              </div>
                              <div class="blog-meta">
                                <?php if(!is_single()): ?>
                                     <h3><a href="<?php esc_url(the_permalink()); ?>"><?php the_title(); ?></a></h3>
                                     <?php else: ?>
                                     <h3><?php the_title(); ?></h3>
                                  <?php endif; ?>
                              </div><!-- end blog-meta -->
                          </div>
                        <?php
                    endwhile;
                  echo '</div>';
                }else{
                  while (have_posts() ) :the_post();
                    if($i == 1) {
                         ?>
                            <div class="row <?php echo $i?>">
                                <div class="blog-item blog_top col-md-12" style="cursor: pointer;">
                                    <div class="blog-image">
                                      <a href="<?php esc_url(the_permalink()); ?>">
                                        <img src="<?php echo get_the_post_thumbnail_url( $post_id, 'thumb-featured-blog' ) ?>" />
                                      </a>
                                    </div>
                                  
                                    <div class="blog-meta-top">
                                     <div class="blog-meta">
                                     <?php if(!is_single()): ?>
                                           <h3><a href="<?php esc_url(the_permalink()); ?>"><?php the_title(); ?></a></h3>
                                           <?php else: ?>
                                           <h3><?php the_title(); ?></h3>
                                        <?php endif; ?>
                                     </div>
                                    </div><!-- end blog-meta -->
                                                                
                                </div>
                            </div>
                          <?php 
                        } else {

                            if ($j % 2 == 0 || $j == 0){
                              echo '<div class="row">';
                            }
                                
                            ?>
                            
                              <div class="blog-item blog_bottom  col-sm-6 col-md-6" style="cursor: pointer;" onclick="window.location='<?php echo get_permalink(); ?>';">
                                  <div class="blog-image">
                                    <a href="<?php esc_url(the_permalink()); ?>">
                                      <img src="<?php echo get_the_post_thumbnail_url( $post_id, 'thumb-featured-blog' ) ?>" />
                                    </a>
                                  </div>
                                  <div class="blog-meta">
                                    <?php if(!is_single()): ?>
                                         <h3><a href="<?php esc_url(the_permalink()); ?>"><?php the_title(); ?></a></h3>
                                         <?php else: ?>
                                         <h3><?php the_title(); ?></h3>
                                      <?php endif; ?>
                                      
                                         
                                  </div><!-- end blog-meta -->
                              </div>
                            <?php
                            if ($j%2 == 1 && $j != 0){
                                echo '</div>';
                            }
                            $j++;
                        }  
                        $i++;
                        // if($i > 8) {
                        //     $i = 1;
                        // }
                        if ($j == $cont){
                            echo '</div>';
                        }
                  endwhile;

                }

                
                ?>
                </div>
                <div class="row">
                  <div class="col-md-12">
                      <div class="content-pagination">
                          <div class="wrap">
                             <?php wpbeginner_numeric_posts_nav(); ?>
                          </div>
                      </div>  
                  </div>
              </div>
            </div>
        </div>    
            <?php
            wp_reset_query();
            ?>
            
        <?php
    endif;

}
    
/** Remove Post Info */
remove_action('genesis_before_post_content','genesis_post_info');
remove_action('genesis_after_post_content','genesis_post_meta');
 
genesis();