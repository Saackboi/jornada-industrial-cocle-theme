<?php
/**
 * ╔══════════════════════════════════════════════════════════════╗
 * ║  JORNADA INDUSTRIAL — TEMA WORDPRESS                       ║
 * ║  Funciones principales del tema                             ║
 * ║                                                              ║
 * ║  Propósito: Configuración base, Customizer, carga de        ║
 * ║  activos (CSS/JS), autoloader de bloques Lazy Blocks,       ║
 * ║  helpers para imágenes, colores y tipografía.               ║
 * ╚══════════════════════════════════════════════════════════════╝
 */

/**
 * Configuración inicial del tema.
 * Se ejecuta después de que el tema está listo.
 */
function jornada_industrial_setup() {
    add_theme_support( 'align-wide' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'title-tag' );
}
add_action( 'after_setup_theme', 'jornada_industrial_setup' );

/**
 * Carga recursos globales: Google Fonts, Material Icons, variables CSS y estilos de plantillas.
 * Se ejecuta tanto en frontend como en el editor Gutenberg.
 * Usa static guard para evitar duplicados si ambos hooks se disparan.
 */
add_action( 'enqueue_block_assets', 'jornada_industrial_enqueue_global_assets' );
add_action( 'wp_enqueue_scripts', 'jornada_industrial_enqueue_global_assets' );
function jornada_industrial_enqueue_global_assets() {
    static $did_enqueue = false;
    if ( $did_enqueue ) {
        return;
    }
    $did_enqueue = true;

    // Iconos Material Symbols
    wp_enqueue_style( 'material-symbols-outlined', 'https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap', array(), null );

    // Variables de diseño del tema + overrides del Customizer
    wp_enqueue_style( 'ji-global-variables', get_template_directory_uri() . '/assets/variables.css', array(), null );
    wp_add_inline_style( 'ji-global-variables', ji_get_customizer_css() );

    // Estilos para plantillas (single, archive)
    wp_enqueue_style(
        'ji-template-styles',
        get_template_directory_uri() . '/assets/templates.css',
        array( 'ji-global-variables' ),
        filemtime( get_template_directory() . '/assets/templates.css' )
    );

    // Google Fonts según la combinación elegida en Customizer
    $font_pairing = get_theme_mod( 'ji_font_pairing', 'bodoni-hanken' );
    $pairings = ji_get_font_pairings();
    if ( isset( $pairings[ $font_pairing ] ) ) {
        wp_enqueue_style( 'ji-google-fonts', 'https://fonts.googleapis.com/css2?family=' . $pairings[ $font_pairing ]['google_url'] . '&display=swap', array(), null );
    }
}

/**
 * Helper: devuelve la URL del archive de noticias.
 * Busca primero categoría "noticias", luego "actualidad", luego page_for_posts.
 * Usado en single.php para el enlace "Volver".
 */
function ji_get_news_archive_url() {
    $cat = get_category_by_slug( 'noticias' );
    if ( $cat ) {
        return get_category_link( $cat->term_id );
    }

    $cat_actualidad = get_category_by_slug( 'actualidad' );
    if ( $cat_actualidad ) {
        return get_category_link( $cat_actualidad->term_id );
    }

    $blog_page_id = get_option( 'page_for_posts' );
    if ( $blog_page_id ) {
        return get_permalink( $blog_page_id );
    }

    return home_url( '/' );
}

/**
 * Define las 4 combinaciones tipográficas disponibles en el Customizer.
 * Cada una: label, heading_font, body_font, google_url.
 */
function ji_get_font_pairings() {
    return array(
        'bodoni-hanken' => array(
            'label' => 'Bodoni Moda + Hanken Grotesk (por defecto)',
            'heading_font' => "'Bodoni Moda', serif",
            'body_font' => "'Hanken Grotesk', sans-serif",
            'google_url' => 'Bodoni+Moda:ital,wght@0,400..900;1,400..900&family=Hanken+Grotesk:ital,wght@0,100..900;1,100..900',
        ),
        'playfair-inter' => array(
            'label' => 'Playfair Display + Inter',
            'heading_font' => "'Playfair Display', serif",
            'body_font' => "'Inter', sans-serif",
            'google_url' => 'Playfair+Display:ital,wght@0,400..900;1,400..900&family=Inter:wght@300;400;500;600;700',
        ),
        'domine-manrope' => array(
            'label' => 'Domine + Manrope',
            'heading_font' => "'Domine', serif",
            'body_font' => "'Manrope', sans-serif",
            'google_url' => 'Domine:wght@400;500;600;700&family=Manrope:wght@300;400;500;600;700',
        ),
        'garamond-jakarta' => array(
            'label' => 'EB Garamond + Plus Jakarta Sans',
            'heading_font' => "'EB Garamond', serif",
            'body_font' => "'Plus Jakarta Sans', sans-serif",
            'google_url' => 'EB+Garamond:ital,wght@0,400..800;1,400..800&family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800',
        ),
    );
}

