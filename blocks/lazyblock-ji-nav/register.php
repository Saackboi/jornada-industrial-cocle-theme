<?php
/**
 * Registro del bloque: JI-OLD - Navegación Principal (Beta)
 */

add_action( 'init', 'jornada_industrial_register_style_ji_nav' );
function jornada_industrial_register_style_ji_nav() {
    wp_enqueue_block_style(
        'lazyblock/ji-nav',
        array(
            'handle' => 'lazyblock-ji-nav-style',
            'src'    => get_template_directory_uri() . '/blocks/lazyblock-ji-nav/block.css',
            'path'   => get_template_directory() . '/blocks/lazyblock-ji-nav/block.css',
        )
    );
}

add_action( 'init', 'jornada_industrial_register_block_ji_nav' );
function jornada_industrial_register_block_ji_nav() {
    if ( function_exists( 'lazyblocks' ) ) {
        lazyblocks()->add_block( array(
            'title' => 'JI-OLD - Navegación Principal',
            'slug' => 'lazyblock/ji-nav',
            'icon' => 'dashicons-navigation',
            'category' => 'theme',
            'supports' => array(
                'align' => array( 'wide', 'full' ),
            ),
            'controls' => array(
                'control_nav_brand' => array( 'type' => 'text', 'name' => 'brand_text', 'label' => 'Texto del Logotipo', 'placement' => 'inspector', 'default' => 'Nnnerlw' ),
                'control_nav_links' => array(
                    'type' => 'repeater',
                    'name' => 'nav_links',
                    'label' => 'Enlaces de Navegación',
                    'placement' => 'inspector',
                ),
                'control_nav_links_label' => array(
                    'type' => 'text',
                    'name' => 'label',
                    'label' => 'Texto del Enlace',
                    'child_of' => 'control_nav_links',
                ),
                'control_nav_links_url' => array(
                    'type' => 'url',
                    'name' => 'url',
                    'label' => 'Dirección URL',
                    'child_of' => 'control_nav_links',
                ),
                'control_nav_btn_text' => array( 'type' => 'text', 'name' => 'btn_text', 'label' => 'Texto del Botón de Acción', 'placement' => 'inspector', 'default' => 'Register' ),
                'control_nav_btn_url' => array( 'type' => 'url', 'name' => 'btn_url', 'label' => 'URL del Botón de Acción', 'placement' => 'inspector' ),
            ),
        ) );
    }
}

add_action( 'init', 'jornada_industrial_callbacks_ji_nav' );
function jornada_industrial_callbacks_ji_nav() {
    add_filter( 'lazyblock/ji-nav/frontend_callback', 'jornada_ji_nav_render', 10, 2 );
    add_filter( 'lazyblock/ji-nav/editor_callback', 'jornada_ji_nav_render', 10, 2 );
}

if ( ! function_exists( 'jornada_ji_nav_render' ) ) {
    function jornada_ji_nav_render( $output, $attributes ) {
        ob_start();
        include __DIR__ . '/block.php';
        return ob_get_clean();
    }
}
