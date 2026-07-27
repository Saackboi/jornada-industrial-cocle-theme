<?php
/**
 * ╔═══════════════════════════════════════════╗
 * ║  BLOCK VIEW: JI - Grid de Noticias       ║
 * ║  Dynamic news grid with WP posts query    ║
 * ╚═══════════════════════════════════════════╝
 */

// Variable extraction
$overline      = isset( $attributes['overline'] ) ? $attributes['overline'] : 'Actualidad';
$section_title = isset( $attributes['section_title'] ) ? $attributes['section_title'] : 'Noticias destacadas';
$more_url      = isset( $attributes['more_url'] ) ? $attributes['more_url'] : '#';

// Imagen tipo esqueleto (SVG inline) para usar como placeholder visual limpio
$skeleton_img = 'data:image/svg+xml;charset=utf-8,%3Csvg xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22 viewBox%3D%220 0 800 450%22%3E%3Crect width%3D%22100%25%22 height%3D%22100%25%22 fill%3D%22%23f1f5f9%22%2F%3E%3Crect x%3D%2210%25%22 y%3D%2220%25%22 width%3D%2280%25%22 height%3D%2240%25%22 rx%3D%228%22 fill%3D%22%23e2e8f0%22%2F%3E%3Crect x%3D%2210%25%22 y%3D%2270%25%22 width%3D%2260%25%22 height%3D%225%25%22 rx%3D%224%22 fill%3D%22%23e2e8f0%22%2F%3E%3Crect x%3D%2210%25%22 y%3D%2280%25%22 width%3D%2240%25%22 height%3D%224%25%22 rx%3D%224%22 fill%3D%22%23e2e8f0%22%2F%3E%3C%2Fsvg%3E';

// ----------------------------------------------------
// CONSULTA DINÁMICA DE ENTRADAS (POSTS) DE WORDPRESS
// ----------------------------------------------------
$args = array(
    'post_type'      => 'post',
    'post_status'    => 'publish',
    'posts_per_page' => 4,
    'orderby'        => 'date',
    'order'          => 'DESC',
);

// Intentar filtrar por categoría 'noticias' o 'actualidad' si existen
$cat = get_category_by_slug( 'noticias' );
if ( $cat ) {
    $args['category_name'] = 'noticias';
} else {
    $cat_act = get_category_by_slug( 'actualidad' );
    if ( $cat_act ) {
        $args['category_name'] = 'actualidad';
        $cat = $cat_act; // Para usarlo en la URL dinámica
    }
}

$news_query = new WP_Query( $args );
$dynamic_news = array();

if ( $news_query->have_posts() ) {
    while ( $news_query->have_posts() ) {
        $news_query->the_post();
        
        // Generar extracto limpio
        $excerpt = get_the_excerpt();
        if ( empty( $excerpt ) ) {
            $excerpt = wp_strip_all_tags( get_the_content() );
        }
        $excerpt = wp_html_excerpt( $excerpt, 140, '...' );
        
        // Obtener la imagen destacada o usar la de tipo esqueleto
        $img_url = '';
        if ( has_post_thumbnail() ) {
            $img_url = get_the_post_thumbnail_url( get_the_ID(), 'large' );
        } else {
            $img_url = $skeleton_img;
        }
        
        $dynamic_news[] = array(
            'title' => get_the_title(),
            'desc'  => $excerpt,
            'url'   => get_permalink(),
            'img'   => array( 'url' => $img_url )
        );
    }
    wp_reset_postdata();
}

// ----------------------------------------------------
// PROCESAMIENTO DE NOTICIA PRINCIPAL Y LATERALES
// ----------------------------------------------------
$main_news_data = null;
$sidebar_news_data = array();

if ( ! empty( $dynamic_news ) ) {
    // La primera entrada de la consulta es la principal (izquierda)
    $main_news_data = $dynamic_news[0];
    
    // Las siguientes son las laterales (derecha)
    if ( count( $dynamic_news ) > 1 ) {
        $sidebar_news_data = array_slice( $dynamic_news, 1 );
    }
}

