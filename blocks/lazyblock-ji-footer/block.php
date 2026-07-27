<?php
/**
 * ╔═══════════════════════════════════════════╗
 * ║  BLOCK VIEW: JI - Footer General         ║
 * ║  Site footer with columns and copyright   ║
 * ╚═══════════════════════════════════════════╝
 */

// Variable extraction
$title       = isset( $attributes['title'] ) ? $attributes['title'] : 'III Jornada Industrial';
$descripcion = isset( $attributes['descripcion'] ) ? $attributes['descripcion'] : 'Un evento organizado por la Facultad de Ingeniería Industrial de la Universidad Tecnológica de Panamá, Centro Regional de Coclé.';
$copyright   = isset( $attributes['copyright'] ) ? $attributes['copyright'] : '© 2025 UTP Coclé. Todos los derechos reservados.';

// Columna 1
$col1_title = isset( $attributes['col1_title'] ) ? $attributes['col1_title'] : 'Recursos UTP';
$col1_links = isset( $attributes['col1_links'] ) && is_array( $attributes['col1_links'] ) ? $attributes['col1_links'] : array();

if ( empty( $col1_links ) ) {
    $col1_links = array(
        array( 'label' => 'Sitio Web UTP', 'url' => 'https://www.utp.ac.pa' ),
        array( 'label' => 'Centro Regional de Coclé', 'url' => 'https://cc.utp.ac.pa' ),
        array( 'label' => 'Facultad de Ingeniería Industrial', 'url' => 'https://fii.utp.ac.pa' )
    );
}

// Columna 2
$col2_title = isset( $attributes['col2_title'] ) ? $attributes['col2_title'] : 'Atención';
$col2_links = isset( $attributes['col2_links'] ) && is_array( $attributes['col2_links'] ) ? $attributes['col2_links'] : array();

if ( empty( $col2_links ) ) {
    $col2_links = array(
        array( 'label' => 'Contacto y Correo', 'url' => 'mailto:cocle.industrial@utp.ac.pa' ),
        array( 'label' => 'Ubicación del Campus', 'url' => '#' ),
        array( 'label' => 'Registro Online', 'url' => '#' )
    );
}

// Clases base del bloque
$clases = 'bloque-ji-footer';
if ( isset( $attributes['align'] ) && ! empty( $attributes['align'] ) ) {
    $clases .= ' align' . $attributes['align'];
}
if ( isset( $attributes['className'] ) && ! empty( $attributes['className'] ) ) {
    $clases .= ' ' . $attributes['className'];
}
?>

<footer class="<?php echo esc_attr( $clases ); ?>">
    <div class="bloque-ji-footer-layout">
        
        <!-- Info Principal (Izquierda) -->
        <div class="bloque-ji-footer-main">
            <h3 class="bloque-ji-footer-brand"><?php echo esc_html( $title ); ?></h3>
            <?php if ( $descripcion ) : ?>
                <p class="bloque-ji-footer-desc"><?php echo esc_html( $descripcion ); ?></p>
            <?php endif; ?>
        </div>

        <!-- Enlaces Columna 1 -->
        <div class="bloque-ji-footer-col">
            <h4 class="bloque-ji-footer-col-title"><?php echo esc_html( $col1_title ); ?></h4>
            <ul class="bloque-ji-footer-links">
                <?php foreach ( $col1_links as $link ) : 
                    $label = isset( $link['label'] ) ? $link['label'] : '';
                    $url   = isset( $link['url'] ) ? $link['url'] : '#';
                    if ( empty( $label ) ) continue;
                    ?>
                    <li><a href="<?php echo esc_url( $url ); ?>"><?php echo esc_html( $label ); ?></a></li>
                <?php endforeach; ?>
            </ul>
        </div>

        <!-- Enlaces Columna 2 -->
        <div class="bloque-ji-footer-col">
            <h4 class="bloque-ji-footer-col-title"><?php echo esc_html( $col2_title ); ?></h4>
            <ul class="bloque-ji-footer-links">
                <?php foreach ( $col2_links as $link ) : 
                    $label = isset( $link['label'] ) ? $link['label'] : '';
                    $url   = isset( $link['url'] ) ? $link['url'] : '#';
                    if ( empty( $label ) ) continue;
                    ?>
                    <li><a href="<?php echo esc_url( $url ); ?>"><?php echo esc_html( $label ); ?></a></li>
                <?php endforeach; ?>
            </ul>
        </div>

    </div>

    <!-- Barra de Copyright -->
    <div class="bloque-ji-footer-bottom">
        <div class="bloque-ji-footer-bottom-layout">
            <p class="bloque-ji-footer-copy"><?php echo esc_html( $copyright ); ?></p>
        </div>
    </div>
</footer>
