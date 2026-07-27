<?php
/**
 * ╔═══════════════════════════════════════════╗
 * ║  BLOCK VIEW: JI - Hero V3                ║
 * ║  Hero with background image, title, cards ║
 * ╚═══════════════════════════════════════════╝
 */

// Variable extraction
$overline    = isset( $attributes['overline'] ) ? $attributes['overline'] : 'Universidad Tecnológica de Panamá';
$titulo      = isset( $attributes['titulo'] ) ? $attributes['titulo'] : "UTP Coclé\nSede de la III Jornada Industrial";
$descripcion = isset( $attributes['descripcion'] ) ? $attributes['descripcion'] : 'Unificando la ingeniería, logística y el mercadeo internacional en un evento sin precedentes en el interior del país.';

$default_bg_url = 'https://lh3.googleusercontent.com/aida-public/AB6AXuBwyLVd_QuBn8HpihInNIVIC9w3s90YYiyvbxBQJgL8Xi-7hnIQtls2ApQY2yO8cHMyRFwP-NcgxzIhsbHvZ-jpFAbr19ylr6-kgDqZHmQgxZxqyd6QizU4VRD57O0SFA3nkIinduvmKnoP63acqQv4RQe__ozGDFRbgnA-upI8Lxirz5pXaguWdP96dZ3mwoLWfev9rzWOHBvMkHK_tfPaVno-rmQ6sjrKCgxe9iXfHtv6RmU6aJhIgysjiRHj3CYVuG7PmOa_rIg';
$bg_url = isset( $attributes['bg_image'] ) ? ji_get_block_image_url( $attributes['bg_image'], $default_bg_url ) : $default_bg_url;



// Repeater: cards
$cards = isset( $attributes['cards'] ) && is_array( $attributes['cards'] ) ? $attributes['cards'] : array();

// Fallback: default 3 cards if repeater is empty
if ( empty( $cards ) ) {
    $cards = array(
        array(
            'titulo' => 'Ingeniería Industrial',
            'descripcion' => 'Optimizando procesos críticos para la industria moderna.'
        ),
        array(
            'titulo' => 'Logística & Transporte',
            'descripcion' => 'Soluciones multimodales para un mercado globalizado.'
        ),
        array(
            'titulo' => 'Mercadeo Global',
            'descripcion' => 'Estrategias de posicionamiento y expansión comercial.'
        )
    );
}

// Container classes
$clases = 'bloque-ji-hero-v3';
if ( isset( $attributes['align'] ) && ! empty( $attributes['align'] ) ) {
    $clases .= ' align' . $attributes['align'];
}
if ( isset( $attributes['className'] ) && ! empty( $attributes['className'] ) ) {
    $clases .= ' ' . $attributes['className'];
}

// Title formatting: convert line breaks and highlight specific text
$titulo_br = nl2br( esc_html( $titulo ) );
// Si el título contiene "Sede de la III Jornada Industrial", envolver esa parte en un span con gradiente
$titulo_html = str_replace(
    'Sede de la III Jornada Industrial',
    '<span class="gold-gradient">Sede de la III Jornada Industrial</span>',
    $titulo_br
);
?>

<header class="<?php echo esc_attr( $clases ); ?>">
    <!-- Background Image with Overlay -->
    <div class="bloque-ji-hero-v3-bg" style="background-image: url('<?php echo esc_url( $bg_url ); ?>');"></div>
    <div class="bloque-ji-hero-v3-overlay"></div>

    <div class="bloque-ji-hero-v3-layout">
        <div class="bloque-ji-hero-v3-content">
            <?php if ( $overline ) : ?>
                <span class="bloque-ji-hero-v3-overline"><?php echo esc_html( $overline ); ?></span>
            <?php endif; ?>

            <h1 class="bloque-ji-hero-v3-title">
                <?php echo wp_kses_post( $titulo_html ); ?>
            </h1>

            <?php if ( $descripcion ) : ?>
                <p class="bloque-ji-hero-v3-desc">
                    <?php echo esc_html( $descripcion ); ?>
                </p>
            <?php endif; ?>

            <!-- bottom row of cards -->
            <div class="bloque-ji-hero-v3-grid">
                <?php foreach ( $cards as $card ) : 
                    $card_title = isset( $card['titulo'] ) ? $card['titulo'] : '';
                    $card_desc  = isset( $card['descripcion'] ) ? $card['descripcion'] : '';
                    
                    // Si ambos campos están vacíos, no pintamos nada (o mostramos valores por defecto)
                    if ( empty($card_title) && empty($card_desc) ) {
                        $card_title = 'Categoría';
                        $card_desc  = 'Detalle del proceso industrial o temática.';
                    }
                    ?>
                    <div class="bloque-ji-hero-v3-card">
                        <h3 class="bloque-ji-hero-v3-card-title"><?php echo esc_html( $card_title ); ?></h3>
                        <p class="bloque-ji-hero-v3-card-desc"><?php echo esc_html( $card_desc ); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</header>
