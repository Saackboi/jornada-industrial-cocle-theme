<?php
/**
 * ╔═══════════════════════════════════════════╗
 * ║  JI-BASE Button                          ║
 * ║  Button block with configurable text,     ║
 * ║  URL, color, and size.                   ║
 * ╚═══════════════════════════════════════════╝
 */
// Field extraction
$texto = isset( $attributes['texto'] ) ? $attributes['texto'] : 'Ver más';
$url = isset( $attributes['url'] ) ? $attributes['url'] : '#';
$color = isset( $attributes['color'] ) ? $attributes['color'] : 'primary';
$tamano = isset( $attributes['tamano'] ) ? $attributes['tamano'] : 'medium';

// Container classes
$clases = 'bloque-ji-button';
if ( isset( $attributes['align'] ) && ! empty( $attributes['align'] ) ) {
    $clases .= ' align' . $attributes['align'];
}
if ( isset( $attributes['className'] ) && ! empty( $attributes['className'] ) ) {
    $clases .= ' ' . $attributes['className'];
}
$clases .= ' is-' . $color . ' is-' . $tamano;
?>
<div class="<?php echo esc_attr( $clases ); ?>">
    <!-- Button link -->
    <a href="<?php echo esc_url( $url ); ?>" class="bloque-ji-button-link">
        <span><?php echo esc_html( $texto ); ?></span>
    </a>
</div>
