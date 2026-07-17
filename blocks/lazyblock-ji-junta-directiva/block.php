<?php
/**
 * Vista del bloque: JI - Junta Directiva
 */
$label = isset( $attributes['section_label'] ) ? $attributes['section_label'] : '';
$title = isset( $attributes['section_title'] ) ? $attributes['section_title'] : '';
$members_raw = isset( $attributes['members'] ) ? $attributes['members'] : array();
$members = array();

if ( is_array( $members_raw ) && count( $members_raw ) > 0 ) {
    // Datos del editor visual de WordPress
    $members = $members_raw;
} elseif ( is_string( $members_raw ) && ! empty( $members_raw ) ) {
    // Datos inyectados como string codificado
    $decoded = json_decode( rawurldecode( $members_raw ), true );
    if ( is_array( $decoded ) && count( $decoded ) > 0 ) {
        $members = $decoded;
    }
}

// Fallback: leer desde wp_options (guardado por el script de construccion)
if ( empty( $members ) ) {
    $from_options = get_option( 'ji_org_junta_members', array() );
    if ( is_array( $from_options ) && count( $from_options ) > 0 ) {
        $members = $from_options;
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
<section class="ji-junta">
    <div class="ji-junta__header">
        <?php if ( ! empty( $label ) ) : ?>
            <div class="ji-junta__label"><?php echo esc_html($label); ?></div>
        <?php endif; ?>
        <h2 class="ji-junta__title"><?php echo $title_html; ?></h2>
        <div class="ji-junta__divider"></div>
    </div>

    <div class="ji-junta__grid">
        <?php 
        $idx = 0;
        foreach ( $members as $member ) : 
            $m_name = isset($member['name']) ? $member['name'] : '';
            $m_role = isset($member['role']) ? $member['role'] : '';
            $m_c1 = isset($member['career_line_1']) ? $member['career_line_1'] : '';
            $m_c2 = isset($member['career_line_2']) ? $member['career_line_2'] : '';
            $m_photo = isset($member['photo']) ? $member['photo'] : '';
            $photo_url = function_exists( 'ji_get_block_image_url' ) ? ji_get_block_image_url( $m_photo ) : '';
            $is_feat = isset($member['is_featured']) && (true === $member['is_featured'] || 'true' === $member['is_featured'] || 1 === $member['is_featured'] || '1' === $member['is_featured']);
            
            $card_class = 'ji-junta__card';
            if ($is_feat) {
                $card_class .= ' ji-junta__card--featured';
            }
            $idx++;
        ?>
            <div class="<?php echo esc_attr($card_class); ?>">
                <?php if ($is_feat) : ?>
                    <span class="ji-junta__badge"><?php echo esc_html($m_role); ?></span>
                <?php endif; ?>
                <div class="ji-junta__avatar-wrap">
                    <div class="ji-junta__avatar-ring" style="animation-delay: -<?php echo $idx * 2; ?>s;"></div>
                    <div class="ji-junta__avatar-bg"></div>
                    <?php if ($photo_url) : ?>
                        <img class="ji-junta__avatar" src="<?php echo esc_url($photo_url); ?>" alt="<?php echo esc_attr($m_name); ?>">
                    <?php endif; ?>
                </div>
                <p class="ji-junta__name"><?php echo esc_html($m_name); ?></p>
                <p class="ji-junta__role"><?php echo esc_html($m_role); ?></p>
                <p class="ji-junta__career"><strong><?php echo esc_html($m_c1); ?></strong><br><?php echo esc_html($m_c2); ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</section>
