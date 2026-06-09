<?php
add_action('init', function() {
    if ( function_exists( 'lazyblocks' ) ) :

        lazyblocks()->add_block( array(
            'id' => 1104,
            'title' => 'JI - About Editorial',
            'icon' => 'dashicons-text-page',
            'keyword' => array(
                0 => 'about',
                1 => 'editorial',
                2 => 'mvo',
            ),
            'slug' => 'lazyblock/ji-about-editorial',
        'description' => 'Bloque editorial premium para Qué Somos, Misión y Visión.',
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
                'type' => 'rich_text',
                'name' => 'que_somos_text',
                'default' => '',
                'label' => 'Texto: ¿Qué Somos?',
                'help' => 'El párrafo introductorio.',
                'child_of' => '',
                'placement' => 'content',
                'hide_if_not_selected' => 'false',
                'save_in_meta' => 'false',
                'save_in_meta_name' => '',
                'required' => 'false',
                'multiline' => 'p',
                'placeholder' => '',
                'characters_limit' => '',
            ),
            array(
                'type' => 'textarea',
                'name' => 'mision_text',
                'default' => '',
                'label' => 'Texto: Misión',
                'help' => 'Texto de la misión.',
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
                'type' => 'textarea',
                'name' => 'vision_text',
                'default' => '',
                'label' => 'Texto: Visión',
                'help' => 'Texto de la visión.',
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
                'type' => 'image',
                'name' => 'image_1',
                'default' => '',
                'label' => 'Imagen Decorativa 1',
                'help' => '',
                'child_of' => '',
                'placement' => 'inspector',
                'hide_if_not_selected' => 'false',
                'save_in_meta' => 'false',
                'save_in_meta_name' => '',
                'required' => 'false',
                'preview_size' => 'medium',
                'placeholder' => '',
            ),
            array(
                'type' => 'image',
                'name' => 'image_2',
                'default' => '',
                'label' => 'Imagen Decorativa 2',
                'help' => '',
                'child_of' => '',
                'placement' => 'inspector',
                'hide_if_not_selected' => 'false',
                'save_in_meta' => 'false',
                'save_in_meta_name' => '',
                'required' => 'false',
                'preview_size' => 'medium',
                'placeholder' => '',
            ),
        ),
        'condition' => array(),
    ) );

    endif;
});

add_action( 'init', function() {
    wp_enqueue_block_style(
        'lazyblock/ji-about-editorial',
        array(
            'handle' => 'lazyblock-ji-about-editorial-style',
            'src'    => get_template_directory_uri() . '/blocks/lazyblock-ji-about-editorial/block.css',
            'path'   => get_template_directory() . '/blocks/lazyblock-ji-about-editorial/block.css',
        )
    );
});

add_action( 'init', function() {
    add_filter( 'lazyblock/ji-about-editorial/frontend_callback', 'jornada_ji_about_editorial_render', 10, 2 );
    add_filter( 'lazyblock/ji-about-editorial/editor_callback', 'jornada_ji_about_editorial_render', 10, 2 );
});

if ( ! function_exists( 'jornada_ji_about_editorial_render' ) ) {
    function jornada_ji_about_editorial_render( $output, $attributes ) {
        ob_start();
        include __DIR__ . '/block.php';
        return ob_get_clean();
    }
}

