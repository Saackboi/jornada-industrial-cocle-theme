<?php
/**
 * Registro del bloque: JI - Propósito y Dirección
 */

add_action( 'init', 'jornada_industrial_register_style_ji_mvo_cards' );
function jornada_industrial_register_style_ji_mvo_cards() {
    wp_enqueue_block_style(
        'lazyblock/ji-mvo-cards',
        array(
            'handle' => 'lazyblock-ji-mvo-cards-style',
            'src'    => get_template_directory_uri() . '/blocks/lazyblock-ji-mvo-cards/block.css',
            'path'   => get_template_directory() . '/blocks/lazyblock-ji-mvo-cards/block.css',
        )
    );
}

add_action( 'init', 'jornada_industrial_register_block_ji_mvo_cards' );
function jornada_industrial_register_block_ji_mvo_cards() {
    if ( function_exists( 'lazyblocks' ) ) {
        lazyblocks()->add_block( array(
            'title' => 'JI - Propósito y Dirección',
            'slug' => 'lazyblock/ji-mvo-cards',
            'icon' => 'dashicons-editor-help',
            'category' => 'theme',
            'supports' => array(
                'align' => array( 'wide', 'full' ),
            ),
            'controls' => array(
                'control_mvo_label' => array( 'type' => 'text', 'name' => 'section_label', 'label' => 'Etiqueta Superior', 'placement' => 'inspector', 'default' => '✦ Nuestra Razón de Ser' ),
                'control_mvo_title' => array( 'type' => 'text', 'name' => 'section_title', 'label' => 'Título de la Sección', 'placement' => 'inspector', 'default' => 'Propósito y Dirección' ),
                'control_mvo_cards' => array( 'type' => 'repeater', 'name' => 'cards', 'label' => 'Tarjetas', 'placement' => 'inspector' ),
                'control_mvo_cards_title' => array( 'type' => 'text', 'name' => 'title', 'label' => 'Título de Tarjeta', 'child_of' => 'control_mvo_cards' ),
                'control_mvo_cards_icon' => array( 'type' => 'text', 'name' => 'icon', 'label' => 'Ícono (Emoji o Símbolo)', 'child_of' => 'control_mvo_cards', 'default' => '🎯' ),
                'control_mvo_cards_desc' => array( 'type' => 'textarea', 'name' => 'description', 'label' => 'Descripción', 'child_of' => 'control_mvo_cards' ),
                'control_mvo_cards_b64' => array( 'type' => 'text', 'name' => 'cards_b64', 'label' => 'Backup Base64 (No Tocar)', 'placement' => 'inspector' ),
            ),
        ) );
    }
}

add_action( 'init', 'jornada_industrial_callbacks_ji_mvo_cards' );
function jornada_industrial_callbacks_ji_mvo_cards() {
    add_filter( 'lazyblock/ji-mvo-cards/frontend_callback', 'jornada_ji_mvo_cards_render', 10, 2 );
    add_filter( 'lazyblock/ji-mvo-cards/editor_callback', 'jornada_ji_mvo_cards_render', 10, 2 );
}

if ( ! function_exists( 'jornada_ji_mvo_cards_render' ) ) {
    function jornada_ji_mvo_cards_render( $output, $attributes ) {
        ob_start();
        include __DIR__ . '/block.php';
        return ob_get_clean();
    }
}
