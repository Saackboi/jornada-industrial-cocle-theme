<?php
/**
 * ╔═══════════════════════════════════════════╗
 * ║  BLOCK: JI-OLD - Hero Principal (Beta)    ║
 * ║  Registro, estilos y callback del bloque  ║
 * ╚═══════════════════════════════════════════╝
 */

// Encola estilos
add_action( 'init', 'jornada_industrial_register_style_ji_hero' );
function jornada_industrial_register_style_ji_hero() {
    wp_enqueue_block_style(
        'lazyblock/ji-hero',
        array(
            'handle' => 'lazyblock-ji-hero-style',
            'src'    => get_template_directory_uri() . '/blocks/lazyblock-ji-hero/block.css',
            'path'   => get_template_directory() . '/blocks/lazyblock-ji-hero/block.css',
        )
    );
}

// Registra bloque
add_action( 'init', 'jornada_industrial_register_block_ji_hero' );
function jornada_industrial_register_block_ji_hero() {
    if ( function_exists( 'lazyblocks' ) ) {
        lazyblocks()->add_block( array(
            'title' => 'JI-OLD - Hero Principal',
            'slug' => 'lazyblock/ji-hero',
            'icon' => 'dashicons-welcome-widgets-menus',
            'category' => 'theme',
            'supports' => array(
                'align' => array( 'wide', 'full' ),
            ),
            'controls' => array(
                'control_ji_hero_titulo' => array( 'type' => 'text', 'name' => 'titulo', 'label' => 'Título', 'placement' => 'inspector', 'default' => 'Find In Interesting Services And Buy Now Anything.' ),
                'control_ji_hero_desc' => array( 'type' => 'textarea', 'name' => 'descripcion', 'label' => 'Descripción', 'placement' => 'inspector', 'default' => 'Suscipit Suspendisse Consectetur Tortor Purus Sed Sociis Vitae Dignissim Et. Nunc Purus Aliquam Integer Habitant Non Neque Orci Ultrices.' ),
                'control_ji_hero_btn1_text' => array( 'type' => 'text', 'name' => 'btn1_text', 'label' => 'Texto Botón Primario', 'placement' => 'inspector', 'default' => 'Get Started' ),
                'control_ji_hero_btn1_url' => array( 'type' => 'url', 'name' => 'btn1_url', 'label' => 'URL Botón Primario', 'placement' => 'inspector' ),
                'control_ji_hero_btn2_text' => array( 'type' => 'text', 'name' => 'btn2_text', 'label' => 'Texto Botón Secundario', 'placement' => 'inspector', 'default' => 'View More' ),
                'control_ji_hero_btn2_url' => array( 'type' => 'url', 'name' => 'btn2_url', 'label' => 'URL Botón Secundario', 'placement' => 'inspector' ),
                'control_ji_hero_img' => array( 'type' => 'image', 'name' => 'imagen_derecha', 'label' => 'Imagen Derecha', 'placement' => 'inspector' ),
            ),
        ) );
    }
}

// Asigna callbacks
add_action( 'init', 'jornada_industrial_callbacks_ji_hero' );
function jornada_industrial_callbacks_ji_hero() {
    add_filter( 'lazyblock/ji-hero/frontend_callback', 'jornada_ji_hero_render', 10, 2 );
    add_filter( 'lazyblock/ji-hero/editor_callback', 'jornada_ji_hero_render', 10, 2 );
}

// Renderiza
if ( ! function_exists( 'jornada_ji_hero_render' ) ) {
    function jornada_ji_hero_render( $output, $attributes ) {
        ob_start();
        include __DIR__ . '/block.php';
        return ob_get_clean();
    }
}
