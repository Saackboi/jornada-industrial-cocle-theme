<?php
/**
 * ╔═══════════════════════════════════════════╗
 * ║  BLOCK: JI - Hero V3                      ║
 * ║  Registro, estilos y callback del bloque  ║
 * ╚═══════════════════════════════════════════╝
 */

// Encola estilos
add_action( 'init', 'jornada_industrial_register_style_ji_hero_v3' );
function jornada_industrial_register_style_ji_hero_v3() {
    wp_enqueue_block_style(
        'lazyblock/ji-hero-v3',
        array(
            'handle' => 'lazyblock-ji-hero-v3-style',
            'src'    => get_template_directory_uri() . '/blocks/lazyblock-ji-hero-v3/block.css',
            'path'   => get_template_directory() . '/blocks/lazyblock-ji-hero-v3/block.css',
        )
    );
}

// Registra bloque
add_action( 'init', 'jornada_industrial_register_block_ji_hero_v3' );
function jornada_industrial_register_block_ji_hero_v3() {
    if ( function_exists( 'lazyblocks' ) ) {
        lazyblocks()->add_block( array(
            'title' => 'JI - Hero V3',
            'slug' => 'lazyblock/ji-hero-v3',
            'icon' => 'dashicons-welcome-widgets-menus',
            'category' => 'theme',
            'supports' => array(
                'align' => array( 'wide', 'full' ),
            ),
            'controls' => array(
                'control_herov3_overline' => array( 'type' => 'text', 'name' => 'overline', 'label' => 'Supertexto / Volanta', 'placement' => 'inspector', 'default' => 'Universidad Tecnológica de Panamá' ),
                'control_herov3_title' => array( 'type' => 'text', 'name' => 'titulo', 'label' => 'Título Principal', 'placement' => 'inspector', 'default' => "UTP Coclé\nSede de la III Jornada Industrial" ),
                'control_herov3_desc' => array( 'type' => 'textarea', 'name' => 'descripcion', 'label' => 'Descripción', 'placement' => 'inspector', 'default' => 'Unificando la ingeniería, logística y el mercadeo internacional en un evento sin precedentes en el interior del país.' ),
                'control_herov3_bg' => array( 'type' => 'image', 'name' => 'bg_image', 'label' => 'Imagen de Fondo', 'placement' => 'inspector' ),
                'control_herov3_cards' => array(
                    'type' => 'repeater',
                    'name' => 'cards',
                    'label' => 'Tarjetas Inferiores (Max 3)',
                    'placement' => 'inspector',
                    'default' => array(
                        array( 'titulo' => 'Ingeniería Industrial', 'descripcion' => 'Optimizando procesos críticos para la industria moderna.' ),
                        array( 'titulo' => 'Logística & Transporte', 'descripcion' => 'Soluciones multimodales para un mercado globalizado.' ),
                        array( 'titulo' => 'Mercadeo Global', 'descripcion' => 'Estrategias de posicionamiento y expansión comercial.' ),
                    ),
                ),
                'control_herov3_cards_title' => array(
                    'type' => 'text',
                    'name' => 'titulo',
                    'label' => 'Título de Tarjeta',
                    'child_of' => 'control_herov3_cards',
                ),
                'control_herov3_cards_desc' => array(
                    'type' => 'text',
                    'name' => 'descripcion',
                    'label' => 'Descripción de Tarjeta',
                    'child_of' => 'control_herov3_cards',
                ),
            ),
        ) );
    }
}

// Asigna callbacks
add_action( 'init', 'jornada_industrial_callbacks_ji_hero_v3' );
function jornada_industrial_callbacks_ji_hero_v3() {
    add_filter( 'lazyblock/ji-hero-v3/frontend_callback', 'jornada_ji_hero_v3_render', 10, 2 );
    add_filter( 'lazyblock/ji-hero-v3/editor_callback', 'jornada_ji_hero_v3_render', 10, 2 );
}

// Renderiza
if ( ! function_exists( 'jornada_ji_hero_v3_render' ) ) {
    function jornada_ji_hero_v3_render( $output, $attributes ) {
        ob_start();
        include __DIR__ . '/block.php';
        return ob_get_clean();
    }
}
