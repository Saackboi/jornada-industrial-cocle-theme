<?php
/**
 * Lazy Block: Hero (Notion Style)
 */

$titulo = isset( $attributes['titulo'] ) ? $attributes['titulo'] : '';
$subtitulo = isset( $attributes['subtitulo'] ) ? $attributes['subtitulo'] : '';
$btn1_texto = isset( $attributes['boton_1_texto'] ) ? $attributes['boton_1_texto'] : '';
$btn1_url = isset( $attributes['boton_1_url'] ) ? $attributes['boton_1_url'] : '#';
$btn2_texto = isset( $attributes['boton_2_texto'] ) ? $attributes['boton_2_texto'] : '';
$btn2_url = isset( $attributes['boton_2_url'] ) ? $attributes['boton_2_url'] : '#';
$imagen_ilustracion = isset( $attributes['imagen_ilustracion']['url'] ) ? $attributes['imagen_ilustracion']['url'] : '';
$imagen_logos = isset( $attributes['imagen_logos']['url'] ) ? $attributes['imagen_logos']['url'] : '';

$clases = 'bloque-hero-notion';
if ( isset( $attributes['align'] ) && ! empty( $attributes['align'] ) ) {
    $clases .= ' align' . $attributes['align'];
}
if ( isset( $attributes['className'] ) && ! empty( $attributes['className'] ) ) {
    $clases .= ' ' . $attributes['className'];
}
?>

<div class="<?php echo esc_attr( $clases ); ?>">
    <div class="bloque-hero-notion-layout">
        
        <!-- Left Column: Content -->
        <div class="bloque-hero-notion-content">
            <?php if ( $titulo ) : ?>
                <h1 class="bloque-hero-notion-title"><?php echo esc_html( $titulo ); ?></h1>
            <?php endif; ?>

            <?php if ( $subtitulo ) : ?>
                <p class="bloque-hero-notion-subtitle"><?php echo esc_html( $subtitulo ); ?></p>
            <?php endif; ?>

            <div class="bloque-hero-notion-buttons">
                <?php if ( $btn1_texto ) : ?>
                    <a href="<?php echo esc_url( $btn1_url ); ?>" class="btn-notion-primary"><?php echo esc_html( $btn1_texto ); ?></a>
                <?php endif; ?>
                
                <?php if ( $btn2_texto ) : ?>
                    <a href="<?php echo esc_url( $btn2_url ); ?>" class="btn-notion-secondary"><?php echo esc_html( $btn2_texto ); ?></a>
                <?php endif; ?>
            </div>

            <?php if ( $imagen_logos ) : ?>
                <div class="bloque-hero-notion-logos">
                    <p class="logos-title">Trusted by teams at</p>
                    <img src="<?php echo esc_url( $imagen_logos ); ?>" alt="Trusted by teams" />
                </div>
            <?php endif; ?>
        </div>

        <!-- Right Column: Illustration -->
        <div class="bloque-hero-notion-illustration">
            <?php if ( $imagen_ilustracion ) : ?>
                <img src="<?php echo esc_url( $imagen_ilustracion ); ?>" alt="Illustration" />
            <?php endif; ?>
        </div>
        
    </div>
</div>
