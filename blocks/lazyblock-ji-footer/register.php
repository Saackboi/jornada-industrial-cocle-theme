<?php
/**
 * Registro del bloque: JI - Footer General
 */

add_action( 'init', 'jornada_industrial_register_style_ji_footer' );
function jornada_industrial_register_style_ji_footer() {
    wp_enqueue_block_style(
        'lazyblock/ji-footer',
        array(
            'handle' => 'lazyblock-ji-footer-style',
            'src'    => get_template_directory_uri() . '/blocks/lazyblock-ji-footer/block.css',
            'path'   => get_template_directory() . '/blocks/lazyblock-ji-footer/block.css',
        )
    );
}

add_action( 'init', 'jornada_industrial_register_block_ji_footer' );
function jornada_industrial_register_block_ji_footer() {
    if ( function_exists( 'lazyblocks' ) ) {
        lazyblocks()->add_block( array(
            'title' => 'JI - Footer General',
            'slug' => 'lazyblock/ji-footer',
            'icon' => 'dashicons-networking',
            'category' => 'theme',
            'supports' => array(
                'align' => array( 'wide', 'full' ),
            ),
            'controls' => array(
                'control_footer_title' => array( 'type' => 'text', 'name' => 'title', 'label' => 'Nombre del Evento', 'placement' => 'inspector', 'default' => 'III Jornada Industrial' ),
                'control_footer_desc' => array( 'type' => 'textarea', 'name' => 'descripcion', 'label' => 'Descripción', 'placement' => 'inspector', 'default' => 'Un evento organizado por la Facultad de Ingeniería Industrial de la Universidad Tecnológica de Panamá, Centro Regional de Coclé.' ),
                'control_footer_copy' => array( 'type' => 'text', 'name' => 'copyright', 'label' => 'Texto de Copyright', 'placement' => 'inspector', 'default' => '© 2025 UTP Coclé. Todos los derechos reservados.' ),
                'control_footer_col1_title' => array( 'type' => 'text', 'name' => 'col1_title', 'label' => 'Título Columna 1', 'placement' => 'inspector', 'default' => 'Recursos UTP' ),
                'control_footer_col1_links' => array(
                    'type' => 'repeater',
                    'name' => 'col1_links',
                    'label' => 'Enlaces Columna 1',
                    'placement' => 'inspector',
                    'default' => array(
                        array( 'label' => 'Sitio Web UTP', 'url' => 'https://www.utp.ac.pa' ),
                        array( 'label' => 'Centro Regional de Coclé', 'url' => 'https://cc.utp.ac.pa' ),
                        array( 'label' => 'Facultad de Ingeniería Industrial', 'url' => 'https://fii.utp.ac.pa' ),
                    ),
                ),
                'control_footer_col1_links_label' => array(
                    'type' => 'text',
                    'name' => 'label',
                    'label' => 'Texto',
                    'child_of' => 'control_footer_col1_links',
                ),
                'control_footer_col1_links_url' => array(
                    'type' => 'url',
                    'name' => 'url',
                    'label' => 'URL',
                    'child_of' => 'control_footer_col1_links',
                ),
                'control_footer_col2_title' => array( 'type' => 'text', 'name' => 'col2_title', 'label' => 'Título Columna 2', 'placement' => 'inspector', 'default' => 'Atención' ),
                'control_footer_col2_links' => array(
                    'type' => 'repeater',
                    'name' => 'col2_links',
                    'label' => 'Enlaces Columna 2',
                    'placement' => 'inspector',
                    'default' => array(
                        array( 'label' => 'Contacto y Correo', 'url' => 'mailto:cocle.industrial@utp.ac.pa' ),
                        array( 'label' => 'Ubicación del Campus', 'url' => '#' ),
                        array( 'label' => 'Registro Online', 'url' => '#' ),
                    ),
                ),
                'control_footer_col2_links_label' => array(
                    'type' => 'text',
                    'name' => 'label',
                    'label' => 'Texto',
                    'child_of' => 'control_footer_col2_links',
                ),
                'control_footer_col2_links_url' => array(
                    'type' => 'url',
                    'name' => 'url',
                    'label' => 'URL',
                    'child_of' => 'control_footer_col2_links',
                ),
            ),
        ) );
    }
}

add_action( 'init', 'jornada_industrial_callbacks_ji_footer' );
function jornada_industrial_callbacks_ji_footer() {
    add_filter( 'lazyblock/ji-footer/frontend_callback', 'jornada_ji_footer_render', 10, 2 );
    add_filter( 'lazyblock/ji-footer/editor_callback', 'jornada_ji_footer_render', 10, 2 );
}

if ( ! function_exists( 'jornada_ji_footer_render' ) ) {
    function jornada_ji_footer_render( $output, $attributes ) {
        ob_start();
        include __DIR__ . '/block.php';
        return ob_get_clean();
    }
}
