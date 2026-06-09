<?php
add_action('init', function() {
    if ( function_exists( 'lazyblocks' ) ) :

        lazyblocks()->add_block( array(
            'id' => 1102,
            'title' => 'JI - Objetivos',
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/></svg>',
            'keyword' => '',
            'slug' => 'lazyblock/ji-objetivos',
            'description' => 'Grid interactivo para listar los objetivos.',
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
            'controls' => array(
                array(
                    'type' => 'text',
                    'name' => 'title',
                    'default' => 'Nuestros Objetivos',
                    'label' => 'Título de la Sección',
                    'help' => '',
                    'child_of' => '',
                    'placement' => 'inspector',
                    'hide_if_not_selected' => 'false',
                    'save_in_meta' => 'false',
                    'save_in_meta_name' => '',
                    'required' => 'false',
                    'placeholder' => '',
                    'characters_limit' => '',
                ),
                array(
                    'type' => 'repeater',
                    'name' => 'objectives',
                    'default' => '',
                    'label' => 'Lista de Objetivos',
                    'help' => '',
                    'child_of' => '',
                    'placement' => 'content',
                    'hide_if_not_selected' => 'false',
                    'save_in_meta' => 'false',
                    'save_in_meta_name' => '',
                    'required' => 'false',
                    'rows_min' => '',
                    'rows_max' => '',
                    'layout' => 'row',
                    'setup_default_rows' => 'false',
                ),
                array(
                    'type' => 'text',
                    'name' => 'obj_title',
                    'default' => '',
                    'label' => 'Título del Objetivo',
                    'help' => '',
                    'child_of' => 'objectives',
                    'placement' => 'content',
                    'hide_if_not_selected' => 'false',
                    'save_in_meta' => 'false',
                    'save_in_meta_name' => '',
                    'required' => 'false',
                    'placeholder' => '',
                    'characters_limit' => '',
                ),
                array(
                    'type' => 'textarea',
                    'name' => 'obj_desc',
                    'default' => '',
                    'label' => 'Descripción del Objetivo',
                    'help' => '',
                    'child_of' => 'objectives',
                    'placement' => 'content',
                    'hide_if_not_selected' => 'false',
                    'save_in_meta' => 'false',
                    'save_in_meta_name' => '',
                    'required' => 'false',
                    'placeholder' => '',
                    'characters_limit' => '',
                ),
            ),
            'condition' => array(),
        ) );

    endif;
});

add_action( 'init', function() {
    wp_enqueue_block_style(
        'lazyblock/ji-objetivos',
        array(
            'handle' => 'lazyblock-ji-objetivos-style',
            'src'    => get_template_directory_uri() . '/blocks/lazyblock-ji-objetivos/block.css',
            'path'   => get_template_directory() . '/blocks/lazyblock-ji-objetivos/block.css',
        )
    );
});

add_action( 'init', function() {
    add_filter( 'lazyblock/ji-objetivos/frontend_callback', 'jornada_ji_objetivos_render', 10, 2 );
    add_filter( 'lazyblock/ji-objetivos/editor_callback', 'jornada_ji_objetivos_render', 10, 2 );
});

if ( ! function_exists( 'jornada_ji_objetivos_render' ) ) {
    function jornada_ji_objetivos_render( $output, $attributes ) {
        ob_start();
        include __DIR__ . '/block.php';
        return ob_get_clean();
    }
}

