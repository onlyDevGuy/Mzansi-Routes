<?php require_once 'includes/header.php'; ?>
<?php require_once 'includes/nav.php'; ?>

<?php
/* ==========================================================================
   Living Style Guide
   A reference page for the team showing the design tokens and components
   that css/style.css provides. It is a developer document, so apart from the
   page title it is written in English only.

   Contrast ratios below were calculated with the WCAG 2.1 formula against
   the background named in each swatch. AA needs 4.5:1 for normal text and
   3:1 for large text (24px+, or 18.5px+ bold) and UI parts like borders.
   ========================================================================== */
$colours = [
    ['name' => 'Deep SA Green',   'role' => 'Primary',   'hex' => '#007A4D', 'alt' => '#005F3B', 'var' => '--color-green',      'ratio' => '5.4:1 on white (AA) · #005F3B 7.8:1 (AAA)', 'use' => 'Brand anchor, footer, active nav, focus rings, primary badges.'],
    ['name' => 'Safari Gold',     'role' => 'Action CTA','hex' => '#FFB612', 'alt' => '#FCB40D', 'var' => '--color-gold',       'ratio' => '10.1:1 with #111827 text (AAA)',           'use' => 'Main call-to-action buttons, star ratings, highlights. Always use dark text on gold.'],
    ['name' => 'Cape Ocean Blue', 'role' => 'Accent',    'hex' => '#0072CE', 'alt' => '#005398', 'var' => '--color-blue',       'ratio' => '4.9:1 on white (AA) · #005398 7.8:1 (AAA)', 'use' => 'Coastal routes, links, information states.'],
    ['name' => 'Protea Red',      'role' => 'Accent',    'hex' => '#DE3831', 'alt' => '#BA1A1A', 'var' => '--color-red',        'ratio' => '4.45:1 — large text only · #BA1A1A 6.5:1 (AA)', 'use' => 'Alerts, wishlist hearts, emergency hotline. Use #BA1A1A for error text.'],
    ['name' => 'Rich Charcoal',   'role' => 'Text',      'hex' => '#141B2B', 'alt' => '#111827', 'var' => '--color-text',       'ratio' => '17.2:1 on white (AAA)',                    'use' => 'Headings and body text.'],
    ['name' => 'Neutral Slate',   'role' => 'Muted text','hex' => '#3E4942', 'alt' => '#4B5563', 'var' => '--color-text-muted', 'ratio' => '9.4:1 on white (AAA)',                     'use' => 'Descriptions, captions, metadata.'],
    ['name' => 'Sunlit Grey',     'role' => 'Surface',   'hex' => '#F9F9FF', 'alt' => '#F1F3FF', 'var' => '--color-bg',         'ratio' => 'Background tone',                          'use' => 'Page background and tinted sections.'],
    ['name' => 'Pure White',      'role' => 'Surface',   'hex' => '#FFFFFF', 'alt' => '',        'var' => '--color-surface',    'ratio' => 'Background tone',                          'use' => 'Cards, inputs, header.'],
];

$type_scale = [
    ['H1 Display · 56px / 36px mobile · ExtraBold 800', 'type-display', 'Expeditions Across Mzansi'],
    ['H2 Section · 40px / 28px mobile · Bold 700',      'type-h2',      'Wild Drakensberg Mountain Trails'],
    ['H3 Sub-section · 24px · SemiBold 600',            'type-h3',      'Curated Vineyards in the Franschhoek Valley'],
    ['H4 Card title · 20px · SemiBold 600',             'type-h4',      'Kruger Sunrise Game Drive'],
    ['Body · 16px · Regular 400 · Inter',               'type-body',    'From the rugged Wild Coast to the red sands of the Kalahari, South Africa offers a rich tapestry of biodiversity, history, and heritage.'],
    ['Small · 14px · Regular 400 · Inter',              'type-small',   'Departure: Cape Town V&A Waterfront · Duration: 4 days · Conservation fee included.'],
    ['Overline · 12px · Bold 700 · +0.08em',            'type-overline','KwaZulu-Natal · iSimangaliso Wetland Park · UNESCO Site'],
];

$spacing = [['xs', 4], ['sm', 8], ['md', 16], ['lg', 24], ['xl', 32], ['2xl', 48], ['3xl', 64]];
?>

