<?php
/**
 * ╔═══════════════════════════════════════════╗
 * ║  BLOCK: JI - About Purpose                ║
 * ║  Registro, estilos y callback del bloque  ║
 * ╚═══════════════════════════════════════════╝
 */

// Registra bloque
add_action('init', function() {
    if ( function_exists( 'lazyblocks' ) ) :

        lazyblocks()->add_block( array(
        'id' => 1103,
        'title' => 'JI - About Purpose',
        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/></svg>',
        'keyword' => '',
        'slug' => 'lazyblock/ji-about-purpose',
        'description' => 'Sección parallax de cristal esmerilado para la organización.',
        'category' => 'jornada-industrial',
        'category_label' => 'jornada-industrial',
        'supports' => array(
            'customClassName' => true,
            'anchor' => false,
            'align' => array(
                0 => 'wide',
                1 => 'full',
            ),
            'html' => false,
            'multiple' => true,
            'inserter' => true,
        ),
        'ghostkit' => array(
            'display' => true,
            'multiple' => false,
        ),
        'controls' => array(
            'control_1103_1' => array(
                'type' => 'text',
                'name' => 'title',
                'default' => 'La Organización',
                'label' => 'Título',
                'help' => '',
                'child_of' => '',
                'placement' => 'content',
                'width' => '100',
                'hide_if_not_selected' => 'false',
                'save_in_meta' => 'false',
                'save_in_meta_name' => '',
                'required' => 'false',
                'placeholder' => '',
                'characters_limit' => '',
            ),
            'control_1103_2' => array(
                'type' => 'rich_text',
                'name' => 'content',
                'default' => '<p>El principal propósito de la Jornada Industrial UTP es...</p>',
                'label' => 'Contenido',
                'help' => '',
                'child_of' => '',
                'placement' => 'content',
                'width' => '100',
                'hide_if_not_selected' => 'false',
                'save_in_meta' => 'false',
                'save_in_meta_name' => '',
                'required' => 'false',
                'placeholder' => '',
                'characters_limit' => '',
            ),
            'control_1103_3' => array(
                'type' => 'image',
                'name' => 'bg_image',
                'default' => '',
                'label' => 'Imagen de Fondo',
                'help' => 'Imagen para el efecto parallax de fondo.',
                'child_of' => '',
                'placement' => 'content',
                'width' => '100',
                'hide_if_not_selected' => 'false',
                'save_in_meta' => 'false',
                'save_in_meta_name' => '',
                'required' => 'false',
                'preview_size' => 'medium',
                'placeholder' => '',
                'characters_limit' => '',
            ),
        ),
        'code' => array(
            'output_method' => 'html',
            'editor_html' => '',
            'editor_callback' => '',
            'editor_css' => '',
            'frontend_html' => '',
            'frontend_callback' => '',
            'frontend_css' => '',
            'show_preview' => 'always',
            'single_output' => false,
        ),
        'condition' => array(),
    ) );

    endif;
});

// Encola estilos
add_action( 'init', function() {
    wp_enqueue_block_style(
        'lazyblock/ji-about-purpose',
        array(
            'handle' => 'lazyblock-ji-about-purpose-style',
            'src'    => get_template_directory_uri() . '/blocks/lazyblock-ji-about-purpose/block.css',
            'path'   => get_template_directory() . '/blocks/lazyblock-ji-about-purpose/block.css',
        )
    );
});

// Asigna callbacks
add_action( 'init', function() {
    add_filter( 'lazyblock/ji-about-purpose/frontend_callback', 'jornada_ji_about_purpose_render', 10, 2 );
    add_filter( 'lazyblock/ji-about-purpose/editor_callback', 'jornada_ji_about_purpose_render', 10, 2 );
});

// Renderiza
if ( ! function_exists( 'jornada_ji_about_purpose_render' ) ) {
    function jornada_ji_about_purpose_render( $output, $attributes ) {
        ob_start();
        include __DIR__ . '/block.php';
        return ob_get_clean();
    }
}

