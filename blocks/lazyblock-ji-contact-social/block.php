<?php

$section_label = isset( $attributes['section_label'] ) ? $attributes['section_label'] : 'Contacto';
$section_title = isset( $attributes['section_title'] ) ? $attributes['section_title'] : 'Conecta con la Jornada';
$section_desc  = isset( $attributes['section_description'] ) ? $attributes['section_description'] : '';
$contacts      = isset( $attributes['contacts'] ) && is_array( $attributes['contacts'] ) ? $attributes['contacts'] : array();
$social_links  = isset( $attributes['social_links'] ) && is_array( $attributes['social_links'] ) ? $attributes['social_links'] : array();

if ( empty( $contacts ) ) {
    $contacts = array(
        array( 'prefix' => 'Dr.', 'name' => 'Francisco Arango', 'email_user' => 'francisco.arango', 'email_domain' => 'utp.ac.pa', 'phone' => '906-0664 Ext. 1221' ),
        array( 'prefix' => 'Ing.', 'name' => 'Miguel López', 'email_user' => 'miguel.lopez', 'email_domain' => 'utp.ac.pa', 'phone' => '997-9623 Ext. 1236' ),
    );
}

if ( empty( $social_links ) ) {
    $social_links = array(
        array( 'name' => 'Instagram', 'url' => 'https://www.instagram.com/industrialutpcocle' ),
        array( 'name' => 'TikTok', 'url' => 'https://www.tiktok.com/@industrialutpcocle' ),
        array( 'name' => 'Sitio Web', 'url' => 'https://jornadaindustrialcocle.utp.ac.pa' ),
    );
}

$clases = 'bloque-ji-contact-social';
if ( isset( $attributes['align'] ) && ! empty( $attributes['align'] ) ) {
    $clases .= ' align' . $attributes['align'];
}
if ( isset( $attributes['className'] ) && ! empty( $attributes['className'] ) ) {
    $clases .= ' ' . $attributes['className'];
}

$get_social_icon = function( $name ) {
    $key = sanitize_title( $name );

    if ( strpos( $key, 'instagram' ) !== false ) {
        return '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M7.8 2h8.4C19.4 2 22 4.6 22 7.8v8.4c0 3.2-2.6 5.8-5.8 5.8H7.8C4.6 22 2 19.4 2 16.2V7.8C2 4.6 4.6 2 7.8 2Zm-.2 2A3.6 3.6 0 0 0 4 7.6v8.8A3.6 3.6 0 0 0 7.6 20h8.8a3.6 3.6 0 0 0 3.6-3.6V7.6A3.6 3.6 0 0 0 16.4 4H7.6Zm9.65 1.55a1.25 1.25 0 1 1 0 2.5 1.25 1.25 0 0 1 0-2.5ZM12 7a5 5 0 1 1 0 10 5 5 0 0 1 0-10Zm0 2a3 3 0 1 0 0 6 3 3 0 0 0 0-6Z"/></svg>';
    }

    if ( strpos( $key, 'tiktok' ) !== false || strpos( $key, 'tik-tok' ) !== false ) {
        return '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M16.6 2c.3 2.6 1.8 4.2 4.4 4.4v3.1a7.6 7.6 0 0 1-4.3-1.3v6.5c0 4.1-2.5 7.3-6.6 7.3A6.1 6.1 0 0 1 4 15.9c0-3.7 3.1-6.5 6.8-6.1v3.4c-1.6-.5-3.5.6-3.5 2.5 0 1.5 1.1 2.7 2.7 2.7 1.7 0 2.8-1 2.8-3.4V2h3.8Z"/></svg>';
    }

    if ( strpos( $key, 'linkedin' ) !== false ) {
        return '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M4.98 3.5C4.98 4.9 3.9 6 2.5 6S0 4.9 0 3.5 1.1 1 2.5 1s2.48 1.1 2.48 2.5ZM.3 8h4.4v15H.3V8Zm7.4 0h4.2v2h.1c.6-1.1 2-2.3 4.1-2.3 4.4 0 5.2 2.9 5.2 6.7V23h-4.4v-7.6c0-1.8 0-4.1-2.5-4.1s-2.9 2-2.9 4V23H7.7V8Z"/></svg>';
    }

    if ( strpos( $key, 'facebook' ) !== false ) {
        return '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M22 12a10 10 0 1 0-11.6 9.9v-7h-2.5V12h2.5V9.8c0-2.5 1.5-3.9 3.8-3.9 1.1 0 2.2.2 2.2.2v2.4h-1.2c-1.2 0-1.6.8-1.6 1.6V12h2.7l-.4 2.9h-2.3v7A10 10 0 0 0 22 12Z"/></svg>';
    }

    return '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 2a10 10 0 1 0 0 20 10 10 0 0 0 0-20Zm6.9 9h-3.1a15 15 0 0 0-1.1-5A8.03 8.03 0 0 1 18.9 11ZM12 4.1c.8 1.1 1.5 3.1 1.8 6.9h-3.6c.3-3.8 1-5.8 1.8-6.9ZM4.3 13h3.9c.1 2 .4 3.7.9 5A8 8 0 0 1 4.3 13Zm3.9-2H4.3a8 8 0 0 1 4.8-5 18 18 0 0 0-.9 5Zm3.8 8.9c-.8-1.1-1.5-3.1-1.8-6.9h3.6c-.3 3.8-1 5.8-1.8 6.9Zm2.7-1.9c.5-1.3.8-3 .9-5h3.1a8 8 0 0 1-4 5Z"/></svg>';
};
?>

