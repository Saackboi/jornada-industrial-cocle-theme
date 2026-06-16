<?php
/**
 * Registro del bloque: JI - Comisiones Especializadas
 */

add_action( 'init', 'jornada_industrial_register_style_ji_comisiones' );
function jornada_industrial_register_style_ji_comisiones() {
    wp_enqueue_block_style(
        'lazyblock/ji-comisiones',
        array(
            'handle' => 'lazyblock-ji-comisiones-style',
            'src'    => get_template_directory_uri() . '/blocks/lazyblock-ji-comisiones/block.css',
            'path'   => get_template_directory() . '/blocks/lazyblock-ji-comisiones/block.css',
        )
    );
}

add_action( 'init', 'jornada_industrial_register_block_ji_comisiones' );
function jornada_industrial_register_block_ji_comisiones() {
    if ( function_exists( 'lazyblocks' ) ) {
        lazyblocks()->add_block( array(
            'title' => 'JI - Comisiones Especializadas',
            'slug' => 'lazyblock/ji-comisiones',
            'icon' => 'dashicons-networking',
            'category' => 'theme',
            'supports' => array(
                'align' => array( 'wide', 'full' ),
            ),
            'controls' => array(
                'control_com_label' => array( 'type' => 'text', 'name' => 'section_label', 'label' => 'Etiqueta Superior', 'placement' => 'inspector', 'default' => '✦ Estructura Interna' ),
                'control_com_title' => array( 'type' => 'text', 'name' => 'section_title', 'label' => 'Título de la Sección', 'placement' => 'inspector', 'default' => 'Comisiones Especializadas' ),
                'control_comisiones' => array( 'type' => 'repeater', 'name' => 'commissions', 'label' => 'Comisiones', 'placement' => 'inspector' ),
                'control_comisiones_name' => array( 'type' => 'text', 'name' => 'name', 'label' => 'Nombre', 'child_of' => 'control_comisiones' ),
                'control_comisiones_leader' => array( 'type' => 'text', 'name' => 'leader', 'label' => 'Líder', 'child_of' => 'control_comisiones' ),
                'control_comisiones_photo' => array( 'type' => 'image', 'name' => 'photo', 'label' => 'Foto de la Comisión', 'child_of' => 'control_comisiones' ),
                'control_comisiones_b64' => array( 'type' => 'text', 'name' => 'commissions_b64', 'label' => 'Backup Base64 (No Tocar)', 'placement' => 'inspector' ),
            ),
        ) );
    }
}

add_action( 'init', 'jornada_industrial_callbacks_ji_comisiones' );
function jornada_industrial_callbacks_ji_comisiones() {
    add_filter( 'lazyblock/ji-comisiones/frontend_callback', 'jornada_ji_comisiones_render', 10, 2 );
    add_filter( 'lazyblock/ji-comisiones/editor_callback', 'jornada_ji_comisiones_render', 10, 2 );
}

if ( ! function_exists( 'jornada_ji_comisiones_render' ) ) {
    function jornada_ji_comisiones_render( $output, $attributes ) {
        ob_start();
        include __DIR__ . '/block.php';
        return ob_get_clean();
    }
}
