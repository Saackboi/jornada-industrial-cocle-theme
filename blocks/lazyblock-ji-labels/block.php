<?php
/**
 * ╔═══════════════════════════════════════════╗
 * ║  BLOCK VIEW: JI - Enlaces Rápidos        ║
 * ║  Quick links / labels list                ║
 * ╚═══════════════════════════════════════════╝
 */

// Variable extraction
$labels_list = isset( $attributes['labels_list'] ) && is_array( $attributes['labels_list'] ) ? $attributes['labels_list'] : array();

// Container classes
$clases = 'bloque-ji-labels';
if ( isset( $attributes['align'] ) && ! empty( $attributes['align'] ) ) {
    $clases .= ' align' . $attributes['align'];
}
if ( isset( $attributes['className'] ) && ! empty( $attributes['className'] ) ) {
    $clases .= ' ' . $attributes['className'];
}
?>

<div class="<?php echo esc_attr( $clases ); ?>">
    <div class="bloque-ji-labels-layout">
        <?php if ( ! empty( $labels_list ) ) : ?>
            <ul class="bloque-ji-labels-list">
                <?php foreach ( $labels_list as $item ) : 
                    $label = isset( $item['label'] ) ? $item['label'] : '';
                    $url   = isset( $item['url'] ) ? $item['url'] : '';
                    
                    // Si no hay texto, usar la URL o 'Item'
                    $display_label = ! empty( $label ) ? $label : ( ! empty( $url ) ? $url : 'Item' );
                    ?>
                    <li class="bloque-ji-labels-item">
                        <?php if ( ! empty( $url ) ) : ?>
                            <a href="<?php echo esc_url( $url ); ?>" class="bloque-ji-labels-link">
                                <?php echo esc_html($display_label); ?>
                            </a>
                        <?php else : ?>
                            <span class="bloque-ji-labels-text">
                                <?php echo esc_html($display_label); ?>
                            </span>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else : ?>
            <!-- Fallback para previsualizar en el editor -->
            <div class="bloque-ji-labels-placeholder">
                <span class="bloque-ji-labels-text-placeholder">Dictumst</span>
                <span class="bloque-ji-labels-text-placeholder">Sapien</span>
                <span class="bloque-ji-labels-text-placeholder">Fames</span>
                <span class="bloque-ji-labels-text-placeholder">Interdum</span>
                <span class="bloque-ji-labels-text-placeholder">Aliquam</span>
                <span class="bloque-ji-labels-text-placeholder">Aenean Sed</span>
            </div>
        <?php endif; ?>
    </div>
</div>
