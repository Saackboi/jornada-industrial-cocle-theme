<?php
/**
 * ╔═══════════════════════════════════════════╗
 * ║  BLOCK VIEW: JI - Cabecera Subpágina     ║
 * ║  Subpage hero header with background      ║
 * ╚═══════════════════════════════════════════╝
 */

// Variable extraction
$eyebrow = isset( $attributes['eyebrow'] ) ? $attributes['eyebrow'] : '';
$title = isset( $attributes['title'] ) ? $attributes['title'] : '';
$subtitle = isset( $attributes['subtitle'] ) ? $attributes['subtitle'] : '';
$bg_image = isset( $attributes['bg_image'] ) ? $attributes['bg_image'] : '';
$logo_url = function_exists( 'ji_get_block_image_url' ) ? ji_get_block_image_url( $bg_image ) : '';

// Title formatting: accent color on last word
$title_html = esc_html($title);
if ( ! empty( $title ) ) {
    $words = explode( ' ', $title );
    if ( count( $words ) > 1 ) {
        $last_word = array_pop( $words );
        $title_html = implode( ' ', $words ) . '<br><span>' . esc_html( $last_word ) . '</span>';
    }
}
?>
<section class="ji-orgs-hero">
    <div class="ji-orgs-hero__bg" style="background-image: url('<?php echo esc_url($logo_url); ?>');"></div>
    <div class="ji-orgs-hero__overlay"></div>
    <div class="ji-orgs-hero__content">
        <?php if ( ! empty( $eyebrow ) ) : ?>
            <div class="ji-orgs-hero__eyebrow"><?php echo esc_html( $eyebrow ); ?></div>
        <?php endif; ?>
        <h1 class="ji-orgs-hero__title"><?php echo $title_html; ?></h1>
        <?php if ( ! empty( $subtitle ) ) : ?>
            <p class="ji-orgs-hero__sub"><?php echo esc_html( $subtitle ); ?></p>
        <?php endif; ?>
        <div class="ji-orgs-hero__scroll"></div>
    </div>
</section>
