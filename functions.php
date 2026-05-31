<?php
/**
 * Setup del tema Jornada Industrial.
 */
function jornada_industrial_setup() {
    // Permitir el uso de bloques anchos (Wide Width) y de ancho completo (Full Width)
    add_theme_support( 'align-wide' );
    
    // Habilitar soporte para Imágenes Destacadas (Post Thumbnails)
    add_theme_support( 'post-thumbnails' );
}
add_action( 'after_setup_theme', 'jornada_industrial_setup' );

/**
 * Encolar fuentes de Google y Material Icons para frontend y editor.
 */
add_action( 'enqueue_block_assets', 'jornada_industrial_enqueue_global_assets' );
function jornada_industrial_enqueue_global_assets() {
    wp_enqueue_style( 'google-fonts-bodoni-hanken', 'https://fonts.googleapis.com/css2?family=Bodoni+Moda:ital,wght@0,400..900;1,400..900&family=Hanken+Grotesk:ital,wght@0,100..900;1,100..900&display=swap', array(), null );
    wp_enqueue_style( 'material-symbols-outlined', 'https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap', array(), null );
}

/**
 * Encolar estilos de los bloques de forma nativa para Gutenberg.
 * wp_enqueue_block_style asegura que el CSS se cargue tanto en el frontend
 * como dentro del iframe del editor de bloques de WordPress automáticamente.
 */
add_action( 'init', 'jornada_industrial_enqueue_block_styles_native' );
function jornada_industrial_enqueue_block_styles_native() {
    // Estilos del bloque Hero (Beta)
    wp_enqueue_block_style(
        'lazyblock/hero',
        array(
            'handle' => 'lazyblock-hero-style',
            'src'    => get_template_directory_uri() . '/blocks/lazyblock-hero/block.css',
            'path'   => get_template_directory() . '/blocks/lazyblock-hero/block.css',
        )
    );

    // Estilos del bloque CTA (Beta)
    wp_enqueue_block_style(
        'lazyblock/cta',
        array(
            'handle' => 'lazyblock-cta-style',
            'src'    => get_template_directory_uri() . '/blocks/lazyblock-cta/block.css',
            'path'   => get_template_directory() . '/blocks/lazyblock-cta/block.css',
        )
    );

    // Estilos del bloque JI-OLD - Navegación Principal
    wp_enqueue_block_style(
        'lazyblock/ji-nav',
        array(
            'handle' => 'lazyblock-ji-nav-style',
            'src'    => get_template_directory_uri() . '/blocks/lazyblock-ji-nav/block.css',
            'path'   => get_template_directory() . '/blocks/lazyblock-ji-nav/block.css',
        )
    );

    // Estilos del bloque JI-OLD - Hero Principal
    wp_enqueue_block_style(
        'lazyblock/ji-hero',
        array(
            'handle' => 'lazyblock-ji-hero-style',
            'src'    => get_template_directory_uri() . '/blocks/lazyblock-ji-hero/block.css',
            'path'   => get_template_directory() . '/blocks/lazyblock-ji-hero/block.css',
        )
    );

    // Estilos del bloque JI-OLD - Enlaces Rápidos
    wp_enqueue_block_style(
        'lazyblock/ji-labels',
        array(
            'handle' => 'lazyblock-ji-labels-style',
            'src'    => get_template_directory_uri() . '/blocks/lazyblock-ji-labels/block.css',
            'path'   => get_template_directory() . '/blocks/lazyblock-ji-labels/block.css',
        )
    );

    // NUEVOS BLOQUES DE ALTA FIDELIDAD (V2/V3)
    wp_enqueue_block_style(
        'lazyblock/ji-navbar',
        array(
            'handle' => 'lazyblock-ji-navbar-style',
            'src'    => get_template_directory_uri() . '/blocks/lazyblock-ji-navbar/block.css',
            'path'   => get_template_directory() . '/blocks/lazyblock-ji-navbar/block.css',
        )
    );
    wp_enqueue_block_style(
        'lazyblock/ji-hero-v3',
        array(
            'handle' => 'lazyblock-ji-hero-v3-style',
            'src'    => get_template_directory_uri() . '/blocks/lazyblock-ji-hero-v3/block.css',
            'path'   => get_template_directory() . '/blocks/lazyblock-ji-hero-v3/block.css',
        )
    );
    wp_enqueue_block_style(
        'lazyblock/ji-gallery',
        array(
            'handle' => 'lazyblock-ji-gallery-style',
            'src'    => get_template_directory_uri() . '/blocks/lazyblock-ji-gallery/block.css',
            'path'   => get_template_directory() . '/blocks/lazyblock-ji-gallery/block.css',
        )
    );
    wp_enqueue_block_style(
        'lazyblock/ji-countdown',
        array(
            'handle' => 'lazyblock-ji-countdown-style',
            'src'    => get_template_directory_uri() . '/blocks/lazyblock-ji-countdown/block.css',
            'path'   => get_template_directory() . '/blocks/lazyblock-ji-countdown/block.css',
        )
    );
    wp_enqueue_block_style(
        'lazyblock/ji-news',
        array(
            'handle' => 'lazyblock-ji-news-style',
            'src'    => get_template_directory_uri() . '/blocks/lazyblock-ji-news/block.css',
            'path'   => get_template_directory() . '/blocks/lazyblock-ji-news/block.css',
        )
    );
    wp_enqueue_block_style(
        'lazyblock/ji-location',
        array(
            'handle' => 'lazyblock-ji-location-style',
            'src'    => get_template_directory_uri() . '/blocks/lazyblock-ji-location/block.css',
            'path'   => get_template_directory() . '/blocks/lazyblock-ji-location/block.css',
        )
    );
    wp_enqueue_block_style(
        'lazyblock/ji-footer',
        array(
            'handle' => 'lazyblock-ji-footer-style',
            'src'    => get_template_directory_uri() . '/blocks/lazyblock-ji-footer/block.css',
            'path'   => get_template_directory() . '/blocks/lazyblock-ji-footer/block.css',
        )
    );
}

