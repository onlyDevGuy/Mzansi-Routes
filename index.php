<?php require_once 'includes/header.php'; ?>
<?php require_once 'includes/nav.php'; ?>

<main id="main">

    <!-- ============ 1. HERO ============
         Full-width photo with a dark gradient on top so the white text stays
         readable. The photo is set in css/style.css (.hero-bg).
         🖼️ IMAGE: images/hero-table-mountain.jpg — Table Mountain panorama
         (1376×768 from Stitch). A wider photo (2400px+) would look sharper on
         large screens. -->
    <section class="hero">
        <div class="hero-bg" aria-hidden="true"></div>
        <div class="container hero-content">
            <p class="pill pill--glass">
                <?php icon('travel_explore'); ?><?php t('hero_pill'); ?>
            </p>
            <h1 class="hero-title"><?php t('discover'); ?></h1>
            <p class="hero-tagline"><?php t('tagline'); ?></p>
            <p class="hero-text"><?php t('hero_text'); ?></p>

            <div class="hero-actions">
                <a class="btn btn-primary btn-lg" href="destinations.php">
                    <?php t('explore'); ?><?php icon('arrow_forward'); ?>
                </a>
                <a class="btn btn-glass btn-lg" href="contact.php">
                    <?php icon('route'); ?><?php t('plan_journey'); ?>
                </a>
            </div>

            <!-- Quick stats strip -->
            <ul class="stats-strip">
                <li><strong>9</strong><span><?php t('stat_provinces'); ?></span></li>
                <li><strong>11</strong><span><?php t('stat_languages'); ?></span></li>
                <li><strong>300+</strong><span><?php t('stat_guides'); ?></span></li>
                <li><strong>2</strong><span><?php t('stat_unesco'); ?></span></li>
            </ul>
        </div>
    </section>

    <!-- ============ 2. WELCOME + 3 CULTURAL PILLARS ============ -->
    <section class="section section--surface">
        <div class="container text-center">
            <!-- Little flag-coloured bars above the heading -->
            <div class="eyebrow eyebrow--flag">
                <span class="flag-bars" aria-hidden="true"><i></i><i></i><i></i><i></i></span>
                <?php t('welcome_eyebrow'); ?>
            </div>
            <h2 class="section-title"><?php t('welcome'); ?></h2>
            <p class="section-lead"><?php t('welcome_text'); ?></p>

            <div class="grid grid-3 pillars">
                <?php
                // icon, translation prefix, destinations filter it links to
                $pillars = [
                    ['diversity_3', 'pillar1', 'cultural'],
                    ['pets',        'pillar2', 'wildlife'],
                    ['surfing',     'pillar3', 'coastal'],
                ];
                foreach ($pillars as list($pillar_icon, $key, $filter)): ?>
                    <article class="card pillar-card">
                        <div class="icon-tile"><?php icon($pillar_icon); ?></div>
                        <p class="card-eyebrow"><?php t($key . '_eyebrow'); ?></p>
                        <h3 class="card-title"><?php t($key . '_title'); ?></h3>
                        <p class="card-text"><?php t($key . '_text'); ?></p>
                        <a class="text-link" href="destinations.php?filter=<?php echo $filter; ?>">
                            <?php t($key . '_link'); ?><?php icon('arrow_forward'); ?>
                        </a>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- ============ 3. FEATURED HIGHLIGHTS (3 destination cards) ============ -->
    <section class="section section--tint">
        <div class="container">
            <div class="section-head">
                <div>
                    <p class="eyebrow"><?php t('featured_eyebrow'); ?></p>
                    <h2 class="section-title"><?php t('featured_title'); ?></h2>
                    <p class="section-sub"><?php t('featured_text'); ?></p>
                </div>
                <a class="text-link" href="destinations.php"><?php t('featured_all'); ?><?php icon('east'); ?></a>
            </div>

            <?php
            /* 🖼️ IMAGES: images/featured-kruger.jpg, featured-cape-winelands.jpg,
               featured-drakensberg.jpg (from Stitch). Each card links to the
               matching card on the Destinations page. */
            $featured = [
                ['key' => 'feat1', 'img' => 'featured-kruger.jpg',         'alt' => 'A male lion resting in golden grass in Kruger National Park',          'icon' => 'eco',      'badge' => 'badge--green', 'rating' => '4.9',  'reviews' => 420, 'link' => 'kruger'],
                ['key' => 'feat2', 'img' => 'featured-cape-winelands.jpg', 'alt' => 'Cape Dutch vineyards surrounded by mountains in the Cape Winelands', 'icon' => 'wine_bar', 'badge' => 'badge--gold',  'rating' => '4.95', 'reviews' => 580, 'link' => 'cape-town'],
                ['key' => 'feat3', 'img' => 'featured-drakensberg.jpg',    'alt' => 'The misty green cliffs of the Drakensberg Amphitheatre',            'icon' => 'hiking',   'badge' => 'badge--blue',  'rating' => '4.88', 'reviews' => 310, 'link' => 'drakensberg'],
            ];
            ?>
            <div class="grid grid-3">
                <?php foreach ($featured as $f): ?>
                    <article class="card media-card">
                        <div class="media-card-img">
                            <img src="images/<?php echo $f['img']; ?>" alt="<?php echo $f['alt']; ?>" loading="lazy" width="800" height="450">
                            <span class="badge <?php echo $f['badge']; ?> media-badge-tl"><?php icon($f['icon']); ?><?php t($f['key'] . '_badge'); ?></span>
                            <button class="wishlist-btn" type="button" aria-pressed="false"
                                    aria-label="<?php echo tr('save_wishlist') . ': ' . tr($f['key'] . '_title'); ?>">
                                <?php icon('favorite'); ?>
                            </button>
                            <span class="rating-chip">
                                <?php icon('star', 'icon--filled'); ?>
                                <?php echo $f['rating']; ?> (<?php echo $f['reviews'] . ' ' . tr('reviews'); ?>)
                            </span>
                        </div>
                        <div class="media-card-body">
                            <p class="card-meta"><?php icon('location_on'); ?><?php t($f['key'] . '_region'); ?></p>
                            <h3 class="card-title"><?php t($f['key'] . '_title'); ?></h3>
                            <p class="card-text clamp-2"><?php t($f['key'] . '_text'); ?></p>
                            <div class="media-card-foot">
                                <div>
                                    <span class="card-meta-label"><?php t('recommended'); ?></span>
                                    <span class="card-days"><?php t($f['key'] . '_days'); ?></span>
                                </div>
                                <a class="btn btn-soft btn-sm" href="destinations.php#<?php echo $f['link']; ?>">
                                    <?php t('view_route'); ?><?php icon('arrow_forward'); ?>
                                </a>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- ============ 4. VIDEO — "Mzansi in Motion" ============
         📹 VIDEO NEEDED: set $youtube_video_id in includes/config.php.
         Until then a placeholder panel is shown in the same spot. -->
    <section class="section section--surface">
        <div class="container video-layout">
            <div class="video-copy">
                <p class="eyebrow"><?php t('video_eyebrow'); ?></p>
                <h2 class="section-title"><?php t('video_title'); ?></h2>
                <p class="section-sub"><?php t('video_text'); ?></p>
            </div>
            <div class="video-frame">
                <?php if ($youtube_video_id !== ''): ?>
                    <!-- youtube-nocookie.com = YouTube's privacy-friendly embed -->
                    <iframe src="https://www.youtube.com/embed/DHItTpJaDno?si=PMkR2syxhB4zj4X3<?php echo htmlspecialchars($youtube_video_id); ?>"
                            title="<?php t('video_iframe_title'); ?>"
                            loading="lazy"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>
                <?php else: ?>
                    <div class="video-placeholder">
                        <?php icon('smart_display'); ?>
                        <span><?php t('video_placeholder'); ?></span>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- ============ 5. UBUNTU QUOTE + TRAVEL STARTER KIT ============ -->
    <section class="section ubuntu-banner">
        <div class="container container--narrow text-center">
            <div class="ubuntu-icon"><?php icon('handshake'); ?></div>
            <blockquote class="ubuntu-quote"><?php t('ubuntu_quote'); ?></blockquote>
            <p class="ubuntu-caption"><?php t('ubuntu_caption'); ?></p>

            <div class="card starter-kit">
                <div class="starter-kit-info">
                    <div class="icon-tile icon-tile--solid"><?php icon('menu_book'); ?></div>
                    <div>
                        <h3 class="card-title"><?php t('kit_title'); ?></h3>
                        <p class="card-text"><?php t('kit_text'); ?></p>
                    </div>
                </div>
                <!-- Opens the pop-up below (handled in js/script.js) -->
                <button class="btn btn-green" type="button" data-open-modal="starter-kit-modal">
                    <?php t('kit_button'); ?><?php icon('download'); ?>
                </button>
            </div>
        </div>
    </section>

    <!-- Starter-kit pop-up. <dialog> is a built-in HTML pop-up that handles
         focus and the Esc key for us. -->
    <dialog class="modal" id="starter-kit-modal" aria-labelledby="kit-modal-title">
        <button class="modal-close" type="button" data-close-modal aria-label="<?php t('close'); ?>"><?php icon('close'); ?></button>
        <div class="icon-tile icon-tile--solid"><?php icon('menu_book'); ?></div>
        <h2 class="modal-title" id="kit-modal-title"><?php t('kit_modal_title'); ?></h2>
        <p class="card-text"><?php t('kit_modal_text'); ?></p>

        <!-- TODO (PHP developer): save the email to a mailing list. -->
        <form class="modal-form" data-starter-kit novalidate>
            <label class="field-label" for="kit-email"><?php t('form_email'); ?></label>
            <input class="input" type="email" id="kit-email" name="email" autocomplete="email"
                   placeholder="<?php t('form_email_ph'); ?>" aria-describedby="kit-status">
            <label class="checkbox">
                <input type="checkbox" name="consent">
                <span><?php t('footer_consent'); ?></span>
            </label>
            <p class="form-status" id="kit-status" role="status"
               data-error="<?php t('footer_news_error'); ?>"></p>
            <button class="btn btn-primary btn-block" type="submit"><?php t('kit_modal_submit'); ?></button>
        </form>

        <!-- Shown after a valid email is entered.
             📄 FILE NEEDED: put the PDF at docs/mzansi-routes-starter-kit-2026.pdf -->
        <div class="modal-success" hidden>
            <p class="alert alert--success"><?php icon('check_circle'); ?><?php t('kit_modal_success'); ?></p>
            <a class="btn btn-green btn-block" href="docs/mzansi-routes-starter-kit-2026.pdf" download>
                <?php icon('download'); ?><?php t('kit_modal_download'); ?>
            </a>
        </div>
    </dialog>

</main>

<?php require_once 'includes/footer.php'; ?>
