<?php
/**
 * Plantilla para archivos de entradas.
 */

$archive_title = is_category( array( 'noticias', 'actualidad' ) ) ? 'Noticias' : wp_strip_all_tags( get_the_archive_title() );
$archive_desc  = get_the_archive_description();
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title( '|', true, 'right' ); ?></title>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<main id="primary" class="site-main ji-template-main">
    <section class="ji-archive">
        <div class="ji-archive-layout">
            <header class="ji-archive-header">
                <div class="ji-archive-header__titles">
                    <span class="ji-template-overline">Actualidad</span>
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
                                <span class="ji-news-card-tag">Noticia</span>
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

                <nav class="ji-archive-pagination" aria-label="Paginación de noticias">
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
                    <h2>No hay noticias publicadas todavía.</h2>
                    <p>Cuando se publiquen entradas, aparecerán automáticamente en este listado.</p>
                </div>
            <?php endif; ?>
        </div>
    </section>
</main>

<?php wp_footer(); ?>
</body>
</html>
