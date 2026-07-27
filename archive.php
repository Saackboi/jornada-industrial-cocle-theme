<?php
/**
 * ╔═══════════════════════════════════════════╗
 * ║  ARCHIVE — Listado por categoría         ║
 * ║  Muestra un grid de tarjetas con las     ║
 * ║  entradas de una categoría. Funciona     ║
 * ║  para noticias, giras, simposio, etc.    ║
 * ╚═══════════════════════════════════════════╝
 */

$current_cat = get_queried_object();
$cat_name = '';
$archive_desc = get_the_archive_description(); // Descripción de la categoría (si tiene)
if ( $current_cat && is_category() ) {
    $cat_name = single_cat_title( '', false );
}
$archive_title = $cat_name ? $cat_name : 'Entradas';
$card_tag = $cat_name ? $cat_name : 'Entrada'; // Tag en cada tarjeta
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<main id="primary" class="site-main ji-template-main">
    <section class="ji-archive">
        <div class="ji-archive-layout">
            <header class="ji-archive-header">
                <div class="ji-archive-header__titles">
                    <h1 class="ji-archive-title"><?php echo esc_html( $archive_title ); ?></h1>
                    <?php if ( $archive_desc ) : ?>
                        <div class="ji-archive-desc"><?php echo wp_kses_post( wpautop( $archive_desc ) ); ?></div>
                    <?php endif; ?>
                </div>

                <a class="ji-template-back-link" href="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <span class="material-symbols-outlined">arrow_back</span>
                    Volver al inicio
                </a>
            </header>

            <?php if ( have_posts() ) : ?>
                <div class="ji-archive-grid">
                    <?php while ( have_posts() ) : the_post(); ?>
                        <article <?php post_class( 'ji-archive-card' ); ?>>
                            <a class="ji-archive-card__image-link" href="<?php the_permalink(); ?>" aria-label="<?php echo esc_attr( get_the_title() ); ?>">
                                <?php if ( has_post_thumbnail() ) : ?>
                                    <?php the_post_thumbnail( 'large', array( 'class' => 'ji-archive-card__image' ) ); ?>
                                <?php else : ?>
                                    <div class="ji-template-image-placeholder" aria-hidden="true"></div>
                                <?php endif; ?>
                            </a>

                            <div class="ji-archive-card__content">
                                <span class="ji-news-card-tag"><?php echo get_the_date( 'd/m/Y' ); ?></span>
                                <h2 class="ji-archive-card__title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h2>
                                <p class="ji-archive-card__excerpt"><?php echo esc_html( wp_html_excerpt( get_the_excerpt(), 150, '...' ) ); ?></p>
                                <a class="ji-archive-card__read-more" href="<?php the_permalink(); ?>">
                                    <span>Leer más</span>
                                    <span class="material-symbols-outlined">chevron_right</span>
                                </a>
                            </div>
                        </article>
                    <?php endwhile; ?>
                </div>

                <nav class="ji-archive-pagination" aria-label="Paginación">
                    <?php
                    the_posts_pagination( array(
                        'mid_size'  => 1,
                        'prev_text' => '<span class="material-symbols-outlined">chevron_left</span> Anterior',
                        'next_text' => 'Siguiente <span class="material-symbols-outlined">chevron_right</span>',
                    ) );
                    ?>
                </nav>
            <?php else : ?>
                <div class="ji-archive-empty">
                    <h2>No hay entradas publicadas todavía.</h2>
                    <p>Cuando se publiquen, aparecerán automáticamente en este listado.</p>
                </div>
            <?php endif; ?>
        </div>
    </section>
</main>

<div class="ji-template-footer">
    <span class="ji-template-footer__org">Universidad Tecnológica de Panamá, Centro Regional de Coclé</span>
    <span class="ji-template-footer__event">Jornada Industrial — <?php echo date( 'Y' ); ?></span>
</div>

<?php wp_footer(); ?>
</body>
</html>
