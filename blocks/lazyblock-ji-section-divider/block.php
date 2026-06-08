<?php
/**
 * Vista del bloque JI - Separador de Sección
 */

$divider_type = isset( $attributes['divider_type'] ) ? $attributes['divider_type'] : 'space';
$divider_size = isset( $attributes['divider_size'] ) ? $attributes['divider_size'] : 'medium';
$from_tone    = isset( $attributes['from_tone'] ) ? $attributes['from_tone'] : 'light';
$to_tone      = isset( $attributes['to_tone'] ) ? $attributes['to_tone'] : 'primary';
$show_accent  = isset( $attributes['show_accent'] ) ? $attributes['show_accent'] : true;

$allowed_types = array( 'space', 'curve' );
$allowed_sizes = array( 'small', 'medium', 'large' );
$allowed_tones = array( 'light', 'primary' );

if ( 'line' === $divider_type || 'gradient' === $divider_type ) {
    $divider_type = 'space';
}
if ( ! in_array( $divider_type, $allowed_types, true ) ) {
    $divider_type = 'space';
}
if ( ! in_array( $divider_size, $allowed_sizes, true ) ) {
    $divider_size = 'medium';
}
if ( ! in_array( $from_tone, $allowed_tones, true ) ) {
    $from_tone = 'light';
}
if ( ! in_array( $to_tone, $allowed_tones, true ) ) {
    $to_tone = 'primary';
}

$clases = 'bloque-ji-section-divider';
$clases .= ' is-' . $divider_type;
$clases .= ' size-' . $divider_size;
$clases .= ' from-' . $from_tone;
$clases .= ' to-' . $to_tone;

if ( $show_accent ) {
    $clases .= ' has-accent';
}
if ( isset( $attributes['align'] ) && ! empty( $attributes['align'] ) ) {
    $clases .= ' align' . $attributes['align'];
}
if ( isset( $attributes['className'] ) && ! empty( $attributes['className'] ) ) {
    $clases .= ' ' . $attributes['className'];
}

$mesh_pattern_id = function_exists( 'wp_unique_id' ) ? wp_unique_id( 'ji-divider-mesh-' ) : 'ji-divider-mesh-' . uniqid();
?>

<div class="<?php echo esc_attr( $clases ); ?>" aria-hidden="true">
    <div class="bloque-ji-section-divider-inner">
        <?php if ( 'curve' === $divider_type ) : ?>
            <svg class="bloque-ji-section-divider-curve" viewBox="0 0 1440 120" preserveAspectRatio="none" focusable="false">
                <defs>
                    <pattern id="<?php echo esc_attr( $mesh_pattern_id ); ?>" width="28" height="28" patternUnits="userSpaceOnUse">
                        <path d="M-7 7 L7 -7 M0 28 L28 0 M21 35 L35 21" stroke="rgba(0,0,0,0.08)" stroke-width="1" fill="none" />
                        <path d="M-7 21 L7 35 M0 0 L28 28 M21 -7 L35 7" stroke="rgba(0,0,0,0.08)" stroke-width="1" fill="none" />
                    </pattern>
                </defs>
                <path class="bloque-ji-section-divider-curve-base" d="M0,72 C240,120 480,120 720,72 C960,24 1200,24 1440,72 L1440,120 L0,120 Z"></path>
                <path class="bloque-ji-section-divider-curve-mesh" d="M0,72 C240,120 480,120 720,72 C960,24 1200,24 1440,72 L1440,120 L0,120 Z" fill="url(#<?php echo esc_attr( $mesh_pattern_id ); ?>)"></path>
            </svg>
        <?php endif; ?>
    </div>
</div>
