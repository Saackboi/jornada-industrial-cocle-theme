<?php
/**
 * Vista del bloque JI - Navegación Principal V2
 */

$brand_text = isset( $attributes['brand_text'] ) ? $attributes['brand_text'] : 'III Jornada Industrial';
$nav_links  = isset( $attributes['nav_links'] ) && is_array( $attributes['nav_links'] ) ? $attributes['nav_links'] : array();
$btn_text   = isset( $attributes['btn_text'] ) ? $attributes['btn_text'] : 'REGISTRO';
$btn_url    = isset( $attributes['btn_url'] ) ? $attributes['btn_url'] : '#';

// Clases base
$clases = 'bloque-ji-navbar';
if ( isset( $attributes['align'] ) && ! empty( $attributes['align'] ) ) {
    $clases .= ' align' . $attributes['align'];
}
if ( isset( $attributes['className'] ) && ! empty( $attributes['className'] ) ) {
    $clases .= ' ' . $attributes['className'];
}
?>

<nav class="<?php echo esc_attr( $clases ); ?>">
    <div class="bloque-ji-navbar-layout">
        <!-- Logotipo -->
        <div class="bloque-ji-navbar-brand">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="bloque-ji-navbar-logo-link">
                <?php echo esc_html( $brand_text ); ?>
            </a>
        </div>

        <!-- Enlaces Dinámicos -->
        <div class="bloque-ji-navbar-menu-container">
            <ul class="bloque-ji-navbar-list">
                <?php if ( ! empty( $nav_links ) ) : ?>
                    <?php foreach ( $nav_links as $link ) : 
                        $link_label = isset( $link['label'] ) ? $link['label'] : '';
                        $link_url   = isset( $link['url'] ) ? $link['url'] : '#';
                        $display_label = ! empty( $link_label ) ? $link_label : ( ( ! empty( $link_url ) && $link_url !== '#' ) ? $link_url : 'Enlace' );
                        ?>
                        <li class="bloque-ji-navbar-item">
                            <a href="<?php echo esc_url( $link_url ); ?>" class="bloque-ji-navbar-link">
                                <?php echo esc_html( $display_label ); ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                <?php else : ?>
                    <!-- Placeholders para el editor o si está vacío -->
                    <li class="bloque-ji-navbar-item"><a href="#" class="bloque-ji-navbar-link">INICIO</a></li>
                    <li class="bloque-ji-navbar-item"><a href="#" class="bloque-ji-navbar-link">NOSOTROS</a></li>
                    <li class="bloque-ji-navbar-item"><a href="#" class="bloque-ji-navbar-link">ACTIVIDADES</a></li>
                    <li class="bloque-ji-navbar-item"><a href="#" class="bloque-ji-navbar-link">PATROCINADORES</a></li>
                <?php endif; ?>
            </ul>
        </div>

        <!-- Botón de Acción -->
        <div class="bloque-ji-navbar-actions">
            <?php if ( ! empty( $btn_text ) ) : ?>
                <a href="<?php echo esc_url( $btn_url ); ?>" class="bloque-ji-navbar-btn">
                    <?php echo esc_html( $btn_text ); ?>
                </a>
            <?php endif; ?>
            
            <!-- Botón de Menú Móvil -->
            <button class="bloque-ji-navbar-mobile-toggle" aria-label="Abrir menú" onclick="this.closest('.bloque-ji-navbar').classList.toggle('mobile-menu-active')">
                <span class="material-symbols-outlined">menu</span>
            </button>
        </div>
    </div>
</nav>
