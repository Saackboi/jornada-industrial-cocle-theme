<?php
/**
 * Vista del bloque: JI - Antecedentes
 * Versión dinámica — todas las ediciones son editables desde el inspector.
 */

// ── Helper: obtener URL de imagen desde dato de control ───────────────────
// Protegida con if(!function_exists) porque block.php se incluye más de una vez
// (editor + frontend) y PHP lanzaría un fatal "Cannot redeclare function".
if ( ! function_exists( 'ji_ant_get_image_url' ) ) {
    function ji_ant_get_image_url( $img_data ) {
        if ( empty( $img_data ) ) return '';
        if ( is_array( $img_data ) ) {
            if ( ! empty( $img_data['url'] ) ) return esc_url( $img_data['url'] );
            if ( ! empty( $img_data['id'] ) ) {
                $src = wp_get_attachment_image_src( (int) $img_data['id'], 'large' );
                return $src ? esc_url( $src[0] ) : '';
            }
        }
        if ( is_numeric( $img_data ) ) {
            $src = wp_get_attachment_image_src( (int) $img_data, 'large' );
            return $src ? esc_url( $src[0] ) : '';
        }
        return '';
    }
}

// ── Atributos del header ───────────────────────────────────────────────────
$label    = isset( $attributes['section_label'] )    ? $attributes['section_label']    : '✦ Nuestra Trayectoria';
$title    = isset( $attributes['section_title'] )    ? $attributes['section_title']    : 'Ediciones Anteriores';
$subtitle = isset( $attributes['section_subtitle'] ) ? $attributes['section_subtitle'] : 'Revive la historia y el impacto de las ediciones pasadas de la Jornada Industrial.';

// ── Imagen de fondo ────────────────────────────────────────────────────────
$bg_image_data = isset( $attributes['bg_image'] ) ? $attributes['bg_image'] : '';
$bg_image_url  = ji_ant_get_image_url( $bg_image_data );
$section_style = '';
$has_bg        = ! empty( $bg_image_url );
if ( $has_bg ) {
    $section_style = ' style="background-image: url(\'' . esc_url( $bg_image_url ) . '\');"';
}

// ── Ediciones (repeater) ───────────────────────────────────────────────────
$editions_raw = isset( $attributes['editions'] ) ? $attributes['editions'] : array();
$user_editions = array();

if ( is_array( $editions_raw ) && count( $editions_raw ) > 0 ) {
    $user_editions = $editions_raw;
} elseif ( is_string( $editions_raw ) && ! empty( $editions_raw ) ) {
    $decoded = json_decode( rawurldecode( $editions_raw ), true );
    if ( is_array( $decoded ) ) {
        $user_editions = $decoded;
    }
}

// ── Ediciones base fijas (siempre presentes) ───────────────────────────────
// Estas 3 ediciones históricas SIEMPRE aparecen. Las nuevas que añada
// el usuario en el repeater se AGREGAN al final. Así nunca desaparecen.
$img_base = get_template_directory_uri() . '/assets/images/antecedentes/';

