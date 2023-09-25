<?php
/**
 * Yazz
 *
 * Yazz Theme.
 *
 * Template Name: Home
 *
 * @package Yazz
 * @author  Yazz
 * @license GPL-2.0+
 * @link    http://www.yazz.com/
 */

remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action( 'genesis_after_header', 'home' );

 /** Code for custom loop */
function home() {
    if ( have_posts() ) : while ( have_posts() ) : the_post();   
        ?>
        <section class="home-hero">
            <div class="wrap">
                <?php echo do_shortcode('[rev_slider alias="home"]'); ?>

                <div class="small-contact">
                    <img src="<?php echo get_stylesheet_directory_uri()?>/images/book.png" alt="book">
                    <div class="content-contact">
                        <div class="cont-form">
                            <div>
                                <div class="cont-title">
                                    <?php 
                                        $text = get_field( 'title_form_book','option' ) ? get_field( 'title_form_book','option' ) : '';
                                    ?>
                                    <?php if ($text != ''): ?>
                                        <h4><?php echo $text ?></h4>    
                                    <?php endif ?>
                                </div>

                            </div>
                            <?php 
                                echo do_shortcode('[activecampaign form=1]');
                            ?>
                        </div>
                    </div>
                </div>
                
            </div>
        </section>
        <?php
        if( $clients = get_field('clients')):
        ?>
        <section class="home-sponsors">
            <div class="wrap">
                <ul class="d-none d-xl-block">
                    <li>Clientes:</li>
                    <?php foreach ($clients as $client) {
                        echo '<li><img src="'.$client['client_image'].'" /></li>';
                    }
                    ?>
                </ul>
                <div class="mob-slide d-block d-xl-none">
                    <?php foreach ($clients as $client) {
                        echo '<div><img src="'.$client['client_image'].'" /></div>';
                    }
                    ?>
                </div>
            </div>
        </section>
        <?php
        endif;
        if($home_historia = get_field('home_historia')):
            ?>
        <section class="home-history" data-aos="fade-zoom-in" data-aos-easing="ease-in-sine" data-aos-delay="600" data-aos-offset="0" data-aos-once="true">
            <div class="wrap">
                <div class="row">
                    <div class="col-sm-12 col-md-5">
                        <div class="home_history_image" >
                            <img class="d-none d-md-block" src="<?php echo get_stylesheet_directory_uri()?>/images/jazz-history.png"  />
                            
                        </div>   
                    </div>
                    <div class="col-sm-12 col-md-7 my-auto">
                        <header class="block-title">
                        <?php
                            echo do_shortcode('[banderas]');
                            if($small_title = $home_historia['small_title']) echo '<span class="small-title">'.$small_title.'</span>';
                            if($history_title = $home_historia['history_title']) echo '<div class="title-animate"><div><h2 class="animate-title-text">'.$history_title.'</h2></div></div>';
                            ?>
                            <img class="d-block d-md-none circle-mob" src="<?php echo get_stylesheet_directory_uri()?>/images/face-history.png" />
                            <?php
                            if($subtitle = $home_historia['subtitle']) echo '<h3>'.$subtitle.'</h3>';
                        ?>
                        </header>
                        <div class="home-history-content" >
                            <?php echo do_shortcode($home_historia['history_content']);?>
                            <a class="btn-purple" href="<?php echo $home_historia['history_button']['url']?>"><?php echo $home_historia['history_button']['title']?></a>
                        </div>
                    </div>
                </div> 
                
            </div>
        </section>
            <?php
        endif;
        if($home_youtube = get_field('home_youtube')):
            ?>
        <section class="home-youtube" data-aos="fade-zoom-in" data-aos-easing="ease-in-sine" data-aos-delay="600" data-aos-offset="0" data-aos-once="true">
            <div class="row">
                <div class="col-md-5">
                    <div class="home-youtube-content">
                        <img src="<?php echo $home_youtube['home_logo'] ?>" style="width: 100px;" /><br>
                        <?php echo do_shortcode($home_youtube['youtube_content']);?>
                        <a class="btn-red" target="_blank" href="https://www.youtube.com/channel/UCe2oog2uPbw5cC_LC5wyTqw?sub_confirmation=1"><?php echo $home_youtube['youtube_button']['title']?></a>
                    </div>

                </div>
                <div class="col-md-7">
                    <div class="video-slide">
                    <?php
                    if($videos_youtube = $home_youtube['videos_youtube']){
                        $vid_num = 0;
                        foreach($videos_youtube as $item_vid){
                            ?>
                            <div class="item-video">
                                <div class="c-video">
                                    <a class="popup-play" href="<?php echo $item_vid['url_video'];?>">
                                    <div class="c-video-preview" id="v_<?php echo $vid_num;?>" data-video-widget="#v_<?php echo $vid_num++;?>" 
                                    data-video="<?php 
                                    parse_str( parse_url( $item_vid['url_video'], PHP_URL_QUERY ), $my_array_of_vars );
                                    echo $my_array_of_vars['v']; ?>" data-type="youtube">
                                        <div class="c-play-video"></div>
                                        <div class="video-wrapper"></div>
                                    </div>
                                    </a>
                                </div>
                                <a class="popup-play" href="<?php echo $item_vid['url_video'];?>">
                                    <h5><?php echo $item_vid['title_video'] ?></h5>
                                </a>
                            </div>
                            <?php
                        }
                    }
                    ?>
                    </div>
                </div>
            </div>
        </section>
            <?php
        endif;
        
        // Clases Viruales
        echo do_shortcode('[clases_virtuales]');
        // End Clases Viruales

        $args = array( 
            'post_type'      => 'testimonio',
            'post_status'    => 'publish',
            // 'orderby'         => 'menu_order',
            'orderby'        => 'post_date',
            'order'          => 'ASC',
        );
        $loop = new WP_Query( $args );
        if ( $loop->have_posts()):
            ?><section class="home-testimonial" data-aos="fade-zoom-in" data-aos-easing="ease-in-sine" data-aos-delay="600" data-aos-offset="0" data-aos-once="true">
                
                <div class="wrap"><div>
                <h2 class="small-title">Testimonios</h2>
                <div class="content-test-slide">
            <?php
            $vnum = 0;
            while ( $loop->have_posts() ) : $loop->the_post();
                $testimonial_id = get_the_ID();
                if( $url_video = get_field('video_url')){
                $type_video = get_field('add_video');
                ?>
                <div class="item-slide">
                    <div class="c-video">
                        <div class="c-video-preview" id="vid_<?php echo $vnum;?>" 
                            data-video-widget="#vid_<?php echo $vnum++;?>" 
                            data-video="<?php $url = $url_video;
                            if($type_video != 'youtube'){
                                echo $url_video;
                            }else {
                                if(strlen($url)==11):
                                    echo $url_video;
                                else:
                                    parse_str( parse_url( $url, PHP_URL_QUERY ), $my_array_of_vars );
                                    echo $my_array_of_vars['v'];  
                                endif;
                            } 
                            ?>" data-type="<?php echo $type_video; ?>">
                            <a class="popup-play" href="<?php echo $item_vid['url_video'];?>">
                              <div class="c-play-video"></div>
                            </a>
                            <div class="video-wrapper"></div>
                        </div>
                    </div>
                    <h5><?php the_title(); ?></h5>
                </div>
                <?php
                }
            endwhile;
            wp_reset_query();
            ?></div></div></section></div><?php
        endif;

        $event_contract = get_field('contratos_yazmin','option');
        if($event_contract):?>
        <section class="home-history home-contract" data-aos="fade-zoom-in" data-aos-easing="ease-in-sine" data-aos-delay="600" data-aos-offset="0" data-aos-once="true">
            <div class="wrap">
                <div class="row">
                    <div class="col-md-5">
                        <div class="">
                            <img class="d-none d-md-block" src="<?php echo get_stylesheet_directory_uri()?>/images/jazz_contract.png" />
                            <div class="contract_image" data-aos="fade-right" data-aos-delay="500" data-aos-once="true"></div>
                        </div>   
                    </div>
                    <div class="col-md-7 my-auto">
                        <header class="block-title">
                        <?php
                            if($small_title = $event_contract['small_title']) echo '<span class="small-title">'.$small_title.'</span>';
                            if($history_title = $event_contract['title']) echo '<div class="title-animate"><div><h2 class="animate-title-text left">'.$history_title.'</h2></div></div>';
                            ?>
                            <img class="d-block d-md-none circle-mob" src="<?php echo get_stylesheet_directory_uri()?>/images/contrata_yazmin.png" />
                            <?php
                            if($subtitle = $event_contract['subtitle']) echo '<h3>'.$subtitle.'</h3>';
                        ?>
                        </header>
                        <div class="home-history-content">
                            <?php echo do_shortcode($event_contract['content']);?>
                            <a class="btn-purple contratame" href="#contact_popup"><?php echo $event_contract['button']['title']?></a>
                        </div>
                    </div>
                </div> 
            </div>
        </section>
            <?php
        endif;

        $args2 = array(
            'post_type'      => 'post',
            'post_status'    => 'publish',
            // 'orderby'         => 'menu_order',
            'orderby'        => 'post_date',
            'order'          => 'DESC',
            'posts_per_page' => 4
        );
        $loop = new WP_Query( $args2 );
        if ( $loop->have_posts()):
            ?><section class="home-article" data-aos="fade-zoom-in" data-aos-easing="ease-in-sine" data-aos-delay="600" data-aos-offset="0" data-aos-once="true">
                <div class="wrap">
                <h2 class="small-title">Artículos Recientes</h2>
                <div class="row gutter-15">
                <?php
                while ( $loop->have_posts() ) : $loop->the_post();
                    $post_id = get_the_ID();
                    ?>
                    <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                        <div class="blog-box">
                            <a href="<?php the_permalink() ?>">
                                <?php if (has_post_thumbnail( $post->ID )): ?>
                                    <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' ); ?>
                                <?php else: ?>
                                    <?php $image = get_stylesheet_directory_uri()."/images/image-post.png" ?>
                                <?php endif ?>
                                <img src="<?php echo $image[0] ?>" alt="blog">
                            </a>
                            <div class="content-tag">
                                <?php 
                                $terms = wp_get_post_terms( $post_id, 'category' );
                                foreach($terms as $cat_name) {
                                    echo '<span>';
                                    echo $cat_name->name;
                                    echo '</span>';
                                }
                                ?>
                            </div>
                            <a href="<?php the_permalink() ?>">
                                <h3><?php the_title(); ?></h3>
                            </a>
                        </div>
                    </div>
                    <?php
                endwhile;
                wp_reset_query();
                ?>
                </div>
                <div class="more">
                    <a class="btn-purple" href="<?php echo get_site_url(); ?>/blog/">Más artículos</a>
                </div>
            </section></div><?php
        endif;

        ?><section class="home-inst" data-aos="fade-zoom-in" data-aos-easing="ease-in-sine" data-aos-delay="600" data-aos-offset="0" data-aos-once="true">
            <div class="wrap">
                <a href="https://www.instagram.com/yazzcontla/"><i class="fab fa-instagram"></i></a>
                <p class="small-title">Si te gusta la farándula como a mi, sigueme y diviertete<br> con las aventuras que paso con los artistas que se cruzan en mi camino.</p>
                <a href="https://www.instagram.com/yazzcontla/" class="text-purple">@yazzcontla</a>
            </div>
            <div class="content-inst">
                <?php
                $user_id = get_field('user_id', 'option');
                $token = get_field('token', 'option');
                $number_of_photos = 12;
                if($user_id && $token) {
                ?>
                <!-- Start Code Instagram -->

                    <div class="row" id="yazz_instafeed">
                    </div>
                    <script>
                    jQuery(document).ready(function($) {
                        var token = '<?php echo $token; ?>', // get from the instagram app
                            userid = '<?php echo $user_id; ?>',
                            num_photos = '<?php echo $number_of_photos; ?>'; // to show how many photos you want to display

                        jQuery.ajax({
                            url: 'https://api.instagram.com/v1/users/self/media/recent',
                            dataType: 'jsonp',
                            type: 'GET',
                            data: {
                                access_token: token,
                                count: num_photos
                            },
                            success: function(data) {
                                console.log(data);
                                for (x in data.data) {
                                    var hightUrl = data.data[x].images.standard_resolution.url;
                                    var text_overlay = data.data[x].caption.text;
                                    var text_over = '';
                                    text_overlay = text_overlay.split(' ');
                                    for(var y=0; y<=25; y++ ){
                                        text_over += text_overlay[y]+' ';
                                    }
                                    jQuery('#yazz_instafeed').append('<div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2" style="background-image: url(' + hightUrl + ')" onclick="window.open(\''+data.data[x].link+'\',\'_blank\');"><div class="caption"><i class="fab fa-instagram"></i>'+text_over+'</div></div>');     
                                }
                            },
                            error: function(data) {
                                console.log(data);
                            }
                        });
                    });
                    </script>
                    <!--/ End Code Instagram -->
                    <?php
                }
                ?>
            </div>
        </section><?php

        ?><section class="contact-book" data-aos="fade-zoom-in" data-aos-easing="ease-in-sine" data-aos-delay="600" data-aos-offset="0" data-aos-once="true">
            <img src="<?php echo get_stylesheet_directory_uri()?>/images/yazz_03.png" alt="yazz" class="img-float">
            <div class="wrap">
                <div class="small-contact c-style">
                    <img src="<?php echo get_stylesheet_directory_uri()?>/images/book.png" alt="book">
                    <div class="content-contact">
                        <!-- <div class="cont-form">
                            <div>
                                <div class="cont-title">
                                    <h4>LOS TRUCOS MÁS USADOS EN FACEBOOK E INSTAGRAM PARA CRECER TUS SEGUIDORES</h4>
                                </div>
                                <div class="item-form">
                                    <input type="text" placeholder="COLOQUE SU NOMBRE">
                                </div>
                                <div class="item-form">
                                    <input type="text" placeholder="COLOQUE SU CORREO ELECTRÓNICO">
                                </div>
                            </div>
                            <div class="item-btn">
                                <img src="<?php echo get_stylesheet_directory_uri()?>/images/arrow-down.png" alt="here">
                                <button class="btn-purple">Sí, lo quiero</button>
                            </div>
                        </div> -->
                        <div class="cont-form">
                            <div>
                                <div class="cont-title">
                                    <?php 
                                        $text = get_field( 'title_form_book','option' ) ? get_field( 'title_form_book','option' ) : '';
                                    ?>
                                    <?php if ($text != ''): ?>
                                        <h4><?php echo $text ?></h4>    
                                    <?php endif ?>
                                </div>
                            </div>
                            <img src="<?php echo get_stylesheet_directory_uri()?>/images/arrow-down.png" alt="here" class="here" >
                            <?php 
                                echo do_shortcode('[activecampaign form=3]');
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </section><?php
    endwhile;
    endif;
    wp_reset_query();
    ?>
    <!-- Hero Popup -->
    <div id="hero_popup" class="hero_popup mfp-hide">
        <div class="content-book">
            <?php 
            $link_hero = get_field('video_hero','option');
            ?>
            <a href="<?php echo $link_hero; ?>" ></a>
                    
        </div>
    </div>
    <!-- End Hero Popup -->
    <?php
}


 genesis();