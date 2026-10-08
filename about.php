<?php require_once 'includes/header.php'; ?>
<?php require_once 'includes/nav.php'; ?>

<?php
/* Team members. 🖼️ IMAGES: images/team-1.jpg … team-6.jpg are AI-generated
   placeholder portraits from Stitch — replace them with real team photos
   (square, at least 300×300px). Update the LinkedIn / email links too. */
$team = [
    ['name' => 'Thabo Molefe',        'initials' => 'TM', 'role' => 'lead',    'img' => 'team-1.jpg', 'colour' => 'green'],
    ['name' => 'Zanele Dlamini',      'initials' => 'ZD', 'role' => 'html',    'img' => 'team-2.jpg', 'colour' => 'gold'],
    ['name' => 'Johan van der Merwe', 'initials' => 'JM', 'role' => 'css',     'img' => 'team-3.jpg', 'colour' => 'blue'],
    ['name' => 'Sipho Sithole',       'initials' => 'SS', 'role' => 'js',      'img' => 'team-4.jpg', 'colour' => 'green'],
    ['name' => 'Pieter Steyn',        'initials' => 'PS', 'role' => 'php',     'img' => 'team-5.jpg', 'colour' => 'gold'],
    ['name' => 'Nomvula Khumalo',     'initials' => 'NK', 'role' => 'content', 'img' => 'team-6.jpg', 'colour' => 'blue'],
];

// icon, colour accent — text comes from value1_… to value4_… in the language files
$values = [
    1 => ['handshake', 'green'],
    2 => ['menu_book', 'gold'],
    3 => ['shield',    'blue'],
    4 => ['explore',   'green'],
];
?>

