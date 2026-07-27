<?php
/**
 * ╔═══════════════════════════════════════════╗
 * ║  BLOCK VIEW: JI - Patrocinadores         ║
 * ║  Sponsors marquee with logo carousel      ║
 * ╚═══════════════════════════════════════════╝
 */

// Variable extraction
$section_label = isset( $attributes['section_label'] ) ? $attributes['section_label'] : 'Aliados estratégicos';
$section_title = isset( $attributes['section_title'] ) ? $attributes['section_title'] : 'Nuestros Patrocinadores';
$section_desc  = isset( $attributes['section_description'] ) ? $attributes['section_description'] : '';
$sponsors      = isset( $attributes['sponsors'] ) && is_array( $attributes['sponsors'] ) ? $attributes['sponsors'] : array();

if ( empty( $sponsors ) ) {
    $sponsors = array(
        array( 'name' => 'Patrocinador 1' ),
        array( 'name' => 'Patrocinador 2' ),
        array( 'name' => 'Patrocinador 3' ),
        array( 'name' => 'Patrocinador 4' ),
        array( 'name' => 'Patrocinador 5' ),
        array( 'name' => 'Patrocinador 6' ),
        array( 'name' => 'Patrocinador 7' ),
        array( 'name' => 'Patrocinador 8' ),
    );
}

$sponsor_rows = array_chunk( $sponsors, 5 );

// Container classes
$clases = 'bloque-ji-sponsors';
if ( isset( $attributes['align'] ) && ! empty( $attributes['align'] ) ) {
    $clases .= ' align' . $attributes['align'];
}
if ( isset( $attributes['className'] ) && ! empty( $attributes['className'] ) ) {
    $clases .= ' ' . $attributes['className'];
}
?>

<div class="<?php echo esc_attr( $clases ); ?>">
    <div class="bloque-ji-sponsors-layout">
        <?php if ( $section_label ) : ?>
            <div class="bloque-ji-sponsors-label"><?php echo esc_html( $section_label ); ?></div>
        <?php endif; ?>

        <?php if ( $section_title ) : ?>
            <h2 class="bloque-ji-sponsors-title"><?php echo esc_html( $section_title ); ?></h2>
        <?php endif; ?>

        <?php if ( $section_desc ) : ?>
            <p class="bloque-ji-sponsors-desc"><?php echo esc_html( $section_desc ); ?></p>
        <?php endif; ?>
    </div>

    <div class="bloque-ji-sponsors-marquee">
        <?php
        // Render helper for individual sponsor item
        $render_item = function( $sponsor ) {
            $logo_url = isset( $sponsor['logo'] ) ? ji_get_block_image_url( $sponsor['logo'] ) : '';
            $name     = isset( $sponsor['name'] ) ? $sponsor['name'] : 'Patrocinador';
            $url      = isset( $sponsor['url'] ) ? $sponsor['url'] : '';
            ?>
            <div class="bloque-ji-sponsors-item">
                <?php if ( $url ) : ?>
                    <a href="<?php echo esc_url( $url ); ?>" class="bloque-ji-sponsors-link" target="_blank" rel="noopener noreferrer">
                <?php endif; ?>

                <?php if ( $logo_url ) : ?>
                    <img src="<?php echo esc_url( $logo_url ); ?>" alt="<?php echo esc_attr( $name ); ?>" class="bloque-ji-sponsors-logo" />
                <?php else : ?>
                    <span class="bloque-ji-sponsors-placeholder"><?php echo esc_html( $name ); ?></span>
                <?php endif; ?>

                <?php if ( $url ) : ?>
                    </a>
                <?php endif; ?>
            </div>
            <?php
        };

        // Render helper for marquee track with duplicate items
        $render_track = function( $row_sponsors, $is_reverse ) use ( $render_item ) {
            $class = 'bloque-ji-sponsors-track';
            if ( $is_reverse ) {
                $class .= ' is-reverse';
            }
            ?>
            <div class="<?php echo esc_attr( $class ); ?>">
                <?php
                foreach ( $row_sponsors as $sponsor ) {
                    $render_item( $sponsor );
                }
                foreach ( $row_sponsors as $sponsor ) {
                    $render_item( $sponsor );
                }
                ?>
            </div>
            <?php
        };

        foreach ( $sponsor_rows as $index => $row_sponsors ) {
            $render_track( $row_sponsors, $index % 2 === 1 );
        }
        ?>
    </div>
</div>
