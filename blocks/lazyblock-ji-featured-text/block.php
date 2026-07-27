/**
 * ╔═══════════════════════════════════════════╗
 * ║  JI-BASE Featured Text                   ║
 * ║  Featured text block with configurable    ║
 * ║  size and alignment.                     ║
 * ╚═══════════════════════════════════════════╝
 */

<?php
// Field extraction
$texto = isset( $attributes['texto'] ) ? $attributes['texto'] : '';
$tamano = isset( $attributes['tamano'] ) ? $attributes['tamano'] : 'large';
$alineacion = isset( $attributes['alineacion'] ) ? $attributes['alineacion'] : 'center';

// Container classes
$clases = 'bloque-ji-featured-text';
if ( isset( $attributes['align'] ) && ! empty( $attributes['align'] ) ) {
    $clases .= ' align' . $attributes['align'];
}
if ( isset( $attributes['className'] ) && ! empty( $attributes['className'] ) ) {
    $clases .= ' ' . $attributes['className'];
}
$clases .= ' is-' . $tamano . ' is-' . $alineacion;
?>
<div class="<?php echo esc_attr( $clases ); ?>">
    <!-- Featured text content -->
    <?php if ( $texto ) : ?>
        <div class="bloque-ji-featured-text-content"><?php echo wp_kses_post( wpautop( $texto ) ); ?></div>
    <?php endif; ?>
</div>
