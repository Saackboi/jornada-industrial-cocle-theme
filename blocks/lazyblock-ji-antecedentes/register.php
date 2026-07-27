<?php
/**
 * ╔═══════════════════════════════════════════╗
 * ║  BLOCK: JI - Antecedentes                 ║
 * ║  Registro, estilos y callback del bloque  ║
 * ╚═══════════════════════════════════════════╝
 */

// Encola estilos
add_action( 'init', 'jornada_industrial_register_style_ji_antecedentes' );
function jornada_industrial_register_style_ji_antecedentes() {
    wp_enqueue_block_style(
        'lazyblock/ji-antecedentes',
        array(
            'handle' => 'lazyblock-ji-antecedentes-style',
            'src'    => get_template_directory_uri() . '/blocks/lazyblock-ji-antecedentes/block.css',
            'path'   => get_template_directory() . '/blocks/lazyblock-ji-antecedentes/block.css',
        )
    );

    wp_enqueue_block_style(
        'lazyblock/ji-antecedentes',
        array(
            'handle' => 'lazyblock-ji-antecedentes-hero-subpage-style',
            'src'    => get_template_directory_uri() . '/blocks/lazyblock-ji-hero-subpage/block.css',
            'path'   => get_template_directory() . '/blocks/lazyblock-ji-hero-subpage/block.css',
        )
    );
}

// Registra bloque
add_action( 'init', 'jornada_industrial_register_block_ji_antecedentes' );
function jornada_industrial_register_block_ji_antecedentes() {
    if ( function_exists( 'lazyblocks' ) ) {
        lazyblocks()->add_block( array(
            'title'    => 'JI - Antecedentes',
            'slug'     => 'lazyblock/ji-antecedentes',
            'icon'     => 'dashicons-archive',
            'category' => 'theme',
            'supports' => array(
                'align' => array( 'wide', 'full' ),
            ),
            'controls' => array(

                // ── Imagen de Fondo de la Sección ────────────────────────────────────
                'control_ant_bg_image' => array(
                    'type'         => 'image',
                    'name'         => 'bg_image',
                    'label'        => 'Imagen de Fondo',
                    'help'         => 'Imagen que se mostrará como fondo de toda la sección.',
                    'placement'    => 'inspector',
                    'default'      => '',
                    'preview_size' => 'medium',
                ),

                // ── Sección Header ──────────────────────────────────────────

                'control_ant_label' => array(
                    'type'      => 'text',
                    'name'      => 'section_label',
                    'label'     => 'Etiqueta Superior',
                    'placement' => 'inspector',
                    'default'   => '✦ Nuestra Trayectoria',
                ),
                'control_ant_title' => array(
                    'type'      => 'text',
                    'name'      => 'section_title',
                    'label'     => 'Título de la Sección',
                    'placement' => 'inspector',
                    'default'   => 'Ediciones Anteriores',
                ),
                'control_ant_subtitle' => array(
                    'type'      => 'text',
                    'name'      => 'section_subtitle',
                    'label'     => 'Subtítulo',
                    'placement' => 'inspector',
                    'default'   => 'Revive la historia y el impacto de las ediciones pasadas de la Jornada Industrial.',
                ),

                // ── Repeater: Ediciones (Jornadas) ──────────────────────────
                'control_editions' => array(
                    'type'      => 'repeater',
                    'name'      => 'editions',
                    'label'     => 'Ediciones',
                    'placement' => 'inspector',
                ),
                    'control_ed_badge' => array(
                        'type'      => 'text',
                        'name'      => 'badge',
                        'label'     => 'Insignia (ej: "Edición Reciente")',
                        'child_of'  => 'control_editions',
                        'default'   => 'Nueva Edición',
                    ),
                    'control_ed_title' => array(
                        'type'      => 'text',
                        'name'      => 'title',
                        'label'     => 'Nombre de la Edición',
                        'child_of'  => 'control_editions',
                        'default'   => 'IV Jornada Industrial',
                    ),
                    'control_ed_tab_label' => array(
                        'type'      => 'text',
                        'name'      => 'tab_label',
                        'label'     => 'Etiqueta del Tab (corta)',
                        'child_of'  => 'control_editions',
                        'default'   => 'IV Jornada (2026)',
                    ),
                    'control_ed_date' => array(
                        'type'      => 'text',
                        'name'      => 'date',
                        'label'     => 'Fecha del Evento',
                        'child_of'  => 'control_editions',
                        'default'   => 'Octubre 2026',
                    ),
                    'control_ed_lema' => array(
                        'type'      => 'text',
                        'name'      => 'lema',
                        'label'     => 'Lema / Tema del Evento',
                        'child_of'  => 'control_editions',
                        'default'   => '',
                    ),
                    'control_ed_description' => array(
                        'type'      => 'textarea',
                        'name'      => 'description',
                        'label'     => 'Descripción General',
                        'child_of'  => 'control_editions',
                        'default'   => 'Descripción de esta edición...',
                    ),
                    'control_ed_hitos' => array(
                        'type'      => 'textarea',
                        'name'      => 'hitos',
                        'label'     => 'Hitos Destacados (uno por línea)',
                        'child_of'  => 'control_editions',
                        'default'   => '',
                    ),
                    'control_ed_main_image' => array(
                        'type'      => 'image',
                        'name'      => 'main_image',
                        'label'     => 'Imagen Principal',
                        'child_of'  => 'control_editions',
                    ),
                    'control_ed_img2' => array(
                        'type'      => 'image',
                        'name'      => 'image_2',
                        'label'     => 'Imagen 2 (miniatura)',
                        'child_of'  => 'control_editions',
                    ),
                    'control_ed_img3' => array(
                        'type'      => 'image',
                        'name'      => 'image_3',
                        'label'     => 'Imagen 3 (miniatura)',
                        'child_of'  => 'control_editions',
                    ),
                    'control_ed_img4' => array(
                        'type'      => 'image',
                        'name'      => 'image_4',
                        'label'     => 'Imagen 4 (miniatura)',
                        'child_of'  => 'control_editions',
                    ),
                    'control_ed_img5' => array(
                        'type'      => 'image',
                        'name'      => 'image_5',
                        'label'     => 'Imagen 5 (miniatura)',
                        'child_of'  => 'control_editions',
                    ),

            ),
        ) );
    }
}

// Asigna callbacks
add_action( 'init', 'jornada_industrial_callbacks_ji_antecedentes' );
function jornada_industrial_callbacks_ji_antecedentes() {
    add_filter( 'lazyblock/ji-antecedentes/frontend_callback', 'jornada_ji_antecedentes_render', 10, 2 );
    add_filter( 'lazyblock/ji-antecedentes/editor_callback',  'jornada_ji_antecedentes_render', 10, 2 );
}

// Renderiza
if ( ! function_exists( 'jornada_ji_antecedentes_render' ) ) {
    function jornada_ji_antecedentes_render( $output, $attributes ) {
        ob_start();
        include __DIR__ . '/block.php';
        return ob_get_clean();
    }
}
