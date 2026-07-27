<?php
/**
 * ╔═══════════════════════════════════════════╗
 * ║  BLOCK: JI-OLD - Enlaces Rápidos (Beta)   ║
 * ║  Registro, estilos y callback del bloque  ║
 * ╚═══════════════════════════════════════════╝
 */

// Encola estilos
add_action( 'init', 'jornada_industrial_register_style_ji_labels' );
function jornada_industrial_register_style_ji_labels() {
    wp_enqueue_block_style(
        'lazyblock/ji-labels',
        array(
            'handle' => 'lazyblock-ji-labels-style',
            'src'    => get_template_directory_uri() . '/blocks/lazyblock-ji-labels/block.css',
            'path'   => get_template_directory() . '/blocks/lazyblock-ji-labels/block.css',
        )
    );
}

// Registra bloque
add_action( 'init', 'jornada_industrial_register_block_ji_labels' );
function jornada_industrial_register_block_ji_labels() {
    if ( function_exists( 'lazyblocks' ) ) {
        lazyblocks()->add_block( array(
            'title' => 'JI-OLD - Enlaces Rápidos',
            'slug' => 'lazyblock/ji-labels',
            'icon' => 'dashicons-ellipsis',
            'category' => 'theme',
            'supports' => array(
                'align' => array( 'wide', 'full' ),
            ),
            'controls' => array(
                'control_ji_labels_list' => array(
                    'type' => 'repeater',
                    'name' => 'labels_list',
                    'label' => 'Lista de Enlaces/Textos',
                    'placement' => 'inspector',
                ),
                'control_ji_labels_list_label' => array(
                    'type' => 'text',
                    'name' => 'label',
                    'label' => 'Texto',
                    'child_of' => 'control_ji_labels_list',
                ),
                'control_ji_labels_list_url' => array(
                    'type' => 'url',
                    'name' => 'url',
                    'label' => 'URL (Opcional)',
                    'child_of' => 'control_ji_labels_list',
                ),
            ),
        ) );
    }
}

// Asigna callbacks
add_action( 'init', 'jornada_industrial_callbacks_ji_labels' );
function jornada_industrial_callbacks_ji_labels() {
    add_filter( 'lazyblock/ji-labels/frontend_callback', 'jornada_ji_labels_render', 10, 2 );
    add_filter( 'lazyblock/ji-labels/editor_callback', 'jornada_ji_labels_render', 10, 2 );
}

// Renderiza
if ( ! function_exists( 'jornada_ji_labels_render' ) ) {
    function jornada_ji_labels_render( $output, $attributes ) {
        ob_start();
        include __DIR__ . '/block.php';
        return ob_get_clean();
    }
}
