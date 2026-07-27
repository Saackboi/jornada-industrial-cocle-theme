/**
 * ╔═══════════════════════════════════════════╗
 * ║  JI-BASE Card Grid                       ║
 * ║  Grid of cards with configurable          ║
 * ║  columns and repeater items.             ║
 * ╚═══════════════════════════════════════════╝
 */

<?php
// Field extraction
$columnas = isset( $attributes['columnas'] ) ? $attributes['columnas'] : '3';
$cards_raw = isset( $attributes['cards'] ) ? $attributes['cards'] : array();
$cards = array();

// Parse repeater data (JSON string or array)
if ( is_array( $cards_raw ) && count( $cards_raw ) > 0 ) {
    $cards = $cards_raw;
} elseif ( is_string( $cards_raw ) && ! empty( $cards_raw ) ) {
    $decoded = json_decode( rawurldecode( $cards_raw ), true );
    if ( is_array( $decoded ) ) {
        $cards = $decoded;
    }
}

// Container classes
$clases = 'bloque-ji-card-grid';
if ( isset( $attributes['align'] ) && ! empty( $attributes['align'] ) ) {
    $clases .= ' align' . $attributes['align'];
}
if ( isset( $attributes['className'] ) && ! empty( $attributes['className'] ) ) {
    $clases .= ' ' . $attributes['className'];
}
$clases .= ' has-' . $columnas . '-cols';
?>
<div class="<?php echo esc_attr( $clases ); ?>">
    <!-- Card grid loop -->
    <?php if ( ! empty( $cards ) ) : ?>
        <div class="bloque-ji-card-grid-inner">
            <?php foreach ( $cards as $card ) :
                $card_titulo = isset( $card['card_titulo'] ) ? $card['card_titulo'] : '';
                $card_desc = isset( $card['card_descripcion'] ) ? $card['card_descripcion'] : '';
                $card_img = isset( $card['card_imagen'] ) ? $card['card_imagen'] : '';
                $card_url = isset( $card['card_url'] ) ? $card['card_url'] : '';
                $card_img_url = function_exists( 'ji_get_block_image_url' ) ? ji_get_block_image_url( $card_img ) : '';
                $has_link = ! empty( $card_url );
                ?>
                <div class="bloque-ji-card-grid-item">
                    <!-- Card item image -->
                    <?php if ( $card_img_url ) : ?>
                        <div class="bloque-ji-card-grid-image">
                            <?php if ( $has_link ) : ?>
                                <a href="<?php echo esc_url( $card_url ); ?>" tabindex="-1" aria-hidden="true">
                                    <img src="<?php echo esc_url( $card_img_url ); ?>" alt="<?php echo esc_attr( $card_titulo ); ?>">
                                </a>
                            <?php else : ?>
                                <img src="<?php echo esc_url( $card_img_url ); ?>" alt="<?php echo esc_attr( $card_titulo ); ?>">
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                    <!-- Card item body -->
                    <div class="bloque-ji-card-grid-body">
                        <?php if ( $card_titulo ) : ?>
                            <h3 class="bloque-ji-card-grid-title">
                                <?php if ( $has_link ) : ?>
                                    <a href="<?php echo esc_url( $card_url ); ?>"><?php echo esc_html( $card_titulo ); ?></a>
                                <?php else : ?>
                                    <?php echo esc_html( $card_titulo ); ?>
                                <?php endif; ?>
                            </h3>
                        <?php endif; ?>
                        <?php if ( $card_desc ) : ?>
                            <p class="bloque-ji-card-grid-desc"><?php echo esc_html( $card_desc ); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
