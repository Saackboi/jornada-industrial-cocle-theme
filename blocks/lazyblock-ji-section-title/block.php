<?php
/**
 * ╔═══════════════════════════════════════════╗
 * ║  JI-BASE Título de Sección               ║
 * ║  Section heading with label, level,       ║
 * ║  alignment, and decorative accent.       ║
 * ╚═══════════════════════════════════════════╝
 */
// Field extraction
$titulo = isset( $attributes['titulo'] ) ? $attributes['titulo'] : '';
$nivel = isset( $attributes['nivel'] ) ? $attributes['nivel'] : 'h2';
$alineacion = isset( $attributes['alineacion'] ) ? $attributes['alineacion'] : 'center';
$subtitulo = isset( $attributes['subtitulo'] ) ? $attributes['subtitulo'] : '';
$mostrar_accento = isset( $attributes['mostrar_accento'] ) && ( true === $attributes['mostrar_accento'] || 'true' === $attributes['mostrar_accento'] );

// Container classes
$clases = 'bloque-ji-section-title';
if ( isset( $attributes['align'] ) && ! empty( $attributes['align'] ) ) {
    $clases .= ' align' . $attributes['align'];
}
if ( isset( $attributes['className'] ) && ! empty( $attributes['className'] ) ) {
    $clases .= ' ' . $attributes['className'];
}
$clases .= ' is-' . $alineacion;
?>
<div class="<?php echo esc_attr( $clases ); ?>">
    <!-- Subtitle label -->
    <?php if ( $subtitulo ) : ?>
        <span class="bloque-ji-section-title-label"><?php echo esc_html( $subtitulo ); ?></span>
    <?php endif; ?>
    <!-- Dynamic heading -->
    <<?php echo esc_attr( $nivel ); ?> class="bloque-ji-section-title-heading">
        <?php echo esc_html( $titulo ); ?>
    </<?php echo esc_attr( $nivel ); ?>>
    <!-- Decorative accent -->
    <?php if ( $mostrar_accento ) : ?>
        <div class="bloque-ji-section-title-accent"></div>
    <?php endif; ?>
</div>
