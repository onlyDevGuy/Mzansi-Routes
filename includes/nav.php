<?php
/* Main menu items: page file name => translation key.
   Add a page here and it appears in the menu (desktop and mobile). */
$nav_items = [
    'index'        => 'home',
    'destinations' => 'destinations',
    'about'        => 'about',
    'contact'      => 'contact',
    'style-guide'  => 'style_guide',
];
?>
<!-- ===================== SITE HEADER (sticky) ===================== -->
<header class="site-header">
    <div class="container header-inner">

        <!-- Brand: logo emblem + name + tagline -->
        <a class="brand" href="index.php">
            <img class="brand-logo" src="images/logo.png" alt="" width="40" height="40">
            <span class="brand-text">
                <span class="brand-name"><?php echo $site_name; ?></span>
                <span class="brand-tagline"><?php t('tagline'); ?></span>
            </span>
        </a>

        <!-- Main navigation. On small screens this becomes a drop-down
             panel, opened by the menu button below (see js/script.js). -->
        <nav class="main-nav" id="main-nav" aria-label="Main">
            <ul class="nav-list">
                <?php foreach ($nav_items as $page => $key): ?>
                    <li>
                        <a class="nav-link<?php echo $current_page === $page ? ' is-active' : ''; ?>"
                           href="<?php echo $page; ?>.php"
                           <?php echo $current_page === $page ? 'aria-current="page"' : ''; ?>>
                            <?php t($key); ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </nav>

        <div class="header-actions">
            <!-- Bilingual switcher (EN / AF). Links reload the page in the
                 chosen language; config.php remembers it in a cookie. -->
            <div class="lang-switch" role="group" aria-label="<?php t('choose_language'); ?>">
                <a href="<?php echo lang_url('en'); ?>" hreflang="en" lang="en"
                   class="lang-option<?php echo $lang === 'en' ? ' is-active' : ''; ?>"
                   aria-label="<?php t('lang_en_label'); ?>"
                   <?php echo $lang === 'en' ? 'aria-current="true"' : ''; ?>>EN</a>
                <a href="<?php echo lang_url('af'); ?>" hreflang="af" lang="af"
                   class="lang-option<?php echo $lang === 'af' ? ' is-active' : ''; ?>"
                   aria-label="<?php t('lang_af_label'); ?>"
                   <?php echo $lang === 'af' ? 'aria-current="true"' : ''; ?>>AF</a>
            </div>

            <a class="btn btn-primary btn-sm header-cta" href="destinations.php">
                <?php icon('explore'); ?><?php t('explore_now'); ?>
            </a>

            <!-- Hamburger button: only visible on mobile / tablet -->
            <button class="menu-toggle" type="button"
                    aria-controls="main-nav" aria-expanded="false"
                    data-label-open="<?php t('menu_open'); ?>"
                    data-label-close="<?php t('menu_close'); ?>"
                    aria-label="<?php t('menu_open'); ?>">
                <?php icon('menu'); ?>
            </button>
        </div>
    </div>
</header>