// Fallback robusto a datos manuales si no hay entradas en WordPress
if ( ! $main_news_data ) {
    $main_img_url = isset( $attributes['main_img'] ) ? ji_get_block_image_url( $attributes['main_img'], $skeleton_img ) : $skeleton_img;
    
    // Verificar si el usuario ha personalizado el título en el inspector, si no, usar placeholder informativo
    $custom_title = isset( $attributes['main_title'] ) ? $attributes['main_title'] : '';
    $fallback_title = ( ! empty( $custom_title ) && $custom_title !== 'Grupo Coclé Avanza: Alianza por la Innovación' ) 
        ? $custom_title 
        : '[Espacio Reservado] Noticia Principal Destacada';

    $custom_desc = isset( $attributes['main_desc'] ) ? $attributes['main_desc'] : '';
    $fallback_desc = ( ! empty( $custom_desc ) && $custom_desc !== 'Líderes de la industria y la academia se reúnen para definir el futuro tecnológico de la región central del país, estableciendo nuevos estándares para la ingeniería.' ) 
        ? $custom_desc 
        : 'Este espacio se llenará automáticamente con la entrada más reciente que publiques bajo la categoría "noticias" en tu panel de administración.';

    $main_news_data = array(
        'title' => $fallback_title,
        'desc'  => $fallback_desc,
        'url'   => isset( $attributes['main_url'] ) ? $attributes['main_url'] : '#',
        'img'   => array( 'url' => $main_img_url )
    );
}

if ( empty( $sidebar_news_data ) ) {
    $sidebar_news_data = isset( $attributes['sidebar_news'] ) && is_array( $attributes['sidebar_news'] ) ? $attributes['sidebar_news'] : array();
    
    // Limpiar o rellenar con placeholders descriptivos si el repetidor está vacío
    if ( empty( $sidebar_news_data ) ) {
        $sidebar_news_data = array(
            array(
                'title' => '[Espacio Reservado] Noticia Lateral 1',
                'desc'  => 'Aquí se mostrará automáticamente la segunda entrada más reciente publicada.',
                'url'   => '#',
                'img'   => array( 'url' => $skeleton_img )
            ),
            array(
                'title' => '[Espacio Reservado] Noticia Lateral 2',
                'desc'  => 'Aquí se mostrará automáticamente la tercera entrada más reciente publicada.',
                'url'   => '#',
                'img'   => array( 'url' => $skeleton_img )
            ),
            array(
                'title' => '[Espacio Reservado] Noticia Lateral 3',
                'desc'  => 'Aquí se mostrará automáticamente la cuarta entrada más reciente publicada.',
                'url'   => '#',
                'img'   => array( 'url' => $skeleton_img )
            )
        );
    } else {
        foreach ( $sidebar_news_data as &$item ) {
            $item_img_url = isset( $item['img'] ) ? ji_get_block_image_url( $item['img'], $skeleton_img ) : $skeleton_img;
            $item['img'] = array( 'url' => $item_img_url );
            // Si el título es el genérico de prueba original, cambiarlo a un aviso de espacio reservado
            if ( empty( $item['title'] ) || in_array( $item['title'], array( 'Seminarios técnicos y conferencias de expertos', 'Visitas guiadas a proyectos locales', 'Desafío de Logística Estudiantil' ) ) ) {
                $item['title'] = '[Espacio Reservado] Noticia de Prueba';
                $item['desc']  = 'Este contenido cambiará automáticamente cuando comiences a publicar entradas.';
            }
        }
        unset( $item );
    }
}

// ----------------------------------------------------
// RESOLVER ENLACE "VER MÁS"
// ----------------------------------------------------
$dynamic_more_url = $more_url;
if ( $cat ) {
    $dynamic_more_url = get_category_link( $cat->term_id );
} else {
    $blog_page_id = get_option( 'page_for_posts' );
    if ( $blog_page_id ) {
        $dynamic_more_url = get_permalink( $blog_page_id );
    }
}

