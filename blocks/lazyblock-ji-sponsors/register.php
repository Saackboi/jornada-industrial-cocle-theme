<?php
/**
 * ╔═══════════════════════════════════════════╗
 * ║  BLOCK: JI - Patrocinadores               ║
 * ║  Registro, estilos y callback del bloque  ║
 * ╚═══════════════════════════════════════════╝
 */

// Encola estilos
add_action( 'init', 'jornada_industrial_register_style_ji_sponsors' );
function jornada_industrial_register_style_ji_sponsors() {
    wp_enqueue_block_style(
        'lazyblock/ji-sponsors',
        array(
            'handle' => 'lazyblock-ji-sponsors-style',
            'src'    => get_template_directory_uri() . '/blocks/lazyblock-ji-sponsors/block.css',
            'path'   => get_template_directory() . '/blocks/lazyblock-ji-sponsors/block.css',
        )
    );
}

// Registra bloque
add_action( 'init', 'jornada_industrial_register_block_ji_sponsors' );
function jornada_industrial_register_block_ji_sponsors() {
    if ( function_exists( 'lazyblocks' ) ) {
        lazyblocks()->add_block( array(
            'title' => 'JI - Patrocinadores',
            'slug' => 'lazyblock/ji-sponsors',
            'icon' => 'dashicons-groups',
            'category' => 'theme',
            'supports' => array(
                'align' => array( 'wide', 'full' ),
            ),
            'controls' => array(
                'control_sponsors_label' => array( 'type' => 'text', 'name' => 'section_label', 'label' => 'Etiqueta Superior', 'placement' => 'inspector', 'default' => 'Aliados estratégicos' ),
                'control_sponsors_title' => array( 'type' => 'text', 'name' => 'section_title', 'label' => 'Título de la Sección', 'placement' => 'inspector', 'default' => 'Nuestros Patrocinadores' ),
                'control_sponsors_desc' => array( 'type' => 'textarea', 'name' => 'section_description', 'label' => 'Descripción Breve', 'placement' => 'inspector', 'default' => 'Organizaciones que impulsan el desarrollo industrial y hacen posible esta jornada.' ),
                'control_sponsors_list' => array(
                    'type' => 'repeater',
                    'name' => 'sponsors',
                    'label' => 'Lista de Patrocinadores',
                    'placement' => 'inspector',
                ),
                'control_sponsors_list_logo' => array(
                    'type' => 'image',
                    'name' => 'logo',
                    'label' => 'Logo',
                    'child_of' => 'control_sponsors_list',
                ),
                'control_sponsors_list_name' => array(
                    'type' => 'text',
                    'name' => 'name',
                    'label' => 'Nombre del Patrocinador',
                    'child_of' => 'control_sponsors_list',
                ),
                'control_sponsors_list_url' => array(
                    'type' => 'url',
                    'name' => 'url',
                    'label' => 'Enlace (opcional)',
                    'child_of' => 'control_sponsors_list',
                ),
            ),
        ) );
    }
}

// Asigna callbacks
add_action( 'init', 'jornada_industrial_callbacks_ji_sponsors' );
function jornada_industrial_callbacks_ji_sponsors() {
    add_filter( 'lazyblock/ji-sponsors/frontend_callback', 'jornada_ji_sponsors_render', 10, 2 );
    add_filter( 'lazyblock/ji-sponsors/editor_callback', 'jornada_ji_sponsors_render', 10, 2 );
}

// Renderiza
if ( ! function_exists( 'jornada_ji_sponsors_render' ) ) {
    function jornada_ji_sponsors_render( $output, $attributes ) {
        ob_start();
        include __DIR__ . '/block.php';
        return ob_get_clean();
    }
}
