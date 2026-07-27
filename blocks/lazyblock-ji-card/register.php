<?php
/**
 * ╔═══════════════════════════════════════════╗
 * ║  JI-BASE Tarjeta Simple                  ║
 * ║  Single card block with image, title,     ║
 * ║  description, and optional link.         ║
 * ╚═══════════════════════════════════════════╝
 */
add_action( 'init', 'jornada_industrial_register_style_ji_card' );
function jornada_industrial_register_style_ji_card() {
    wp_enqueue_block_style(
        'lazyblock/ji-card',
        array(
            'handle' => 'lazyblock-ji-card-style',
            'src'    => get_template_directory_uri() . '/blocks/lazyblock-ji-card/block.css',
            'path'   => get_template_directory() . '/blocks/lazyblock-ji-card/block.css',
        )
    );
}

add_action( 'init', 'jornada_industrial_register_block_ji_card' );
function jornada_industrial_register_block_ji_card() {
    if ( function_exists( 'lazyblocks' ) ) {
        lazyblocks()->add_block( array(
            'title'    => 'JI-BASE Tarjeta Simple',
            'slug'     => 'lazyblock/ji-card',
            'icon'     => 'dashicons-id',
            'category' => 'theme',
            'supports' => array( 'align' => array( 'wide', 'full' ) ),
            'controls' => array(
                'control_crd_titulo' => array(
                    'type'      => 'text',
                    'name'      => 'titulo',
                    'label'     => 'Título',
                    'placement' => 'inspector',
                    'default'   => 'Título de la tarjeta',
                ),
                'control_crd_descripcion' => array(
                    'type'      => 'textarea',
                    'name'      => 'descripcion',
                    'label'     => 'Descripción',
                    'placement' => 'inspector',
                    'default'   => 'Descripción breve.',
                ),
                'control_crd_imagen' => array(
                    'type'      => 'image',
                    'name'      => 'imagen',
                    'label'     => 'Imagen (opcional)',
                    'placement' => 'inspector',
                    'default'   => '',
                ),
                'control_crd_url' => array(
                    'type'      => 'url',
                    'name'      => 'url',
                    'label'     => 'Enlace (opcional)',
                    'placement' => 'inspector',
                    'default'   => '',
                ),
            ),
        ) );
    }
}

add_action( 'init', 'jornada_industrial_callbacks_ji_card' );
function jornada_industrial_callbacks_ji_card() {
    add_filter( 'lazyblock/ji-card/frontend_callback', 'jornada_ji_card_render', 10, 2 );
    add_filter( 'lazyblock/ji-card/editor_callback', 'jornada_ji_card_render', 10, 2 );
}

if ( ! function_exists( 'jornada_ji_card_render' ) ) {
    function jornada_ji_card_render( $output, $attributes ) {
        ob_start();
        include __DIR__ . '/block.php';
        return ob_get_clean();
    }
}