// Clases base del bloque
$clases = 'bloque-ji-news';
if ( isset( $attributes['align'] ) && ! empty( $attributes['align'] ) ) {
    $clases .= ' align' . $attributes['align'];
}
if ( isset( $attributes['className'] ) && ! empty( $attributes['className'] ) ) {
    $clases .= ' ' . $attributes['className'];
}
?>

<section class="<?php echo esc_attr( $clases ); ?>">
    <div class="bloque-ji-news-layout">
        
        <!-- Header de la Sección -->
        <div class="bloque-ji-news-header">
            <div class="bloque-ji-news-header-titles">
                <?php if ( $overline ) : ?>
                    <span class="bloque-ji-news-overline"><?php echo esc_html( $overline ); ?></span>
                <?php endif; ?>
                <?php if ( $section_title ) : ?>
                    <h2 class="bloque-ji-news-title"><?php echo esc_html( $section_title ); ?></h2>
                <?php endif; ?>
            </div>
            
            <a href="<?php echo esc_url( $dynamic_more_url ); ?>" class="bloque-ji-news-more-link">
                <span>Ver todas las noticias</span>
                <span class="material-symbols-outlined">arrow_right_alt</span>
            </a>
        </div>

        <!-- Grid de Contenido -->
        <div class="bloque-ji-news-grid">
            
            <!-- Noticia Principal (Izquierda) -->
            <article class="bloque-ji-news-main-card">
                <a href="<?php echo esc_url( $main_news_data['url'] ); ?>" class="bloque-ji-news-main-img-wrapper">
                    <img src="<?php echo esc_url( $main_news_data['img']['url'] ); ?>" alt="<?php echo esc_attr( $main_news_data['title'] ); ?>" class="bloque-ji-news-main-img" />
                </a>
                <div class="bloque-ji-news-main-content">
                    <span class="bloque-ji-news-card-tag">DESTACADO</span>
                    <h3 class="bloque-ji-news-main-title-text">
                        <a href="<?php echo esc_url( $main_news_data['url'] ); ?>"><?php echo esc_html( $main_news_data['title'] ); ?></a>
                    </h3>
                    <p class="bloque-ji-news-main-desc-text"><?php echo esc_html( $main_news_data['desc'] ); ?></p>
                    <a href="<?php echo esc_url( $main_news_data['url'] ); ?>" class="bloque-ji-news-read-more">
                        <span>LEER MÁS</span>
                        <span class="material-symbols-outlined">chevron_right</span>
                    </a>
                </div>
            </article>

            <!-- Lista de Noticias Laterales (Derecha) -->
            <div class="bloque-ji-news-sidebar-list">
                <?php foreach ( $sidebar_news_data as $news_item ) : 
                    $news_title = isset( $news_item['title'] ) ? $news_item['title'] : '';
                    $news_desc  = isset( $news_item['desc'] ) ? $news_item['desc'] : '';
                    $news_url   = isset( $news_item['url'] ) ? $news_item['url'] : '#';
                    $news_img   = isset( $news_item['img']['url'] ) ? $news_item['img']['url'] : $skeleton_img;

                    // Evitar filas vacías
                    if ( empty( $news_title ) && empty( $news_desc ) ) continue;
                    ?>
                    <article class="bloque-ji-news-sidebar-card">
                        <a href="<?php echo esc_url( $news_url ); ?>" class="bloque-ji-news-sidebar-img-wrapper">
                            <img src="<?php echo esc_url( $news_img ); ?>" alt="<?php echo esc_attr( $news_title ); ?>" class="bloque-ji-news-sidebar-img" />
                        </a>
                        <div class="bloque-ji-news-sidebar-content">
                            <h4 class="bloque-ji-news-sidebar-title-text">
                                <a href="<?php echo esc_url( $news_url ); ?>"><?php echo esc_html( $news_title ); ?></a>
                            </h4>
                            <p class="bloque-ji-news-sidebar-desc-text"><?php echo esc_html( $news_desc ); ?></p>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>

        </div>
    </div>
</section>