<main id="main">

    <!-- ============ HERO (green with Ndebele-inspired pattern) ============ -->
    <section class="page-hero page-hero--green text-center">
        <!-- Decorative geometric pattern drawn with SVG (no image file needed) -->
        <svg class="pattern-overlay" aria-hidden="true" width="100%" height="100%">
            <defs>
                <pattern id="ndebele-geom" width="120" height="120" patternUnits="userSpaceOnUse">
                    <path d="M0,60 L60,0 L120,60 L60,120 Z" fill="none" stroke="currentColor" stroke-width="4"/>
                    <path d="M30,60 L60,30 L90,60 L60,90 Z" fill="none" stroke="currentColor" stroke-width="3"/>
                    <line x1="0" y1="0" x2="120" y2="120" stroke="currentColor" stroke-width="2"/>
                    <line x1="120" y1="0" x2="0" y2="120" stroke="currentColor" stroke-width="2"/>
                    <circle cx="60" cy="60" r="12" fill="currentColor"/>
                </pattern>
            </defs>
            <rect width="100%" height="100%" fill="url(#ndebele-geom)"/>
        </svg>

        <div class="container">
            <p class="pill pill--gold"><?php icon('diversity_3'); ?><?php t('about_pill'); ?></p>
            <h1 class="hero-title"><?php t('about'); ?></h1>
            <p class="hero-text"><?php t('about_intro'); ?></p>

            <ul class="stats-strip stats-strip--plain">
                <li><strong>9</strong><span><?php t('about_stat_provinces'); ?></span></li>
                <li><strong>150+</strong><span><?php t('about_stat_hosts'); ?></span></li>
                <li><strong>11</strong><span><?php t('about_stat_languages'); ?></span></li>
                <li><strong>100%</strong><span><?php t('about_stat_local'); ?></span></li>
            </ul>
        </div>
    </section>

    <!-- ============ OUR STORY: photo collage + text ============ -->
    <section class="section">
        <div class="container story-layout">
            <!-- 🖼️ IMAGES: images/about-guide.jpg (tall portrait) and
                 images/about-savanna.jpg (square landscape), from Stitch -->
            <div class="story-collage">
                <img class="story-img-main" src="images/about-guide.jpg"
                     alt="A smiling South African tour guide in Xhosa-patterned clothing with Table Mountain behind her"
                     loading="lazy" width="640" height="800">
                <img class="story-img-small" src="images/about-savanna.jpg"
                     alt="Acacia trees on the Kruger savanna at dawn"
                     loading="lazy" width="500" height="500">
                <div class="story-badge">
                    <div class="icon-tile icon-tile--round icon-tile--solid"><?php icon('verified'); ?></div>
                    <div>
                        <span class="story-badge-label"><?php t('story_badge_est'); ?></span>
                        <span class="story-badge-city"><?php t('story_badge_city'); ?></span>
                    </div>
                </div>
            </div>

            <div class="story-copy">
                <p class="eyebrow eyebrow--line"><?php t('story_eyebrow'); ?></p>
                <h2 class="section-title"><?php t('story_title'); ?></h2>
                <p class="story-text"><?php t('story_text'); ?></p>

                <ul class="feature-list">
                    <li class="feature-item">
                        <div class="icon-tile icon-tile--solid"><?php icon('groups'); ?></div>
                        <div>
                            <h3 class="card-title"><?php t('story_point1_title'); ?></h3>
                            <p class="card-text"><?php t('story_point1_text'); ?></p>
                        </div>
                    </li>
                    <li class="feature-item">
                        <div class="icon-tile icon-tile--solid icon-tile--gold-dark"><?php icon('palette'); ?></div>
                        <div>
                            <h3 class="card-title"><?php t('story_point2_title'); ?></h3>
                            <p class="card-text"><?php t('story_point2_text'); ?></p>
                        </div>
                    </li>
                    <li class="feature-item">
                        <div class="icon-tile icon-tile--solid icon-tile--blue"><?php icon('eco'); ?></div>
                        <div>
                            <h3 class="card-title"><?php t('story_point3_title'); ?></h3>
                            <p class="card-text"><?php t('story_point3_text'); ?></p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </section>

    <!-- ============ FOUR CORE VALUES ============ -->
    <section class="section section--tint">
        <div class="container">
            <div class="section-intro text-center">
                <p class="eyebrow eyebrow--line eyebrow--line-both"><?php t('values_eyebrow'); ?></p>
                <h2 class="section-title"><?php t('values_title'); ?></h2>
                <p class="section-sub"><?php t('values_text'); ?></p>
            </div>

            <div class="grid grid-4">
                <?php foreach ($values as $n => list($value_icon, $colour)): ?>
                    <article class="card value-card accent--<?php echo $colour; ?>">
                        <div class="icon-tile icon-tile--accent"><?php icon($value_icon); ?></div>
                        <h3 class="value-title"><?php t('value' . $n . '_title'); ?></h3>
                        <p class="value-sub"><?php t('value' . $n . '_sub'); ?></p>
                        <p class="card-text"><?php t('value' . $n . '_text'); ?></p>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- ============ MEET THE TEAM (3 × 2 grid) ============ -->
    <section class="section">
        <div class="container">
            <div class="section-intro text-center">
                <p class="eyebrow eyebrow--line eyebrow--line-both"><?php t('team_eyebrow'); ?></p>
                <h2 class="section-title"><?php t('team_title'); ?></h2>
                <p class="section-sub"><?php t('team_text'); ?></p>
            </div>

            <div class="grid grid-3">
                <?php foreach ($team as $m): ?>
                    <article class="card team-card accent--<?php echo $m['colour']; ?>">
                        <div class="team-photo">
                            <img src="images/<?php echo $m['img']; ?>" alt="<?php echo $m['name']; ?>"
                                 loading="lazy" width="224" height="224">
                            <span class="team-initials" aria-hidden="true"><?php echo $m['initials']; ?></span>
                        </div>
                        <h3 class="team-name"><?php echo $m['name']; ?></h3>
                        <p class="value-sub"><?php t('role_' . $m['role']); ?></p>
                        <p class="card-text"><?php t('bio_' . $m['role']); ?></p>
                        <div class="team-links">
                            <!-- 🔗 LINKS NEEDED: real LinkedIn URL and email address -->
                            <a class="icon-btn" href="#" aria-label="<?php echo tr('team_linkedin') . ' ' . $m['name']; ?>"><?php icon('share'); ?></a>
                            <a class="icon-btn" href="#" aria-label="<?php echo tr('team_email') . ' ' . $m['name']; ?>"><?php icon('mail'); ?></a>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- ============ ACCREDITATION BAR ============
         The badges are icon-based. 🖼️ If you get the official partner logos,
         replace each .icon-tile with an <img> of the logo. -->
    <section class="section section--tint-strong">
        <div class="container text-center">
            <p class="eyebrow eyebrow--muted"><?php t('accred_title'); ?></p>
            <div class="grid grid-3 accred-grid">
                <?php
                $accreds = [1 => ['travel', 'green'], 2 => ['shield_with_heart', 'gold'], 3 => ['nest_eco_leaf', 'blue']];
                foreach ($accreds as $n => list($accred_icon, $colour)): ?>
                    <div class="card accred-card accent--<?php echo $colour; ?>">
                        <div class="icon-tile icon-tile--accent icon-tile--round icon-tile--lg"><?php icon($accred_icon); ?></div>
                        <h3 class="card-title"><?php t('accred' . $n . '_name'); ?></h3>
                        <p class="card-meta-label"><?php t('accred' . $n . '_sub'); ?></p>
                        <span class="badge badge--soft"><?php t('accred' . $n . '_tag'); ?></span>
                    </div>
                <?php endforeach; ?>
            </div>
            <p class="accred-note"><?php t('accred_note'); ?></p>
        </div>
    </section>

    <!-- ============ PARTNER CTA STRIP ============ -->
    <section class="cta-strip">
        <div class="container cta-strip-inner">
            <div>
                <h2 class="cta-title"><?php t('partner_title'); ?></h2>
                <p class="cta-text"><?php t('partner_text'); ?></p>
            </div>
            <a class="btn btn-primary btn-lg" href="contact.php"><?php t('partner_button'); ?><?php icon('arrow_forward'); ?></a>
        </div>
    </section>

</main>

<?php require_once 'includes/footer.php'; ?>
