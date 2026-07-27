/**
 * ╔═══════════════════════════════════════════╗
 * ║  JI-BASE Card Grid                       ║
 * ║  Grid of cards with configurable          ║
 * ║  columns and repeater items.             ║
 * ╚═══════════════════════════════════════════╝
 */

<?php
add_action( 'init', 'jornada_industrial_register_style_ji_card_grid' );
function jornada_industrial_register_style_ji_card_grid() {
    wp_enqueue_block_style(
        'lazyblock/ji-card-grid',
        array(
            'handle' => 'lazyblock-ji-card-grid-style',
            'src'    => get_template_directory_uri() . '/blocks/lazyblock-ji-card-grid/block.css',
            'path'   => get_template_directory() . '/blocks/lazyblock-ji-card-grid/block.css',
        )
    );
}

add_action( 'init', 'jornada_industrial_register_block_ji_card_grid' );
function jornada_industrial_register_block_ji_card_grid() {
    if ( function_exists( 'lazyblocks' ) ) {
        lazyblocks()->add_block( array(
            'title'    => 'JI-BASE Grid de Tarjetas',
            'slug'     => 'lazyblock/ji-card-grid',
            'icon'     => 'dashicons-grid-view',
            'category' => 'theme',
            'supports' => array( 'align' => array( 'wide', 'full' ) ),
            'controls' => array(
                'control_crg_columnas' => array(
                    'type'      => 'select',
                    'name'      => 'columnas',
                    'label'     => 'Columnas',
                    'placement' => 'inspector',
                    'default'   => '3',
                    'choices'   => array(
                        array( 'label' => '2 columnas', 'value' => '2' ),
                        array( 'label' => '3 columnas', 'value' => '3' ),
                    ),
                ),
                'control_crg_cards' => array(
                    'type'      => 'repeater',
                    'name'      => 'cards',
                    'label'     => 'Tarjetas',
                    'placement' => 'inspector',
                    'default'   => array(),
                ),
                'control_crg_titulo' => array(
                    'type'      => 'text',
                    'name'      => 'card_titulo',
                    'label'     => 'Título',
                    'placement' => 'inspector',
                    'default'   => 'Título',
                    'child_of'  => 'control_crg_cards',
                ),
                'control_crg_descripcion' => array(
                    'type'      => 'textarea',
                    'name'      => 'card_descripcion',
                    'label'     => 'Descripción',
                    'placement' => 'inspector',
                    'default'   => '',
                    'child_of'  => 'control_crg_cards',
                ),
                'control_crg_imagen' => array(
                    'type'      => 'image',
                    'name'      => 'card_imagen',
                    'label'     => 'Imagen (opcional)',
                    'placement' => 'inspector',
                    'default'   => '',
                    'child_of'  => 'control_crg_cards',
                ),
                'control_crg_url' => array(
                    'type'      => 'url',
                    'name'      => 'card_url',
                    'label'     => 'Enlace (opcional)',
                    'placement' => 'inspector',
                    'default'   => '',
                    'child_of'  => 'control_crg_cards',
                ),
            ),
        ) );
    }
}

add_action( 'init', 'jornada_industrial_callbacks_ji_card_grid' );
function jornada_industrial_callbacks_ji_card_grid() {
    add_filter( 'lazyblock/ji-card-grid/frontend_callback', 'jornada_ji_card_grid_render', 10, 2 );
    add_filter( 'lazyblock/ji-card-grid/editor_callback', 'jornada_ji_card_grid_render', 10, 2 );
}

if ( ! function_exists( 'jornada_ji_card_grid_render' ) ) {
    function jornada_ji_card_grid_render( $output, $attributes ) {
        ob_start();
        include __DIR__ . '/block.php';
        return ob_get_clean();
    }
}
