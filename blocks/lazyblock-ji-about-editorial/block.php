<?php
/**
 * Block template for JI - About Editorial
 * Premium Magazine-Layout: Split screen with bold typographic cards
 */

$que_somos = isset($attributes['que_somos_text']) && !empty($attributes['que_somos_text']) ? $attributes['que_somos_text'] : 'Escribe aquí la introducción...';
$mision = isset($attributes['mision_text']) && !empty($attributes['mision_text']) ? $attributes['mision_text'] : 'Escribe aquí la misión...';
$vision = isset($attributes['vision_text']) && !empty($attributes['vision_text']) ? $attributes['vision_text'] : 'Escribe aquí la visión...';

$img1_url = ji_get_block_image_url($attributes['image_1'] ?? '', 'https://images.unsplash.com/photo-1522071820081-009f0129c71c?q=80&w=1200&auto=format&fit=crop');
$img2_url = ji_get_block_image_url($attributes['image_2'] ?? '', 'https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?q=80&w=1200&auto=format&fit=crop');
?>
<section class="ji-editorial" aria-label="Acerca de Jornada Industrial">

    <!-- ===== BLOQUE 1: ¿QUÉ SOMOS? — Split screen cinematic ===== -->
    <div class="ji-editorial__intro">
        <!-- Panel izquierdo: texto -->
        <div class="ji-editorial__intro-text">
            <div class="ji-editorial__label">
                <span class="ji-editorial__label-line"></span>
                <span>Sobre Nosotros</span>
            </div>
            <h2 class="ji-editorial__intro-heading">
                ¿Qué
                <br>
                <em class="ji-editorial__intro-em">somos?</em>
            </h2>
            <div class="ji-editorial__intro-body">
                <?php echo $que_somos; ?>
            </div>
        </div>

        <!-- Panel derecho: imagen con efecto morphing -->
        <div class="ji-editorial__intro-visual">
            <div class="ji-editorial__morph-frame">
                <div class="ji-editorial__morph-glow"></div>
                <img
                    src="<?php echo esc_url($img1_url); ?>"
                    alt="Equipo Jornada Industrial"
                    class="ji-editorial__morph-img"
                />
            </div>
            <!-- Decorative scattered dots -->
            <div class="ji-editorial__dots-pattern"></div>
        </div>
    </div>

    <!-- ===== BLOQUE 2: MISIÓN & VISIÓN — Bold editorial timeline ===== -->
    <div class="ji-editorial__mv-section">

        <!-- Headline cruzada con línea decorativa -->
        <div class="ji-editorial__mv-header">
            <div class="ji-editorial__mv-marquee" aria-hidden="true">
                <span>MISIÓN &amp; VISIÓN &nbsp;·&nbsp; MISIÓN &amp; VISIÓN &nbsp;·&nbsp; MISIÓN &amp; VISIÓN &nbsp;·&nbsp; MISIÓN &amp; VISIÓN &nbsp;·&nbsp; MISIÓN &amp; VISIÓN &nbsp;·&nbsp; MISIÓN &amp; VISIÓN &nbsp;·&nbsp; MISIÓN &amp; VISIÓN &nbsp;·&nbsp; MISIÓN &amp; VISIÓN &nbsp;·&nbsp; MISIÓN &amp; VISIÓN &nbsp;·&nbsp; MISIÓN &amp; VISIÓN &nbsp;·&nbsp;</span>
                <span aria-hidden="true">MISIÓN &amp; VISIÓN &nbsp;·&nbsp; MISIÓN &amp; VISIÓN &nbsp;·&nbsp; MISIÓN &amp; VISIÓN &nbsp;·&nbsp; MISIÓN &amp; VISIÓN &nbsp;·&nbsp; MISIÓN &amp; VISIÓN &nbsp;·&nbsp; MISIÓN &amp; VISIÓN &nbsp;·&nbsp; MISIÓN &amp; VISIÓN &nbsp;·&nbsp; MISIÓN &amp; VISIÓN &nbsp;·&nbsp; MISIÓN &amp; VISIÓN &nbsp;·&nbsp; MISIÓN &amp; VISIÓN &nbsp;·&nbsp;</span>
            </div>
        </div>

        <!-- Cards de Misión y Visión -->
        <div class="ji-editorial__mv-grid">

            <!-- Misión -->
            <article class="ji-mv-card ji-mv-card--mision">
                <div class="ji-mv-card__accent-bar"></div>
                <div class="ji-mv-card__inner">
                    <div class="ji-mv-card__meta">
                        <div class="ji-mv-card__icon" aria-hidden="true">
                            <!-- Target / Propósito icon -->
                            <svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="24" cy="24" r="20" stroke="currentColor" stroke-width="2"/>
                                <circle cx="24" cy="24" r="12" stroke="currentColor" stroke-width="1.5" stroke-dasharray="4 3"/>
                                <circle cx="24" cy="24" r="5" fill="currentColor"/>
                                <line x1="24" y1="4" x2="24" y2="10" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                <line x1="24" y1="38" x2="24" y2="44" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                <line x1="4" y1="24" x2="10" y2="24" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                <line x1="38" y1="24" x2="44" y2="24" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                            </svg>
                        </div>
                        <span class="ji-mv-card__tag">01 — Propósito</span>
                    </div>
                    <h3 class="ji-mv-card__title">Nuestra<br>Misión</h3>
                    <p class="ji-mv-card__text"><?php echo esc_html($mision); ?></p>
                    <div class="ji-mv-card__footer">
                        <div class="ji-mv-card__line"></div>
                        <span class="ji-mv-card__cta-text">Lo que nos mueve</span>
                    </div>
                </div>
                <!-- Decorative bg number -->
                <span class="ji-mv-card__bg-num" aria-hidden="true">01</span>
                <!-- Image strip -->
                <div class="ji-mv-card__img-strip">
                    <img src="<?php echo esc_url($img2_url); ?>" alt="" class="ji-mv-card__img" />
                    <div class="ji-mv-card__img-overlay"></div>
                </div>
            </article>

            <!-- Visión -->
            <article class="ji-mv-card ji-mv-card--vision">
                <div class="ji-mv-card__accent-bar"></div>
                <div class="ji-mv-card__inner">
                    <div class="ji-mv-card__meta">
                        <div class="ji-mv-card__icon" aria-hidden="true">
                            <!-- Eye / Visión icon -->
                            <svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4 24C4 24 13 8 24 8C35 8 44 24 44 24C44 24 35 40 24 40C13 40 4 24 4 24Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                                <circle cx="24" cy="24" r="7" stroke="currentColor" stroke-width="2"/>
                                <circle cx="24" cy="24" r="3" fill="currentColor"/>
                                <path d="M18 14L10 8M30 14L38 8" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                            </svg>
                        </div>
                        <span class="ji-mv-card__tag">02 — Dirección</span>
                    </div>
                    <h3 class="ji-mv-card__title">Nuestra<br>Visión</h3>
                    <p class="ji-mv-card__text"><?php echo esc_html($vision); ?></p>
                    <div class="ji-mv-card__footer">
                        <div class="ji-mv-card__line"></div>
                        <span class="ji-mv-card__cta-text">Hacia dónde vamos</span>
                    </div>
                </div>
                <!-- Decorative bg number -->
                <span class="ji-mv-card__bg-num" aria-hidden="true">02</span>
            </article>

        </div>
    </div>

</section>
