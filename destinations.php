<?php require_once 'includes/header.php'; ?>
<?php require_once 'includes/nav.php'; ?>

<?php
/* ==========================================================================
   Destination data
   The text for each card (name, badge, description, duration, season) is in
   the language files under dest_{key}_... so it can be translated.
   - id         : used for the card's anchor, e.g. destinations.php#kruger
   - category   : one or more of cultural / wildlife / coastal (for filters)
   - days       : rough length in days, used by "Sort by: Duration"
   - rating, reviews : sample numbers for the design — replace with real data
   🖼️ IMAGES: images/destination-*.jpg (from Stitch)
   ========================================================================== */
$destinations = [
    ['id' => 'soweto',        'key' => 'soweto',      'province' => 'prov_gauteng',      'category' => 'cultural',          'unesco' => false, 'rating' => 4.9, 'reviews' => 1240, 'days' => 1,    'season_icon' => 'wb_sunny',    'image' => 'destination-soweto.jpg',              'alt' => 'Vilakazi Street in Soweto with colourful murals and street cafés'],
    ['id' => 'robben-island', 'key' => 'robben',      'province' => 'prov_western_cape', 'category' => 'cultural',          'unesco' => true,  'rating' => 4.8, 'reviews' => 980,  'days' => 0.2,  'season_icon' => 'sailing',     'image' => 'destination-robben-island.jpg',       'alt' => 'Robben Island prison gates with Table Mountain across the bay'],
    ['id' => 'venda',         'key' => 'venda',       'province' => 'prov_limpopo',      'category' => 'cultural',          'unesco' => false, 'rating' => 4.7, 'reviews' => 310,  'days' => 2.5,  'season_icon' => 'nature',      'image' => 'destination-venda.jpg',               'alt' => 'Misty Lake Fundudzi surrounded by green forest in Venda'],
    ['id' => 'lesedi',        'key' => 'lesedi',      'province' => 'prov_gauteng',      'category' => 'cultural',          'unesco' => false, 'rating' => 4.8, 'reviews' => 640,  'days' => 0.5,  'season_icon' => 'festival',    'image' => 'destination-lesedi.jpg',              'alt' => 'Dancers in traditional beadwork performing at Lesedi Cultural Village'],
    ['id' => 'cradle',        'key' => 'cradle',      'province' => 'prov_gauteng',      'category' => 'cultural wildlife', 'unesco' => true,  'rating' => 4.9, 'reviews' => 720,  'days' => 1,    'season_icon' => 'history_edu', 'image' => 'destination-cradle-of-humankind.jpg', 'alt' => 'The Maropeng visitor centre in the grasslands of the Cradle of Humankind'],
    ['id' => 'bo-kaap',       'key' => 'bokaap',      'province' => 'prov_western_cape', 'category' => 'cultural coastal',  'unesco' => false, 'rating' => 4.8, 'reviews' => 860,  'days' => 0.15, 'season_icon' => 'restaurant',  'image' => 'destination-bo-kaap.jpg',             'alt' => 'Brightly painted houses on a cobblestone street in the Bo-Kaap'],
    ['id' => 'cape-town',     'key' => 'capetown',    'province' => 'prov_western_cape', 'category' => 'coastal',           'unesco' => false, 'rating' => 5.0, 'reviews' => 2150, 'days' => 5.5,  'season_icon' => 'wb_sunny',    'image' => 'destination-cape-town.jpg',           'alt' => 'Table Mountain and Camps Bay beach in Cape Town'],
    ['id' => 'kruger',        'key' => 'kruger',      'province' => 'prov_mpumalanga',   'category' => 'wildlife',          'unesco' => false, 'rating' => 5.0, 'reviews' => 1870, 'days' => 4,    'season_icon' => 'visibility',  'image' => 'destination-kruger-national-park.jpg','alt' => 'A lion resting on golden grass at sunrise in Kruger National Park'],
    ['id' => 'drakensberg',   'key' => 'drakensberg', 'province' => 'prov_kzn',          'category' => 'wildlife',          'unesco' => true,  'rating' => 4.9, 'reviews' => 540,  'days' => 3.5,  'season_icon' => 'hiking',      'image' => 'destination-drakensberg.jpg',         'alt' => 'The basalt peaks of the Drakensberg Amphitheatre under a blue sky'],
];