/**
 * Convierte un color hex (ej. #0a192f) a string RGB (ej. "10, 25, 47").
 * Soporta hex de 3 y 6 dígitos.
 */
function ji_hex_to_rgb( $hex ) {
    $hex = ltrim( $hex, '#' );
    if ( strlen( $hex ) === 3 ) {
        $hex = $hex[0] . $hex[0] . $hex[1] . $hex[1] . $hex[2] . $hex[2];
    }
    $r = hexdec( substr( $hex, 0, 2 ) );
    $g = hexdec( substr( $hex, 2, 2 ) );
    $b = hexdec( substr( $hex, 4, 2 ) );
    return "{$r}, {$g}, {$b}";
}

/**
 * Aclara un color hex en un porcentaje dado.
 * Útil para generar variantes hover/light de colores primarios.
 */
function ji_lighten_hex( $hex, $percent ) {
    $hex = ltrim( $hex, '#' );
    if ( strlen( $hex ) === 3 ) {
        $hex = $hex[0] . $hex[0] . $hex[1] . $hex[1] . $hex[2] . $hex[2];
    }
    $r = hexdec( substr( $hex, 0, 2 ) );
    $g = hexdec( substr( $hex, 2, 2 ) );
    $b = hexdec( substr( $hex, 4, 2 ) );
    $r = min( 255, $r + round( ( 255 - $r ) * $percent / 100 ) );
    $g = min( 255, $g + round( ( 255 - $g ) * $percent / 100 ) );
    $b = min( 255, $b + round( ( 255 - $b ) * $percent / 100 ) );
    return sprintf( '#%02x%02x%02x', $r, $g, $b );
}

/**
 * ── CUSTOMIZER ──────────────────────────────────────────────────
 * Registra la sección "Paleta de Colores" con opciones de color
 * primario, acento y combinación tipográfica.
 */
add_action( 'customize_register', 'jornada_industrial_customizer_register' );
function jornada_industrial_customizer_register( $wp_customize ) {
    $wp_customize->add_section( 'ji_theme_options', array(
        'title'    => 'Paleta de Colores',
        'priority' => 130,
        'description' => 'Personaliza colores y tipografía del tema.',
    ) );

    // Color Primario
    $wp_customize->add_setting( 'ji_primary_color', array(
        'default'   => '#0a192f',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ji_primary_color', array(
        'label'    => 'Color Primario',
        'section'  => 'ji_theme_options',
    ) ) );

    // Color de Acento (oro)
    $wp_customize->add_setting( 'ji_accent_color', array(
        'default'   => '#c19a5b',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ji_accent_color', array(
        'label'    => 'Color de Acento',
        'section'  => 'ji_theme_options',
    ) ) );

    // Combinación tipográfica
    $pairings = ji_get_font_pairings();
    $choices = array();
    foreach ( $pairings as $key => $pairing ) {
        $choices[ $key ] = $pairing['label'];
    }

    $wp_customize->add_setting( 'ji_font_pairing', array(
        'default'   => 'bodoni-hanken',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'ji_font_pairing', array(
        'label'   => 'Combinación Tipográfica',
        'section' => 'ji_theme_options',
        'type'    => 'select',
        'choices' => $choices,
    ) );
}

/**
 * Devuelve el CSS inline generado desde los valores del Customizer.
 * Sobrescribe las variables de assets/variables.css dinámicamente.
 * Se inyecta tanto en frontend (wp_head) como en editor (enqueue_block_assets).
 */
function ji_get_customizer_css() {
    $primary = get_theme_mod( 'ji_primary_color', '#0a192f' );
    $accent  = get_theme_mod( 'ji_accent_color', '#c19a5b' );
    $font_pairing = get_theme_mod( 'ji_font_pairing', 'bodoni-hanken' );

    $primary_rgb = ji_hex_to_rgb( $primary );
    $accent_light = ji_lighten_hex( $accent, 20 );

    $pairings = ji_get_font_pairings();
    $pairing = isset( $pairings[ $font_pairing ] ) ? $pairings[ $font_pairing ] : $pairings['bodoni-hanken'];

    return ":root {
        --ji-color-primary: {$primary};
        --ji-color-primary-rgb: {$primary_rgb};
        --ji-color-accent: {$accent};
        --ji-color-accent-light: {$accent_light};
        --ji-color-text: {$primary};
        --ji-color-text-muted: rgba({$primary_rgb}, 0.7);
        --ji-color-text-muted-soft: rgba({$primary_rgb}, 0.6);
        --ji-font-heading: {$pairing['heading_font']};
        --ji-font-body: {$pairing['body_font']};
    }";
}

