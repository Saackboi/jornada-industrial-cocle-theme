<?php
/**
 * Vista del bloque JI - Lugar y Mapa
 */

$overline       = isset( $attributes['overline'] ) ? $attributes['overline'] : 'Ubicación Estratégica';
$titulo         = isset( $attributes['titulo'] ) ? $attributes['titulo'] : "Lugar del evento:\nCOEDUCO, Coclé";
$descripcion    = isset( $attributes['descripcion'] ) ? $attributes['descripcion'] : 'Acompáñenos en el epicentro de la innovación. COEDUCO ofrece instalaciones de primer nivel para albergar ponencias internacionales y demostraciones técnicas en vivo.';
$btn_text       = isset( $attributes['btn_text'] ) ? $attributes['btn_text'] : 'Obtener Ruta';
$btn_url        = isset( $attributes['btn_url'] ) ? $attributes['btn_url'] : '#';
$map_iframe_url = isset( $attributes['map_iframe_url'] ) ? $attributes['map_iframe_url'] : 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15764.072935273397!2d-80.37042010839843!3d8.497587799999993!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8fac6123e7f8e815%3A0xc4b38d3845b4c10a!2sUniversidad%20Tecnol%C3%B3gica%20de%20Panam%C3%A1%2C%20Centro%20Regional%20de%20Cocl%C3%A9!5e0!3m2!1sen!2s!4v1715000000000!5m2!1sen!2s';

// Clases base del bloque
$clases = 'bloque-ji-location';
if ( isset( $attributes['align'] ) && ! empty( $attributes['align'] ) ) {
    $clases .= ' align' . $attributes['align'];
}
if ( isset( $attributes['className'] ) && ! empty( $attributes['className'] ) ) {
    $clases .= ' ' . $attributes['className'];
}

// Convertir saltos de línea del título
$titulo_br = nl2br( esc_html( $titulo ) );
?>

<section class="<?php echo esc_attr( $clases ); ?>">
    <div class="bloque-ji-location-layout">
        
        <!-- Contenido Informativo (Izquierda) -->
        <div class="bloque-ji-location-content">
            <?php if ( $overline ) : ?>
                <span class="bloque-ji-location-overline"><?php echo esc_html( $overline ); ?></span>
            <?php endif; ?>

            <h2 class="bloque-ji-location-title">
                <?php echo wp_kses_post( $titulo_br ); ?>
            </h2>

            <?php if ( $descripcion ) : ?>
                <p class="bloque-ji-location-desc">
                    <?php echo esc_html( $descripcion ); ?>
                </p>
            <?php endif; ?>

            <?php if ( ! empty( $btn_text ) ) : ?>
                <a href="<?php echo esc_url( $btn_url ); ?>" class="bloque-ji-location-btn" target="_blank" rel="noopener noreferrer">
                    <span><?php echo esc_html( $btn_text ); ?></span>
                    <span class="material-symbols-outlined">directions</span>
                </a>
            <?php endif; ?>
        </div>

        <!-- Mapa de Google Maps (Derecha) -->
        <div class="bloque-ji-location-map-container">
            <?php if ( ! empty( $map_iframe_url ) ) : ?>
                <iframe 
                    src="<?php echo esc_url( $map_iframe_url ); ?>" 
                    class="bloque-ji-location-iframe" 
                    allowfullscreen="" 
                    loading="lazy" 
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            <?php else : ?>
                <!-- Contenedor vacío por si no hay URL -->
                <div class="bloque-ji-location-map-placeholder">
                    <span class="material-symbols-outlined">map</span>
                    <p>Ubicación no configurada</p>
                </div>
            <?php endif; ?>
        </div>

    </div>
</section>
