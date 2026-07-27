<?php
/**
 * ╔═══════════════════════════════════════════╗
 * ║  JI-BASE Tarjeta Simple                  ║
 * ║  Single card with image, title,           ║
 * ║  description, and optional link.         ║
 * ╚═══════════════════════════════════════════╝
 */
// Field extraction
$titulo = isset( $attributes['titulo'] ) ? $attributes['titulo'] : '';
$descripcion = isset( $attributes['descripcion'] ) ? $attributes['descripcion'] : '';
$imagen = isset( $attributes['imagen'] ) ? $attributes['imagen'] : '';
$url = isset( $attributes['url'] ) ? $attributes['url'] : '';
$img_url = function_exists( 'ji_get_block_image_url' ) ? ji_get_block_image_url( $imagen ) : '';

// Container classes
$clases = 'bloque-ji-card';
if ( isset( $attributes['align'] ) && ! empty( $attributes['align'] ) ) {
    $clases .= ' align' . $attributes['align'];
}
if ( isset( $attributes['className'] ) && ! empty( $attributes['className'] ) ) {
    $clases .= ' ' . $attributes['className'];
}
$has_link = ! empty( $url );
?>
<div class="<?php echo esc_attr( $clases ); ?>">
    <!-- Card image -->
    <?php if ( $img_url ) : ?>
        <div class="bloque-ji-card-image">
            <?php if ( $has_link ) : ?>
                <a href="<?php echo esc_url( $url ); ?>" tabindex="-1" aria-hidden="true">
                    <img src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( $titulo ); ?>">
                </a>
            <?php else : ?>
                <img src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( $titulo ); ?>">
            <?php endif; ?>
        </div>
    <?php endif; ?>
    <!-- Card body -->
    <div class="bloque-ji-card-body">
        <?php if ( $titulo ) : ?>
            <h3 class="bloque-ji-card-title">
                <?php if ( $has_link ) : ?>
                    <a href="<?php echo esc_url( $url ); ?>"><?php echo esc_html( $titulo ); ?></a>
                <?php else : ?>
                    <?php echo esc_html( $titulo ); ?>
                <?php endif; ?>
            </h3>
        <?php endif; ?>
        <?php if ( $descripcion ) : ?>
            <p class="bloque-ji-card-desc"><?php echo esc_html( $descripcion ); ?></p>
        <?php endif; ?>
    </div>
</div>
