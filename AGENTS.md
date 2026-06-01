# Arquitectura de Bloques para Tema WordPress Personalizado

Este documento establece las reglas, estándares y mejores prácticas para el desarrollo de bloques personalizados utilizando el plugin **Lazy Blocks** y la API nativa de Gutenberg en nuestro tema de WordPress.

## 1. Arquitectura de Bloques

Cada bloque es un componente completamente modular. Debe existir en su propia carpeta dentro de `/blocks/`.

**Estructura de la carpeta del bloque:**
```text
/wp-content/themes/jornada-industrial/
├── blocks/
│   ├── lazyblock-[slug-del-bloque]/
│   │   ├── block.php        # Plantilla de renderizado (Vista)
│   │   └── block.css        # Estilos específicos del bloque
```

### Reglas Estrictas

1. **Modularidad:** Cada bloque debe ser independiente. Sus estilos y lógica de presentación deben estar contenidos en su propia carpeta `lazyblock-[slug]`.
2. **No Constructores Visuales:** Prohibido el uso de Elementor, Divi, WPBakery, etc.
3. **No Widgets Antiguos:** No se crearán widgets tradicionales de WordPress.
4. **No Shortcodes:** Todo el contenido debe renderizarse utilizando bloques nativos de Gutenberg a través de Lazy Blocks.
5. **Registro Programático en PHP:** Para evitar la pérdida de configuraciones, mantener el versionado de código y asegurar la portabilidad, los bloques y sus campos se registran por código en `functions.php` usando `lazyblocks()->add_block()`.
6. **Mapeo de Callbacks:** Se configuran callbacks explícitos usando los filtros `lazyblock/[slug]/frontend_callback` y `lazyblock/[slug]/editor_callback` para redirigir el renderizado al archivo `block.php` correspondiente.
7. **Convención de Prefijos:** Todos los bloques del tema deben utilizar el prefijo `JI - ` en su título de presentación en el editor (ej. `JI - Navegación Principal`) y la estructura `ji-[slug]` en su slug (ej. `lazyblock/ji-nav`) y nombre de directorio (`lazyblock-ji-nav`) para mantener el orden, evitar conflictos con bloques nativos y facilitar su búsqueda.
8. **Robustez y Registro en Repetidores (Repeaters):**
   * **Vista (`block.php`):** La vista no debe saltarse filas si están parcialmente vacías (ej. si el usuario añade una fila pero no le pone texto). En su lugar, debe renderizarlas usando valores alternativos o placeholders por defecto para no romper el flujo del editor.
   * **Registro (`functions.php`):** Al registrar programáticamente campos repetidores en el array de `controls`, **NO** se debe anidar la clave `sub_controls`. En su lugar, los sub-controles del repetidor deben definirse planos al mismo nivel que el control padre en el array, utilizando el atributo `'child_of' => '[id_del_control_padre]'`. Esto es fundamental para que Gutenberg los renderice como campos editables en lugar de simples contenedores vacíos tipo "ROW".

---

## 2. Archivos del Bloque

### A. `block.php` (La Vista)

Este archivo recupera los datos definidos en Lazy Blocks y genera el HTML.

**Reglas de la Vista:**
1. **Variables Iniciales:** Los datos se extraen de la variable global `$attributes` que Lazy Blocks inyecta automáticamente.
2. **Soporte de Clases Nativas:** Debe comprobar e inyectar la clase de alineación de Gutenberg (`alignwide`, `alignfull`) y clases personalizadas (`className`) en el contenedor principal.
3. **Sanitización (Crucial):** **TODA** salida de datos debe ser sanitizada usando las funciones nativas de WordPress:
   * `esc_html()`: Para texto simple dentro de etiquetas HTML.
   * `esc_attr()`: Para valores de atributos HTML (clases, IDs, `href`, `src`, etc.).
   * `esc_url()`: Para URLs.
   * `wp_kses_post()`: Para contenido que puede contener HTML permitido (como el de un campo Rich Text).

**Ejemplo Base (`block.php`):**
```php
<?php
// Obtener valores de Lazy Blocks
$titulo = isset( $attributes['titulo'] ) ? $attributes['titulo'] : '';
$descripcion = isset( $attributes['descripcion'] ) ? $attributes['descripcion'] : '';

// Clases base para el contenedor
$clases = 'bloque-[slug-del-bloque]';
if ( isset( $attributes['align'] ) && ! empty( $attributes['align'] ) ) {
    $clases .= ' align' . $attributes['align'];
}
if ( isset( $attributes['className'] ) && ! empty( $attributes['className'] ) ) {
    $clases .= ' ' . $attributes['className'];
}
?>

<div class="<?php echo esc_attr( $clases ); ?>">
    <div class="bloque-[slug]-layout">
        <?php if ( $titulo ) : ?>
            <h2><?php echo esc_html( $titulo ); ?></h2>
        <?php endif; ?>
        
        <?php if ( $descripcion ) : ?>
            <div class="bloque-descripcion">
                <?php echo wp_kses_post( $descripcion ); ?>
            </div>
        <?php endif; ?>
    </div>
</div>
```

### B. `block.css` (Estilos)

Contiene los estilos exclusivos del bloque.

