<?php
/**
 * Lazy Block: CTA
 */

$titulo = isset( $attributes['titulo'] ) ? $attributes['titulo'] : '';
$descripcion = isset( $attributes['descripcion'] ) ? $attributes['descripcion'] : '';
$texto_boton = isset( $attributes['texto_boton'] ) ? $attributes['texto_boton'] : '';
$url_boton = isset( $attributes['url_boton'] ) ? $attributes['url_boton'] : '';

$clases = 'bloque-cta';
if ( isset( $attributes['align'] ) && ! empty( $attributes['align'] ) ) {
    $clases .= ' align' . $attributes['align'];
}
if ( isset( $attributes['className'] ) && ! empty( $attributes['className'] ) ) {
    $clases .= ' ' . $attributes['className'];
}
?>

<div class="<?php echo esc_attr( $clases ); ?>">
    <div class="bloque-cta-layout">
        <div class="bloque-cta-contenido">
            <?php if ( $titulo ) : ?>
                <h2 class="bloque-cta-titulo"><?php echo esc_html( $titulo ); ?></h2>
            <?php endif; ?>

            <?php if ( $descripcion ) : ?>
                <div class="bloque-cta-descripcion">
                    <?php echo wp_kses_post( $descripcion ); ?>
                </div>
            <?php endif; ?>
        </div>

        <?php if ( $url_boton ) : ?>
            <div class="bloque-cta-accion">
                <a href="<?php echo esc_url( $url_boton ); ?>" class="bloque-cta-boton">
                    <?php echo esc_html( $texto_boton ?: 'Saber más' ); ?>
                </a>
            </div>
        <?php endif; ?>
    </div>
</div>
