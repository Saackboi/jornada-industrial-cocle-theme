<?php
/**
 * Registro del bloque: JI - Navegación Principal V2
 */

add_action( 'init', 'jornada_industrial_register_style_ji_navbar' );
function jornada_industrial_register_style_ji_navbar() {
    wp_enqueue_block_style(
        'lazyblock/ji-navbar',
        array(
            'handle' => 'lazyblock-ji-navbar-style',
            'src'    => get_template_directory_uri() . '/blocks/lazyblock-ji-navbar/block.css',
            'path'   => get_template_directory() . '/blocks/lazyblock-ji-navbar/block.css',
        )
    );
}

add_action( 'init', 'jornada_industrial_register_block_ji_navbar' );
function jornada_industrial_register_block_ji_navbar() {
    if ( function_exists( 'lazyblocks' ) ) {
        lazyblocks()->add_block( array(
            'title' => 'JI - Navegación Principal V2',
            'slug' => 'lazyblock/ji-navbar',
            'icon' => 'dashicons-navigation',
            'category' => 'theme',
            'supports' => array(
                'align' => array( 'wide', 'full' ),
            ),
            'controls' => array(
                'control_navv2_logo'  => array( 'type' => 'image', 'name' => 'brand_logo', 'label' => 'Logo de la Facultad', 'placement' => 'inspector' ),
                'control_navv2_brand' => array( 'type' => 'text', 'name' => 'brand_text', 'label' => 'Texto del Logotipo', 'placement' => 'inspector', 'default' => 'III Jornada Industrial' ),
                'control_navv2_links' => array(
                    'type' => 'repeater',
                    'name' => 'nav_links',
                    'label' => 'Enlaces de Navegación',
                    'placement' => 'inspector',
                    'default' => array(
                        array( 'label' => 'INICIO', 'url' => '#' ),
                        array( 'label' => 'NOSOTROS', 'url' => '#' ),
                        array( 'label' => 'ACTIVIDADES', 'url' => '#' ),
                        array( 'label' => 'PATROCINADORES', 'url' => '#' ),
                    ),
                ),
                'control_navv2_links_label' => array(
                    'type' => 'text',
                    'name' => 'label',
                    'label' => 'Texto del Enlace',
                    'child_of' => 'control_navv2_links',
                ),
                'control_navv2_links_url' => array(
                    'type' => 'url',
                    'name' => 'url',
                    'label' => 'Dirección URL',
                    'child_of' => 'control_navv2_links',
                ),
                'control_navv2_btn_text' => array( 'type' => 'text', 'name' => 'btn_text', 'label' => 'Texto del Botón de Acción', 'placement' => 'inspector', 'default' => 'REGISTRO' ),
                'control_navv2_btn_url' => array( 'type' => 'url', 'name' => 'btn_url', 'label' => 'URL del Botón de Acción', 'placement' => 'inspector' ),
            ),
        ) );
    }
}

add_action( 'init', 'jornada_industrial_callbacks_ji_navbar' );
function jornada_industrial_callbacks_ji_navbar() {
    add_filter( 'lazyblock/ji-navbar/frontend_callback', 'jornada_ji_navbar_render', 10, 2 );
    add_filter( 'lazyblock/ji-navbar/editor_callback', 'jornada_ji_navbar_render', 10, 2 );
}

if ( ! function_exists( 'jornada_ji_navbar_render' ) ) {
    function jornada_ji_navbar_render( $output, $attributes ) {
        ob_start();
        include __DIR__ . '/block.php';
        return ob_get_clean();
    }
}