/**
 * Registrar Bloques de Lazy Blocks por código para evitar la interfaz manual
 */
add_action( 'init', 'jornada_industrial_register_lazy_blocks' );
function jornada_industrial_register_lazy_blocks() {
    if ( function_exists( 'lazyblocks' ) ) {

        // 1. Bloque Hero (Beta)
        lazyblocks()->add_block( array(
            'title' => 'Hero',
            'slug' => 'lazyblock/hero',
            'icon' => 'dashicons-cover-image',
            'category' => 'theme',
            'supports' => array(
                'align' => array( 'wide', 'full' ),
            ),
            'controls' => array(
                'control_titulo' => array( 'type' => 'text', 'name' => 'titulo', 'label' => 'Título', 'placement' => 'inspector', 'default' => 'Build something beautiful.' ),
                'control_subtitulo' => array( 'type' => 'textarea', 'name' => 'subtitulo', 'label' => 'Subtítulo', 'placement' => 'inspector', 'default' => 'Notion helps you and your team get more done with peace of mind.' ),
                'control_btn1_text' => array( 'type' => 'text', 'name' => 'boton_1_texto', 'label' => 'Texto Botón Principal', 'placement' => 'inspector', 'default' => 'Get Notion free' ),
                'control_btn1_url' => array( 'type' => 'url', 'name' => 'boton_1_url', 'label' => 'URL Botón Principal', 'placement' => 'inspector' ),
                'control_btn2_text' => array( 'type' => 'text', 'name' => 'boton_2_texto', 'label' => 'Texto Botón Secundario', 'placement' => 'inspector', 'default' => 'Request a demo' ),
                'control_btn2_url' => array( 'type' => 'url', 'name' => 'boton_2_url', 'label' => 'URL Botón Secundario', 'placement' => 'inspector' ),
                'control_imagen' => array( 'type' => 'image', 'name' => 'imagen_ilustracion', 'label' => 'Imagen / Ilustración Derecha', 'placement' => 'inspector' ),
                'control_logos' => array( 'type' => 'image', 'name' => 'imagen_logos', 'label' => 'Imagen de Logos (Opcional)', 'placement' => 'inspector' ),
            ),
        ) );

        // 2. Bloque CTA (Beta)
        lazyblocks()->add_block( array(
            'title' => 'Call to Action',
            'slug' => 'lazyblock/cta',
            'icon' => 'dashicons-admin-links',
            'category' => 'theme',
            'supports' => array(
                'align' => array( 'wide', 'full' ),
            ),
            'controls' => array(
                'control_cta_titulo' => array( 'type' => 'text', 'name' => 'titulo', 'label' => 'Título', 'placement' => 'inspector' ),
                'control_cta_desc' => array( 'type' => 'rich_text', 'name' => 'descripcion', 'label' => 'Descripción', 'placement' => 'inspector' ),
                'control_cta_btn' => array( 'type' => 'text', 'name' => 'texto_boton', 'label' => 'Texto del Botón', 'placement' => 'inspector' ),
                'control_cta_url' => array( 'type' => 'url', 'name' => 'url_boton', 'label' => 'URL del Botón', 'placement' => 'inspector' ),
            ),
        ) );

        // 3. JI-OLD - Navegación Principal (Beta)
        lazyblocks()->add_block( array(
            'title' => 'JI-OLD - Navegación Principal',
            'slug' => 'lazyblock/ji-nav',
            'icon' => 'dashicons-navigation',
            'category' => 'theme',
            'supports' => array(
                'align' => array( 'wide', 'full' ),
            ),
            'controls' => array(
                'control_nav_brand' => array( 'type' => 'text', 'name' => 'brand_text', 'label' => 'Texto del Logotipo', 'placement' => 'inspector', 'default' => 'Nnnerlw' ),
                'control_nav_links' => array(
                    'type' => 'repeater',
                    'name' => 'nav_links',
                    'label' => 'Enlaces de Navegación',
                    'placement' => 'inspector',
                ),
                'control_nav_links_label' => array(
                    'type' => 'text',
                    'name' => 'label',
                    'label' => 'Texto del Enlace',
                    'child_of' => 'control_nav_links',
                ),
                'control_nav_links_url' => array(
                    'type' => 'url',
                    'name' => 'url',
                    'label' => 'Dirección URL',
                    'child_of' => 'control_nav_links',
                ),
                'control_nav_btn_text' => array( 'type' => 'text', 'name' => 'btn_text', 'label' => 'Texto del Botón de Acción', 'placement' => 'inspector', 'default' => 'Register' ),
                'control_nav_btn_url' => array( 'type' => 'url', 'name' => 'btn_url', 'label' => 'URL del Botón de Acción', 'placement' => 'inspector' ),
            ),
        ) );

        // 4. JI-OLD - Hero Principal (Beta)
        lazyblocks()->add_block( array(
            'title' => 'JI-OLD - Hero Principal',
            'slug' => 'lazyblock/ji-hero',
            'icon' => 'dashicons-welcome-widgets-menus',
            'category' => 'theme',
            'supports' => array(
                'align' => array( 'wide', 'full' ),
            ),
            'controls' => array(
                'control_ji_hero_titulo' => array( 'type' => 'text', 'name' => 'titulo', 'label' => 'Título', 'placement' => 'inspector', 'default' => 'Find In Interesting Services And Buy Now Anything.' ),
                'control_ji_hero_desc' => array( 'type' => 'textarea', 'name' => 'descripcion', 'label' => 'Descripción', 'placement' => 'inspector', 'default' => 'Suscipit Suspendisse Consectetur Tortor Purus Sed Sociis Vitae Dignissim Et. Nunc Purus Aliquam Integer Habitant Non Neque Orci Ultrices.' ),
                'control_ji_hero_btn1_text' => array( 'type' => 'text', 'name' => 'btn1_text', 'label' => 'Texto Botón Primario', 'placement' => 'inspector', 'default' => 'Get Started' ),
                'control_ji_hero_btn1_url' => array( 'type' => 'url', 'name' => 'btn1_url', 'label' => 'URL Botón Primario', 'placement' => 'inspector' ),
                'control_ji_hero_btn2_text' => array( 'type' => 'text', 'name' => 'btn2_text', 'label' => 'Texto Botón Secundario', 'placement' => 'inspector', 'default' => 'View More' ),
                'control_ji_hero_btn2_url' => array( 'type' => 'url', 'name' => 'btn2_url', 'label' => 'URL Botón Secundario', 'placement' => 'inspector' ),
                'control_ji_hero_img' => array( 'type' => 'image', 'name' => 'imagen_derecha', 'label' => 'Imagen Derecha', 'placement' => 'inspector' ),
            ),
        ) );

        // 5. JI-OLD - Enlaces Rápidos (Beta)
        lazyblocks()->add_block( array(
            'title' => 'JI-OLD - Enlaces Rápidos',
            'slug' => 'lazyblock/ji-labels',
            'icon' => 'dashicons-ellipsis',
            'category' => 'theme',
            'supports' => array(
                'align' => array( 'wide', 'full' ),
            ),
            'controls' => array(
                'control_ji_labels_list' => array(
                    'type' => 'repeater',
                    'name' => 'labels_list',
                    'label' => 'Lista de Enlaces/Textos',
                    'placement' => 'inspector',
                ),
                'control_ji_labels_list_label' => array(
                    'type' => 'text',
                    'name' => 'label',
                    'label' => 'Texto',
                    'child_of' => 'control_ji_labels_list',
                ),
                'control_ji_labels_list_url' => array(
                    'type' => 'url',
                    'name' => 'url',
                    'label' => 'URL (Opcional)',
                    'child_of' => 'control_ji_labels_list',
                ),
            ),
        ) );


        // ==========================================
        // NUEVOS BLOQUES DE ALTA FIDELIDAD (PREMIUM)
        // ==========================================

        // I. JI - Navegación Principal V2
        lazyblocks()->add_block( array(
            'title' => 'JI - Navegación Principal V2',
            'slug' => 'lazyblock/ji-navbar',
            'icon' => 'dashicons-navigation',
            'category' => 'theme',
            'supports' => array(
                'align' => array( 'wide', 'full' ),
            ),
            'controls' => array(
                'control_navv2_brand' => array( 'type' => 'text', 'name' => 'brand_text', 'label' => 'Texto del Logotipo', 'placement' => 'inspector', 'default' => 'III Jornada Industrial' ),
                'control_navv2_links' => array(
                    'type' => 'repeater',
                    'name' => 'nav_links',
                    'label' => 'Enlaces de Navegación',
                    'placement' => 'inspector',
                    'default' => array(
                        array( 'label' => 'INICIO', 'url' => '#' ),
                        array( 'label' => 'NOSOTROS', 'url' => '#' ),
                        array( 'label' => 'ACTIVIDADES', 'url' => '#' ),
                        array( 'label' => 'PATROCINADORES', 'url' => '#' ),
                    ),
                ),
                'control_navv2_links_label' => array(
                    'type' => 'text',
                    'name' => 'label',
                    'label' => 'Texto del Enlace',
                    'child_of' => 'control_navv2_links',
                ),
                'control_navv2_links_url' => array(
                    'type' => 'url',
                    'name' => 'url',
                    'label' => 'Dirección URL',
                    'child_of' => 'control_navv2_links',
                ),
                'control_navv2_btn_text' => array( 'type' => 'text', 'name' => 'btn_text', 'label' => 'Texto del Botón de Acción', 'placement' => 'inspector', 'default' => 'REGISTRO' ),
                'control_navv2_btn_url' => array( 'type' => 'url', 'name' => 'btn_url', 'label' => 'URL del Botón de Acción', 'placement' => 'inspector' ),
            ),
        ) );

        // II. JI - Hero V3
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

        // III. JI - Galería Dinámica
        lazyblocks()->add_block( array(
            'title' => 'JI - Galería Dinámica',
            'slug' => 'lazyblock/ji-gallery',
            'icon' => 'dashicons-format-gallery',
            'category' => 'theme',
            'supports' => array(
                'align' => array( 'wide', 'full' ),
            ),
            'controls' => array(
                'control_gallery_title' => array( 'type' => 'text', 'name' => 'titulo', 'label' => 'Título de la Sección', 'placement' => 'inspector', 'default' => 'Visión del Evento' ),
                'control_gallery_images' => array(
                    'type' => 'repeater',
                    'name' => 'images',
                    'label' => 'Lista de Imágenes',
                    'placement' => 'inspector',
                ),
                'control_gallery_images_img' => array(
                    'type' => 'image',
                    'name' => 'img',
                    'label' => 'Imagen',
                    'child_of' => 'control_gallery_images',
                ),
            ),
        ) );

        // IV. JI - Contador Regresivo
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

        // V. JI - Grid de Noticias
        lazyblocks()->add_block( array(
            'title' => 'JI - Grid de Noticias',
            'slug' => 'lazyblock/ji-news',
            'icon' => 'dashicons-media-document',
            'category' => 'theme',
            'supports' => array(
                'align' => array( 'wide', 'full' ),
            ),
            'controls' => array(
                'control_news_overline' => array( 'type' => 'text', 'name' => 'overline', 'label' => 'Supertexto', 'placement' => 'inspector', 'default' => 'Actualidad' ),
                'control_news_section_title' => array( 'type' => 'text', 'name' => 'section_title', 'label' => 'Título de la Sección', 'placement' => 'inspector', 'default' => 'Noticias destacadas' ),
                'control_news_more_url' => array( 'type' => 'url', 'name' => 'more_url', 'label' => 'URL Ver Todas', 'placement' => 'inspector' ),
                'control_news_main_img' => array( 'type' => 'image', 'name' => 'main_img', 'label' => 'Imagen Noticia Principal', 'placement' => 'inspector' ),
                'control_news_main_title' => array( 'type' => 'text', 'name' => 'main_title', 'label' => 'Título Noticia Principal', 'placement' => 'inspector', 'default' => 'Grupo Coclé Avanza: Alianza por la Innovación' ),
                'control_news_main_desc' => array( 'type' => 'textarea', 'name' => 'main_desc', 'label' => 'Descripción Noticia Principal', 'placement' => 'inspector', 'default' => 'Líderes de la industria y la academia se reúnen para definir el futuro tecnológico de la región central del país, estableciendo nuevos estándares para la ingeniería.' ),
                'control_news_main_url' => array( 'type' => 'url', 'name' => 'main_url', 'label' => 'URL Noticia Principal', 'placement' => 'inspector' ),
                'control_news_sidebar' => array(
                    'type' => 'repeater',
                    'name' => 'sidebar_news',
                    'label' => 'Noticias Laterales (Max 3)',
                    'placement' => 'inspector',
                    'default' => array(
                        array( 'title' => 'Seminarios técnicos y conferencias de expertos', 'desc' => 'Conoce a los ponentes internacionales que compartirán sus conocimientos en automatización.', 'url' => '#' ),
                        array( 'title' => 'Visitas guiadas a proyectos locales', 'desc' => 'Una mirada de cerca a las implementaciones de ingeniería de vanguardia en Coclé.', 'url' => '#' ),
                        array( 'title' => 'Desafío de Logística Estudiantil', 'desc' => 'Los estudiantes competirán resolviendo casos prácticos de optimización de cadena de suministro.', 'url' => '#' ),
                    ),
                ),
                'control_news_sidebar_img' => array(
                    'type' => 'image',
                    'name' => 'img',
                    'label' => 'Imagen',
                    'child_of' => 'control_news_sidebar',
                ),
                'control_news_sidebar_title' => array(
                    'type' => 'text',
                    'name' => 'title',
                    'label' => 'Título',
                    'child_of' => 'control_news_sidebar',
                ),
                'control_news_sidebar_desc' => array(
                    'type' => 'text',
                    'name' => 'desc',
                    'label' => 'Descripción',
                    'child_of' => 'control_news_sidebar',
                ),
                'control_news_sidebar_url' => array(
                    'type' => 'url',
                    'name' => 'url',
                    'label' => 'URL (Opcional)',
                    'child_of' => 'control_news_sidebar',
                ),
            ),
        ) );

        // VI. JI - Lugar y Mapa
        lazyblocks()->add_block( array(
            'title' => 'JI - Lugar y Mapa',
            'slug' => 'lazyblock/ji-location',
            'icon' => 'dashicons-location',
            'category' => 'theme',
            'supports' => array(
                'align' => array( 'wide', 'full' ),
            ),
            'controls' => array(
                'control_location_overline' => array( 'type' => 'text', 'name' => 'overline', 'label' => 'Supertexto', 'placement' => 'inspector', 'default' => 'Ubicación Estratégica' ),
                'control_location_title' => array( 'type' => 'text', 'name' => 'titulo', 'label' => 'Título', 'placement' => 'inspector', 'default' => "Lugar del evento:\nCOEDUCO, Coclé" ),
                'control_location_desc' => array( 'type' => 'textarea', 'name' => 'descripcion', 'label' => 'Descripción', 'placement' => 'inspector', 'default' => 'Acompáñenos en el epicentro de la innovación. COEDUCO ofrece instalaciones de primer nivel para albergar ponencias internacionales y demostraciones técnicas en vivo.' ),
                'control_location_btn_text' => array( 'type' => 'text', 'name' => 'btn_text', 'label' => 'Texto del Botón', 'placement' => 'inspector', 'default' => 'Obtener Ruta' ),
                'control_location_btn_url' => array( 'type' => 'url', 'name' => 'btn_url', 'label' => 'URL del Botón', 'placement' => 'inspector' ),
                'control_location_map_url' => array( 'type' => 'text', 'name' => 'map_iframe_url', 'label' => 'URL de Embed de Google Maps (src de iframe)', 'placement' => 'inspector', 'default' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15764.072935273397!2d-80.37042010839843!3d8.497587799999993!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8fac6123e7f8e815%3A0xc4b38d3845b4c10a!2sUniversidad%20Tecnol%C3%B3gica%20de%20Panam%C3%A1%2C%20Centro%20Regional%20de%20Cocl%C3%A9!5e0!3m2!1sen!2s!4v1715000000000!5m2!1sen!2s' ),
            ),
        ) );

        // VII. JI - Footer General
        lazyblocks()->add_block( array(
            'title' => 'JI - Footer General',
            'slug' => 'lazyblock/ji-footer',
            'icon' => 'dashicons-networking',
            'category' => 'theme',
            'supports' => array(
                'align' => array( 'wide', 'full' ),
            ),
            'controls' => array(
                'control_footer_title' => array( 'type' => 'text', 'name' => 'title', 'label' => 'Nombre del Evento', 'placement' => 'inspector', 'default' => 'III Jornada Industrial' ),
                'control_footer_desc' => array( 'type' => 'textarea', 'name' => 'descripcion', 'label' => 'Descripción', 'placement' => 'inspector', 'default' => 'Un evento organizado por la Facultad de Ingeniería Industrial de la Universidad Tecnológica de Panamá, Centro Regional de Coclé.' ),
                'control_footer_copy' => array( 'type' => 'text', 'name' => 'copyright', 'label' => 'Texto de Copyright', 'placement' => 'inspector', 'default' => '© 2025 UTP Coclé. Todos los derechos reservados.' ),
                'control_footer_col1_title' => array( 'type' => 'text', 'name' => 'col1_title', 'label' => 'Título Columna 1', 'placement' => 'inspector', 'default' => 'Recursos UTP' ),
                'control_footer_col1_links' => array(
                    'type' => 'repeater',
                    'name' => 'col1_links',
                    'label' => 'Enlaces Columna 1',
                    'placement' => 'inspector',
                    'default' => array(
                        array( 'label' => 'Sitio Web UTP', 'url' => 'https://www.utp.ac.pa' ),
                        array( 'label' => 'Centro Regional de Coclé', 'url' => 'https://cc.utp.ac.pa' ),
                        array( 'label' => 'Facultad de Ingeniería Industrial', 'url' => 'https://fii.utp.ac.pa' ),
                    ),
                ),
                'control_footer_col1_links_label' => array(
                    'type' => 'text',
                    'name' => 'label',
                    'label' => 'Texto',
                    'child_of' => 'control_footer_col1_links',
                ),
                'control_footer_col1_links_url' => array(
                    'type' => 'url',
                    'name' => 'url',
                    'label' => 'URL',
                    'child_of' => 'control_footer_col1_links',
                ),
                'control_footer_col2_title' => array( 'type' => 'text', 'name' => 'col2_title', 'label' => 'Título Columna 2', 'placement' => 'inspector', 'default' => 'Atención' ),
                'control_footer_col2_links' => array(
                    'type' => 'repeater',
                    'name' => 'col2_links',
                    'label' => 'Enlaces Columna 2',
                    'placement' => 'inspector',
                    'default' => array(
                        array( 'label' => 'Contacto y Correo', 'url' => 'mailto:cocle.industrial@utp.ac.pa' ),
                        array( 'label' => 'Ubicación del Campus', 'url' => '#' ),
                        array( 'label' => 'Registro Online', 'url' => '#' ),
                    ),
                ),
                'control_footer_col2_links_label' => array(
                    'type' => 'text',
                    'name' => 'label',
                    'label' => 'Texto',
                    'child_of' => 'control_footer_col2_links',
                ),
                'control_footer_col2_links_url' => array(
                    'type' => 'url',
                    'name' => 'url',
                    'label' => 'URL',
                    'child_of' => 'control_footer_col2_links',
                ),
            ),
        ) );

    }
}

/**
 * Forzar el renderizado de la plantilla (Frontend y Editor) usando callbacks directos.
 */
add_action( 'init', 'jornada_industrial_lazyblocks_callbacks' );
function jornada_industrial_lazyblocks_callbacks() {
    // Callbacks para Hero (Beta)
    add_filter( 'lazyblock/hero/frontend_callback', 'jornada_hero_render', 10, 2 );
    add_filter( 'lazyblock/hero/editor_callback', 'jornada_hero_render', 10, 2 );

    // Callbacks para CTA (Beta)
    add_filter( 'lazyblock/cta/frontend_callback', 'jornada_cta_render', 10, 2 );
    add_filter( 'lazyblock/cta/editor_callback', 'jornada_cta_render', 10, 2 );

    // Callbacks para JI-OLD - Navegación Principal
    add_filter( 'lazyblock/ji-nav/frontend_callback', 'jornada_ji_nav_render', 10, 2 );
    add_filter( 'lazyblock/ji-nav/editor_callback', 'jornada_ji_nav_render', 10, 2 );

    // Callbacks para JI-OLD - Hero Principal
    add_filter( 'lazyblock/ji-hero/frontend_callback', 'jornada_ji_hero_render', 10, 2 );
    add_filter( 'lazyblock/ji-hero/editor_callback', 'jornada_ji_hero_render', 10, 2 );

    // Callbacks para JI-OLD - Enlaces Rápidos
    add_filter( 'lazyblock/ji-labels/frontend_callback', 'jornada_ji_labels_render', 10, 2 );
    add_filter( 'lazyblock/ji-labels/editor_callback', 'jornada_ji_labels_render', 10, 2 );

    // Callbacks para los nuevos bloques premium
    add_filter( 'lazyblock/ji-navbar/frontend_callback', 'jornada_ji_navbar_render', 10, 2 );
    add_filter( 'lazyblock/ji-navbar/editor_callback', 'jornada_ji_navbar_render', 10, 2 );

    add_filter( 'lazyblock/ji-hero-v3/frontend_callback', 'jornada_ji_hero_v3_render', 10, 2 );
    add_filter( 'lazyblock/ji-hero-v3/editor_callback', 'jornada_ji_hero_v3_render', 10, 2 );

    add_filter( 'lazyblock/ji-gallery/frontend_callback', 'jornada_ji_gallery_render', 10, 2 );
    add_filter( 'lazyblock/ji-gallery/editor_callback', 'jornada_ji_gallery_render', 10, 2 );

    add_filter( 'lazyblock/ji-countdown/frontend_callback', 'jornada_ji_countdown_render', 10, 2 );
    add_filter( 'lazyblock/ji-countdown/editor_callback', 'jornada_ji_countdown_render', 10, 2 );

    add_filter( 'lazyblock/ji-news/frontend_callback', 'jornada_ji_news_render', 10, 2 );
    add_filter( 'lazyblock/ji-news/editor_callback', 'jornada_ji_news_render', 10, 2 );

    add_filter( 'lazyblock/ji-location/frontend_callback', 'jornada_ji_location_render', 10, 2 );
    add_filter( 'lazyblock/ji-location/editor_callback', 'jornada_ji_location_render', 10, 2 );

    add_filter( 'lazyblock/ji-footer/frontend_callback', 'jornada_ji_footer_render', 10, 2 );
    add_filter( 'lazyblock/ji-footer/editor_callback', 'jornada_ji_footer_render', 10, 2 );
}

function jornada_hero_render( $output, $attributes ) {
    ob_start();
    include get_template_directory() . '/blocks/lazyblock-hero/block.php';
    return ob_get_clean();
}

function jornada_cta_render( $output, $attributes ) {
    ob_start();
    include get_template_directory() . '/blocks/lazyblock-cta/block.php';
    return ob_get_clean();
}

function jornada_ji_nav_render( $output, $attributes ) {
    ob_start();
    include get_template_directory() . '/blocks/lazyblock-ji-nav/block.php';
    return ob_get_clean();
}

function jornada_ji_hero_render( $output, $attributes ) {
    ob_start();
    include get_template_directory() . '/blocks/lazyblock-ji-hero/block.php';
    return ob_get_clean();
}

function jornada_ji_labels_render( $output, $attributes ) {
    ob_start();
    include get_template_directory() . '/blocks/lazyblock-ji-labels/block.php';
    return ob_get_clean();
}

// NUEVOS CALLBACKS DE RENDERIZADO
function jornada_ji_navbar_render( $output, $attributes ) {
    ob_start();
    include get_template_directory() . '/blocks/lazyblock-ji-navbar/block.php';
    return ob_get_clean();
}

function jornada_ji_hero_v3_render( $output, $attributes ) {
    ob_start();
    include get_template_directory() . '/blocks/lazyblock-ji-hero-v3/block.php';
    return ob_get_clean();
}

function jornada_ji_gallery_render( $output, $attributes ) {
    ob_start();
    include get_template_directory() . '/blocks/lazyblock-ji-gallery/block.php';
    return ob_get_clean();
}

function jornada_ji_countdown_render( $output, $attributes ) {
    ob_start();
    include get_template_directory() . '/blocks/lazyblock-ji-countdown/block.php';
    return ob_get_clean();
}

function jornada_ji_news_render( $output, $attributes ) {
    ob_start();
    include get_template_directory() . '/blocks/lazyblock-ji-news/block.php';
    return ob_get_clean();
}

function jornada_ji_location_render( $output, $attributes ) {
    ob_start();
    include get_template_directory() . '/blocks/lazyblock-ji-location/block.php';
    return ob_get_clean();
}

function jornada_ji_footer_render( $output, $attributes ) {
    ob_start();
    include get_template_directory() . '/blocks/lazyblock-ji-footer/block.php';
    return ob_get_clean();
}

/**
 * Filter to fix default values for repeater controls in Lazy Blocks
 */
add_filter( 'lzb/prepare_block_attribute', 'jornada_industrial_repeater_default_fix', 20, 2 );
function jornada_industrial_repeater_default_fix( $attribute_data, $control ) {
    if ( isset( $control['type'] ) && 'repeater' === $control['type'] && ! empty( $control['default'] ) ) {
        $attribute_data['default'] = rawurlencode( wp_json_encode( $control['default'] ) );
    }
    return $attribute_data;
}

/**
 * Enqueue block editor inline script to fix Lazy Blocks repeater default value serialization in Gutenberg
 */
add_action( 'enqueue_block_editor_assets', 'jornada_industrial_enqueue_block_editor_inline_script', 100 );
function jornada_industrial_enqueue_block_editor_inline_script() {
    $js_code = "(function() {
        function rawurlencode(str) {
            return encodeURIComponent(str)
                .replace(/!/g, '%21')
                .replace(/'/g, '%27')
                .replace(/\\(/g, '%28')
                .replace(/\\)/g, '%29')
                .replace(/\\*/g, '%2A');
        }

        if ( window.wp && window.wp.hooks ) {
            window.wp.hooks.addFilter('lzb.registerBlockType.args', 'jornada-industrial/repeater-default-fix', function( args, slug, blockData ) {
                if ( blockData && blockData.controls ) {
                    args.attributes = args.attributes || {};
                    
                    // Preservar los atributos reservados estándar de Lazy Blocks en el cliente
                    args.attributes['lazyblock'] = {
                        type: 'object',
                        default: { slug: slug }
                    };
                    args.attributes['className'] = {
                        type: 'string',
                        default: ''
                    };
                    args.attributes['anchor'] = {
                        type: 'string',
                        default: ''
                    };
                    args.attributes['blockId'] = {
                        type: 'string',
                        default: ''
                    };
                    args.attributes['blockUniqueClass'] = {
                        type: 'string',
                        default: ''
                    };
                    args.attributes['ghostkitSpacings'] = {
                        type: 'object',
                        default: ''
                    };
                    args.attributes['ghostkitSR'] = {
                        type: 'string',
                        default: ''
                    };

                    Object.keys(blockData.controls).forEach(function(key) {
                        var control = blockData.controls[key];
                        if (control && control.name && !control.child_of) {
                            var hasDefault = control.default !== undefined && control.default !== null;
                            if (control.type === 'repeater') {
                                args.attributes[control.name] = {
                                    type: 'string',
                                    default: hasDefault ? rawurlencode(JSON.stringify(control.default)) : ''
                                };
                            } else if (control.type === 'image' || control.type === 'file' || control.type === 'gallery') {
                                args.attributes[control.name] = {
                                    type: 'string',
                                    default: ''
                                };
                            } else if (control.type === 'toggle' || control.type === 'checkbox') {
                                args.attributes[control.name] = {
                                    type: 'boolean',
                                    default: hasDefault ? (control.default === true || control.default === 'true') : false
                                };
                            } else {
                                args.attributes[control.name] = {
                                    type: 'string',
                                    default: hasDefault ? String(control.default) : ''
                                };
                            }
                        }
                    });
                }
                return args;
            });
        }
    })();";
    wp_add_inline_script( 'lazyblocks-editor', $js_code, 'before' );
}

