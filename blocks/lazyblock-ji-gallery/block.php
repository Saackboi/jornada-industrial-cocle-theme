<?php
/**
 * ╔═══════════════════════════════════════════╗
 * ║  BLOCK VIEW: JI - Galería Dinámica       ║
 * ║  Image gallery with marquee and lightbox  ║
 * ╚═══════════════════════════════════════════╝
 */

// Variable extraction
$titulo = isset( $attributes['titulo'] ) ? $attributes['titulo'] : 'Visión del Evento';
$images = isset( $attributes['images'] ) && is_array( $attributes['images'] ) ? $attributes['images'] : array();

// Fallback con imágenes por defecto de alta calidad si está vacío
if ( empty( $images ) ) {
    $images = array(
        array( 'img' => array( 'url' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBwyLVd_QuBn8HpihInNIVIC9w3s90YYiyvbxBQJgL8Xi-7hnIQtls2ApQY2yO8cHMyRFwP-NcgxzIhsbHvZ-jpFAbr19ylr6-kgDqZHmQgxZxqyd6QizU4VRD57O0SFA3nkIinduvmKnoP63acqQv4RQe__ozGDFRbgnA-upI8Lxirz5pXaguWdP96dZ3mwoLWfev9rzWOHBvMkHK_tfPaVno-rmQ6sjrKCgxe9iXfHtv6RmU6aJhIgysjiRHj3CYVuG7PmOa_rIg' ) ),
        array( 'img' => array( 'url' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBwyLVd_QuBn8HpihInNIVIC9w3s90YYiyvbxBQJgL8Xi-7hnIQtls2ApQY2yO8cHMyRFwP-NcgxzIhsbHvZ-jpFAbr19ylr6-kgDqZHmQgxZxqyd6QizU4VRD57O0SFA3nkIinduvmKnoP63acqQv4RQe__ozGDFRbgnA-upI8Lxirz5pXaguWdP96dZ3mwoLWfev9rzWOHBvMkHK_tfPaVno-rmQ6sjrKCgxe9iXfHtv6RmU6aJhIgysjiRHj3CYVuG7PmOa_rIg' ) ),
        array( 'img' => array( 'url' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBwyLVd_QuBn8HpihInNIVIC9w3s90YYiyvbxBQJgL8Xi-7hnIQtls2ApQY2yO8cHMyRFwP-NcgxzIhsbHvZ-jpFAbr19ylr6-kgDqZHmQgxZxqyd6QizU4VRD57O0SFA3nkIinduvmKnoP63acqQv4RQe__ozGDFRbgnA-upI8Lxirz5pXaguWdP96dZ3mwoLWfev9rzWOHBvMkHK_tfPaVno-rmQ6sjrKCgxe9iXfHtv6RmU6aJhIgysjiRHj3CYVuG7PmOa_rIg' ) ),
        array( 'img' => array( 'url' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBwyLVd_QuBn8HpihInNIVIC9w3s90YYiyvbxBQJgL8Xi-7hnIQtls2ApQY2yO8cHMyRFwP-NcgxzIhsbHvZ-jpFAbr19ylr6-kgDqZHmQgxZxqyd6QizU4VRD57O0SFA3nkIinduvmKnoP63acqQv4RQe__ozGDFRbgnA-upI8Lxirz5pXaguWdP96dZ3mwoLWfev9rzWOHBvMkHK_tfPaVno-rmQ6sjrKCgxe9iXfHtv6RmU6aJhIgysjiRHj3CYVuG7PmOa_rIg' ) )
    );
}

// Clases base del bloque
$clases = 'bloque-ji-gallery';
if ( isset( $attributes['align'] ) && ! empty( $attributes['align'] ) ) {
    $clases .= ' align' . $attributes['align'];
}
if ( isset( $attributes['className'] ) && ! empty( $attributes['className'] ) ) {
    $clases .= ' ' . $attributes['className'];
}
?>

<div class="<?php echo esc_attr( $clases ); ?>">
    <div class="bloque-ji-gallery-layout">
        <?php if ( $titulo ) : ?>
            <h2 class="bloque-ji-gallery-title"><?php echo esc_html( $titulo ); ?></h2>
        <?php endif; ?>
    </div>

    <!-- Contenedor Marquee para el Scroll Infinito -->
    <div class="bloque-ji-gallery-marquee">
        <div class="bloque-ji-gallery-track">
            <!-- Primera vuelta -->
            <?php foreach ( $images as $image ) : 
                $img_url = isset( $image['img'] ) ? ji_get_block_image_url( $image['img'] ) : '';
                if ( empty( $img_url ) ) continue;
                ?>
                <div class="bloque-ji-gallery-item">
                    <img src="<?php echo esc_url( $img_url ); ?>" alt="Imagen de Galería" class="bloque-ji-gallery-img" />
                </div>
            <?php endforeach; ?>

            <!-- Segunda vuelta para bucle infinito continuo -->
            <?php foreach ( $images as $image ) : 
                $img_url = isset( $image['img'] ) ? ji_get_block_image_url( $image['img'] ) : '';
                if ( empty( $img_url ) ) continue;
                ?>
                <div class="bloque-ji-gallery-item">
                    <img src="<?php echo esc_url( $img_url ); ?>" alt="Imagen de Galería Copia" class="bloque-ji-gallery-img" />
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<script>
(function() {
    function initGalleries() {
        const galleries = document.querySelectorAll('.bloque-ji-gallery');
        galleries.forEach(function(gallery) {
            if (gallery.dataset.initialized) return;
            gallery.dataset.initialized = 'true';

            const marquee = gallery.querySelector('.bloque-ji-gallery-marquee');
            const track = gallery.querySelector('.bloque-ji-gallery-track');
            if (!marquee || !track) return;

            let isDown = false;
            let startX;
            let startPageX;
            let startPageY;
            let wasDragged = false;
            let isHovered = false;
            let currentX = 0;
            const speed = 0.8; // pixels per frame

            // Calculate half width of track
            let halfWidth = track.scrollWidth / 2;
            
            // Recalculate halfWidth on resize
            window.addEventListener('resize', function() {
                halfWidth = track.scrollWidth / 2;
            });

            // Auto-scroll loop
            function updateScroll() {
                if (!isDown && !isHovered) {
                    currentX -= speed;
                    if (currentX <= -halfWidth) {
                        currentX += halfWidth;
                    }
                    track.style.transform = 'translate3d(' + currentX + 'px, 0, 0)';
                }
                requestAnimationFrame(updateScroll);
            }
            requestAnimationFrame(updateScroll);

            // Hover handlers for items
            const items = gallery.querySelectorAll('.bloque-ji-gallery-item');
            items.forEach(function(item) {
                item.addEventListener('mouseenter', function() {
                    isHovered = true;
                });
                item.addEventListener('mouseleave', function() {
                    isHovered = false;
                });

                // Lightbox Click Handler
                item.addEventListener('click', function(e) {
                    e.preventDefault();
                    if (wasDragged) {
                        return; // Prevent opening if it was a drag gesture
                    }
                    const img = item.querySelector('.bloque-ji-gallery-img');
                    if (img) {
                        openLightbox(img.src);
                    }
                });
            });

            // Drag / Swipe handlers
            marquee.addEventListener('mousedown', function(e) {
                isDown = true;
                wasDragged = false;
                marquee.classList.add('active');
                startX = e.pageX - currentX;
                startPageX = e.pageX;
                startPageY = e.pageY;
            });

            marquee.addEventListener('mouseleave', function() {
                isDown = false;
                marquee.classList.remove('active');
            });

            marquee.addEventListener('mouseup', function() {
                isDown = false;
                marquee.classList.remove('active');
                setTimeout(function() {
                    wasDragged = false;
                }, 50);
            });

            marquee.addEventListener('mousemove', function(e) {
                if (!isDown) return;
                e.preventDefault();
                
                const deltaX = Math.abs(e.pageX - startPageX);
                const deltaY = Math.abs(e.pageY - startPageY);
                if (deltaX > 5 || deltaY > 5) {
                    wasDragged = true;
                }

                const x = e.pageX - startX;
                currentX = x;
                
                // Wrap around
                if (currentX > 0) {
                    currentX -= halfWidth;
                } else if (currentX < -halfWidth) {
                    currentX += halfWidth;
                }
                
                track.style.transform = 'translate3d(' + currentX + 'px, 0, 0)';
            });

            // Touch events for mobile
            marquee.addEventListener('touchstart', function(e) {
                isDown = true;
                wasDragged = false;
                startX = e.touches[0].pageX - currentX;
                startPageX = e.touches[0].pageX;
                startPageY = e.touches[0].pageY;
            });

            marquee.addEventListener('touchend', function() {
                isDown = false;
                setTimeout(function() {
                    wasDragged = false;
                }, 50);
            });

            marquee.addEventListener('touchmove', function(e) {
                if (!isDown) return;
                
                const deltaX = Math.abs(e.touches[0].pageX - startPageX);
                const deltaY = Math.abs(e.touches[0].pageY - startPageY);
                if (deltaX > 5 || deltaY > 5) {
                    wasDragged = true;
                }

                const x = e.touches[0].pageX - startX;
                currentX = x;
                
                if (currentX > 0) {
                    currentX -= halfWidth;
                } else if (currentX < -halfWidth) {
                    currentX += halfWidth;
                }
                
                track.style.transform = 'translate3d(' + currentX + 'px, 0, 0)';
            });
        });
    }

    // Lightbox Functionality
    function openLightbox(src) {
        let lightbox = document.getElementById('ji-gallery-lightbox');
        if (!lightbox) {
            lightbox = document.createElement('div');
            lightbox.id = 'ji-gallery-lightbox';
            lightbox.innerHTML = `
                <div class="ji-lightbox-overlay"></div>
                <div class="ji-lightbox-content">
                    <img class="ji-lightbox-img" src="" alt="Ampliada" />
                    <button class="ji-lightbox-close" aria-label="Cerrar">&times;</button>
                </div>
            `;
            document.body.appendChild(lightbox);

            // Add lightbox styles dynamically
            const style = document.createElement('style');
            style.textContent = `
                #ji-gallery-lightbox {
                    position: fixed;
                    top: 0;
                    left: 0;
                    width: 100vw;
                    height: 100vh;
                    z-index: 999999;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    opacity: 0;
                    pointer-events: none;
                    transition: opacity 0.3s ease;
                }
                #ji-gallery-lightbox.active {
                    opacity: 1;
                    pointer-events: auto;
                }
                .ji-lightbox-overlay {
                    position: absolute;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    background: rgba(10, 25, 47, 0.9);
                    backdrop-filter: blur(5px);
                }
                .ji-lightbox-content {
                    position: relative;
                    max-width: 90%;
                    max-height: 90%;
                    z-index: 10;
                    transform: scale(0.9);
                    transition: transform 0.3s ease;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                }
                #ji-gallery-lightbox.active .ji-lightbox-content {
                    transform: scale(1);
                }
                .ji-lightbox-img {
                    max-width: 100%;
                    max-height: 90vh;
                    object-fit: contain;
                    border: 4px solid #ffffff;
                    box-shadow: 0 20px 40px rgba(0,0,0,0.5);
                }
                .ji-lightbox-close {
                    position: absolute;
                    top: -40px;
                    right: 0;
                    background: none;
                    border: none;
                    color: #ffffff;
                    font-size: 36px;
                    cursor: pointer;
                    line-height: 1;
                    padding: 0;
                    transition: color 0.2s ease;
                }
                .ji-lightbox-close:hover {
                    color: #c19a5b;
                }
            `;
            document.head.appendChild(style);

            // Close events
            lightbox.querySelector('.ji-lightbox-close').addEventListener('click', closeLightbox);
            lightbox.querySelector('.ji-lightbox-overlay').addEventListener('click', closeLightbox);
        }

        const img = lightbox.querySelector('.ji-lightbox-img');
        img.src = src;
        lightbox.classList.add('active');
        document.body.style.overflow = 'hidden'; // Disable page scrolling
    }

    function closeLightbox() {
        const lightbox = document.getElementById('ji-gallery-lightbox');
        if (lightbox) {
            lightbox.classList.remove('active');
            document.body.style.overflow = ''; // Restore page scrolling
        }
    }

    // Run init
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initGalleries);
    } else {
        initGalleries();
    }
    window.addEventListener('load', initGalleries);
    setInterval(initGalleries, 1000);
})();
</script>
