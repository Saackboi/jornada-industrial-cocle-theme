<?php
/**
 * ╔═══════════════════════════════════════════╗
 * ║  SINGLE — Entrada individual             ║
 * ║  Muestra una entrada con imagen          ║
 * ║  destacada, título, fecha, contenido     ║
 * ║  y enlace "Volver" a la categoría.       ║
 * ╚═══════════════════════════════════════════╝
 */
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
    <?php if ( have_posts() ) : ?>
        <?php while ( have_posts() ) : the_post(); ?>
            <article <?php post_class( 'ji-single-post' ); ?>>
                <?php
                // Determinar URL de retorno según la primera categoría del post
                $back_cats = get_the_category();
                $back_url = ji_get_news_archive_url(); // fallback a noticias
                if ( ! empty( $back_cats ) ) {
                    $back_url = get_category_link( $back_cats[0]->term_id );
                }
                ?>
                <header class="ji-single-hero">
                    <div class="ji-single-hero__inner">
                        <a class="ji-template-back-link" href="<?php echo esc_url( $back_url ); ?>">
                            <span class="material-symbols-outlined">arrow_back</span>
                            Volver
                        </a>

                        <span class="ji-template-overline">
                            <?php echo esc_html( get_the_category_list( ', ' ) ? wp_strip_all_tags( get_the_category_list( ', ' ) ) : 'Actualidad' ); ?>
                        </span>

                        <h1 class="ji-single-title"><?php the_title(); ?></h1>

                        <div class="ji-single-meta">
                            <time datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
                        </div>
                    </div>
                </header>

                <div class="ji-single-featured-wrap">
                    <?php if ( has_post_thumbnail() ) : ?>
                        <?php the_post_thumbnail( 'large', array( 'class' => 'ji-single-featured-img' ) ); ?>
                    <?php else : ?>
                        <div class="ji-template-image-placeholder" aria-hidden="true"></div>
                    <?php endif; ?>
                </div>

                <div class="ji-single-content-wrap">
                    <div class="ji-single-content">
                        <?php the_content(); ?>
                    </div>

                    <footer class="ji-single-footer">
                        <a class="ji-template-back-link" href="<?php echo esc_url( $back_url ); ?>">
                            <span class="material-symbols-outlined">arrow_back</span>
                            Volver
                        </a>
                    </footer>
                </div>
            </article>
        <?php endwhile; ?>
    <?php endif; ?>
</main>

<div class="ji-template-footer">
    <span class="ji-template-footer__org">Universidad Tecnológica de Panamá, Centro Regional de Coclé</span>
    <span class="ji-template-footer__event">Jornada Industrial — <?php echo date( 'Y' ); ?></span>
</div>

<?php wp_footer(); ?>
</body>
</html>
