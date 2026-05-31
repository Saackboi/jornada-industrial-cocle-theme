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

