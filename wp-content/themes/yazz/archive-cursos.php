<?php
/**
 * Yazz
 *
 * Yazz Theme.
 *
 * Template Name: Page / Cursos
 *
 * @package Yazz
 * @author  Yazz
 * @license GPL-2.0+
 * @link    http://www.yazz.com/
 */
remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action('genesis_after_header', 'page_event_function');
function page_event_function() {
    $args = array( 
        'posts_per_page'   => 2,
        'post_type'      => 'cursos',
        'post_status'    => 'publish',
        // 'orderby'         => 'menu_order',
        'orderby'        => 'post_date',
        'order'          => 'DESC',
    );
    $loop = new WP_Query( $args );
    if ( $loop->have_posts()):
        ?><section class="section-event ">
            <div class="wrap">
            <h2>CURSOS</h2>
            <?php
            while ( $loop->have_posts() ) : $loop->the_post();?>
                <div class="event-box cursos-box">
                    <div class="e-left left-cursos">
                        <div>
                            <?php
                            $thumb_url_top = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()),'full');
                            if($thumb_url_top){ 
                            ?>
                                <img src="<?php echo $thumb_url_top[0]; ?>" alt="logo">
                            <?php } ?>
                        </div>
                    </div>
                    <div class="e-right right-cursos">
                        <?php
                        the_excerpt();
                        $cursos = get_field('cursos');
                        $external_link = get_field('external_link');
                        if ($external_link) {
                            $link_cursos = get_field('permanlink');   
                            // print_r($link_cursos);                    
                        }else{
                            $link_cursos = get_permalink();
                        }

                        ?>
                        <a href="<?php echo $link_cursos ?>" target="<?php echo $link_external = ($external_link) ? '_blank' : '' ; ?>" class="btn-purple">Más Información</a>
                    </div>
                </div>
                <?php
            endwhile;
            wp_reset_postdata();
            wp_reset_query();
            ?>
            </div>
        </section><?php
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

    /* Eventos
    -----------------------------------*/
    $args = array( 
        'posts_per_page'   => 2,
        'post_type'      => 'evento',
        'post_status'    => 'publish',
        // 'orderby'         => 'menu_order',
        'orderby'        => 'post_date',
        'order'          => 'DESC',
    );
    $loop = new WP_Query( $args );
    if ( $loop->have_posts()):
        ?><section class="section-event">
            <div class="wrap">
            <h2>PRÓXIMOS EVENTOS</h2>
            <?php
            while ( $loop->have_posts() ) : $loop->the_post();
                $event_id = get_the_ID();
                $date_event = get_field('fecha_de_evento', $event_id);
                $e_start = date_create($date_event['fecha_inicio']);
                $e_end = date_create($date_event['fecha_fin']);
                $f_start = date_format($e_start, 'F');
                $f_end = date_format($e_end, 'F');
                $j_start = date_format($e_start, 'j');
                $j_end = date_format($e_end, 'j');
                $y_start = date_format($e_start, 'Y');
                $y_end = date_format($e_end, 'Y');
                ?>
                <div class="event-box">
                    <div class="e-left">
                        <div class="details-date">
                            <?php 
                            if(date_format($e_end, 'ymd') < date('ymd')){
                                echo '<span class="c-tag">expirado</span>';
                            }
                            if($f_start == $f_end){
                                echo '<span>'.$f_start.'</span>';
                            } else {
                                echo '<span>'.$f_start.'-'.$f_end.'</span>';
                            }
                            if($j_start == $j_end){
                                echo '<span class="c-date">'.$j_start.'</span>';
                            } else {
                                echo '<span class="c-date">'.$j_start.'-'.$j_end.'</span>';
                            }
                            if($y_start == $y_end){
                                echo '<span>'.$y_start.'</span>';
                            } else {
                                echo '<span>'.$y_start.'-'.$y_end.'</span>';
                            }
                            ?>
                        </div>
                        <div>
                            <?php if($event_logo = get_field('logo_del_evento')){ ?>
                                <img src="<?php echo $event_logo; ?>" alt="logo">
                            <?php } ?>
                        </div>
                    </div>
                    <div class="e-right">
                        <h4><?php the_title(); ?></h4>
                        <?php the_excerpt();
                        if(date_format($e_end, 'ymd') > date('ymd')){
                            if(get_field('enlaces_de_evento')['pestana_nueva']) {
                                $target = '_blank';
                            }else {
                                $target = '_self';
                            }
                            if(get_field('enlaces_de_evento')['usar_un_enlace_externo']){
                                ?><a class="btn-purple" href="<?php echo get_field('enlaces_de_evento')['enlace_a_mas_informacion'] ?>" title="event" target="<?php echo $target ?>"><?php echo get_field('enlaces_de_evento')['texto_del_enlace'] ?></a><?php
                            }else {
                                ?><a class="btn-purple" href="<?php the_permalink(); ?>" title="event" target="<?php echo $target ?>">Más información</a><?php
                            }
                        }
                        ?>
                    </div>
                </div>
                <?php
            endwhile;
            wp_reset_query();
            ?>
            <div class="more">
                    <a class="btn-purple" href="#">ver más eventos</a>
                </div>
            </div>

        </section><?php
    endif;

    ?>
    <section class="contact-book-bio">
        <div class="wrap">
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
                            echo do_shortcode('[activecampaign form=3]');
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php



}

genesis();