/**
 * Fallback: inyecta el CSS del Customizer en wp_head.
 * El inline style ya se inyecta via enqueue_block_assets,
 * esto asegura cobertura en páginas que no cargan el editor.
 */
add_action( 'wp_head', function () {
    echo '<style id="ji-customizer-vars">' . ji_get_customizer_css() . '</style>';
} );

/**
 * ── AUTOLOADER DE BLOQUES ──────────────────────────────────────
 * Escanea /blocks/ y carga cada register.php automáticamente.
 * Cada bloque declara su estilo, registro y callback.
 */
function jornada_industrial_autoload_blocks() {
    $blocks_dir = get_template_directory() . '/blocks';
    if ( is_dir( $blocks_dir ) ) {
        $dirs = glob( $blocks_dir . '/*', GLOB_ONLYDIR );
        if ( is_array( $dirs ) ) {
            foreach ( $dirs as $dir ) {
                $register_file = $dir . '/register.php';
                if ( file_exists( $register_file ) ) {
                    require_once $register_file;
                }
            }
        }
    }
}
jornada_industrial_autoload_blocks();

/**
 * ── LAZY BLOCKS FIXES ──────────────────────────────────────────
 * Los siguientes filtros corrigen problemas de serialización
 * de atributos en Lazy Blocks (versión gratuita).
 */

/**
 * Codifica en URL los valores por defecto de los repetidores
 * para que Gutenberg los serialice correctamente.
 */
add_filter( 'lzb/prepare_block_attribute', 'jornada_industrial_repeater_default_fix', 20, 2 );
function jornada_industrial_repeater_default_fix( $attribute_data, $control ) {
    if ( isset( $control['type'] ) && 'repeater' === $control['type'] && ! empty( $control['default'] ) ) {
        $attribute_data['default'] = rawurlencode( wp_json_encode( $control['default'] ) );
    }
    return $attribute_data;
}

/**
 * Inyecta JavaScript en el editor para:
 * 1. Forzar defaults serializados como URL-encoded JSON.
 * 2. Solucionar el bloqueo de teclado en nested repeaters (sub_links).
 *    Intercepta los valores del repetidor padre, los modifica
 *    y los vuelve a serializar.
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

                    // Preservar atributos estándar de Lazy Blocks
                    args.attributes['lazyblock'] = { type: 'object', default: { slug: slug } };
                    args.attributes['className'] = { type: 'string', default: '' };
                    args.attributes['anchor'] = { type: 'string', default: '' };
                    args.attributes['blockId'] = { type: 'string', default: '' };
                    args.attributes['blockUniqueClass'] = { type: 'string', default: '' };
                    args.attributes['ghostkitSpacings'] = { type: 'object', default: '' };
                    args.attributes['ghostkitSR'] = { type: 'string', default: '' };

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
                                args.attributes[control.name] = { type: 'string', default: '' };
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

            // ── NESTED REPEATER FIX ──
            // Gestiona los sub-controles de nav_links.sub_links
            // para evitar bloqueo de inputs en repetidores anidados.
            function getNavLinks(parentProps) {
                var rawNavLinks = parentProps && parentProps.attributes && parentProps.attributes.nav_links;
                var navLinks = [];
                if (typeof rawNavLinks === 'string' && rawNavLinks !== '') {
                    try {
                        var decoded = decodeURIComponent(rawNavLinks);
                        navLinks = JSON.parse(decoded);
                    } catch (e) {
                        try { navLinks = JSON.parse(rawNavLinks); } catch (err) {
                            try { navLinks = JSON.parse(decodeURI(rawNavLinks)); } catch (err2) {}
                        }
                    }
                } else if (Array.isArray(rawNavLinks)) {
                    navLinks = rawNavLinks;
                }
                return navLinks || [];
            }

            function saveNavLinks(parentProps, navLinks) {
                if (parentProps && parentProps.setAttributes) {
                    var serialized = rawurlencode(JSON.stringify(navLinks));
                    parentProps.setAttributes({ nav_links: serialized });
                }
            }

            window.wp.hooks.addFilter('lzb.editor.control.repeater.render', 'jornada-industrial/sub-repeater-render-fix', function(render, props, parentProps) {
                if (props.data && props.data.name === 'sub_links') {
                    var parentIndex = props.childIndex;
                    var navLinks = getNavLinks(parentProps);
                    var parentLink = navLinks[parentIndex];

                    if (!parentLink || !parentLink.is_dropdown) {
                        return null;
                    }

                    var originalRenderControls = props.renderControls;
                    props.renderControls = function() {
                        window.lazyblocksSubLinksParentIndex = parentIndex;
                        try {
                            return originalRenderControls.apply(this, arguments);
                        } finally {
                            window.lazyblocksSubLinksParentIndex = undefined;
                        }
                    };
                }
                return render;
            }, 5);

            function wrapControlProps(render, props, parentProps) {
                if (props.data && props.data.child_of === 'control_navv2_links_sub_links') {
                    var parentIndex = window.lazyblocksSubLinksParentIndex;
                    var childIndex = props.childIndex;

                    if (parentIndex !== undefined && parentProps) {
                        props.getValue = function() {
                            var navLinks = getNavLinks(parentProps);
                            var parentLink = navLinks[parentIndex];
                            if (parentLink && parentLink.sub_links && parentLink.sub_links[childIndex]) {
                                return parentLink.sub_links[childIndex][props.data.name] || '';
                            }
                            return '';
                        };

                        props.onChange = function(newVal) {
                            var navLinks = getNavLinks(parentProps);
                            var parentLink = navLinks[parentIndex];
                            if (parentLink) {
                                parentLink.sub_links = parentLink.sub_links || [];
                                parentLink.sub_links[childIndex] = parentLink.sub_links[childIndex] || {};
                                parentLink.sub_links[childIndex][props.data.name] = newVal;
                                saveNavLinks(parentProps, navLinks);
                            }
                        };
                    }
                }
                return render;
            }

            window.wp.hooks.addFilter('lzb.editor.control.text.render', 'jornada-industrial/sub-control-text-render-fix', wrapControlProps, 5);
            window.wp.hooks.addFilter('lzb.editor.control.url.render', 'jornada-industrial/sub-control-url-render-fix', wrapControlProps, 5);
        }
    })();";
    wp_add_inline_script( 'lazyblocks-editor', $js_code, 'before' );
}

/**
 * ── SCROLL TO TOP ───────────────────────────────────────────────
 * Botón flotante para volver al inicio de la página.
 */