/**
 * Obtener la URL de una imagen de Lazy Blocks de forma robusta.
 * Resuelve arrays, IDs numéricos, JSON encriptado/urlencoded y URLs directas en texto.
 */
function ji_get_block_image_url( $image_val, $fallback = '' ) {
    if ( empty( $image_val ) ) {
        return $fallback;
    }
    if ( is_array( $image_val ) ) {
        return ! empty( $image_val['url'] ) ? $image_val['url'] : $fallback;
    }
    if ( is_numeric( $image_val ) ) {
        $url = wp_get_attachment_url( $image_val );
        return $url ? $url : $fallback;
    }
    if ( is_string( $image_val ) ) {
        $image_val = trim( $image_val );
        
        // Resolver URL-encoded JSON
        if ( 0 === strpos( $image_val, '%7B' ) || 0 === strpos( $image_val, '%7b' ) ) {
            $image_val = rawurldecode( $image_val );
        }
        
        // Resolver JSON
        if ( 0 === strpos( $image_val, '{' ) ) {
            $decoded = json_decode( $image_val, true );
            if ( is_array( $decoded ) && ! empty( $decoded['url'] ) ) {
                return $decoded['url'];
            }
        }
        
        // Si es un URL directo o ruta relativa
        if ( 0 === strpos( $image_val, 'http' ) || 0 === strpos( $image_val, '/' ) || 0 === strpos( $image_val, './' ) ) {
            return $image_val;
        }
    }
    return $fallback;
}

