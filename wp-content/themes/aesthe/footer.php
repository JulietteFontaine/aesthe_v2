<section class="newsletter  wrapper  half">
    <div class="newsletter__main">
        <p class="newsletter__main__smallTitle">Newsletter</p>
        <p>Restons connectés</p>
    </div>
    <div class="newsletter__input">
        <p>En validant votre inscription, vous acceptez qu'aesthé mémorise et utilise votre adresse email dans le but de vous envoyer notre newsletter.</p>
        <?php echo do_shortcode('[activecampaign form=1 css=0]'); ?>
    </div>
</section>

<footer class="footer  wrapper">
    <div class="footer__main">
        <!-- COLONNE 1 -->
        <div>
            <ul>
                <li class="footer__main__tittle"><?php the_field('titre_colonne_1', 'option'); ?></li>
                <?php if (have_rows('footer_colonne_1', 'option')) : ?>
                    <?php while (have_rows('footer_colonne_1', 'option')) : the_row();
                        $link = get_sub_field('lien');
                        if ($link) :
                            $link_url = $link['url'];
                            $link_title = $link['title'];
                            $link_target = $link['target'] ? $link['target'] : '_self';
                    ?>
                            <li>
                                <a href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>"><?php echo esc_html($link_title); ?></a>
                            </li>
                        <?php endif; ?>
                    <?php endwhile; ?>
                <?php endif; ?>
            </ul>
        </div>
        <!-- COLONNE 2 -->
        <div>
            <ul>
                <li><?php the_field('titre_colonne_2', 'option'); ?></li>
                <?php if (have_rows('footer_colonne_2', 'option')) : ?>
                    <?php while (have_rows('footer_colonne_2', 'option')) : the_row();
                        $link = get_sub_field('lien');
                        if ($link) :
                            $link_url = $link['url'];
                            $link_title = $link['title'];
                            $link_target = $link['target'] ? $link['target'] : '_self';
                    ?>
                            <li>
                                <a href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>"><?php echo esc_html($link_title); ?></a>
                            </li>
                        <?php endif; ?>
                    <?php endwhile; ?>
                <?php endif; ?>
            </ul>
        </div>
        <!-- COLONNE 3 -->
        <div>
            <ul>
                <li><?php the_field('titre_colonne_3', 'option'); ?></li>
                <?php if (have_rows('footer_colonne_3', 'option')) : ?>
                    <?php while (have_rows('footer_colonne_3', 'option')) : the_row();
                        $link = get_sub_field('lien');
                        if ($link) :
                            $link_url = $link['url'];
                            $link_title = $link['title'];
                            $link_target = $link['target'] ? $link['target'] : '_self';
                    ?>
                            <li>
                                <a href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>"><?php echo esc_html($link_title); ?></a>
                            </li>
                        <?php endif; ?>
                    <?php endwhile; ?>
                <?php endif; ?>
            </ul>
        </div>
        <!-- COLONNE 4 -->
        <div>
        <ul>
                <li class="colonne_title"><?php the_field('nous_contacter', 'option'); ?></span></li>
                <?php the_field('telephone', 'option'); ?></br>
                <?php the_field('email', 'option'); ?></br>
                <li class="adress"><?php the_field('adresse', 'option'); ?></li>
                <li class="network">
                    <a href="<?= get_field('facebook', 'options') ?>" aria-label="Page aesthé médecine esthétique Facebook" target="_blank" rel="noopener nofollow"><?php include('wp-content/themes/aesthe/assets/img/fb.svg'); ?></a>
                    <a href="<?= get_field('instagram', 'options') ?>" aria-label="Page aesthé médecine esthétique Instagram" target="_blank" rel="noopener nofollow"><?php include('wp-content/themes/aesthe/assets/img/ig.svg'); ?></a>
                    <a href="<?= get_field('linkedin', 'options') ?>" aria-label="Page aesthé médecine esthétique LinkedIn" target="_blank" rel="noopener nofollow"><?php include('wp-content/themes/aesthe/assets/img/li.svg'); ?></a>
                </li>
        </ul>
        </div>

        <div class="footer__legal">
            <div class="svg_aetshe">
            <?php include('wp-content/themes/aesthe/assets/img/logoN.svg'); ?>
            </div>
            <span class="info">
            ©<?= date('Y') ?> aesthé
            <a href="<?= get_bloginfo('url') ?>/confidentialite/">Confidentialité</a>
            <a href="<?= get_bloginfo('url') ?>/legal/">Légal</a>
            </span>
        </div>
    </div>

</footer>

<div class="form-thx">

    <?php
    if (isset($_POST)) {

        if (@$_POST['c_email'] != '') {

            if ($_POST['c_fake'] != '') die(); // recaptcha

            $nom_champ['c_nom'] = 'Nom';
            $nom_champ['c_prenom'] = 'Prénom';
            $nom_champ['c_email'] = 'Email';
            $nom_champ['c_tel'] = 'Téléphone';
            $nom_champ['c_msg'] = 'Message';

            $headers = 'From: no-reply@lesite.com' . "\n";
            $headers .= 'Reply-To: ' . $_POST['c_email'] . "\n";
            $headers .= 'Content-Type: text/html; charset="utf-8"' . "\n";
            $headers .= 'Content-Transfer-Encoding: 8bit';

            $msg = "";
            foreach ($_POST as $key => $value) if ($value != '') $msg .= $nom_champ[htmlspecialchars($key)] . " => " . htmlspecialchars($value) . "<br>";

            $mail = 'Bonjour, un message sur lesite.com<br><br>' . $msg;

            wp_mail('hello@lesite.com', 'lesite.com', $mail, $headers);
            // wp_mail('jean@pamstudio.co', 'lesite.com', $mail, $headers);

            echo "<script>alert('Nous vous remercions et revenons vers vous prochainement !');</script>";
        }
    }
    ?>
