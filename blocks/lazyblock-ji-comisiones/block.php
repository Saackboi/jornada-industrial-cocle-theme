<?php
/**
 * ╔═══════════════════════════════════════════╗
 * ║  BLOCK VIEW: JI - Comisiones             ║
 * ║  Accordion-style commissions showcase     ║
 * ╚═══════════════════════════════════════════╝
 */

// Variable extraction
$label = isset( $attributes['section_label'] ) ? $attributes['section_label'] : '';
$title = isset( $attributes['section_title'] ) ? $attributes['section_title'] : '';
$commissions_raw = isset( $attributes['commissions'] ) ? $attributes['commissions'] : array();
$commissions = array();

// Data source: editor array or decoded JSON string
if ( is_array( $commissions_raw ) && count( $commissions_raw ) > 0 ) {
    $commissions = $commissions_raw;
} elseif ( is_string( $commissions_raw ) && ! empty( $commissions_raw ) ) {
    $decoded = json_decode( rawurldecode( $commissions_raw ), true );
    if ( is_array( $decoded ) && count( $decoded ) > 0 ) {
        $commissions = $decoded;
    }
}

// Fallback: load from wp_options
if ( empty( $commissions ) ) {
    $from_options = get_option( 'ji_org_comisiones', array() );
    if ( is_array( $from_options ) && count( $from_options ) > 0 ) {
        $commissions = $from_options;
    }
}

// Title formatting: accent on last word
$title_html = esc_html($title);
if ( ! empty( $title ) ) {
    $words = explode( ' ', $title );
    if ( count( $words ) > 1 ) {
        $last_word = array_pop( $words );
        $title_html = implode( ' ', $words ) . ' <span class="ji-com-creative__title-accent">' . esc_html( $last_word ) . '</span>';
    }
}
?>
<section class="ji-com-creative">
    <!-- Subtle Background Blur Blob -->
    <div class="ji-com-creative__bg-blob"></div>

    <!-- Scrolling Text Background -->
    <div class="ji-com-creative__marquee">
        <div class="ji-com-creative__marquee-track">
            <span>IV JORNADA INDUSTRIAL</span>
            <span>IV JORNADA INDUSTRIAL</span>
            <span>IV JORNADA INDUSTRIAL</span>
            <span>IV JORNADA INDUSTRIAL</span>
        </div>
    </div>

    <div class="ji-com-creative__container">
        <header class="ji-com-creative__header">
            <?php if ( ! empty( $label ) ) : ?>
                <div class="ji-com-creative__label"><?php echo esc_html($label); ?></div>
            <?php endif; ?>
            <h2 class="ji-com-creative__title"><?php echo $title_html; ?></h2>
            <p class="ji-com-creative__subtitle">Pasa el cursor sobre cada comisión para descubrir a su equipo.</p>
        </header>

        <div class="ji-com-acc" id="ji-com-acc">
            <?php 
            $i = 0;
            foreach ( $commissions as $com ) : 
                $i++;
                $c_name = isset($com['name']) ? $com['name'] : '';
                $c_leader = isset($com['leader']) ? $com['leader'] : '';
                
                $c_photo = isset($com['photo']) ? $com['photo'] : '';
                $photo_url = function_exists( 'ji_get_block_image_url' ) ? ji_get_block_image_url( $c_photo ) : '';
                
                if (empty($photo_url)) {
                    // Unique stunning placeholders from Unsplash so the accordion looks incredible immediately
                    $photo_url = "https://images.unsplash.com/photo-1522071820081-009f0129c71c?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80&sig=" . $i;
                }
                
                // First item is active by default
                $active_class = $i === 1 ? 'is-active' : '';
            ?>
                <div class="ji-com-acc__item <?php echo $active_class; ?>">
                    <img class="ji-com-acc__bg" src="<?php echo esc_url($photo_url); ?>" alt="<?php echo esc_attr($c_name); ?>">
                    <div class="ji-com-acc__overlay"></div>
                    
                    <div class="ji-com-acc__collapsed-title">
                        <span><?php echo esc_html($c_name); ?></span>
                    </div>

                    <div class="ji-com-acc__expanded-content">
                        <div class="ji-com-acc__info">
                            <h3 class="ji-com-acc__name"><?php echo esc_html($c_name); ?></h3>
                            <div class="ji-com-acc__leader-box">
                                <span class="ji-com-acc__leader-role">Líder</span>
                                <span class="ji-com-acc__leader-name"><?php echo esc_html($c_leader); ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const items = document.querySelectorAll('.ji-com-acc__item');
    if(items.length > 0) {
        items.forEach(item => {
            item.addEventListener('mouseenter', () => {
                items.forEach(i => i.classList.remove('is-active'));
                item.classList.add('is-active');
            });
            // Support for touch devices
            item.addEventListener('click', () => {
                items.forEach(i => i.classList.remove('is-active'));
                item.classList.add('is-active');
            });
        });
    }
});
</script>
