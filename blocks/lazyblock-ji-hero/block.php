<?php
/**
 * ╔═══════════════════════════════════════════╗
 * ║  BLOCK VIEW: JI - Hero Principal         ║
 * ║  Main hero with title, description, CTA   ║
 * ╚═══════════════════════════════════════════╝
 */

// Variable extraction
$titulo         = isset( $attributes['titulo'] ) ? $attributes['titulo'] : 'Find In Interesting Services And Buy Now Anything.';
$descripcion    = isset( $attributes['descripcion'] ) ? $attributes['descripcion'] : '';
$btn1_text      = isset( $attributes['btn1_text'] ) ? $attributes['btn1_text'] : 'Get Started';
$btn1_url       = isset( $attributes['btn1_url'] ) ? $attributes['btn1_url'] : '#';
$btn2_text      = isset( $attributes['btn2_text'] ) ? $attributes['btn2_text'] : 'View More';
$btn2_url       = isset( $attributes['btn2_url'] ) ? $attributes['btn2_url'] : '#';
$imagen_derecha = isset( $attributes['imagen_derecha'] ) ? $attributes['imagen_derecha'] : null;

// Container classes
$clases = 'bloque-ji-hero';
if ( isset( $attributes['align'] ) && ! empty( $attributes['align'] ) ) {
    $clases .= ' align' . $attributes['align'];
}
if ( isset( $attributes['className'] ) && ! empty( $attributes['className'] ) ) {
    $clases .= ' ' . $attributes['className'];
}
?>

<div class="<?php echo esc_attr( $clases ); ?>">
    <div class="bloque-ji-hero-layout">
        <!-- Contenido Izquierdo (Textos y Botones) -->
        <div class="bloque-ji-hero-content">
            <?php if ( ! empty( $titulo ) ) : ?>
                <h1 class="bloque-ji-hero-title"><?php echo esc_html( $titulo ); ?></h1>
            <?php endif; ?>

            <?php if ( ! empty( $descripcion ) ) : ?>
                <p class="bloque-ji-hero-desc"><?php echo esc_html( $descripcion ); ?></p>
            <?php endif; ?>

            <div class="bloque-ji-hero-actions">
                <?php if ( ! empty( $btn1_text ) ) : ?>
                    <a href="<?php echo esc_url( $btn1_url ); ?>" class="bloque-ji-hero-btn-primary">
                        <?php echo esc_html( $btn1_text ); ?>
                    </a>
                <?php endif; ?>

                <?php if ( ! empty( $btn2_text ) ) : ?>
                    <a href="<?php echo esc_url( $btn2_url ); ?>" class="bloque-ji-hero-btn-secondary">
                        <?php echo esc_html( $btn2_text ); ?>
                    </a>
                <?php endif; ?>
            </div>
        </div>

        <!-- Ilustración / Imagen Derecha -->
        <div class="bloque-ji-hero-media">
            <?php if ( $imagen_derecha && isset( $imagen_derecha['url'] ) ) : ?>
                <img src="<?php echo esc_url( $imagen_derecha['url'] ); ?>" alt="<?php echo esc_attr( isset( $imagen_derecha['alt'] ) ? $imagen_derecha['alt'] : 'Hero Image' ); ?>" class="bloque-ji-hero-img">
            <?php else : ?>
                <!-- Placeholder elegante que simula el estilo de la imagen del mockup si no se sube nada -->
                <div class="bloque-ji-hero-placeholder">
                    <div class="bloque-ji-hero-placeholder-inner"></div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
