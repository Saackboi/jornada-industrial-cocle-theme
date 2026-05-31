<?php
/**
 * Registro del bloque: JI - Lugar y Mapa
 */

add_action( 'init', 'jornada_industrial_register_style_ji_location' );
function jornada_industrial_register_style_ji_location() {
    wp_enqueue_block_style(
        'lazyblock/ji-location',
        array(
            'handle' => 'lazyblock-ji-location-style',
            'src'    => get_template_directory_uri() . '/blocks/lazyblock-ji-location/block.css',
            'path'   => get_template_directory() . '/blocks/lazyblock-ji-location/block.css',
        )
    );
}

add_action( 'init', 'jornada_industrial_register_block_ji_location' );
function jornada_industrial_register_block_ji_location() {
    if ( function_exists( 'lazyblocks' ) ) {
        lazyblocks()->add_block( array(
            'title' => 'JI - Lugar y Mapa',
            'slug' => 'lazyblock/ji-location',
            'icon' => 'dashicons-location',
            'category' => 'theme',
            'supports' => array(
                'align' => array( 'wide', 'full' ),
            ),
            'controls' => array(
                'control_location_overline' => array( 'type' => 'text', 'name' => 'overline', 'label' => 'Supertexto', 'placement' => 'inspector', 'default' => 'Ubicación Estratégica' ),
                'control_location_title' => array( 'type' => 'text', 'name' => 'titulo', 'label' => 'Título', 'placement' => 'inspector', 'default' => "Lugar del evento:\nCOEDUCO, Coclé" ),
                'control_location_desc' => array( 'type' => 'textarea', 'name' => 'descripcion', 'label' => 'Descripción', 'placement' => 'inspector', 'default' => 'Acompáñenos en el epicentro de la innovación. COEDUCO ofrece instalaciones de primer nivel para albergar ponencias internacionales y demostraciones técnicas en vivo.' ),
                'control_location_btn_text' => array( 'type' => 'text', 'name' => 'btn_text', 'label' => 'Texto del Botón', 'placement' => 'inspector', 'default' => 'Obtener Ruta' ),
                'control_location_btn_url' => array( 'type' => 'url', 'name' => 'btn_url', 'label' => 'URL del Botón', 'placement' => 'inspector' ),
                'control_location_map_url' => array( 'type' => 'text', 'name' => 'map_iframe_url', 'label' => 'URL de Embed de Google Maps (src de iframe)', 'placement' => 'inspector', 'default' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15764.072935273397!2d-80.37042010839843!3d8.497587799999993!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8fac6123e7f8e815%3A0xc4b38d3845b4c10a!2sUniversidad%20Tecnol%C3%B3gica%20de%20Panam%C3%A1%2C%20Centro%20Regional%20de%20Cocl%C3%A9!5e0!3m2!1sen!2s!4v1715000000000!5m2!1sen!2s' ),
            ),
        ) );
    }
}

add_action( 'init', 'jornada_industrial_callbacks_ji_location' );
function jornada_industrial_callbacks_ji_location() {
    add_filter( 'lazyblock/ji-location/frontend_callback', 'jornada_ji_location_render', 10, 2 );
    add_filter( 'lazyblock/ji-location/editor_callback', 'jornada_ji_location_render', 10, 2 );
}

if ( ! function_exists( 'jornada_ji_location_render' ) ) {
    function jornada_ji_location_render( $output, $attributes ) {
        ob_start();
        include __DIR__ . '/block.php';
        return ob_get_clean();
    }
}