**Reglas de Estilos:**
1. **Encapsulamiento:** Todos los estilos deben usar selectores específicos de la clase principal del bloque (ej. `.bloque-[slug]`) para evitar colisiones.
2. **No Globales:** No incluyas estilos globales (`body`, `a`, `h1`) en los archivos CSS de los bloques individuales.
3. **Box-Sizing:** Asegura que el contenedor principal use `box-sizing: border-box;` para evitar roturas por padding.

---

## 3. Encolado de Estilos Nativos (`functions.php`)

Para garantizar que los estilos se carguen tanto en la web (frontend) como **dentro del iframe del editor Gutenberg**, se debe utilizar la función nativa `wp_enqueue_block_style` en el hook `init`:

```php
add_action( 'init', 'jornada_industrial_enqueue_block_styles' );
function jornada_industrial_enqueue_block_styles() {
    wp_enqueue_block_style(
        'lazyblock/[slug-del-bloque]',
        array(
            'handle' => 'lazyblock-[slug-del-bloque]-style',
            'src'    => get_template_directory_uri() . '/blocks/lazyblock-[slug-del-bloque]/block.css',
            'path'   => get_template_directory() . '/blocks/lazyblock-[slug-del-bloque]/block.css',
        )
    );
}
```

---

## 4. Guía de Solución de Problemas (Evitar Dolores de Cabeza)

A lo largo del desarrollo de los bloques `Hero` y `CTA` se resolvieron varios problemas críticos. Aquí se detalla cómo solucionarlos si vuelven a aparecer:

### A. El bloque se ve bien en la web pero sin estilos en el editor de WordPress
* **Causa:** Gutenberg renderiza el editor dentro de un `iframe` aislado. El encolado clásico con `wp_enqueue_scripts` no inyecta estilos dentro del iframe.
* **Solución:** Utilizar exclusivamente `wp_enqueue_block_style()` (como se explica en la sección 3). WordPress se encarga de inyectar el archivo CSS dentro de los componentes del iframe del editor de manera automática.

### B. Imágenes o QR desbordan el bloque o se salen de la caja de selección azul
* **Causa:** En maquetaciones con CSS Grid o Flexbox, las imágenes que tienen un ancho indefinido o `width: auto` hacen que el navegador use su tamaño en píxeles nativo como ancho mínimo de la columna. Esto expande la columna de la rejilla y desborda el contenedor.
* **Solución:** 
  1. Forzar a la imagen a ocupar el ancho de su columna: `width: 100%; height: auto; object-fit: contain;`.
  2. Aplicar `min-width: 0;` a la columna de la rejilla que envuelve la imagen para permitirle encogerse libremente si el viewport es pequeño.

### C. Los bloques no se estiran a pantalla completa (Alineación Wide/Full)
* **Causa:** El tema no avisa a WordPress que soporta bloques anchos, o el bloque no los tiene habilitados en sus opciones de soporte.
* **Solución:**
  1. Habilitar soporte de alineación ancha en el tema (`functions.php`):
     ```php
     add_theme_support( 'align-wide' );
     ```
  2. Activar el soporte en el registro del bloque:
     ```php
     'supports' => array( 'align' => array( 'wide', 'full' ) )
     ```
  3. En `block.php`, inyectar la clase `align{$attributes['align']}` al div externo.
  4. En CSS, usar el truco de márgenes negativos con unidades de viewport para romper contenedores del tema:
     ```css
     .mi-bloque.alignfull {
         width: 100vw;
         max-width: 100vw;
         margin-left: calc(50% - 50vw);
         margin-right: calc(50% - 50vw);
     }
     ```

### D. La vista previa (Preview) de la página sale completamente en blanco
* **Causa:** El archivo `index.php` del tema está vacío. Al previsualizar o visitar la web, WordPress carga `index.php` por defecto y no muestra nada.
* **Solución:** `index.php` debe contar como mínimo con la estructura HTML semántica básica y las llamadas obligatorias de WordPress:
  - `<head>` con `wp_head()` para cargar estilos.
  - El bucle Loop estándar con `the_content()` para pintar los bloques Gutenberg.
  - `wp_footer()` antes del cierre de body para scripts de administración y barra de WordPress.

### E. Bloqueo de escritura (inputs bloqueados) en repeaters anidados
* **Causa:** Gutenberg serializa y almacena los valores de los repetidores padres (como `nav_links`) como un string JSON codificado en URL. Al renderizar campos de un sub-repetidor hijo (segundo nivel como `sub_links`), Lazy Blocks intenta actualizar un atributo `sub_links` directo que no existe en el bloque, lo que trata al string como un tipo primitivo inmutable y bloquea la entrada del teclado.
* **Solución:** Interceptar los sub-controles con filtros JS en `functions.php` (`lzb.editor.control.text.render` y `lzb.editor.control.url.render`) y:
  1. Decodificar y parsear el string JSON del atributo padre (`JSON.parse(decodeURIComponent(nav_links))`).
  2. Modificar el valor del sub-control dentro del array resultante utilizando el índice del padre.
  3. Volver a serializar y codificar el array completo para actualizar el atributo padre con `setAttributes({ nav_links: serialized })`.

---

*Mantén este documento actualizado ante cualquier nueva lección aprendida o decisión de arquitectura.*
