<?php
/**
 * ╔═══════════════════════════════════════════╗
 * ║  BLOCK: Call to Action (Beta)             ║
 * ║  Registro, estilos y callback del bloque  ║
 * ╚═══════════════════════════════════════════╝
 */

// Encola estilos
add_action( 'init', 'jornada_industrial_register_style_cta' );
function jornada_industrial_register_style_cta() {
    wp_enqueue_block_style(
        'lazyblock/cta',
        array(
            'handle' => 'lazyblock-cta-style',
            'src'    => get_template_directory_uri() . '/blocks/lazyblock-cta/block.css',
            'path'   => get_template_directory() . '/blocks/lazyblock-cta/block.css',
        )
    );
}

// Registra bloque
add_action( 'init', 'jornada_industrial_register_block_cta' );
function jornada_industrial_register_block_cta() {
    if ( function_exists( 'lazyblocks' ) ) {
        lazyblocks()->add_block( array(
            'title' => 'Call to Action',
            'slug' => 'lazyblock/cta',
            'icon' => 'dashicons-admin-links',
            'category' => 'theme',
            'supports' => array(
                'align' => array( 'wide', 'full' ),
            ),
            'controls' => array(
                'control_cta_titulo' => array( 'type' => 'text', 'name' => 'titulo', 'label' => 'Título', 'placement' => 'inspector' ),
                'control_cta_desc' => array( 'type' => 'rich_text', 'name' => 'descripcion', 'label' => 'Descripción', 'placement' => 'inspector' ),
                'control_cta_btn' => array( 'type' => 'text', 'name' => 'texto_boton', 'label' => 'Texto del Botón', 'placement' => 'inspector' ),
                'control_cta_url' => array( 'type' => 'url', 'name' => 'url_boton', 'label' => 'URL del Botón', 'placement' => 'inspector' ),
            ),
        ) );
    }
}

// Asigna callbacks
add_action( 'init', 'jornada_industrial_callbacks_cta' );
function jornada_industrial_callbacks_cta() {
    add_filter( 'lazyblock/cta/frontend_callback', 'jornada_cta_render', 10, 2 );
    add_filter( 'lazyblock/cta/editor_callback', 'jornada_cta_render', 10, 2 );
}

// Renderiza
if ( ! function_exists( 'jornada_cta_render' ) ) {
    function jornada_cta_render( $output, $attributes ) {
        ob_start();
        include __DIR__ . '/block.php';
        return ob_get_clean();
    }
}
