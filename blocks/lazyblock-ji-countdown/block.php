<?php
/**
 * ╔═══════════════════════════════════════════╗
 * ║  BLOCK VIEW: JI - Contador Regresivo     ║
 * ║  Countdown timer with days/hours/min/sec ║
 * ╚═══════════════════════════════════════════╝
 */

// Variable extraction
$target_date = isset( $attributes['target_date'] ) ? $attributes['target_date'] : '2026-06-15 09:00:00';
$cta_text    = isset( $attributes['cta_text'] ) ? $attributes['cta_text'] : 'Compra tu boleto';
$cta_url     = isset( $attributes['cta_url'] ) ? $attributes['cta_url'] : '#';
$unique_id   = uniqid( 'ji-countdown-' );

// Container classes
$clases = 'bloque-ji-countdown';
if ( isset( $attributes['align'] ) && ! empty( $attributes['align'] ) ) {
    $clases .= ' align' . $attributes['align'];
}
if ( isset( $attributes['className'] ) && ! empty( $attributes['className'] ) ) {
    $clases .= ' ' . $attributes['className'];
}
?>

<div id="<?php echo esc_attr( $unique_id ); ?>" class="<?php echo esc_attr( $clases ); ?>" data-target="<?php echo esc_attr( $target_date ); ?>">
    <div class="bloque-ji-countdown-layout">
        <div class="bloque-ji-countdown-header">
            <span class="bloque-ji-countdown-overline">Próximo Evento</span>
            <h2 class="bloque-ji-countdown-title">El tiempo corre</h2>
        </div>
        
        <div class="bloque-ji-countdown-grid">
            <div class="bloque-ji-countdown-card">
                <span class="bloque-ji-countdown-number days">00</span>
                <span class="bloque-ji-countdown-label">Días</span>
            </div>
            <div class="bloque-ji-countdown-card">
                <span class="bloque-ji-countdown-number hours">00</span>
                <span class="bloque-ji-countdown-label">Horas</span>
            </div>
            <div class="bloque-ji-countdown-card">
                <span class="bloque-ji-countdown-number minutes">00</span>
                <span class="bloque-ji-countdown-label">Minutos</span>
            </div>
            <div class="bloque-ji-countdown-card">
                <span class="bloque-ji-countdown-number seconds">00</span>
                <span class="bloque-ji-countdown-label">Segundos</span>
            </div>
        </div>

        <?php if ( $cta_text ) : ?>
            <div class="bloque-ji-countdown-cta">
                <p class="bloque-ji-countdown-cta-text">Asegura tu lugar en la jornada</p>
                <a href="<?php echo esc_url( $cta_url ); ?>" class="bloque-ji-countdown-btn">
                    <?php echo esc_html( $cta_text ); ?>
                    <span class="material-symbols-outlined">arrow_forward</span>
                </a>
            </div>
        <?php endif; ?>
    </div>

    <script type="text/javascript">
    (function() {
        const container = document.getElementById('<?php echo esc_js( $unique_id ); ?>');
        if (!container) return;

        const targetStr = container.getAttribute('data-target');
        // Reemplazar espacios por 'T' para asegurar soporte multiplataforma en iOS Safari
        const targetDate = new Date(targetStr.replace(' ', 'T')).getTime();

        const daysEl = container.querySelector('.days');
        const hoursEl = container.querySelector('.hours');
        const minutesEl = container.querySelector('.minutes');
        const secondsEl = container.querySelector('.seconds');

        function updateCountdown() {
            const now = new Date().getTime();
            const distance = targetDate - now;

            if (isNaN(targetDate) || distance < 0) {
                if (daysEl) daysEl.textContent = '00';
                if (hoursEl) hoursEl.textContent = '00';
                if (minutesEl) minutesEl.textContent = '00';
                if (secondsEl) secondsEl.textContent = '00';
                clearInterval(interval);
                return;
            }

            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            if (daysEl) daysEl.textContent = days.toString().padStart(2, '0');
            if (hoursEl) hoursEl.textContent = hours.toString().padStart(2, '0');
            if (minutesEl) minutesEl.textContent = minutes.toString().padStart(2, '0');
            if (secondsEl) secondsEl.textContent = seconds.toString().padStart(2, '0');
        }

        updateCountdown();
        const interval = setInterval(updateCountdown, 1000);
    })();
    </script>
</div>
