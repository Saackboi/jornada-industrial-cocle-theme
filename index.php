<?php
/**
 * Plantilla principal del tema Jornada Industrial.
 * Muestra el contenido de Gutenberg de forma directa y limpia.
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title( '|', true, 'right' ); ?></title>
    <?php wp_head(); ?>
    <style>
        /* Estilos base mínimos para que el tema se vea limpio */
        body {
            margin: 0;
            padding: 0;
            background-color: #ffffff;
            color: #000000;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            overflow-x: hidden;
        }
        .site-main {
            width: 100%;
            margin: 0 auto;
        }
    </style>
</head>
<body <?php body_class(); ?>>

    <main id="primary" class="site-main">
        <?php
        if ( have_posts() ) :
            while ( have_posts() ) : the_post();
                the_content();
            endwhile;
        endif;
        ?>
    </main>

    <?php wp_footer(); ?>
</body>
</html>
