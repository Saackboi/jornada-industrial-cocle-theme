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
    wp_enqueue_style( 'material-symbols-outlined', 'https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap', array(), null );

    wp_enqueue_style( 'ji-global-variables', get_template_directory_uri() . '/assets/variables.css', array(), null );
    wp_add_inline_style( 'ji-global-variables', ji_get_customizer_css() );

    $font_pairing = get_theme_mod( 'ji_font_pairing', 'bodoni-hanken' );
    $pairings = ji_get_font_pairings();
    if ( isset( $pairings[ $font_pairing ] ) ) {
        wp_enqueue_style( 'ji-google-fonts', 'https://fonts.googleapis.com/css2?family=' . $pairings[ $font_pairing ]['google_url'] . '&display=swap', array(), null );
    }
}

/**
 * Font pairings para el Customizer.
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
 * Convertir hex a string RGB.
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
 * Lighten a hex color by a percentage.
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
 * Customizer: Sección Paleta de Colores Jornada Industrial.
 */
add_action( 'customize_register', 'jornada_industrial_customizer_register' );
function jornada_industrial_customizer_register( $wp_customize ) {
    $wp_customize->add_section( 'ji_theme_options', array(
        'title'    => 'Paleta de Colores',
        'priority' => 130,
        'description' => 'Personaliza colores y tipografía del tema.',
    ) );

    $wp_customize->add_setting( 'ji_primary_color', array(
        'default'   => '#0a192f',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ji_primary_color', array(
        'label'    => 'Color Primario',
        'section'  => 'ji_theme_options',
    ) ) );

    $wp_customize->add_setting( 'ji_accent_color', array(
        'default'   => '#c19a5b',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ji_accent_color', array(
        'label'    => 'Color de Acento',
        'section'  => 'ji_theme_options',
    ) ) );

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
 * Inyectar CSS con valores del Customizer.
 */
/**
 * Devuelve el CSS inline del Customizer para sobreescribir variables.css.
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
 * Fallback: inyecta en wp_head por si acaso (vía inline style ya cubre editor).
 */
add_action( 'wp_head', function () {
    echo '<style id="ji-customizer-vars">' . ji_get_customizer_css() . '</style>';
} );

/**
 * Autoloader para cargar el registro y callbacks de cada bloque modular.
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

            // Filtros para solucionar el problema del repetidor anidado (nested repeater) de Lazy Blocks
            function getNavLinks(parentProps) {
                var rawNavLinks = parentProps && parentProps.attributes && parentProps.attributes.nav_links;
                var navLinks = [];
                if (typeof rawNavLinks === 'string' && rawNavLinks !== '') {
                    try {
                        var decoded = decodeURIComponent(rawNavLinks);
                        navLinks = JSON.parse(decoded);
                    } catch (e) {
                        try {
                            navLinks = JSON.parse(rawNavLinks);
                        } catch (err) {
                            try {
                                navLinks = JSON.parse(decodeURI(rawNavLinks));
                            } catch (err2) {}
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
                    parentProps.setAttributes({
                        nav_links: serialized
                    });
                }
            }

            window.wp.hooks.addFilter('lzb.editor.control.repeater.render', 'jornada-industrial/sub-repeater-render-fix', function(render, props, parentProps) {
                if (props.data && props.data.name === 'sub_links') {
                    var parentIndex = props.childIndex; // i
                    
                    var navLinks = getNavLinks(parentProps);
                    var parentLink = navLinks[parentIndex];
                    
                    // Si el enlace padre no tiene marcado 'is_dropdown', no renderizamos este control (lo ocultamos)
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
                    var childIndex = props.childIndex; // j
                    
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