$base_editions = array(
    array(
        'badge'       => 'Edición Reciente',
        'title'       => 'III Jornada Industrial',
        'tab_label'   => 'III Jornada (2025)',
        'date'        => '17 al 23 de octubre de 2025',
        'lema'        => '"Interconexión estratégica: comercio, transporte e industria, la clave para la sostenibilidad"',
        'description' => 'La III Jornada Industrial consolidó el evento como un referente académico en Coclé. Bajo la dirección del Mgtr. Miguel López, Mgtr. Luis Urieta y el Dr. Francisco Arango, estudiantes de Ingeniería Industrial, Logística y Mercadeo diseñaron espacios formativos de alto nivel técnico.',
        'hitos'       => "Conferencia de Prensa Oficial: Lanzamiento oficial el 13 de mayo de 2025.\nVI Jornada de Maquetas: 6 maquetas funcionales de almacenes y CEDIs por 25 estudiantes del Grupo Coclé Avanza.\nTalleres y simposios centrados en la interconexión estratégica del sector productivo.",
        'main_image'  => array( 'url' => $img_base . 'iii_jornada_lanzamiento_1.jpg' ),
        'image_2'     => array( 'url' => $img_base . 'iii_jornada_lanzamiento_1.jpg' ),
        'image_3'     => array( 'url' => $img_base . 'iii_jornada_lanzamiento_2.jpg' ),
        'image_4'     => array( 'url' => $img_base . 'iii_jornada_lanzamiento_3.jpg' ),
        'image_5'     => array( 'url' => $img_base . 'iii_jornada_press.jpg' ),
        '_base'       => true, // marcador: es una edición base, no del repeater
    ),
    array(
        'badge'       => 'Consolidación',
        'title'       => 'II Jornada Industrial',
        'tab_label'   => 'II Jornada (2024)',
        'date'        => '21 al 22 de octubre de 2024',
        'lema'        => '',
        'description' => 'La II Jornada Industrial movilizó de forma masiva a la comunidad estudiantil y a expertos del sector empresarial en el Salón de Conferencias del Centro Regional de Coclé.',
        'hitos'       => "Inauguración Oficial: Apertura a cargo del Ing. Efraín Conte, director del centro regional.\nGiras Académicas (18 oct): Visitas técnicas a Calesa, Cemex, EPA y Hutchison Ports PPC.\nTalleres: Diseño Gráfico en la era digital y Planificación de Negocios.\nV Jornada de Maquetas: Más de 200 visitantes evaluando riesgos logísticos.",
        'main_image'  => array( 'url' => $img_base . 'ii_jornada_inauguracion_1.jpg' ),
        'image_2'     => array( 'url' => $img_base . 'ii_jornada_inauguracion_1.jpg' ),
        'image_3'     => array( 'url' => $img_base . 'ii_jornada_lanzamiento_1.jpg' ),
        'image_4'     => array( 'url' => $img_base . 'ii_jornada_taller_diseno.jpg' ),
        'image_5'     => array( 'url' => $img_base . 'ii_jornada_maquetas_1.jpg' ),
        '_base'       => true,
    ),
    array(
        'badge'       => 'El Origen',
        'title'       => 'I Jornada Industrial',
        'tab_label'   => 'I Jornada (2023)',
        'date'        => 'Lunes 15 de mayo de 2023',
        'lema'        => '',
        'description' => 'La I Jornada Industrial nació de la visión de unificar en un solo gran espacio de aprendizaje multidisciplinario los eventos individuales de las carreras de la Facultad de Ingeniería Industrial (FII) del Centro Regional de la UTP en Coclé.',
        'hitos'       => "Unificación Académica: Fusión bajo el nombre oficial de Jornada Industrial para integrar Ingeniería Industrial, Mercadeo y Logística.\nLanzamiento Fundacional: Evento oficial el 15 de mayo de 2023.\nLiderazgo Estudiantil: Primer proyecto donde los estudiantes diseñaron la marca, patrocinadores e itinerario.",
        'main_image'  => array( 'url' => $img_base . 'i_jornada_1.jpg' ),
        'image_2'     => array( 'url' => $img_base . 'i_jornada_1.jpg' ),
        'image_3'     => array( 'url' => $img_base . 'i_jornada_2.jpg' ),
        'image_4'     => array( 'url' => $img_base . 'i_jornada_3.jpg' ),
        'image_5'     => array( 'url' => $img_base . 'i_jornada_4.jpg' ),
        '_base'       => true,
    ),
);

// Las ediciones del repeater del usuario se PREPENDEN (aparecen primero, como las más recientes)
// y las 3 base siempre se mantienen al final.
$editions = array_merge( $user_editions, $base_editions );

// ── Formatear título con acento en la última palabra ─────────────────────
$title_html = esc_html( $title );
if ( ! empty( $title ) ) {
    $words = explode( ' ', $title );
    if ( count( $words ) > 1 ) {
        $last       = array_pop( $words );
        $title_html = implode( ' ', $words ) . ' <span class="ji-ant__title-accent">' . esc_html( $last ) . '</span>';
    }
}

// ID único para este bloque (evita conflictos si hay más de uno en la página)
$block_id = 'ji-ant-' . substr( md5( microtime() . get_the_ID() ), 0, 8 );
?>

