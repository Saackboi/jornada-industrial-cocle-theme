<?php
/**
 * Vista del bloque JI - Navegación Principal
 */

$brand_text = isset( $attributes['brand_text'] ) ? $attributes['brand_text'] : 'Nnnerlw';
$nav_links  = isset( $attributes['nav_links'] ) && is_array( $attributes['nav_links'] ) ? $attributes['nav_links'] : array();
$btn_text   = isset( $attributes['btn_text'] ) ? $attributes['btn_text'] : 'Register';
$btn_url    = isset( $attributes['btn_url'] ) ? $attributes['btn_url'] : '#';

// Clases base del bloque
$clases = 'bloque-ji-nav';
if ( isset( $attributes['align'] ) && ! empty( $attributes['align'] ) ) {
    $clases .= ' align' . $attributes['align'];
}
if ( isset( $attributes['className'] ) && ! empty( $attributes['className'] ) ) {
    $clases .= ' ' . $attributes['className'];
}
?>

<header class="<?php echo esc_attr( $clases ); ?>">
    <div class="bloque-ji-nav-layout">
        <!-- Logotipo -->
        <div class="bloque-ji-nav-brand">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="bloque-ji-nav-logo-link">
                <?php echo esc_html( $brand_text ); ?>
            </a>
        </div>

        <!-- Enlaces Dinámicos -->
        <nav class="bloque-ji-nav-menu">
            <?php if ( ! empty( $nav_links ) ) : ?>
                <ul class="bloque-ji-nav-list">
                    <?php foreach ( $nav_links as $link ) : 
                        $link_label = isset( $link['label'] ) ? $link['label'] : '';
                        $link_url   = isset( $link['url'] ) ? $link['url'] : '#';
                        
                        // Si no hay texto, usar la URL (si no es #) o 'Enlace'
                        $display_label = ! empty( $link_label ) ? $link_label : ( ( ! empty( $link_url ) && $link_url !== '#' ) ? $link_url : 'Enlace' );
                        ?>
                        <li class="bloque-ji-nav-item">
                            <a href="<?php echo esc_url( $link_url ); ?>" class="bloque-ji-nav-link">
                                <?php echo esc_html( $display_label ); ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </nav>

        <!-- Botón de Acción -->
        <?php if ( ! empty( $btn_text ) ) : ?>
            <div class="bloque-ji-nav-actions">
                <a href="<?php echo esc_url( $btn_url ); ?>" class="bloque-ji-nav-btn">
                    <?php echo esc_html( $btn_text ); ?>
                </a>
            </div>
        <?php endif; ?>
    </div>
</header>
