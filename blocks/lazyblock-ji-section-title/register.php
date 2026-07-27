/**
 * ╔═══════════════════════════════════════════╗
 * ║  JI-BASE Section Title                   ║
 * ║  Section title with configurable heading  ║
 * ║  level, alignment, and optional subtitle. ║
 * ╚═══════════════════════════════════════════╝
 */

<?php
add_action( 'init', 'jornada_industrial_register_style_ji_section_title' );
function jornada_industrial_register_style_ji_section_title() {
    wp_enqueue_block_style(
        'lazyblock/ji-section-title',
        array(
            'handle' => 'lazyblock-ji-section-title-style',
            'src'    => get_template_directory_uri() . '/blocks/lazyblock-ji-section-title/block.css',
            'path'   => get_template_directory() . '/blocks/lazyblock-ji-section-title/block.css',
        )
    );
}

add_action( 'init', 'jornada_industrial_register_block_ji_section_title' );
function jornada_industrial_register_block_ji_section_title() {
    if ( function_exists( 'lazyblocks' ) ) {
        lazyblocks()->add_block( array(
            'title'    => 'JI-BASE Título de Sección',
            'slug'     => 'lazyblock/ji-section-title',
            'icon'     => 'dashicons-heading',
            'category' => 'theme',
            'supports' => array( 'align' => array( 'wide', 'full' ) ),
            'controls' => array(
                'control_stt_titulo' => array(
                    'type'      => 'text',
                    'name'      => 'titulo',
                    'label'     => 'Título',
                    'placement' => 'inspector',
                    'default'   => 'Título de la sección',
                ),
                'control_stt_nivel' => array(
                    'type'      => 'select',
                    'name'      => 'nivel',
                    'label'     => 'Nivel',
                    'placement' => 'inspector',
                    'default'   => 'h2',
                    'choices'   => array(
                        array( 'label' => 'H2', 'value' => 'h2' ),
                        array( 'label' => 'H3', 'value' => 'h3' ),
                        array( 'label' => 'H4', 'value' => 'h4' ),
                    ),
                ),
                'control_stt_alineacion' => array(
                    'type'      => 'select',
                    'name'      => 'alineacion',
                    'label'     => 'Alineación',
                    'placement' => 'inspector',
                    'default'   => 'center',
                    'choices'   => array(
                        array( 'label' => 'Centrado', 'value' => 'center' ),
                        array( 'label' => 'Izquierda', 'value' => 'left' ),
                    ),
                ),
                'control_stt_subtitulo' => array(
                    'type'      => 'textarea',
                    'name'      => 'subtitulo',
                    'label'     => 'Subtítulo (opcional)',
                    'placement' => 'inspector',
                    'default'   => '',
                ),
                'control_stt_accento' => array(
                    'type'      => 'toggle',
                    'name'      => 'mostrar_accento',
                    'label'     => 'Mostrar línea decorativa',
                    'placement' => 'inspector',
                    'default'   => true,
                ),
            ),
        ) );
    }
}

add_action( 'init', 'jornada_industrial_callbacks_ji_section_title' );
function jornada_industrial_callbacks_ji_section_title() {
    add_filter( 'lazyblock/ji-section-title/frontend_callback', 'jornada_ji_section_title_render', 10, 2 );
    add_filter( 'lazyblock/ji-section-title/editor_callback', 'jornada_ji_section_title_render', 10, 2 );
}

if ( ! function_exists( 'jornada_ji_section_title_render' ) ) {
    function jornada_ji_section_title_render( $output, $attributes ) {
        ob_start();
        include __DIR__ . '/block.php';
        return ob_get_clean();
    }
}
