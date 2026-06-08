<?php
/**
 * Registro del bloque: JI - Separador de Sección
 */

add_action( 'init', 'jornada_industrial_register_style_ji_section_divider' );
function jornada_industrial_register_style_ji_section_divider() {
    wp_enqueue_block_style(
        'lazyblock/ji-section-divider',
        array(
            'handle' => 'lazyblock-ji-section-divider-style',
            'src'    => get_template_directory_uri() . '/blocks/lazyblock-ji-section-divider/block.css',
            'path'   => get_template_directory() . '/blocks/lazyblock-ji-section-divider/block.css',
        )
    );
}

add_action( 'init', 'jornada_industrial_register_block_ji_section_divider' );
function jornada_industrial_register_block_ji_section_divider() {
    if ( function_exists( 'lazyblocks' ) ) {
        lazyblocks()->add_block( array(
            'title' => 'JI - Separador de Sección',
            'slug' => 'lazyblock/ji-section-divider',
            'icon' => 'dashicons-minus',
            'category' => 'theme',
            'supports' => array(
                'align' => array( 'wide', 'full' ),
            ),
            'controls' => array(
                'control_divider_type' => array(
                    'type' => 'select',
                    'name' => 'divider_type',
                    'label' => 'Tipo de Separador',
                    'placement' => 'inspector',
                    'default' => 'space',
                    'choices' => array(
                        array( 'label' => 'Espacio limpio', 'value' => 'space' ),
                        array( 'label' => 'Curva suave', 'value' => 'curve' ),
                    ),
                ),
                'control_divider_size' => array(
                    'type' => 'select',
                    'name' => 'divider_size',
                    'label' => 'Altura',
                    'placement' => 'inspector',
                    'default' => 'medium',
                    'choices' => array(
                        array( 'label' => 'Pequeño', 'value' => 'small' ),
                        array( 'label' => 'Medio', 'value' => 'medium' ),
                        array( 'label' => 'Grande', 'value' => 'large' ),
                    ),
                ),
                'control_divider_from' => array(
                    'type' => 'select',
                    'name' => 'from_tone',
                    'label' => 'Fondo anterior',
                    'placement' => 'inspector',
                    'default' => 'light',
                    'choices' => array(
                        array( 'label' => 'Claro', 'value' => 'light' ),
                        array( 'label' => 'Azul', 'value' => 'primary' ),
                    ),
                ),
                'control_divider_to' => array(
                    'type' => 'select',
                    'name' => 'to_tone',
                    'label' => 'Fondo siguiente',
                    'placement' => 'inspector',
                    'default' => 'primary',
                    'choices' => array(
                        array( 'label' => 'Claro', 'value' => 'light' ),
                        array( 'label' => 'Azul', 'value' => 'primary' ),
                    ),
                ),
                'control_divider_accent' => array(
                    'type' => 'toggle',
                    'name' => 'show_accent',
                    'label' => 'Mostrar acento dorado',
                    'placement' => 'inspector',
                    'default' => true,
                ),
            ),
        ) );
    }
}

add_action( 'init', 'jornada_industrial_callbacks_ji_section_divider' );
function jornada_industrial_callbacks_ji_section_divider() {
    add_filter( 'lazyblock/ji-section-divider/frontend_callback', 'jornada_ji_section_divider_render', 10, 2 );
    add_filter( 'lazyblock/ji-section-divider/editor_callback', 'jornada_ji_section_divider_render', 10, 2 );
}

if ( ! function_exists( 'jornada_ji_section_divider_render' ) ) {
    function jornada_ji_section_divider_render( $output, $attributes ) {
        ob_start();
        include __DIR__ . '/block.php';
        return ob_get_clean();
    }
}
