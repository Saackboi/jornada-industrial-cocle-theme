<?php
/**
 * ╔═══════════════════════════════════════════╗
 * ║  BLOCK: JI - Contacto y Redes             ║
 * ║  Registro, estilos y callback del bloque  ║
 * ╚═══════════════════════════════════════════╝
 */

// Encola estilos
add_action( 'init', 'jornada_industrial_register_style_ji_contact_social' );
function jornada_industrial_register_style_ji_contact_social() {
    wp_enqueue_block_style(
        'lazyblock/ji-contact-social',
        array(
            'handle' => 'lazyblock-ji-contact-social-style',
            'src'    => get_template_directory_uri() . '/blocks/lazyblock-ji-contact-social/block.css',
            'path'   => get_template_directory() . '/blocks/lazyblock-ji-contact-social/block.css',
        )
    );
}

// Registra bloque
add_action( 'init', 'jornada_industrial_register_block_ji_contact_social' );
function jornada_industrial_register_block_ji_contact_social() {
    if ( function_exists( 'lazyblocks' ) ) {
        lazyblocks()->add_block( array(
            'title' => 'JI - Contacto y Redes',
            'slug' => 'lazyblock/ji-contact-social',
            'icon' => 'dashicons-share',
            'category' => 'theme',
            'supports' => array(
                'align' => array( 'wide', 'full' ),
            ),
            'controls' => array(
                'control_cs_label' => array( 'type' => 'text', 'name' => 'section_label', 'label' => 'Etiqueta Superior', 'placement' => 'inspector', 'default' => 'Contacto' ),
                'control_cs_title' => array( 'type' => 'text', 'name' => 'section_title', 'label' => 'Título de la Sección', 'placement' => 'inspector', 'default' => 'Conecta con la Jornada' ),
                'control_cs_desc' => array( 'type' => 'textarea', 'name' => 'section_description', 'label' => 'Descripción', 'placement' => 'inspector', 'default' => 'Contacta al equipo organizador o síguenos en redes para enterarte de anuncios, actividades y novedades.' ),

                'control_cs_contacts' => array(
                    'type' => 'repeater',
                    'name' => 'contacts',
                    'label' => 'Contactos',
                    'placement' => 'inspector',
                ),
                'control_cs_contacts_prefix' => array(
                    'type' => 'text',
                    'name' => 'prefix',
                    'label' => 'Tratamiento (Dr., Ing., Mtro.)',
                    'child_of' => 'control_cs_contacts',
                ),
                'control_cs_contacts_name' => array(
                    'type' => 'text',
                    'name' => 'name',
                    'label' => 'Nombre Completo',
                    'child_of' => 'control_cs_contacts',
                ),
                'control_cs_contacts_email_user' => array(
                    'type' => 'text',
                    'name' => 'email_user',
                    'label' => 'Correo - Usuario (antes del @)',
                    'child_of' => 'control_cs_contacts',
                ),
                'control_cs_contacts_email_domain' => array(
                    'type' => 'text',
                    'name' => 'email_domain',
                    'label' => 'Correo - Dominio (después del @)',
                    'child_of' => 'control_cs_contacts',
                ),
                'control_cs_contacts_phone' => array(
                    'type' => 'text',
                    'name' => 'phone',
                    'label' => 'Teléfono',
                    'child_of' => 'control_cs_contacts',
                ),

                'control_cs_social' => array(
                    'type' => 'repeater',
                    'name' => 'social_links',
                    'label' => 'Redes Sociales',
                    'placement' => 'inspector',
                ),
                'control_cs_social_name' => array(
                    'type' => 'text',
                    'name' => 'name',
                    'label' => 'Nombre de la Red (Instagram, TikTok, Web)',
                    'child_of' => 'control_cs_social',
                ),
                'control_cs_social_url' => array(
                    'type' => 'url',
                    'name' => 'url',
                    'label' => 'URL',
                    'child_of' => 'control_cs_social',
                ),
            ),
        ) );
    }
}

// Asigna callbacks
add_action( 'init', 'jornada_industrial_callbacks_ji_contact_social' );
function jornada_industrial_callbacks_ji_contact_social() {
    add_filter( 'lazyblock/ji-contact-social/frontend_callback', 'jornada_ji_contact_social_render', 10, 2 );
    add_filter( 'lazyblock/ji-contact-social/editor_callback', 'jornada_ji_contact_social_render', 10, 2 );
}

// Renderiza
if ( ! function_exists( 'jornada_ji_contact_social_render' ) ) {
    function jornada_ji_contact_social_render( $output, $attributes ) {
        ob_start();
        include __DIR__ . '/block.php';
        return ob_get_clean();
    }
}
