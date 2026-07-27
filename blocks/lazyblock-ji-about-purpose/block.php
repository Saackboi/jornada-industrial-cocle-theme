<?php
/**
 * ╔═══════════════════════════════════════════╗
 * ║  BLOCK VIEW: JI - About Purpose          ║
 * ║  Purpose section with background image    ║
 * ╚═══════════════════════════════════════════╝
 */

// Variable extraction
$title = $attributes['title'] ?? '';
$content = $attributes['content'] ?? '';
$bg_image = $attributes['bg_image'] ?? '';

// Fallback: default background image
$bg_url = 'https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?q=80&w=2000&auto=format&fit=crop';
if ( ! empty( $bg_image['url'] ) ) {
    $bg_url = esc_url( $bg_image['url'] );
}
?>

<div class="ji-about-purpose" style="background-image: url('<?php echo $bg_url; ?>');">
    <div class="ji-about-purpose__overlay"></div>
    
    <div class="ji-about-purpose__container">
        <div class="ji-about-purpose__glass-card">
            <?php if ($title): ?>
                <h2 class="ji-about-purpose__title"><?php echo esc_html($title); ?></h2>
            <?php endif; ?>
            
            <div class="ji-about-purpose__content">
                <?php echo wp_kses_post($content); ?>
            </div>
            
            <div class="ji-about-purpose__accent-line"></div>
        </div>
    </div>
</div>
