<?php
/**
 * Yazz
 *
 * Yazz Theme.
 *
 * Template Name: Pagina / Evento
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
        'posts_per_page'   => -1,
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
                if(date_format($e_end, 'ymd') < date('ymd')){
                    $overlay_exprired = '<div class="expired-overlay"></div>';
                    $expired = 'expired';
                }
                ?>
                <div class="event-box <?php echo $expired; ?>">
                    <?php 
                        echo $overlay_exprired;
                    ?>
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
            </div>
        </section><?php
    endif;
    
    if($yazmin_ensena = get_field('yazmin_ensena')):
        ?>
    <!-- Yazmin Enseña -->
    <section class="home-ensena home-contract" style="background-image: url(<?php echo $yazmin_ensena['background']['url']; ?>);">
        <div class="wrap">
            <div class="row">
                 <div class="col-sm-12 col-md-8 col-lg-8 my-auto">
                    <header class="block-title">
                    <h2><?php echo $yazmin_ensena['titulo']; ?></h2>
                    </header>
                    <div class="event-box">
                        <div class="l-left">
                            <ul>
                            <?php 
                            $lista_izquierda =  $yazmin_ensena['lista_izquierda'];
                            foreach ($lista_izquierda as $item_izquierda) {?>
                                <li><a href="<?php echo $item_izquierda['item']['url'] ?>" target="_<?php echo $item_izquierda['item']['target'] ?>"><?php echo $item_izquierda['item']['title'] ?></a> </li>   
                            <?php } ?>
                            </ul>
                        </div>
                        <div class="l-right">
                            <ul>
                            <?php 
                            $lista_izquierda =  $yazmin_ensena['lista_derecha'];
                            foreach ($lista_izquierda as $item_derecha) {?>
                                <li><a href="<?php echo $item_derecha['item']['url'] ?>" target="_<?php echo $item_derecha['item']['target'] ?>"><?php echo $item_derecha['item']['title'] ?></a> </li>   
                            <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-md-4 col-lg-4">
                    <div class="ensena_image">
                        <img src="<?php echo $yazmin_ensena['imgen_derecha']['url']; ?>" />
                    </div>   
                </div>
            </div> 
        </div>
    </section>
    <!-- End Yazmin Enseña -->
        <?php
    endif;
    
    
    
    $event_contract = get_field('contratos','option')['contract'];
    if($event_contract):?>
    <section class="home-history home-contract">
        <div class="wrap">
            <div class="row">
                <div class="col-md-5">
                    <div class="">
                        <img class="d-none d-md-block" src="<?php echo get_stylesheet_directory_uri()?>/images/jazz_contract.png" />
                        <div class="contract_image" data-aos="fade-right" data-aos-delay="500"></div>
                    </div>   
                </div>
                <div class="col-md-7 my-auto">
                    <header class="block-title">
                    <?php
                        if($small_title = $event_contract['contract_fields_small_title']) echo '<span class="small-title">'.$small_title.'</span>';
                        if($history_title = $event_contract['contract_fields_history_title']) echo '<h2 class="animate-title-text left">'.$history_title.'</h2>';
                        ?>
                        <img class="d-block d-md-none circle-mob" src="<?php echo get_stylesheet_directory_uri()?>/images/contrata_yazmin.png" />
                        <?php
                        if($subtitle = $event_contract['contract_fields_subtitle']) echo '<h3>'.$subtitle.'</h3>';
                    ?>
                    </header>
                    <div class="home-history-content">
                        <?php echo do_shortcode($event_contract['contract_fields_history_content']);?>

                        <a class="btn-purple contratame" href="#contact_popup"><?php echo $event_contract['contract_fields_history_button']['title']?></a>
                    </div>
                </div>
            </div> 
        </div>
    </section>
        <?php
    endif;

    $args = array( 
        'post_type'      => 'testimonio',
        'post_status'    => 'publish',
        // 'orderby'         => 'menu_order',
        'orderby'        => 'post_date',
        'order'          => 'ASC',
    );
    $loop = new WP_Query( $args );
    if ( $loop->have_posts()):
        ?><section class="home-testimonial"><div class="wrap">
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
        ?></div></section></div><?php
    endif;

    if($gallery_event = get_field('fotos_de_eventos')):
        $gallery = $gallery_event['galeria'];
        $x = count($gallery)-1;
        $i = 0;
        $y = 1;
        ?>
        <section class="gallery-event" style="background-image: url(<?php echo $gallery_event['fondo_galeria'] ?>)">
            <h2>Fotos de Eventos</h2>
            <div class="wrap">
                <div class="slide-gallery gallery">
                    <?php
                    while($x >= 0) {
                        echo '<div class="g-item"><div class="row gutter-0">';
                        for($i; $i<count($gallery); $i++) {
                            ?>
                            <div class="col-md-3">
                                <a href="<?php echo $gallery[$i]['url'] ?>" class="g-img"><img src="<?php echo $gallery[$i]['url'] ?>" alt="<?php echo $gallery[$i]['title'] ?>"></a>
                            </div>
                            <?php
                            if($i + 1 == $y*8){
                                break;
                            }
                        }
                        $x = $x - 8;
                        $y++;
                        $i++;
                        echo '</div></div>';
                    }
                    ?>
                </div>
            </div>
        </section>
        <?php
    endif;

    $home_hours = get_field('clases_vistuales');
    if($home_hours = $home_hours['home_hours']):
        ?>
    <section class="home-hours c-hours">
        <div class="wrap">
            <div class="row">
                <div class="col-md-7">
                    <header class="block-title">
                        <img src="<?php echo get_stylesheet_directory_uri()?>/images/flive.png" style="width: 100px;" /><br>
                    <?php
                        if($small_title = $home_hours['hour_fields_small_title']) echo '<span class="small-title">'.$small_title.'</span>';
                        if($history_title = $home_hours['hour_fields_history_title']) echo '<h2 class="animate-title">'.$history_title.'</h2>';
                        if($subtitle = $home_hours['hour_fields_subtitle']) echo '<h3>'.$subtitle.'</h3>';
                    ?>
                    </header>
                    <div class="home-history-content">
                        <?php echo do_shortcode($home_hours['hour_fields_history_content']);?>
                        <a class="btn-purple" href="<?php echo $home_hours['hour_fields_history_button']['url']?>"><?php echo $home_hours['hour_fields_history_button']['title']?></a>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="home_history_image">
                        <img src="<?php echo get_stylesheet_directory_uri()?>/images/yazmin-hour.png" />
                    </div>                    
                </div>
            </div> 
            
        </div>
    </section>
        <?php
    endif;

    // Clases Viruales
    echo do_shortcode('[clases_virtuales]');
    // End Clases Viruales
    
    ?><section class="contact-book-bio">
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
    </section><?php
}

genesis();