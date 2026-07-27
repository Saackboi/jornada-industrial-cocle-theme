/**
 * ╔═══════════════════════════════════════════╗
 * ║  JI-BASE Divider                         ║
 * ║  Divider/separator block with             ║
 * ║  configurable type and margin.           ║
 * ╚═══════════════════════════════════════════╝
 */

<?php
// Field extraction
$tipo = isset( $attributes['tipo'] ) ? $attributes['tipo'] : 'line';
$margen = isset( $attributes['margen'] ) ? $attributes['margen'] : 'medium';

// Container classes
$clases = 'bloque-ji-divider';
if ( isset( $attributes['align'] ) && ! empty( $attributes['align'] ) ) {
    $clases .= ' align' . $attributes['align'];
}
if ( isset( $attributes['className'] ) && ! empty( $attributes['className'] ) ) {
    $clases .= ' ' . $attributes['className'];
}
$clases .= ' is-' . $tipo . ' is-' . $margen;
?>
<div class="<?php echo esc_attr( $clases ); ?>">
    <!-- Line divider -->
    <?php if ( 'line' === $tipo ) : ?>
        <div class="bloque-ji-divider-line"></div>
    <?php endif; ?>
</div>
