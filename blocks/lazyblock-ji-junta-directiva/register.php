<?php
/**
 * Registro del bloque: JI - Junta Directiva
 */

add_action( 'init', 'jornada_industrial_register_style_ji_junta_directiva' );
function jornada_industrial_register_style_ji_junta_directiva() {
    wp_enqueue_block_style(
        'lazyblock/ji-junta-directiva',
        array(
            'handle' => 'lazyblock-ji-junta-directiva-style',
            'src'    => get_template_directory_uri() . '/blocks/lazyblock-ji-junta-directiva/block.css',
            'path'   => get_template_directory() . '/blocks/lazyblock-ji-junta-directiva/block.css',
        )
    );
}

add_action( 'init', 'jornada_industrial_register_block_ji_junta_directiva' );
function jornada_industrial_register_block_ji_junta_directiva() {
    if ( function_exists( 'lazyblocks' ) ) {
        lazyblocks()->add_block( array(
            'title' => 'JI - Junta Directiva',
            'slug' => 'lazyblock/ji-junta-directiva',
            'icon' => 'dashicons-groups',
            'category' => 'theme',
            'supports' => array(
                'align' => array( 'wide', 'full' ),
            ),
            'controls' => array(
                'control_junta_label' => array( 'type' => 'text', 'name' => 'section_label', 'label' => 'Etiqueta Superior', 'placement' => 'inspector', 'default' => '✦ Liderazgo' ),
                'control_junta_title' => array( 'type' => 'text', 'name' => 'section_title', 'label' => 'Título de la Sección', 'placement' => 'inspector', 'default' => 'Junta Directiva' ),
                'control_junta_members' => array( 'type' => 'repeater', 'name' => 'members', 'label' => 'Integrantes de la Junta', 'placement' => 'inspector' ),
                'control_junta_members_name' => array( 'type' => 'text', 'name' => 'name', 'label' => 'Nombre Completo', 'child_of' => 'control_junta_members' ),
                'control_junta_members_role' => array( 'type' => 'text', 'name' => 'role', 'label' => 'Cargo', 'child_of' => 'control_junta_members' ),
                'control_junta_members_c1' => array( 'type' => 'text', 'name' => 'career_line_1', 'label' => 'Carrera (Línea 1)', 'child_of' => 'control_junta_members' ),
                'control_junta_members_c2' => array( 'type' => 'text', 'name' => 'career_line_2', 'label' => 'Carrera (Línea 2)', 'child_of' => 'control_junta_members' ),
                'control_junta_members_photo' => array( 'type' => 'image', 'name' => 'photo', 'label' => 'Foto de Perfil', 'child_of' => 'control_junta_members' ),
                'control_junta_members_featured' => array( 'type' => 'toggle', 'name' => 'is_featured', 'label' => '¿Destacar cargo? (Badge de Presidente)', 'child_of' => 'control_junta_members', 'default' => false ),
                'control_junta_members_b64' => array( 'type' => 'text', 'name' => 'members_b64', 'label' => 'Backup Base64 (No Tocar)', 'placement' => 'inspector' ),
            ),
        ) );
    }
}

add_action( 'init', 'jornada_industrial_callbacks_ji_junta_directiva' );
function jornada_industrial_callbacks_ji_junta_directiva() {
    add_filter( 'lazyblock/ji-junta-directiva/frontend_callback', 'jornada_ji_junta_directiva_render', 10, 2 );
    add_filter( 'lazyblock/ji-junta-directiva/editor_callback', 'jornada_ji_junta_directiva_render', 10, 2 );
}

if ( ! function_exists( 'jornada_ji_junta_directiva_render' ) ) {
    function jornada_ji_junta_directiva_render( $output, $attributes ) {
        ob_start();
        include __DIR__ . '/block.php';
        return ob_get_clean();
    }
}
