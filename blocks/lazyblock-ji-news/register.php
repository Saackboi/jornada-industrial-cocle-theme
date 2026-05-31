<?php
/**
 * Registro del bloque: JI - Grid de Noticias
 */

add_action( 'init', 'jornada_industrial_register_style_ji_news' );
function jornada_industrial_register_style_ji_news() {
    wp_enqueue_block_style(
        'lazyblock/ji-news',
        array(
            'handle' => 'lazyblock-ji-news-style',
            'src'    => get_template_directory_uri() . '/blocks/lazyblock-ji-news/block.css',
            'path'   => get_template_directory() . '/blocks/lazyblock-ji-news/block.css',
        )
    );
}

add_action( 'init', 'jornada_industrial_register_block_ji_news' );
function jornada_industrial_register_block_ji_news() {
    if ( function_exists( 'lazyblocks' ) ) {
        lazyblocks()->add_block( array(
            'title' => 'JI - Grid de Noticias',
            'slug' => 'lazyblock/ji-news',
            'icon' => 'dashicons-media-document',
            'category' => 'theme',
            'supports' => array(
                'align' => array( 'wide', 'full' ),
            ),
            'controls' => array(
                'control_news_overline' => array( 'type' => 'text', 'name' => 'overline', 'label' => 'Supertexto', 'placement' => 'inspector', 'default' => 'Actualidad' ),
                'control_news_section_title' => array( 'type' => 'text', 'name' => 'section_title', 'label' => 'Título de la Sección', 'placement' => 'inspector', 'default' => 'Noticias destacadas' ),
                'control_news_more_url' => array( 'type' => 'url', 'name' => 'more_url', 'label' => 'URL Ver Todas', 'placement' => 'inspector' ),
                'control_news_main_img' => array( 'type' => 'image', 'name' => 'main_img', 'label' => 'Imagen Noticia Principal', 'placement' => 'inspector' ),
                'control_news_main_title' => array( 'type' => 'text', 'name' => 'main_title', 'label' => 'Título Noticia Principal', 'placement' => 'inspector', 'default' => 'Grupo Coclé Avanza: Alianza por la Innovación' ),
                'control_news_main_desc' => array( 'type' => 'textarea', 'name' => 'main_desc', 'label' => 'Descripción Noticia Principal', 'placement' => 'inspector', 'default' => 'Líderes de la industria y la academia se reúnen para definir el futuro tecnológico de la región central del país, estableciendo nuevos estándares para la ingeniería.' ),
                'control_news_main_url' => array( 'type' => 'url', 'name' => 'main_url', 'label' => 'URL Noticia Principal', 'placement' => 'inspector' ),
                'control_news_sidebar' => array(
                    'type' => 'repeater',
                    'name' => 'sidebar_news',
                    'label' => 'Noticias Laterales (Max 3)',
                    'placement' => 'inspector',
                    'default' => array(
                        array( 'title' => 'Seminarios técnicos y conferencias de expertos', 'desc' => 'Conoce a los ponentes internacionales que compartirán sus conocimientos en automatización.', 'url' => '#' ),
                        array( 'title' => 'Visitas guiadas a proyectos locales', 'desc' => 'Una mirada de cerca a las implementaciones de ingeniería de vanguardia en Coclé.', 'url' => '#' ),
                        array( 'title' => 'Desafío de Logística Estudiantil', 'desc' => 'Los estudiantes competirán resolviendo casos prácticos de optimización de cadena de suministro.', 'url' => '#' ),
                    ),
                ),
                'control_news_sidebar_img' => array(
                    'type' => 'image',
                    'name' => 'img',
                    'label' => 'Imagen',
                    'child_of' => 'control_news_sidebar',
                ),
                'control_news_sidebar_title' => array(
                    'type' => 'text',
                    'name' => 'title',
                    'label' => 'Título',
                    'child_of' => 'control_news_sidebar',
                ),
                'control_news_sidebar_desc' => array(
                    'type' => 'text',
                    'name' => 'desc',
                    'label' => 'Descripción',
                    'child_of' => 'control_news_sidebar',
                ),
                'control_news_sidebar_url' => array(
                    'type' => 'url',
                    'name' => 'url',
                    'label' => 'URL (Opcional)',
                    'child_of' => 'control_news_sidebar',
                ),
            ),
        ) );
    }
}

add_action( 'init', 'jornada_industrial_callbacks_ji_news' );
function jornada_industrial_callbacks_ji_news() {
    add_filter( 'lazyblock/ji-news/frontend_callback', 'jornada_ji_news_render', 10, 2 );
    add_filter( 'lazyblock/ji-news/editor_callback', 'jornada_ji_news_render', 10, 2 );
}

if ( ! function_exists( 'jornada_ji_news_render' ) ) {
    function jornada_ji_news_render( $output, $attributes ) {
        ob_start();
        include __DIR__ . '/block.php';
        return ob_get_clean();
    }
}
