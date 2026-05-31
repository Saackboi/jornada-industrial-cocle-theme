<?php
/**
 * Registro del bloque: Hero (Beta)
 */

add_action( 'init', 'jornada_industrial_register_style_hero' );
function jornada_industrial_register_style_hero() {
    wp_enqueue_block_style(
        'lazyblock/hero',
        array(
            'handle' => 'lazyblock-hero-style',
            'src'    => get_template_directory_uri() . '/blocks/lazyblock-hero/block.css',
            'path'   => get_template_directory() . '/blocks/lazyblock-hero/block.css',
        )
    );
}

add_action( 'init', 'jornada_industrial_register_block_hero' );
function jornada_industrial_register_block_hero() {
    if ( function_exists( 'lazyblocks' ) ) {
        lazyblocks()->add_block( array(
            'title' => 'Hero',
            'slug' => 'lazyblock/hero',
            'icon' => 'dashicons-cover-image',
            'category' => 'theme',
            'supports' => array(
                'align' => array( 'wide', 'full' ),
            ),
            'controls' => array(
                'control_titulo' => array( 'type' => 'text', 'name' => 'titulo', 'label' => 'Título', 'placement' => 'inspector', 'default' => 'Build something beautiful.' ),
                'control_subtitulo' => array( 'type' => 'textarea', 'name' => 'subtitulo', 'label' => 'Subtítulo', 'placement' => 'inspector', 'default' => 'Notion helps you and your team get more done with peace of mind.' ),
                'control_btn1_text' => array( 'type' => 'text', 'name' => 'boton_1_texto', 'label' => 'Texto Botón Principal', 'placement' => 'inspector', 'default' => 'Get Notion free' ),
                'control_btn1_url' => array( 'type' => 'url', 'name' => 'boton_1_url', 'label' => 'URL Botón Principal', 'placement' => 'inspector' ),
                'control_btn2_text' => array( 'type' => 'text', 'name' => 'boton_2_texto', 'label' => 'Texto Botón Secundario', 'placement' => 'inspector', 'default' => 'Request a demo' ),
                'control_btn2_url' => array( 'type' => 'url', 'name' => 'boton_2_url', 'label' => 'URL Botón Secundario', 'placement' => 'inspector' ),
                'control_imagen' => array( 'type' => 'image', 'name' => 'imagen_ilustracion', 'label' => 'Imagen / Ilustración Derecha', 'placement' => 'inspector' ),
                'control_logos' => array( 'type' => 'image', 'name' => 'imagen_logos', 'label' => 'Imagen de Logos (Opcional)', 'placement' => 'inspector' ),
            ),
        ) );
    }
}

add_action( 'init', 'jornada_industrial_callbacks_hero' );
function jornada_industrial_callbacks_hero() {
    add_filter( 'lazyblock/hero/frontend_callback', 'jornada_hero_render', 10, 2 );
    add_filter( 'lazyblock/hero/editor_callback', 'jornada_hero_render', 10, 2 );
}

if ( ! function_exists( 'jornada_hero_render' ) ) {
    function jornada_hero_render( $output, $attributes ) {
        ob_start();
        include __DIR__ . '/block.php';
        return ob_get_clean();
    }
}