<div class="<?php echo esc_attr( $clases ); ?>">
    <div class="bloque-ji-contact-social-layout">
        <?php if ( $section_label ) : ?>
            <div class="bloque-ji-contact-social-label"><?php echo esc_html( $section_label ); ?></div>
        <?php endif; ?>

        <?php if ( $section_title ) : ?>
            <h2 class="bloque-ji-contact-social-title"><?php echo esc_html( $section_title ); ?></h2>
        <?php endif; ?>

        <?php if ( $section_desc ) : ?>
            <p class="bloque-ji-contact-social-desc"><?php echo esc_html( $section_desc ); ?></p>
        <?php endif; ?>
    </div>

    <div class="bloque-ji-contact-social-grid">
        <div class="bloque-ji-contact-social-contacts">
            <?php foreach ( $contacts as $contact ) :
                $prefix      = isset( $contact['prefix'] ) ? $contact['prefix'] : '';
                $name        = isset( $contact['name'] ) ? $contact['name'] : 'Contacto';
                $email_user  = isset( $contact['email_user'] ) ? $contact['email_user'] : '';
                $email_domain = isset( $contact['email_domain'] ) ? $contact['email_domain'] : '';
                $phone       = isset( $contact['phone'] ) ? $contact['phone'] : '';
                $email_id    = 'ji-email-' . sanitize_html_class( $name . '-' . $prefix );
                $full_name   = trim( ( $prefix ? $prefix . ' ' : '' ) . $name );
            ?>
                <div class="bloque-ji-contact-social-card">
                    <div class="bloque-ji-contact-social-card-name"><?php echo esc_html( $full_name ); ?></div>

                    <?php if ( $email_user && $email_domain ) : ?>
                        <div class="bloque-ji-contact-social-email" data-user="<?php echo esc_attr( $email_user ); ?>" data-domain="<?php echo esc_attr( $email_domain ); ?>" id="<?php echo esc_attr( $email_id ); ?>">
                            <button class="bloque-ji-contact-social-email-btn" onclick="jiRevealEmail(this)">
                                <span class="material-symbols-outlined">mail</span>
                                Ver correo
                            </button>
                        </div>
                    <?php endif; ?>

                    <?php if ( $phone ) : ?>
                        <a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9]/', '', $phone ) ); ?>" class="bloque-ji-contact-social-phone">
                            <span class="material-symbols-outlined">call</span>
                            <?php echo esc_html( $phone ); ?>
                        </a>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="bloque-ji-contact-social-links">
            <?php foreach ( $social_links as $social ) :
                $name        = isset( $social['name'] ) ? $social['name'] : 'Red Social';
                $url         = isset( $social['url'] ) ? $social['url'] : '#';
                $social_key  = sanitize_title( $name );
            ?>
                <a href="<?php echo esc_url( $url ); ?>" target="_blank" rel="noopener noreferrer" class="bloque-ji-contact-social-link-card is-<?php echo esc_attr( $social_key ); ?>" aria-label="<?php echo esc_attr( $name ); ?>">
                    <span class="bloque-ji-contact-social-link-icon"><?php echo $get_social_icon( $name ); ?></span>
                    <span class="bloque-ji-contact-social-link-name"><?php echo esc_html( $name ); ?></span>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<script>
function jiRevealEmail(btn) {
    var el = btn.closest('.bloque-ji-contact-social-email');
    var user = el.getAttribute('data-user');
    var domain = el.getAttribute('data-domain');
    var email = user + '@' + domain;
    el.innerHTML = '<a href="mailto:' + email + '" class="bloque-ji-contact-social-email-link"><span class="material-symbols-outlined">mail</span>' + email + '</a>';
}
</script>