<main id="main">

    <section class="page-hero page-hero--tint">
        <div class="glow glow--green" aria-hidden="true"></div>
        <div class="container">
            <p class="pill pill--soft"><?php icon('menu_book'); ?>Design System v1.0</p>
            <h1 class="page-title"><?php t('style_guide'); ?></h1>
            <p class="section-lead text-left"><?php t('sg_intro'); ?></p>
            <p class="badge badge--green"><?php icon('accessibility_new'); ?>WCAG 2.1 AA</p>
        </div>
    </section>

    <!-- ============ 01 COLOURS ============ -->
    <section class="section section--tight">
        <div class="container">
            <div class="sg-head">
                <div class="icon-tile"><?php icon('palette'); ?></div>
                <div><p class="eyebrow">01 / Foundations</p><h2 class="section-title section-title--md">Colour Palette</h2></div>
            </div>
            <div class="grid grid-4">
                <?php foreach ($colours as $c): ?>
                    <article class="card swatch">
                        <div class="swatch-colour" style="background: <?php echo $c['hex']; ?>"></div>
                        <div class="swatch-body">
                            <p class="card-eyebrow"><?php echo $c['role']; ?></p>
                            <h3 class="card-title"><?php echo $c['name']; ?></h3>
                            <!-- Click to copy the hex code (js/script.js) -->
                            <button class="copy-btn" type="button" data-copy="<?php echo $c['hex']; ?>">
                                <code><?php echo $c['hex']; ?></code><?php icon('content_copy'); ?>
                            </button>
                            <?php if ($c['alt']): ?><p class="swatch-alt">Alt: <code><?php echo $c['alt']; ?></code></p><?php endif; ?>
                            <p class="swatch-var"><code>var(<?php echo $c['var']; ?>)</code></p>
                            <p class="swatch-ratio"><?php echo $c['ratio']; ?></p>
                            <p class="card-text"><?php echo $c['use']; ?></p>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- ============ 02 TYPOGRAPHY ============ -->
    <section class="section section--tint section--tight">
        <div class="container">
            <div class="sg-head">
                <div class="icon-tile"><?php icon('format_size'); ?></div>
                <div><p class="eyebrow">02 / Typography</p><h2 class="section-title section-title--md">Type Scale &amp; Pairing</h2></div>
            </div>
            <div class="grid grid-2 sg-fonts">
                <div class="card sg-font-card">
                    <p class="card-eyebrow">Headings &amp; labels</p>
                    <p class="sg-font-sample font-heading">Plus Jakarta Sans</p>
                    <p class="card-text">Aa Bb Cc Dd Ee Ff 0123456789 — weights 600, 700, 800</p>
                </div>
                <div class="card sg-font-card">
                    <p class="card-eyebrow">Body &amp; UI</p>
                    <p class="sg-font-sample">Inter</p>
                    <p class="card-text">The quick brown fox jumps over the sleeping lion — weights 400, 500, 600</p>
                </div>
            </div>
            <div class="card sg-type-list">
                <?php foreach ($type_scale as list($label, $class, $sample)): ?>
                    <div class="sg-type-row">
                        <p class="card-meta-label"><?php echo $label; ?> · <code>.<?php echo $class; ?></code></p>
                        <p class="<?php echo $class; ?>"><?php echo $sample; ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- ============ 03 COMPONENTS ============ -->
    <section class="section section--tight">
        <div class="container">
            <div class="sg-head">
                <div class="icon-tile"><?php icon('widgets'); ?></div>
                <div><p class="eyebrow">03 / Components</p><h2 class="section-title section-title--md">Interface Elements</h2></div>
            </div>

            <!-- Button matrix: each style in its default, hover, active
                 (pressed) and disabled state. Hover/active are shown with
                 helper classes so you can compare them side by side. -->
            <div class="card sg-block">
                <h3 class="card-title">Button Matrix</h3>
                <div class="sg-table-wrap">
                    <table class="sg-table sg-buttons">
                        <thead><tr><th scope="col">Style</th><th scope="col">Default</th><th scope="col">Hover</th><th scope="col">Active</th><th scope="col">Disabled</th></tr></thead>
                        <tbody>
                            <?php
                            $buttons = [
                                ['Primary (gold)', 'btn-primary', 'explore', 'Book Route'],
                                ['Secondary (outline)', 'btn-outline', 'map', 'View Itinerary'],
                                ['Green', 'btn-green', 'download', 'Get Guide'],
                                ['Soft', 'btn-soft', 'arrow_forward', 'Explore Guide'],
                            ];
                            foreach ($buttons as list($label, $class, $btn_icon, $text)): ?>
                                <tr>
                                    <th scope="row"><code>.<?php echo $class; ?></code><br><span class="card-meta-label"><?php echo $label; ?></span></th>
                                    <td><button class="btn <?php echo $class; ?>" type="button"><?php icon($btn_icon); ?><?php echo $text; ?></button></td>
                                    <td><button class="btn <?php echo $class; ?> is-hover" type="button" tabindex="-1"><?php icon($btn_icon); ?><?php echo $text; ?></button></td>
                                    <td><button class="btn <?php echo $class; ?> is-active-state" type="button" tabindex="-1"><?php icon($btn_icon); ?><?php echo $text; ?></button></td>
                                    <td><button class="btn <?php echo $class; ?>" type="button" disabled><?php icon('lock'); ?><?php echo $text; ?></button></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="grid grid-2 sg-components">
                <!-- Destination card sample -->
                <div>
                    <p class="card-meta-label">Destination card · <code>.card.media-card</code> · lifts on hover</p>
                    <article class="card media-card">
                        <div class="media-card-img">
                            <!-- 🖼️ IMAGE: images/styleguide-garden-route.jpg (from Stitch) -->
                            <img src="images/styleguide-garden-route.jpg" alt="Aerial view of the Twelve Apostles peaks above Camps Bay" loading="lazy" width="800" height="450">
                            <span class="badge badge--blue media-badge-tl"><?php icon('waves'); ?>Coastal Discovery</span>
                            <button class="wishlist-btn" type="button" aria-pressed="false" aria-label="Save to wishlist: Garden Route"><?php icon('favorite'); ?></button>
                        </div>
                        <div class="media-card-body">
                            <p class="card-meta"><?php icon('location_on'); ?>Western Cape</p>
                            <h3 class="card-title">Garden Route &amp; Tsitsikamma</h3>
                            <p class="card-text">Coastal cliffs, ancient yellowwood forests, and marine sanctuaries, with bridge walks and ocean safaris.</p>
                            <div class="card-facts">
                                <span><?php icon('schedule'); ?>6 Days / 5 Nights</span>
                                <span><?php icon('star', 'icon--filled'); ?>4.95 (142)</span>
                            </div>
                        </div>
                    </article>
                </div>

                <!-- Team / ranger profile sample -->
                <div>
                    <p class="card-meta-label">Profile card · <code>.card.team-card</code></p>
                    <article class="card team-card accent--green">
                        <div class="team-photo">
                            <!-- 🖼️ IMAGE: images/styleguide-ranger.jpg (from Stitch) -->
                            <img src="images/styleguide-ranger.jpg" alt="Portrait of a safari ranger in an olive uniform" loading="lazy" width="224" height="224">
                            <span class="team-initials" aria-hidden="true"><?php icon('verified'); ?></span>
                        </div>
                        <h3 class="team-name">Sipho Ndlovu</h3>
                        <p class="value-sub">Lead Bushveld Tracker</p>
                        <p class="card-text">14 years tracking big cats across the Greater Kruger. Specialist in Shangaan botanical lore.</p>
                        <div class="tag-row">
                            <span class="badge badge--soft">FGASA Level 3</span>
                            <span class="badge badge--soft">Zulu / Eng / Shangaan</span>
                        </div>
                    </article>
                </div>
            </div>

            <!-- Form field states -->
            <div class="card sg-block">
                <h3 class="card-title">Form Inputs &amp; Feedback States</h3>
                <div class="grid grid-2 sg-forms">
                    <div class="field">
                        <label class="field-label" for="sg-default">Default</label>
                        <div class="input-wrap"><?php icon('search'); ?><input class="input" id="sg-default" type="text" placeholder="Search destinations…"></div>
                    </div>
                    <div class="field">
                        <label class="field-label" for="sg-focus">Focused (shown with <code>.is-focus</code>)</label>
                        <div class="input-wrap"><?php icon('person'); ?><input class="input is-focus" id="sg-focus" type="text" value="Sindi Ndlovu"></div>
                    </div>
                    <div class="field">
                        <label class="field-label" for="sg-error">Error</label>
                        <div class="input-wrap"><?php icon('mail'); ?><input class="input" id="sg-error" type="email" value="sindi@mail" aria-invalid="true" aria-describedby="sg-error-msg"></div>
                        <p class="field-error" id="sg-error-msg"><span class="icon" aria-hidden="true">error</span><span>Please enter a valid email address.</span></p>
                    </div>
                    <div class="field">
                        <label class="field-label" for="sg-disabled">Disabled</label>
                        <div class="input-wrap"><?php icon('lock'); ?><input class="input" id="sg-disabled" type="text" value="Registration closed" disabled></div>
                    </div>
                </div>
                <p class="alert alert--success"><?php icon('check_circle'); ?>Success message · <code>.alert--success</code></p>
                <p class="alert alert--error"><?php icon('warning'); ?>Error summary · <code>.alert--error</code></p>
            </div>

            <!-- Badges, pills, language switch -->
            <div class="card sg-block">
                <h3 class="card-title">Badges, Pills &amp; Switchers</h3>
                <div class="sg-badges">
                    <div>
                        <p class="card-meta-label">Language switch · <code>.lang-switch</code></p>
                        <div class="lang-switch" role="group" aria-label="Example language switch">
                            <span class="lang-option is-active">EN</span><span class="lang-option">AF</span>
                        </div>
                    </div>
                    <div>
                        <p class="card-meta-label">Badges · <code>.badge--green / --gold / --blue / --red / --soft</code></p>
                        <div class="tag-row">
                            <span class="badge badge--green"><?php icon('verified'); ?>UNESCO</span>
                            <span class="badge badge--gold">Big Five Safari</span>
                            <span class="badge badge--blue"><?php icon('kayaking'); ?>Coastal Trail</span>
                            <span class="badge badge--red"><?php icon('local_fire_department'); ?>Festival</span>
                            <span class="badge badge--soft">Western Cape</span>
                        </div>
                    </div>
                    <div>
                        <p class="card-meta-label">Filter chips · <code>.chip</code></p>
                        <div class="tag-row">
                            <span class="chip is-active">All</span><span class="chip">Cultural</span><span class="chip">Wildlife</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ============ 04 LAYOUT ============ -->
    <section class="section section--tint section--tight">
        <div class="container">
            <div class="sg-head">
                <div class="icon-tile"><?php icon('grid_view'); ?></div>
                <div><p class="eyebrow">04 / Layout</p><h2 class="section-title section-title--md">Spacing &amp; Breakpoints</h2></div>
            </div>
            <div class="grid grid-2">
                <div class="card sg-block">
                    <h3 class="card-title">8px Spacing Scale</h3>
                    <ul class="sg-spacing">
                        <?php foreach ($spacing as list($name, $px)): ?>
                            <li><code>--space-<?php echo $name; ?></code><span class="sg-bar" style="width: <?php echo $px * 3; ?>px"></span><span><?php echo $px; ?>px</span></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="card sg-block">
                    <h3 class="card-title">Responsive Breakpoints</h3>
                    <ul class="sg-breakpoints">
                        <li><?php icon('smartphone'); ?><div><strong>Mobile · under 768px</strong><span>1 column, 16px side margins, menu collapses into a drop-down</span></div></li>
                        <li><?php icon('tablet'); ?><div><strong>Tablet · 768px – 1199px</strong><span>2-column grids, 32px margins</span></div></li>
                        <li><?php icon('desktop_windows'); ?><div><strong>Desktop · 1200px and up</strong><span>3-column grids, max content width 1280px</span></div></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- ============ 05 ACCESSIBILITY ============ -->
    <section class="section section--tight">
        <div class="container">
            <div class="sg-head">
                <div class="icon-tile"><?php icon('accessibility_new'); ?></div>
                <div><p class="eyebrow">05 / Inclusion</p><h2 class="section-title section-title--md">Accessibility Checklist (WCAG 2.1 AA)</h2></div>
            </div>
            <div class="card sg-table-wrap">
                <table class="sg-table">
                    <thead><tr><th scope="col">Criterion</th><th scope="col">Level</th><th scope="col">How Mzansi Routes meets it</th></tr></thead>
                    <tbody>
                        <tr><td>1.4.3 Contrast (Minimum)</td><td>AA</td><td>Body text #141B2B / #3E4942 on light surfaces (9:1+). Gold buttons always use dark #111827 text (10:1).</td></tr>
                        <tr><td>1.4.11 Non-text Contrast</td><td>AA</td><td>Input borders and focus rings use the green brand colour (5.4:1 on white).</td></tr>
                        <tr><td>2.1.1 Keyboard</td><td>A</td><td>Every link, button, filter and the mobile menu work with Tab, Enter, Space and Esc.</td></tr>
                        <tr><td>2.4.1 Bypass Blocks</td><td>A</td><td>"Skip to main content" link is the first item on every page.</td></tr>
                        <tr><td>2.4.7 Focus Visible</td><td>AA</td><td>A 2px green outline with offset appears on every focused element (<code>:focus-visible</code>).</td></tr>
                        <tr><td>3.1.1 / 3.1.2 Language</td><td>A / AA</td><td><code>&lt;html lang&gt;</code> follows the EN / AF switch; the switch links carry their own <code>lang</code>.</td></tr>
                        <tr><td>3.3.1 / 3.3.3 Error Identification &amp; Suggestion</td><td>A / AA</td><td>Form errors appear as text under each field, linked with <code>aria-describedby</code> and <code>aria-invalid</code>.</td></tr>
                        <tr><td>2.5.5 Target Size</td><td>AAA (bonus)</td><td>Buttons and chips are at least 44px high; 48px on mobile.</td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

</main>

<?php require_once 'includes/footer.php'; ?>