<section class="ji-ant <?php echo $has_bg ? 'has-bg-image' : ''; ?>" id="<?php echo esc_attr( $block_id ); ?>"<?php echo $section_style; ?>>
    <div class="ji-ant__bg-mesh"></div>
    <?php if ( $has_bg ) : ?><div class="ji-ant__bg-overlay"></div><?php endif; ?>

    <div class="ji-ant__container">

        <!-- Header -->
        <header class="ji-ant__header">
            <?php if ( ! empty( $label ) ) : ?>
                <div class="ji-ant__label"><?php echo esc_html( $label ); ?></div>
            <?php endif; ?>
            <h2 class="ji-ant__title"><?php echo $title_html; ?></h2>
            <?php if ( ! empty( $subtitle ) ) : ?>
                <p class="ji-ant__subtitle"><?php echo esc_html( $subtitle ); ?></p>
            <?php endif; ?>
        </header>

        <!-- Tab Navigation -->
        <div class="ji-ant__tabs-nav" role="tablist">
            <?php foreach ( $editions as $i => $ed ) :
                $pane_id   = esc_attr( $block_id . '-pane-' . $i );
                $tab_label = ! empty( $ed['tab_label'] )
                    ? $ed['tab_label']
                    : ( ! empty( $ed['title'] ) ? $ed['title'] : 'Edición ' . ( $i + 1 ) );
            ?>
                <button
                    class="ji-ant__tab-btn <?php echo $i === 0 ? 'is-active' : ''; ?>"
                    role="tab"
                    aria-controls="<?php echo $pane_id; ?>"
                    aria-selected="<?php echo $i === 0 ? 'true' : 'false'; ?>"
                    data-pane="<?php echo $pane_id; ?>"
                >
                    <?php echo esc_html( $tab_label ); ?>
                </button>
            <?php endforeach; ?>
        </div>

        <!-- Tab Panels -->
        <div class="ji-ant__tabs-content">
            <?php foreach ( $editions as $i => $ed ) :
                $pane_id  = esc_attr( $block_id . '-pane-' . $i );
                $ed_badge = ! empty( $ed['badge'] )       ? $ed['badge']       : '';
                $ed_title = ! empty( $ed['title'] )       ? $ed['title']       : '';
                $ed_date  = ! empty( $ed['date'] )        ? $ed['date']        : '';
                $ed_lema  = ! empty( $ed['lema'] )        ? $ed['lema']        : '';
                $ed_desc  = ! empty( $ed['description'] ) ? $ed['description'] : '';
                $ed_hitos = ! empty( $ed['hitos'] )       ? $ed['hitos']       : '';

                // Images
                $main_url = ji_ant_get_image_url( isset( $ed['main_image'] ) ? $ed['main_image'] : '' );
                $all_urls = array();
                foreach ( array( 'main_image', 'image_2', 'image_3', 'image_4', 'image_5' ) as $img_key ) {
                    $u = ji_ant_get_image_url( isset( $ed[ $img_key ] ) ? $ed[ $img_key ] : '' );
                    if ( ! empty( $u ) ) $all_urls[] = $u;
                }
                $all_urls  = array_values( array_unique( $all_urls ) );
                $main_url  = ! empty( $all_urls ) ? $all_urls[0] : '';

                // Hitos como array
                $hitos_arr = array();
                if ( ! empty( $ed_hitos ) ) {
                    $hitos_arr = array_values( array_filter( array_map( 'trim', explode( "\n", $ed_hitos ) ) ) );
                }

                $thumb_count = count( $all_urls );
            ?>
                <div
                    class="ji-ant__tab-pane <?php echo $i === 0 ? 'is-active' : ''; ?>"
                    id="<?php echo $pane_id; ?>"
                    role="tabpanel"
                >
                    <div class="ji-ant__content-grid">

                        <!-- Info Column -->
                        <div class="ji-ant__info-col">
                            <?php if ( ! empty( $ed_badge ) ) : ?>
                                <span class="ji-ant__edition-badge"><?php echo esc_html( $ed_badge ); ?></span>
                            <?php endif; ?>

                            <?php if ( ! empty( $ed_title ) ) : ?>
                                <h3 class="ji-ant__edition-title"><?php echo esc_html( $ed_title ); ?></h3>
                            <?php endif; ?>

                            <?php if ( ! empty( $ed_date ) ) : ?>
                                <div class="ji-ant__meta">
                                    <span class="material-symbols-outlined">calendar_today</span>
                                    <?php echo esc_html( $ed_date ); ?>
                                </div>
                            <?php endif; ?>

                            <?php if ( ! empty( $ed_lema ) ) : ?>
                                <blockquote class="ji-ant__lema"><?php echo esc_html( $ed_lema ); ?></blockquote>
                            <?php endif; ?>

                            <?php if ( ! empty( $ed_desc ) ) : ?>
                                <p class="ji-ant__text"><?php echo nl2br( esc_html( $ed_desc ) ); ?></p>
                            <?php endif; ?>

                            <?php if ( ! empty( $hitos_arr ) ) : ?>
                                <h4 class="ji-ant__subheading">Hitos Destacados</h4>
                                <ul class="ji-ant__list">
                                    <?php foreach ( $hitos_arr as $hito ) : ?>
                                        <li><?php echo esc_html( $hito ); ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        </div>

                        <!-- Gallery Column -->
                        <div class="ji-ant__gallery-col">
                            <?php if ( ! empty( $main_url ) ) : ?>
                                <div class="ji-ant__gallery-main">
                                    <img
                                        class="ji-ant__gallery-img"
                                        src="<?php echo $main_url; ?>"
                                        alt="<?php echo esc_attr( $ed_title ); ?>"
                                        loading="lazy"
                                    >
                                </div>
                            <?php else : ?>
                                <div class="ji-ant__gallery-placeholder">
                                    <span class="material-symbols-outlined">image</span>
                                    <p>Añade imágenes desde el panel lateral</p>
                                </div>
                            <?php endif; ?>

                            <?php if ( $thumb_count > 1 ) : ?>
                                <div class="ji-ant__gallery-thumbs" style="--thumb-cols:<?php echo min( $thumb_count, 5 ); ?>;">
                                    <?php foreach ( $all_urls as $ti => $turl ) : ?>
                                        <div
                                            class="ji-ant__thumb-item <?php echo $ti === 0 ? 'is-active' : ''; ?>"
                                            data-large="<?php echo esc_url( $turl ); ?>"
                                        >
                                            <img
                                                src="<?php echo esc_url( $turl ); ?>"
                                                alt="<?php echo esc_attr( $ed_title . ' foto ' . ( $ti + 1 ) ); ?>"
                                                loading="lazy"
                                            >
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </div>

                    </div><!-- /.ji-ant__content-grid -->
                </div><!-- /.ji-ant__tab-pane -->
            <?php endforeach; ?>
        </div><!-- /.ji-ant__tabs-content -->

    </div><!-- /.ji-ant__container -->
