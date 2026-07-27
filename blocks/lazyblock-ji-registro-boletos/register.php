<?php
/**
 * Registro del bloque: JI - Registro de Boletos
 */

add_action( 'init', 'jornada_industrial_register_style_ji_registro_boletos' );
function jornada_industrial_register_style_ji_registro_boletos() {
    wp_enqueue_block_style(
        'lazyblock/ji-registro-boletos',
        array(
            'handle' => 'lazyblock-ji-registro-boletos-style',
            'src'    => get_template_directory_uri() . '/blocks/lazyblock-ji-registro-boletos/block.css',
            'path'   => get_template_directory() . '/blocks/lazyblock-ji-registro-boletos/block.css',
        )
    );
}

add_action( 'init', 'jornada_industrial_register_block_ji_registro_boletos' );
function jornada_industrial_register_block_ji_registro_boletos() {
    if ( function_exists( 'lazyblocks' ) ) {
        lazyblocks()->add_block( array(
            'title' => 'JI - Registro de Boletos',
            'slug' => 'lazyblock/ji-registro-boletos',
            'icon' => 'dashicons-tickets-alt',
            'category' => 'theme',
            'supports' => array(
                'align' => array( 'wide', 'full' ),
            ),
            'controls' => array(
                'control_registro_label' => array( 'type' => 'text', 'name' => 'section_label', 'label' => 'Etiqueta Superior', 'placement' => 'inspector', 'default' => 'Registro oficial' ),
                'control_registro_title' => array( 'type' => 'text', 'name' => 'section_title', 'label' => 'Titulo', 'placement' => 'inspector', 'default' => 'Compra tu boleto' ),
                'control_registro_description' => array( 'type' => 'textarea', 'name' => 'description', 'label' => 'Descripcion', 'placement' => 'inspector', 'default' => 'Selecciona una de las personas autorizadas para vender boletos y presiona el boton de registro. El formulario se abrira con los datos del vendedor cargados para completar tu inscripcion.' ),
                'control_registro_vendedores' => array( 'type' => 'repeater', 'name' => 'sellers', 'label' => 'Vendedores', 'placement' => 'inspector' ),
                'control_registro_name' => array( 'type' => 'text', 'name' => 'name', 'label' => 'Nombre', 'child_of' => 'control_registro_vendedores' ),
                'control_registro_email' => array( 'type' => 'text', 'name' => 'email', 'label' => 'Correo', 'child_of' => 'control_registro_vendedores' ),
                'control_registro_cedula' => array( 'type' => 'text', 'name' => 'cedula', 'label' => 'Cedula', 'child_of' => 'control_registro_vendedores' ),
                'control_registro_phone' => array( 'type' => 'text', 'name' => 'phone', 'label' => 'Telefono', 'child_of' => 'control_registro_vendedores' ),
                'control_registro_commission' => array( 'type' => 'text', 'name' => 'commission', 'label' => 'Comision', 'child_of' => 'control_registro_vendedores' ),
                'control_registro_url' => array( 'type' => 'url', 'name' => 'url', 'label' => 'Link de registro', 'child_of' => 'control_registro_vendedores' ),
            ),
        ) );
    }
}

add_action( 'init', 'jornada_industrial_callbacks_ji_registro_boletos' );
function jornada_industrial_callbacks_ji_registro_boletos() {
    add_filter( 'lazyblock/ji-registro-boletos/frontend_callback', 'jornada_ji_registro_boletos_render', 10, 2 );
    add_filter( 'lazyblock/ji-registro-boletos/editor_callback', 'jornada_ji_registro_boletos_render', 10, 2 );
}

if ( ! function_exists( 'jornada_ji_registro_boletos_render' ) ) {
    function jornada_ji_registro_boletos_render( $output, $attributes ) {
        ob_start();
        include __DIR__ . '/block.php';
        return ob_get_clean();
    }
}
