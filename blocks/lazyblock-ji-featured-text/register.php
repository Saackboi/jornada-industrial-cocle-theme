<?php
/**
 * ╔═══════════════════════════════════════════╗
 * ║  JI-BASE Texto Destacado                 ║
 * ║  Featured text block with size and        ║
 * ║  alignment options.                      ║
 * ╚═══════════════════════════════════════════╝
 */
add_action( 'init', 'jornada_industrial_register_style_ji_featured_text' );
function jornada_industrial_register_style_ji_featured_text() {
    wp_enqueue_block_style(
        'lazyblock/ji-featured-text',
        array(
            'handle' => 'lazyblock-ji-featured-text-style',
            'src'    => get_template_directory_uri() . '/blocks/lazyblock-ji-featured-text/block.css',
            'path'   => get_template_directory() . '/blocks/lazyblock-ji-featured-text/block.css',
        )
    );
}

add_action( 'init', 'jornada_industrial_register_block_ji_featured_text' );
function jornada_industrial_register_block_ji_featured_text() {
    if ( function_exists( 'lazyblocks' ) ) {
        lazyblocks()->add_block( array(
            'title'    => 'JI-BASE Texto Destacado',
            'slug'     => 'lazyblock/ji-featured-text',
            'icon'     => 'dashicons-format-quote',
            'category' => 'theme',
            'supports' => array( 'align' => array( 'wide', 'full' ) ),
            'controls' => array(
                'control_sft_texto' => array(
                    'type'      => 'textarea',
                    'name'      => 'texto',
                    'label'     => 'Texto destacado',
                    'placement' => 'inspector',
                    'default'   => 'Texto destacado de la sección.',
                ),
                'control_sft_tamano' => array(
                    'type'      => 'select',
                    'name'      => 'tamano',
                    'label'     => 'Tamaño',
                    'placement' => 'inspector',
                    'default'   => 'large',
                    'choices'   => array(
                        array( 'label' => 'Grande', 'value' => 'large' ),
                        array( 'label' => 'Mediano', 'value' => 'medium' ),
                    ),
                ),
                'control_sft_alineacion' => array(
                    'type'      => 'select',
                    'name'      => 'alineacion',
                    'label'     => 'Alineación',
                    'placement' => 'inspector',
                    'default'   => 'center',
                    'choices'   => array(
                        array( 'label' => 'Centrado', 'value' => 'center' ),
                        array( 'label' => 'Izquierda', 'value' => 'left' ),
                    ),
                ),
            ),
        ) );
    }
}

add_action( 'init', 'jornada_industrial_callbacks_ji_featured_text' );
function jornada_industrial_callbacks_ji_featured_text() {
    add_filter( 'lazyblock/ji-featured-text/frontend_callback', 'jornada_ji_featured_text_render', 10, 2 );
    add_filter( 'lazyblock/ji-featured-text/editor_callback', 'jornada_ji_featured_text_render', 10, 2 );
}

if ( ! function_exists( 'jornada_ji_featured_text_render' ) ) {
    function jornada_ji_featured_text_render( $output, $attributes ) {
        ob_start();
        include __DIR__ . '/block.php';
        return ob_get_clean();
    }
}
