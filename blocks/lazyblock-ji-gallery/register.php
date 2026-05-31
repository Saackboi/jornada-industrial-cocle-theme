<?php
/**
 * Registro del bloque: JI - Galería Dinámica
 */

add_action( 'init', 'jornada_industrial_register_style_ji_gallery' );
function jornada_industrial_register_style_ji_gallery() {
    wp_enqueue_block_style(
        'lazyblock/ji-gallery',
        array(
            'handle' => 'lazyblock-ji-gallery-style',
            'src'    => get_template_directory_uri() . '/blocks/lazyblock-ji-gallery/block.css',
            'path'   => get_template_directory() . '/blocks/lazyblock-ji-gallery/block.css',
        )
    );
}

add_action( 'init', 'jornada_industrial_register_block_ji_gallery' );
function jornada_industrial_register_block_ji_gallery() {
    if ( function_exists( 'lazyblocks' ) ) {
        lazyblocks()->add_block( array(
            'title' => 'JI - Galería Dinámica',
            'slug' => 'lazyblock/ji-gallery',
            'icon' => 'dashicons-format-gallery',
            'category' => 'theme',
            'supports' => array(
                'align' => array( 'wide', 'full' ),
            ),
            'controls' => array(
                'control_gallery_title' => array( 'type' => 'text', 'name' => 'titulo', 'label' => 'Título de la Sección', 'placement' => 'inspector', 'default' => 'Visión del Evento' ),
                'control_gallery_images' => array(
                    'type' => 'repeater',
                    'name' => 'images',
                    'label' => 'Lista de Imágenes',
                    'placement' => 'inspector',
                ),
                'control_gallery_images_img' => array(
                    'type' => 'image',
                    'name' => 'img',
                    'label' => 'Imagen',
                    'child_of' => 'control_gallery_images',
                ),
            ),
        ) );
    }
}

add_action( 'init', 'jornada_industrial_callbacks_ji_gallery' );
function jornada_industrial_callbacks_ji_gallery() {
    add_filter( 'lazyblock/ji-gallery/frontend_callback', 'jornada_ji_gallery_render', 10, 2 );
    add_filter( 'lazyblock/ji-gallery/editor_callback', 'jornada_ji_gallery_render', 10, 2 );
}

if ( ! function_exists( 'jornada_ji_gallery_render' ) ) {
    function jornada_ji_gallery_render( $output, $attributes ) {
        ob_start();
        include __DIR__ . '/block.php';
        return ob_get_clean();
    }
}