</div>

<?php wp_footer(); ?>

<!-- rgpd -->
<script type="text/javascript" src="<?= get_template_directory_uri(); ?>/assets/js/tarteaucitron/tarteaucitron.js"></script>

<script>
    tarteaucitron.init({
        "privacyUrl": "",
        /* Privacy policy url */

        "hashtag": "#tarteaucitron",
        /* Open the panel with this hashtag */
        "cookieName": "tarteaucitron",
        /* Cookie name */
        "orientation": "middle",
        /* Banner position (top - bottom - middle - popup) */

        "groupServices": false,
        /* Group services by category */

        "showAlertSmall": false,
        /* Show the small banner on bottom right */
        "cookieslist": false,
        /* Show the cookie list */

        "showIcon": true,
        /* Show cookie icon to manage cookies */
        // "iconSrc": "", /* Optionnal: URL or base64 encoded image */
        "iconPosition": "BottomRight",
        /* Position of the icon between BottomRight, BottomLeft, TopRight and TopLeft */

        "adblocker": false,
        /* Show a Warning if an adblocker is detected */

        "DenyAllCta": true,
        /* Show the deny all button */
        "AcceptAllCta": true,
        /* Show the accept all button when highPrivacy on */
        "highPrivacy": true,
        /* HIGHLY RECOMMANDED Disable auto consent */

        "handleBrowserDNTRequest": false,
        /* If Do Not Track == 1, disallow all */

        "removeCredit": false,
        /* Remove credit link */
        "moreInfoLink": true,
        /* Show more info link */
        "useExternalCss": false,
        /* If false, the tarteaucitron.css file will be loaded */

        //"cookieDomain": ".my-multisite-domaine.fr", /* Shared cookie for subdomain website */

        "readmoreLink": "",
        /* Change the default readmore link pointing to tarteaucitron.io */

        "mandatory": true /* Show a message about mandatory cookies */
    });
</script>

<!-- ANALYTICS -->
<script type="text/javascript">
    tarteaucitron.user.gajsUa = 'G-JL4CCQQTG4';
    tarteaucitron.user.gajsMore = function() {
        /* add here your optionnal _ga.push() */
    };
    (tarteaucitron.job = tarteaucitron.job || []).push('gajs');
</script>

<!-- Meta Pixel Code -->
<script>
    ! function(f, b, e, v, n, t, s) {
        if (f.fbq) return;
        n = f.fbq = function() {
            n.callMethod ?
                n.callMethod.apply(n, arguments) : n.queue.push(arguments)
        };
        if (!f._fbq) f._fbq = n;
        n.push = n;
        n.loaded = !0;
        n.version = '2.0';
        n.queue = [];
        t = b.createElement(e);
        t.async = !0;
        t.src = v;
        s = b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t, s)
    }(window, document, 'script',
        'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '807331923271916');
    fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=807331923271916&ev=PageView&noscript=1" /></noscript>
<!-- End Meta Pixel Code -->

<!-- GOOGLE TAG MANAGER -->
<!-- <script type="text/javascript">
    tarteaucitron.user.googletagmanagerId = 'GTM-5V3M2D8';
    (tarteaucitron.job = tarteaucitron.job || []).push('googletagmanager');
</script> -->

<!-- end rgpd -->

<!-- Start of aesthe Zendesk Widget script -->
<!-- <script id="ze-snippet" src="https://static.zdassets.com/ekr/snippet.js?key=f2540ec4-431b-4a2f-8b5b-396d1ff466d8"> </script> -->
<!-- End of aesthe Zendesk Widget script -->

<!-- ACTIVECAMPAIGN : Géré plus bas sans tarte au citron -->
<!-- <script type="text/javascript">
    tarteaucitron.user.actid = '225286553';
    (tarteaucitron.job = tarteaucitron.job || []).push('activecampaign');
</script> -->

<!-- activecampaign -->
<script type="text/javascript">
    (function(e, t, o, n, p, r, i) {
        e.visitorGlobalObjectAlias = n;
        e[e.visitorGlobalObjectAlias] = e[e.visitorGlobalObjectAlias] || function() {
            (e[e.visitorGlobalObjectAlias].q = e[e.visitorGlobalObjectAlias].q || []).push(arguments)
        };
        e[e.visitorGlobalObjectAlias].l = (new Date).getTime();
        r = t.createElement("script");
        r.src = o;
        r.async = true;
        i = t.getElementsByTagName("script")[0];
        i.parentNode.insertBefore(r, i)
    })(window, document, "https://diffuser-cdn.app-us1.com/diffuser/diffuser.js", "vgo");
    vgo('setAccount', '225286553');
    vgo('setTrackByDefault', true);
    vgo('process');
</script>

<?php if (is_page('contact')) : ?><script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script><?php endif; ?>
    <!-- <script src="<?= get_template_directory_uri(); ?>/assets/js/code-min.js"></script> -->
<script>
    jQuery('p:empty').remove();
</script>
</body>

</html>