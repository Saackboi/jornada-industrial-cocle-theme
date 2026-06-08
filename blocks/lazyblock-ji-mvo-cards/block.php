<?php
/**
 * Vista del bloque: JI - Propósito y Dirección
 */
$label = isset( $attributes['section_label'] ) ? $attributes['section_label'] : '';
$title = isset( $attributes['section_title'] ) ? $attributes['section_title'] : '';
$cards_raw = isset( $attributes['cards'] ) ? $attributes['cards'] : array();
$cards = array();

if ( is_array( $cards_raw ) && count( $cards_raw ) > 0 ) {
    $cards = $cards_raw;
} elseif ( is_string( $cards_raw ) && ! empty( $cards_raw ) ) {
    $decoded = json_decode( rawurldecode( $cards_raw ), true );
    if ( is_array( $decoded ) && count( $decoded ) > 0 ) {
        $cards = $decoded;
    }
}

// Fallback: leer desde wp_options
if ( empty( $cards ) ) {
    $from_options = get_option( 'ji_org_mvo_cards', array() );
    if ( is_array( $from_options ) && count( $from_options ) > 0 ) {
        $cards = $from_options;
    }
}

// Split title by words to put italic on last word
$title_html = esc_html($title);
if ( ! empty( $title ) ) {
    $words = explode( ' ', $title );
    if ( count( $words ) > 1 ) {
        $last_word = array_pop( $words );
        $title_html = implode( ' ', $words ) . ' <em>' . esc_html( $last_word ) . '</em>';
    }
}
?>
<section class="ji-mvo">
    <?php if ( ! empty( $label ) ) : ?>
        <div class="ji-mvo__section-label"><?php echo esc_html($label); ?></div>
    <?php endif; ?>
    <h2 class="ji-mvo__section-title"><?php echo $title_html; ?></h2>

    <div class="ji-mvo__grid">
        <?php foreach ( $cards as $card ) : ?>
            <div class="ji-mvo__item">
                <span class="ji-mvo__icon"><?php echo esc_html(isset($card['icon']) ? $card['icon'] : '🎯'); ?></span>
                <p class="ji-mvo__title"><?php echo esc_html(isset($card['title']) ? $card['title'] : ''); ?></p>
                <p class="ji-mvo__text"><?php echo esc_html(isset($card['description']) ? $card['description'] : ''); ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</section>