add_action( 'wp_footer', 'jornada_industrial_scroll_to_top' );
function jornada_industrial_scroll_to_top() {
    ?>
    <button id="ji-scroll-top" class="ji-scroll-top" aria-label="Volver arriba">
        <span class="material-symbols-outlined">arrow_upward</span>
    </button>
    <style>
        .ji-scroll-top {
            position: fixed;
            bottom: 32px;
            right: 32px;
            width: 48px;
            height: 48px;
            border: 1px solid var(--ji-color-accent, #c19a5b);
            background: transparent;
            color: var(--ji-color-accent, #c19a5b);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            z-index: 9998;
            box-sizing: border-box;
        }
        .ji-scroll-top.is-visible {
            opacity: 1;
            visibility: visible;
        }
        .ji-scroll-top:hover {
            background: var(--ji-color-accent, #c19a5b);
            color: var(--ji-color-white, #ffffff);
        }
        .ji-scroll-top .material-symbols-outlined {
            font-size: 24px;
        }
        @media (max-width: 768px) {
            .ji-scroll-top {
                bottom: 20px;
                right: 20px;
                width: 42px;
                height: 42px;
            }
        }
    </style>
    <script>
    (function() {
        var btn = document.getElementById('ji-scroll-top');
        if (!btn) return;
        var showAt = 300;
        function onScroll() {
            if (window.scrollY > showAt) {
                btn.classList.add('is-visible');
            } else {
                btn.classList.remove('is-visible');
            }
        }
        window.addEventListener('scroll', onScroll, { passive: true });
        btn.addEventListener('click', function() {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    })();
    </script>
    <?php
}

/**
 * ── HELPERS ─────────────────────────────────────────────────────
 */

/**
 * Obtiene la URL de una imagen desde múltiples formatos que Lazy Blocks puede devolver:
 * - Array con clave 'url'
 * - ID numérico de attachment
 * - JSON string (incluyendo URL-encoded)
 * - URL directa (http, /, ./)
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

        // Detectar JSON encodeado en URL
        if ( 0 === strpos( $image_val, '%7B' ) || 0 === strpos( $image_val, '%7b' ) ) {
            $image_val = rawurldecode( $image_val );
        }

        // Parsear JSON
        if ( 0 === strpos( $image_val, '{' ) ) {
            $decoded = json_decode( $image_val, true );
            if ( is_array( $decoded ) && ! empty( $decoded['url'] ) ) {
                return $decoded['url'];
            }
        }

        // URL directa
        if ( 0 === strpos( $image_val, 'http' ) || 0 === strpos( $image_val, '/' ) || 0 === strpos( $image_val, './' ) ) {
            return $image_val;
        }
    }
    return $fallback;
}
