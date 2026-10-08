<!-- ===================== SITE FOOTER ===================== -->
<footer class="site-footer">
    <div class="container">
        <div class="footer-grid">

            <!-- Column 1: brand, mission & Ubuntu quote -->
            <div class="footer-col">
                <a class="footer-brand" href="index.php">
                    <img src="images/logo.png" alt="" width="40" height="40">
                    <span><?php echo $site_name; ?></span>
                </a>
                <p class="footer-tagline"><?php t('tagline'); ?></p>
                <p class="footer-text"><?php t('footer_mission'); ?></p>
                <blockquote class="footer-quote"><?php t('footer_quote'); ?></blockquote>
            </div>

            <!-- Column 2: quick navigation -->
            <nav class="footer-col" aria-label="<?php t('footer_quick_links'); ?>">
                <h2 class="footer-heading"><?php t('footer_quick_links'); ?></h2>
                <ul class="footer-links">
                    <li><a href="index.php"><?php t('home'); ?></a></li>
                    <li><a href="destinations.php"><?php t('destinations'); ?></a></li>
                    <li><a href="destinations.php?filter=cultural"><?php t('footer_cultural'); ?></a></li>
                    <li><a href="destinations.php?filter=wildlife"><?php t('footer_safari'); ?></a></li>
                    <li><a href="about.php"><?php t('about'); ?></a></li>
                    <li><a href="contact.php"><?php t('contact'); ?></a></li>
                    <li><a href="style-guide.php"><?php t('style_guide'); ?></a></li>
                </ul>
            </nav>

            <!-- Column 3: headquarters contact details -->
            <div class="footer-col">
                <h2 class="footer-heading"><?php t('footer_contact_loc'); ?></h2>
                <ul class="footer-contact">
                    <li><?php icon('location_on'); ?><span><?php t('footer_address'); ?></span></li>
                    <li><?php icon('mail'); ?><a href="mailto:info@mzansiroutes.co.za">info@mzansiroutes.co.za</a></li>
                    <li><?php icon('call'); ?><a href="tel:+27848088701">+27 (0)84 808 8701</a></li>
                    <li><?php icon('schedule'); ?><span><?php t('footer_hours'); ?></span></li>
                </ul>
            </div>

            <!-- Column 4: newsletter + social links -->
            <div class="footer-col">
                <h2 class="footer-heading"><?php t('footer_connected'); ?></h2>
                <p class="footer-text"><?php t('footer_news_text'); ?></p>

                <!-- Newsletter: checked in the browser by js/script.js.
                     TODO (PHP developer): send the address to a mailing list
                     or database — it is not stored anywhere yet. -->
                <form class="newsletter-form" data-newsletter novalidate>
                    <label class="sr-only" for="newsletter-email"><?php t('footer_email_label'); ?></label>
                    <div class="newsletter-row">
                        <input class="input" type="email" id="newsletter-email" name="email"
                               placeholder="<?php t('footer_email_ph'); ?>" autocomplete="email"
                               aria-describedby="newsletter-status">
                        <button class="btn btn-primary" type="submit"><?php icon('send'); ?><?php t('footer_join'); ?></button>
                    </div>
                    <label class="checkbox checkbox--on-dark">
                        <input type="checkbox" name="consent">
                        <span><?php t('footer_consent'); ?></span>
                    </label>
                    <!-- Error / success message is written here by JavaScript.
                         role="status" makes screen readers announce it. -->
                    <p class="form-status" id="newsletter-status" role="status"
                       data-error="<?php t('footer_news_error'); ?>"
                       data-success="<?php t('footer_news_success'); ?>"></p>
                </form>

                <ul class="social-links">
                    <?php foreach ($social_links as $name => $s): ?>
                        <li>
                            <a href="<?php echo $s['url']; ?>" target="_blank" rel="noopener noreferrer"
                               aria-label="<?php t($s['label']); ?>"><?php social_icon($name); ?></a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>

        <!-- Bottom bar: copyright, legal links, accreditation seal -->
        <div class="footer-bottom">
            <p><?php t('footer_rights'); ?></p>
            <div class="footer-legal">
                <!-- 📄 PAGES NEEDED: Privacy Policy and Terms pages do not exist yet -->
                <a href="#"><?php t('footer_privacy'); ?></a>
                <a href="#"><?php t('footer_terms'); ?></a>
                <span class="footer-seal"><?php icon('verified'); ?><?php t('footer_accredited'); ?></span>
            </div>
        </div>
    </div>
</footer>

</body>
</html>
