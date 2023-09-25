<?php
/**
 * Yazz
 *
 * Yazz Theme.
 *
 * Template Name: Pagina / Blog
 *
 * @package Yazz
 * @author  Yazz
 * @license GPL-2.0+
 * @link    http://www.yazz.com/
 */


// Page 
add_action('genesis_after_header', 'page_event_function');
function page_event_function() {
    ?>
    <section class="get-book-bio">
        <div class="wrap">
            <div class="get-book">
                <img src="<?php echo get_stylesheet_directory_uri()?>/images/book.png" alt="book">
                <div class="content-contact">
                    <!-- <div class="cont-form"> -->
                      <div class="cont-title">
                          <?php 
                              $text = get_field( 'title_form_book','option' ) ? get_field( 'title_form_book','option' ) : '';
                          ?>
                          <?php if ($text != ''): ?>
                              <h4><?php echo $text ?></h4>    
                          <?php endif ?>
                          <?php 
                              $description = get_field( 'descripcion_book','option' ) ? get_field( 'descripcion_book','option' ) : '';
                          ?>
                           <?php if ($description != ''): ?>
                              <p><?php echo $description ?></p>    
                          <?php endif ?>
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
}

remove_action ('genesis_loop', 'genesis_do_loop'); // Remove the standard loop
add_action( 'genesis_loop', 'custom_do_loop' ); // Add custom loop
function custom_do_loop() {
    
    $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

    $args = array( 
        'posts_per_page'   => 7,
        'post_type'      => 'post',
        // 'orderby'         => 'menu_order',
        'orderby'    => 'post_date',
        'order'      => 'DESC',
        'paged'          => get_query_var( 'paged' )
    );
    global $wp_query;
    $wp_query = new WP_Query( $args );
    if ( $wp_query->have_posts()):
        $i = 1;
        $j = 0;
        $first = ''; 
        $numOfCols = 2;
        $bootstrapColWidth = 12 / $numOfCols;

        ?>
        <div class="blog-wrap">
            <div class="wrap">
            <?php

            $bodyclasses = get_body_class();

            if (in_array("paged", $bodyclasses)) {
                echo '<div class="row">';
                 while ( $wp_query->have_posts() ) : $wp_query->the_post();
                    
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
              while ( $wp_query->have_posts() ) : $wp_query->the_post();
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