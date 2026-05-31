<?php
/**
 * Registro del bloque: JI - Contador Regresivo
 */

add_action( 'init', 'jornada_industrial_register_style_ji_countdown' );
function jornada_industrial_register_style_ji_countdown() {
    wp_enqueue_block_style(
        'lazyblock/ji-countdown',
        array(
            'handle' => 'lazyblock-ji-countdown-style',
            'src'    => get_template_directory_uri() . '/blocks/lazyblock-ji-countdown/block.css',
            'path'   => get_template_directory() . '/blocks/lazyblock-ji-countdown/block.css',
        )
    );
}

add_action( 'init', 'jornada_industrial_register_block_ji_countdown' );
function jornada_industrial_register_block_ji_countdown() {
    if ( function_exists( 'lazyblocks' ) ) {
        lazyblocks()->add_block( array(
            'title' => 'JI - Contador Regresivo',
            'slug' => 'lazyblock/ji-countdown',
            'icon' => 'dashicons-clock',
            'category' => 'theme',
            'supports' => array(
                'align' => array( 'wide', 'full' ),
            ),
            'controls' => array(
                'control_countdown_date' => array( 'type' => 'text', 'name' => 'target_date', 'label' => 'Fecha Objetivo (YYYY-MM-DD HH:MM:SS)', 'placement' => 'inspector', 'default' => '2026-06-15 09:00:00' ),
            ),
        ) );
    }
}

add_action( 'init', 'jornada_industrial_callbacks_ji_countdown' );
function jornada_industrial_callbacks_ji_countdown() {
    add_filter( 'lazyblock/ji-countdown/frontend_callback', 'jornada_ji_countdown_render', 10, 2 );
    add_filter( 'lazyblock/ji-countdown/editor_callback', 'jornada_ji_countdown_render', 10, 2 );
}

if ( ! function_exists( 'jornada_ji_countdown_render' ) ) {
    function jornada_ji_countdown_render( $output, $attributes ) {
        ob_start();
        include __DIR__ . '/block.php';
        return ob_get_clean();
    }
}
