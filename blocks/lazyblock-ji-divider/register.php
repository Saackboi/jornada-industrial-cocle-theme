<?php
/**
 * ╔═══════════════════════════════════════════╗
 * ║  JI-BASE Separador Decorativo            ║
 * ║  Divider block with line or spacing       ║
 * ║  and configurable margin.                ║
 * ╚═══════════════════════════════════════════╝
 */
add_action( 'init', 'jornada_industrial_register_style_ji_divider' );
function jornada_industrial_register_style_ji_divider() {
    wp_enqueue_block_style(
        'lazyblock/ji-divider',
        array(
            'handle' => 'lazyblock-ji-divider-style',
            'src'    => get_template_directory_uri() . '/blocks/lazyblock-ji-divider/block.css',
            'path'   => get_template_directory() . '/blocks/lazyblock-ji-divider/block.css',
        )
    );
}

add_action( 'init', 'jornada_industrial_register_block_ji_divider' );
function jornada_industrial_register_block_ji_divider() {
    if ( function_exists( 'lazyblocks' ) ) {
        lazyblocks()->add_block( array(
            'title'    => 'JI-BASE Separador Decorativo',
            'slug'     => 'lazyblock/ji-divider',
            'icon'     => 'dashicons-minus',
            'category' => 'theme',
            'supports' => array( 'align' => array( 'wide', 'full' ) ),
            'controls' => array(
                'control_sdv_tipo' => array(
                    'type'      => 'select',
                    'name'      => 'tipo',
                    'label'     => 'Tipo',
                    'placement' => 'inspector',
                    'default'   => 'line',
                    'choices'   => array(
                        array( 'label' => 'Línea dorada', 'value' => 'line' ),
                        array( 'label' => 'Espacio', 'value' => 'spacing' ),
                    ),
                ),
                'control_sdv_margen' => array(
                    'type'      => 'select',
                    'name'      => 'margen',
                    'label'     => 'Espaciado',
                    'placement' => 'inspector',
                    'default'   => 'medium',
                    'choices'   => array(
                        array( 'label' => 'Pequeño', 'value' => 'small' ),
                        array( 'label' => 'Mediano', 'value' => 'medium' ),
                        array( 'label' => 'Grande', 'value' => 'large' ),
                    ),
                ),
            ),
        ) );
    }
}

add_action( 'init', 'jornada_industrial_callbacks_ji_divider' );
function jornada_industrial_callbacks_ji_divider() {
    add_filter( 'lazyblock/ji-divider/frontend_callback', 'jornada_ji_divider_render', 10, 2 );
    add_filter( 'lazyblock/ji-divider/editor_callback', 'jornada_ji_divider_render', 10, 2 );
}

if ( ! function_exists( 'jornada_ji_divider_render' ) ) {
    function jornada_ji_divider_render( $output, $attributes ) {
        ob_start();
        include __DIR__ . '/block.php';
        return ob_get_clean();
    }
}
