<?php
/**
 * ╔═══════════════════════════════════════════╗
 * ║  BLOCK: JI - Cabecera de Subpágina        ║
 * ║  Registro, estilos y callback del bloque  ║
 * ╚═══════════════════════════════════════════╝
 */

// Encola estilos
add_action( 'init', 'jornada_industrial_register_style_ji_hero_subpage' );
function jornada_industrial_register_style_ji_hero_subpage() {
    wp_enqueue_block_style(
        'lazyblock/ji-hero-subpage',
        array(
            'handle' => 'lazyblock-ji-hero-subpage-style',
            'src'    => get_template_directory_uri() . '/blocks/lazyblock-ji-hero-subpage/block.css',
            'path'   => get_template_directory() . '/blocks/lazyblock-ji-hero-subpage/block.css',
        )
    );
}

// Registra bloque
add_action( 'init', 'jornada_industrial_register_block_ji_hero_subpage' );
function jornada_industrial_register_block_ji_hero_subpage() {
    if ( function_exists( 'lazyblocks' ) ) {
        lazyblocks()->add_block( array(
            'title' => 'JI - Cabecera de Subpágina',
            'slug' => 'lazyblock/ji-hero-subpage',
            'icon' => 'dashicons-cover-image',
            'category' => 'theme',
            'supports' => array(
                'align' => array( 'wide', 'full' ),
            ),
            'controls' => array(
                'control_hero_subpage_eyebrow' => array( 'type' => 'text', 'name' => 'eyebrow', 'label' => 'Copete / Eyebrow', 'placement' => 'inspector', 'default' => '✦ Nosotros · IV Jornada Industrial' ),
                'control_hero_subpage_title' => array( 'type' => 'text', 'name' => 'title', 'label' => 'Título Principal', 'placement' => 'inspector', 'default' => 'Comité Organizador' ),
                'control_hero_subpage_subtitle' => array( 'type' => 'text', 'name' => 'subtitle', 'label' => 'Subtítulo / Descripción', 'placement' => 'inspector', 'default' => 'Los estudiantes que hacen posible el evento de ingeniería más importante del Centro Regional de Coclé.' ),
                'control_hero_subpage_bg' => array( 'type' => 'image', 'name' => 'bg_image', 'label' => 'Imagen de Fondo', 'placement' => 'inspector' ),
            ),
        ) );
    }
}

// Asigna callbacks
add_action( 'init', 'jornada_industrial_callbacks_ji_hero_subpage' );
function jornada_industrial_callbacks_ji_hero_subpage() {
    add_filter( 'lazyblock/ji-hero-subpage/frontend_callback', 'jornada_ji_hero_subpage_render', 10, 2 );
    add_filter( 'lazyblock/ji-hero-subpage/editor_callback', 'jornada_ji_hero_subpage_render', 10, 2 );
}

// Renderiza
if ( ! function_exists( 'jornada_ji_hero_subpage_render' ) ) {
    function jornada_ji_hero_subpage_render( $output, $attributes ) {
        ob_start();
        include __DIR__ . '/block.php';
        return ob_get_clean();
    }
}
