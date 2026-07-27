/**
 * ╔═══════════════════════════════════════════╗
 * ║  JI-BASE Button                          ║
 * ║  Button block with configurable text,     ║
 * ║  URL, color, and size.                   ║
 * ╚═══════════════════════════════════════════╝
 */

<?php
add_action( 'init', 'jornada_industrial_register_style_ji_button' );
function jornada_industrial_register_style_ji_button() {
    wp_enqueue_block_style(
        'lazyblock/ji-button',
        array(
            'handle' => 'lazyblock-ji-button-style',
            'src'    => get_template_directory_uri() . '/blocks/lazyblock-ji-button/block.css',
            'path'   => get_template_directory() . '/blocks/lazyblock-ji-button/block.css',
        )
    );
}

add_action( 'init', 'jornada_industrial_register_block_ji_button' );
function jornada_industrial_register_block_ji_button() {
    if ( function_exists( 'lazyblocks' ) ) {
        lazyblocks()->add_block( array(
            'title'    => 'JI-BASE Botón',
            'slug'     => 'lazyblock/ji-button',
            'icon'     => 'dashicons-button',
            'category' => 'theme',
            'supports' => array( 'align' => array( 'wide', 'full' ) ),
            'controls' => array(
                'control_btn_texto' => array(
                    'type'      => 'text',
                    'name'      => 'texto',
                    'label'     => 'Texto del botón',
                    'placement' => 'inspector',
                    'default'   => 'Ver más',
                ),
                'control_btn_url' => array(
                    'type'      => 'url',
                    'name'      => 'url',
                    'label'     => 'Enlace',
                    'placement' => 'inspector',
                    'default'   => '#',
                ),
                'control_btn_color' => array(
                    'type'      => 'select',
                    'name'      => 'color',
                    'label'     => 'Color',
                    'placement' => 'inspector',
                    'default'   => 'primary',
                    'choices'   => array(
                        array( 'label' => 'Oro (relleno)', 'value' => 'primary' ),
                        array( 'label' => 'Azul (borde)', 'value' => 'outline' ),
                    ),
                ),
                'control_btn_tamano' => array(
                    'type'      => 'select',
                    'name'      => 'tamano',
                    'label'     => 'Tamaño',
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

add_action( 'init', 'jornada_industrial_callbacks_ji_button' );
function jornada_industrial_callbacks_ji_button() {
    add_filter( 'lazyblock/ji-button/frontend_callback', 'jornada_ji_button_render', 10, 2 );
    add_filter( 'lazyblock/ji-button/editor_callback', 'jornada_ji_button_render', 10, 2 );
}

if ( ! function_exists( 'jornada_ji_button_render' ) ) {
    function jornada_ji_button_render( $output, $attributes ) {
        ob_start();
        include __DIR__ . '/block.php';
        return ob_get_clean();
    }
}