</section>

<script>
(function() {
    var blockEl = document.getElementById('<?php echo esc_js( $block_id ); ?>');
    if ( ! blockEl ) return;

    // Tab switching
    var tabBtns = blockEl.querySelectorAll('.ji-ant__tab-btn');
    var tabPanes = blockEl.querySelectorAll('.ji-ant__tab-pane');

    tabBtns.forEach(function(btn) {
        btn.addEventListener('click', function() {
            var targetId = btn.getAttribute('data-pane');
            tabBtns.forEach(function(b) {
                b.classList.remove('is-active');
                b.setAttribute('aria-selected', 'false');
            });
            tabPanes.forEach(function(p) { p.classList.remove('is-active'); });
            btn.classList.add('is-active');
            btn.setAttribute('aria-selected', 'true');
            var pane = blockEl.querySelector('#' + targetId);
            if (pane) pane.classList.add('is-active');
        });
    });

    // Gallery thumbnail switcher
    blockEl.querySelectorAll('.ji-ant__thumb-item').forEach(function(thumb) {
        thumb.addEventListener('click', function() {
            var largeUrl = thumb.getAttribute('data-large');
            var pane = thumb.closest('.ji-ant__tab-pane');
            var mainImg = pane ? pane.querySelector('.ji-ant__gallery-img') : null;
            if (mainImg && largeUrl) {
                mainImg.src = largeUrl;
                pane.querySelectorAll('.ji-ant__thumb-item').forEach(function(t) {
                    t.classList.remove('is-active');
                });
                thumb.classList.add('is-active');
            }
        });
    });
})();
</script>