$filters = ['all' => 'filter_all', 'cultural' => 'filter_cultural', 'wildlife' => 'filter_wildlife', 'coastal' => 'filter_coastal', 'unesco' => 'filter_unesco'];
?>

<main id="main">

    <!-- ============ PAGE HEADER: breadcrumb, title, counter, filters ============ -->
    <section class="page-hero page-hero--tint">
        <div class="glow glow--green" aria-hidden="true"></div>
        <div class="glow glow--gold" aria-hidden="true"></div>
        <div class="container">
            <nav class="breadcrumb" aria-label="<?php t('breadcrumb'); ?>">
                <a href="index.php"><?php icon('home'); ?><?php t('home'); ?></a>
                <?php icon('chevron_right'); ?>
                <span aria-current="page"><?php t('destinations'); ?></span>
            </nav>

            <div class="page-hero-row">
                <div>
                    <p class="pill pill--soft"><span class="dot dot--gold" aria-hidden="true"></span><?php t('dest_eyebrow'); ?></p>
                    <h1 class="page-title"><?php t('destinations'); ?></h1>
                    <p class="section-lead text-left"><?php t('dest_intro'); ?></p>
                </div>
                <div class="counter-card">
                    <div class="icon-tile icon-tile--sm"><?php icon('explore'); ?></div>
                    <div>
                        <strong><?php echo count($destinations); ?></strong>
                        <span><?php t('dest_count_label'); ?></span>
                    </div>
                </div>
            </div>

            <!-- Search, category chips and sort. All filtering happens in the
                 browser (js/script.js) — no page reload needed. -->
            <div class="filter-panel" role="search">
                <div class="search-field">
                    <?php icon('search'); ?>
                    <label class="sr-only" for="destination-search"><?php t('search_label'); ?></label>
                    <input class="input" type="search" id="destination-search"
                           placeholder="<?php t('search_placeholder'); ?>" autocomplete="off">
                </div>

                <div class="chip-group" role="group" aria-label="<?php t('filter_label'); ?>">
                    <?php foreach ($filters as $value => $key): ?>
                        <button class="chip<?php echo $value === 'all' ? ' is-active' : ''; ?>" type="button"
                                data-filter="<?php echo $value; ?>"
                                aria-pressed="<?php echo $value === 'all' ? 'true' : 'false'; ?>">
                            <?php t($key); ?><?php echo $value === 'all' ? ' (' . count($destinations) . ')' : ''; ?>
                        </button>
                    <?php endforeach; ?>
                </div>

                <div class="sort-field">
                    <?php icon('sort'); ?>
                    <label class="sr-only" for="sort-select"><?php t('sort_label'); ?></label>
                    <select class="input input--select" id="sort-select">
                        <option value="popularity"><?php t('sort_popularity'); ?></option>
                        <option value="duration"><?php t('sort_duration'); ?></option>
                        <option value="rating"><?php t('sort_rating'); ?></option>
                    </select>
                </div>
            </div>
        </div>
    </section>

    <!-- ============ DESTINATION GRID (3 × 3 on desktop) ============ -->
    <section class="section section--tight">
        <div class="container">
            <!-- Announces "9 destinations shown" etc. to screen readers when filters change -->
            <p class="results-count" id="results-count" aria-live="polite">
                <span data-count><?php echo count($destinations); ?></span> <?php t('results_count'); ?>
            </p>

            <div class="grid grid-3" id="destinations-grid">
                <?php foreach ($destinations as $index => $d):
                    $k = 'dest_' . $d['key']; ?>
                    <article class="card media-card destination-card" id="<?php echo $d['id']; ?>"
                             data-category="<?php echo $d['category']; ?>"
                             data-unesco="<?php echo $d['unesco'] ? 'true' : 'false'; ?>"
                             data-rating="<?php echo $d['rating']; ?>"
                             data-days="<?php echo $d['days']; ?>"
                             data-popularity="<?php echo $index; ?>">
                        <div class="media-card-img media-card-img--fade">
                            <img src="images/<?php echo $d['image']; ?>" alt="<?php echo $d['alt']; ?>"
                                 loading="lazy" width="800" height="450">
                            <div class="badge-row">
                                <span class="badge badge--glass"><?php icon('location_on'); ?><?php t($d['province']); ?></span>
                                <?php if ($d['unesco']): ?>
                                    <span class="badge badge--green"><?php icon('verified'); ?><?php t('unesco'); ?></span>
                                <?php endif; ?>
                            </div>
                            <button class="wishlist-btn" type="button" aria-pressed="false"
                                    aria-label="<?php echo tr('save_wishlist') . ': ' . tr($k . '_name'); ?>">
                                <?php icon('favorite'); ?>
                            </button>
                            <span class="badge badge--gold media-badge-bl"><?php t($k . '_badge'); ?></span>
                        </div>

                        <div class="media-card-body">
                            <div class="card-title-row">
                                <h2 class="card-title"><?php t($k . '_name'); ?></h2>
                                <span class="rating">
                                    <?php icon('star', 'icon--filled'); ?>
                                    <strong><?php echo number_format($d['rating'], 1); ?></strong>
                                    <span class="rating-count">(<?php echo number_format($d['reviews']) . ' ' . tr('reviews'); ?>)</span>
                                </span>
                            </div>
                            <p class="card-text"><?php t($k . '_desc'); ?></p>

                            <div class="card-facts">
                                <span><?php icon('schedule'); ?><?php t($k . '_duration'); ?></span>
                                <span><?php icon($d['season_icon']); ?><?php t($k . '_season'); ?></span>
                            </div>
                            <!-- TODO: link to a detail page for each destination once those pages exist -->
                            <a class="btn btn-soft btn-block" href="#<?php echo $d['id']; ?>">
                                <?php t('explore_guide'); ?><?php icon('arrow_forward'); ?>
                            </a>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>

            <!-- Shown by JavaScript when the search/filter matches nothing -->
            <div class="empty-state" id="no-results" hidden>
                <div class="empty-icon"><?php icon('search_off'); ?></div>
                <h2 class="card-title"><?php t('no_results_title'); ?></h2>
                <p class="card-text"><?php t('no_results_text'); ?></p>
                <button class="btn btn-green" type="button" id="reset-filters"><?php t('no_results_reset'); ?></button>
            </div>
        </div>
    </section>

    <!-- ============ ROAD TRIP CALLOUT ============ -->
    <section class="section section--tint section--tight">
        <div class="container">
            <div class="roadtrip-banner">
                <!-- Decorative topographic circles -->
                <svg class="roadtrip-pattern" viewBox="0 0 100 100" aria-hidden="true">
                    <circle cx="50" cy="50" r="45" stroke-dasharray="4 2"/>
                    <circle cx="50" cy="50" r="35"/>
                    <circle cx="50" cy="50" r="25" stroke-dasharray="2 2"/>
                    <circle cx="50" cy="50" r="15"/>
                </svg>
                <div class="roadtrip-copy">
                    <div class="icon-tile icon-tile--gold icon-tile--lg"><?php icon('alt_route'); ?></div>
                    <div>
                        <p class="eyebrow eyebrow--light"><?php icon('map'); ?><?php t('roadtrip_eyebrow'); ?></p>
                        <h2 class="roadtrip-title"><?php t('roadtrip_title'); ?></h2>
                        <p class="roadtrip-text"><?php t('roadtrip_text'); ?></p>
                        <ul class="route-tags">
                            <li><?php t('roadtrip_garden'); ?></li>
                            <li><?php t('roadtrip_panorama'); ?></li>
                            <li><?php t('roadtrip_r62'); ?></li>
                        </ul>
                    </div>
                </div>
                <div class="roadtrip-actions">
                    <!-- 📄 PAGE NEEDED: road-trip guide page (Garden Route, Panorama Route, Route 62) -->
                    <a class="btn btn-primary" href="#"><?php icon('explore'); ?><?php t('roadtrip_view'); ?></a>
                    <!-- 📄 FILE NEEDED: put the offline map PDF at docs/mzansi-road-trip-maps.pdf -->
                    <a class="btn btn-glass" href="docs/mzansi-road-trip-maps.pdf" download><?php icon('download'); ?><?php t('roadtrip_download'); ?></a>
                </div>
            </div>
        </div>
    </section>

</main>

<?php require_once 'includes/footer.php'; ?>
