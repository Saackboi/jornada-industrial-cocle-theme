<?php
/**
 * Vista del bloque: JI - Registro de Boletos
 */
$label = isset( $attributes['section_label'] ) ? $attributes['section_label'] : '';
$title = isset( $attributes['section_title'] ) ? $attributes['section_title'] : '';
$description = isset( $attributes['description'] ) ? $attributes['description'] : '';
$sellers_raw = isset( $attributes['sellers'] ) ? $attributes['sellers'] : array();
$sellers = array();

if ( is_array( $sellers_raw ) && count( $sellers_raw ) > 0 ) {
    $sellers = $sellers_raw;
} elseif ( is_string( $sellers_raw ) && ! empty( $sellers_raw ) ) {
    $decoded = json_decode( rawurldecode( $sellers_raw ), true );
    if ( is_array( $decoded ) && count( $decoded ) > 0 ) {
        $sellers = $decoded;
    }
}

if ( empty( $sellers ) ) {
    $from_options = get_option( 'ji_registro_vendedores', array() );
    if ( is_array( $from_options ) && count( $from_options ) > 0 ) {
        $sellers = $from_options;
    }
}

$commissions = array();
foreach ( $sellers as $seller ) {
    $commission = isset( $seller['commission'] ) ? trim( $seller['commission'] ) : '';
    if ( '' !== $commission && ! in_array( $commission, $commissions, true ) ) {
        $commissions[] = $commission;
    }
}

$title_html = esc_html( $title );
if ( ! empty( $title ) ) {
    $words = explode( ' ', $title );
    if ( count( $words ) > 1 ) {
        $last_word = array_pop( $words );
        $title_html = esc_html( implode( ' ', $words ) ) . ' <span>' . esc_html( $last_word ) . '</span>';
    }
}
?>
<section class="ji-registro">
    <div class="ji-registro__mark" aria-hidden="true">REG</div>
    <div class="ji-registro__container">
        <header class="ji-registro__header">
            <?php if ( ! empty( $label ) ) : ?>
                <p class="ji-registro__label"><?php echo esc_html( $label ); ?></p>
            <?php endif; ?>
            <?php if ( ! empty( $title ) ) : ?>
                <h2 class="ji-registro__title"><?php echo $title_html; ?></h2>
            <?php endif; ?>
            <?php if ( ! empty( $description ) ) : ?>
                <p class="ji-registro__description"><?php echo esc_html( $description ); ?></p>
            <?php endif; ?>
        </header>

        <?php if ( ! empty( $commissions ) ) : ?>
            <div class="ji-registro__filters" aria-label="Comisiones de vendedores">
                <button class="ji-registro__filter is-active" type="button" data-commission="all">Todos</button>
                <?php foreach ( $commissions as $commission ) : ?>
                    <button class="ji-registro__filter" type="button" data-commission="<?php echo esc_attr( sanitize_title( $commission ) ); ?>"><?php echo esc_html( $commission ); ?></button>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <div class="ji-registro__grid">
            <?php foreach ( $sellers as $seller ) : ?>
                <?php
                $name = isset( $seller['name'] ) ? $seller['name'] : 'Vendedor autorizado';
                $email = isset( $seller['email'] ) ? $seller['email'] : '';
                $cedula = isset( $seller['cedula'] ) ? $seller['cedula'] : '';
                $phone = isset( $seller['phone'] ) ? $seller['phone'] : '';
                $commission = isset( $seller['commission'] ) ? $seller['commission'] : '';
                $url = isset( $seller['url'] ) ? $seller['url'] : '';
                $initials = '';
                foreach ( explode( ' ', $name ) as $part ) {
                    if ( '' !== trim( $part ) ) {
                        $initials .= strtoupper( substr( remove_accents( trim( $part ) ), 0, 1 ) );
                    }
                    if ( strlen( $initials ) >= 2 ) {
                        break;
                    }
                }
                ?>
                <article class="ji-registro-card" data-commission="<?php echo esc_attr( sanitize_title( $commission ) ); ?>">
                    <div class="ji-registro-card__top">
                        <div class="ji-registro-card__avatar"><?php echo esc_html( $initials ); ?></div>
                        <div>
                            <h3 class="ji-registro-card__name"><?php echo esc_html( $name ); ?></h3>
                            <?php if ( ! empty( $commission ) ) : ?>
                                <p class="ji-registro-card__commission"><?php echo esc_html( $commission ); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <dl class="ji-registro-card__details">
                        <?php if ( ! empty( $phone ) ) : ?>
                            <div><dt>Telefono</dt><dd><?php echo esc_html( $phone ); ?></dd></div>
                        <?php endif; ?>
                        <?php if ( ! empty( $email ) ) : ?>
                            <div><dt>Correo</dt><dd><?php echo esc_html( $email ); ?></dd></div>
                        <?php endif; ?>
                        <?php if ( ! empty( $cedula ) ) : ?>
                            <div><dt>Cedula</dt><dd><?php echo esc_html( $cedula ); ?></dd></div>
                        <?php endif; ?>
                    </dl>

                    <?php if ( ! empty( $url ) ) : ?>
                        <a class="ji-registro-card__button" href="<?php echo esc_url( $url ); ?>" target="_blank" rel="noopener">Registrarme con este vendedor</a>
                    <?php endif; ?>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.ji-registro').forEach(function(block) {
        const filters = block.querySelectorAll('.ji-registro__filter');
        const cards = block.querySelectorAll('.ji-registro-card');

        filters.forEach(function(filter) {
            filter.addEventListener('click', function() {
                const selected = filter.getAttribute('data-commission');
                filters.forEach(function(item) { item.classList.remove('is-active'); });
                filter.classList.add('is-active');

                cards.forEach(function(card) {
                    const show = selected === 'all' || card.getAttribute('data-commission') === selected;
                    card.hidden = !show;
                });
            });
        });
    });
});
</script>
