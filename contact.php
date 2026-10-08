<?php
/* Load settings + translations first, so the form can be checked
   before any HTML is printed. */
require_once 'includes/config.php';

/* ==========================================================================
   Contact form — server-side validation
   js/script.js checks the form in the browser first (faster feedback), but
   the server must ALWAYS check again: browser checks can be switched off.
   ========================================================================== */
$categories = ['general' => 'form_cat_general', 'itinerary' => 'form_cat_itinerary', 'partner' => 'form_cat_partner', 'press' => 'form_cat_press'];

$values  = ['name' => '', 'email' => '', 'category' => 'general', 'phone' => '', 'message' => '', 'consent' => false];
$errors  = [];   // field name => translation key of the error message
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // isset() checks keep this working on older PHP versions (5.6+)
    $values['name']     = isset($_POST['name'])     ? trim($_POST['name'])     : '';
    $values['email']    = isset($_POST['email'])    ? trim($_POST['email'])    : '';
    $values['category'] = isset($_POST['category']) ? $_POST['category']       : '';
    $values['phone']    = isset($_POST['phone'])    ? trim($_POST['phone'])    : '';
    $values['message']  = isset($_POST['message'])  ? trim($_POST['message'])  : '';
    $values['consent']  = isset($_POST['consent']);

    if ($values['name'] === '') {
        $errors['name'] = 'err_name';
    }
    if ($values['email'] === '') {
        $errors['email'] = 'err_email_empty';
    } elseif (!filter_var($values['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'err_email_invalid';
    }
    if (!array_key_exists($values['category'], $categories)) {
        $errors['category'] = 'err_category';
    }
    // Phone is optional, but if given it may only contain digits, spaces, +, ( ) and -
    if ($values['phone'] !== '' && !preg_match('/^\+?[0-9\s()\-]{7,20}$/', $values['phone'])) {
        $errors['phone'] = 'err_phone';
    }
    if (mb_strlen($values['message']) < 10) {
        $errors['message'] = 'err_message';
    }
    if (!$values['consent']) {
        $errors['consent'] = 'err_consent';
    }

    if (empty($errors)) {
        /* TODO (PHP developer): send the message, e.g. with mail() or
           PHPMailer, or save it to a database. Nothing is sent yet. */
        $success = true;
        // Empty the form after a successful send
        $values = ['name' => '', 'email' => '', 'category' => 'general', 'phone' => '', 'message' => '', 'consent' => false];
    }
}

/* Small helpers for printing the form */
function old($field)
{
    global $values;
    return htmlspecialchars($values[$field], ENT_QUOTES, 'UTF-8');
}

// Adds the error styling + aria attributes to a field that failed validation
function field_attrs($field)
{
    global $errors;
    if (isset($errors[$field])) {
        echo 'aria-invalid="true" aria-describedby="' . $field . '-error"';
    }
}

// Prints the error message under a field (an empty, hidden one if no error,
// so JavaScript can fill it in later)
function field_error($field)
{
    global $errors;
    $message = isset($errors[$field]) ? tr($errors[$field]) : '';
    echo '<p class="field-error" id="' . $field . '-error"' . ($message === '' ? ' hidden' : '') . '>';
    echo '<span class="icon" aria-hidden="true">error</span><span class="field-error-text">' . $message . '</span></p>';
}

require_once 'includes/header.php';
require_once 'includes/nav.php';
?>

<main id="main">

    <!-- ============ PAGE HEADER ============ -->
    <section class="page-hero page-hero--tint">
        <div class="glow glow--green" aria-hidden="true"></div>
        <div class="glow glow--gold glow--bottom" aria-hidden="true"></div>
        <div class="container">
            <p class="eyebrow"><span class="dot dot--gold" aria-hidden="true"></span><?php t('contact_eyebrow'); ?></p>
            <h1 class="page-title"><?php t('contact'); ?></h1>
            <p class="page-subtitle"><?php t('contact_subtitle'); ?></p>
            <p class="section-lead text-left"><?php t('contact_intro'); ?></p>
        </div>
    </section>

    <!-- ============ TWO COLUMNS: contact info (left) + form (right) ============ -->
    <section class="section section--tight">
        <div class="container contact-layout">

            <!-- ---------- Left: contact information ---------- -->
            <div class="contact-side">
                <div class="info-panel">
                    <div class="info-panel-head">
                        <div>
                            <p class="eyebrow eyebrow--light"><?php t('info_eyebrow'); ?></p>
                            <h2 class="info-panel-title"><?php t('info_title'); ?></h2>
                        </div>
                        <div class="icon-tile icon-tile--glass icon-tile--lg"><?php icon('support_agent'); ?></div>
                    </div>

                    <ul class="info-list">
                        <li>
                            <div class="icon-tile icon-tile--glass icon-tile--sm"><?php icon('location_on'); ?></div>
                            <div><span class="info-label"><?php t('info_address'); ?></span><p><?php t('info_address_value'); ?></p></div>
                        </li>
                        <li class="info-split">
                            <div class="info-split-item">
                                <div class="icon-tile icon-tile--glass icon-tile--sm"><?php icon('call'); ?></div>
                                <div><span class="info-label"><?php t('info_phone'); ?></span><a href="tel:+27214240000">+27 (0)84 808 8701</a></div>
                            </div>
                            <div class="info-split-item">
                                <div class="icon-tile icon-tile--glass icon-tile--sm"><?php icon('chat'); ?></div>
                                <div><span class="info-label"><?php t('info_whatsapp'); ?></span><a href="tel:+27825551234">+27 (0)84 808 8701</a></div>
                            </div>
                        </li>
                        <li>
                            <div class="icon-tile icon-tile--glass icon-tile--sm"><?php icon('alternate_email'); ?></div>
                            <div>
                                <span class="info-label"><?php t('info_email'); ?></span>
                                <a href="mailto:info@mzansiroutes.co.za">info@mzansiroutes.co.za</a><br>
                                <a href="mailto:support@mzansiroutes.co.za">support@mzansiroutes.co.za</a>
                            </div>
                        </li>
                        <li>
                            <div class="icon-tile icon-tile--glass icon-tile--sm"><?php icon('schedule'); ?></div>
                            <div>
                                <span class="info-label"><?php t('info_hours'); ?></span>
                                <p><?php t('info_hours_week'); ?></p>
                                <p class="muted-light"><?php t('info_hours_sat'); ?></p>
                            </div>
                        </li>
                    </ul>

                    <!-- South African Tourism helpline -->
                    <div class="emergency-box">
                        <div class="icon-tile icon-tile--round icon-tile--red"><?php icon('e911_emergency'); ?></div>
                        <div>
                            <span class="info-label info-label--gold"><?php t('info_emergency'); ?></span>
                            <a class="emergency-number" href="tel:+27833182475">+27 (0)83 318 2475</a>
                        </div>
                    </div>

                    <!-- Opens a WhatsApp chat with the helpline number -->
                    <a class="whatsapp-btn" href="https://wa.me/+27848088701" target="_blank" rel="noopener noreferrer">
                        <span><?php icon('forum'); ?><?php t('info_whatsapp_chat'); ?></span>
                        <span class="badge badge--white"><?php t('info_instant'); ?></span>
                    </a>

                    <div class="info-social">
                        <span class="info-label"><?php t('info_connect'); ?></span>
                        <ul class="social-links">
                            <?php foreach ($social_links as $name => $s): ?>
                                <li><a href="<?php echo $s['url']; ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php t($s['label']); ?>"><?php social_icon($name); ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>

                <div class="registered-note">
                    <div class="icon-tile icon-tile--white"><?php icon('verified'); ?></div>
                    <div>
                        <strong><?php t('info_registered'); ?></strong>
                        <span><?php t('info_registered_sub'); ?></span>
                    </div>
                </div>
            </div>

            <!-- ---------- Right: inquiry form ---------- -->
            <div class="card form-card">
                <p class="pill pill--green-soft"><?php icon('mail'); ?><?php t('form_eyebrow'); ?></p>
                <h2 class="form-title"><?php t('form_title'); ?></h2>
                <p class="card-text"><?php t('form_intro'); ?></p>

                <?php if ($success): ?>
                    <div class="alert alert--success" role="status">
                        <?php icon('check_circle'); ?>
                        <div><strong><?php t('form_success_title'); ?></strong><p><?php t('form_success_text'); ?></p></div>
                    </div>
                <?php endif; ?>

                <!-- Error summary: shown by PHP after a failed submit, or by JS -->
                <div class="alert alert--error" id="form-error-summary" role="alert" <?php echo empty($errors) ? 'hidden' : ''; ?>>
                    <?php icon('warning'); ?><span><?php t('err_summary'); ?></span>
                </div>

                <!-- novalidate turns off the browser's built-in pop-ups so our own
                     accessible messages are used instead (js/script.js). -->
                <form class="contact-form" id="contact-form" method="post" action="contact.php" novalidate>
                    <div class="form-row">
                        <div class="field">
                            <label class="field-label" for="name"><?php t('form_name'); ?> <span class="req" aria-hidden="true">*</span></label>
                            <div class="input-wrap">
                                <?php icon('person'); ?>
                                <input class="input" type="text" id="name" name="name" value="<?php echo old('name'); ?>"
                                       placeholder="<?php t('form_name_ph'); ?>" autocomplete="name" required
                                       data-error-required="<?php t('err_name'); ?>" <?php field_attrs('name'); ?>>
                            </div>
                            <?php field_error('name'); ?>
                        </div>

                        <div class="field">
                            <label class="field-label" for="email"><?php t('form_email'); ?> <span class="req" aria-hidden="true">*</span></label>
                            <div class="input-wrap">
                                <?php icon('mail'); ?>
                                <input class="input" type="email" id="email" name="email" value="<?php echo old('email'); ?>"
                                       placeholder="<?php t('form_email_ph'); ?>" autocomplete="email" required
                                       data-error-required="<?php t('err_email_empty'); ?>"
                                       data-error-invalid="<?php t('err_email_invalid'); ?>" <?php field_attrs('email'); ?>>
                            </div>
                            <?php field_error('email'); ?>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="field">
                            <label class="field-label" for="category"><?php t('form_category'); ?> <span class="req" aria-hidden="true">*</span></label>
                            <div class="input-wrap">
                                <?php icon('category'); ?>
                                <select class="input input--select" id="category" name="category" required <?php field_attrs('category'); ?>>
                                    <?php foreach ($categories as $value => $key): ?>
                                        <option value="<?php echo $value; ?>" <?php echo $values['category'] === $value ? 'selected' : ''; ?>><?php t($key); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <?php field_error('category'); ?>
                        </div>

                        <div class="field">
                            <label class="field-label" for="phone"><?php t('form_phone'); ?> <span class="optional"><?php t('form_optional'); ?></span></label>
                            <div class="input-wrap">
                                <?php icon('call'); ?>
                                <input class="input" type="tel" id="phone" name="phone" value="<?php echo old('phone'); ?>"
                                       placeholder="<?php t('form_phone_ph'); ?>" autocomplete="tel"
                                       data-error-invalid="<?php t('err_phone'); ?>" <?php field_attrs('phone'); ?>>
                            </div>
                            <?php field_error('phone'); ?>
                        </div>
                    </div>

                    <div class="field">
                        <label class="field-label" for="message"><?php t('form_message'); ?> <span class="req" aria-hidden="true">*</span></label>
                        <textarea class="input" id="message" name="message" rows="5" required minlength="10"
                                  placeholder="<?php t('form_message_ph'); ?>"
                                  data-error-required="<?php t('err_message'); ?>" <?php field_attrs('message'); ?>><?php echo old('message'); ?></textarea>
                        <?php field_error('message'); ?>
                    </div>

                    <!-- POPIA consent (required by South African privacy law) -->
                    <div class="field">
                        <label class="checkbox">
                            <input type="checkbox" id="consent" name="consent" required
                                   data-error-required="<?php t('err_consent'); ?>"
                                   <?php echo $values['consent'] ? 'checked' : ''; ?> <?php field_attrs('consent'); ?>>
                            <span><?php t('form_consent'); ?></span>
                        </label>
                        <?php field_error('consent'); ?>
                    </div>

                    <div class="form-footer">
                        <p class="popia-note"><?php icon('lock'); ?><?php t('form_popia'); ?></p>
                        <button class="btn btn-primary btn-lg" type="submit"><?php t('form_submit'); ?><?php icon('send'); ?></button>
                    </div>
                </form>

                <div class="form-meta">
                    <span><?php t('form_turnaround'); ?></span>
                    <span class="online-status"><span class="dot dot--pulse" aria-hidden="true"></span><?php t('form_online'); ?></span>
                </div>
            </div>
        </div>
    </section>

    <!-- ============ TRAVEL HUB MAP ============
         A live Google Map of 150 Long Street (no API key needed).
         The white info card floats on top of the map. -->
    <section class="section section--tint section--tight">
        <div class="container">
            <div class="section-head">
                <div>
                    <p class="eyebrow"><?php icon('pin_drop'); ?><?php t('hub_eyebrow'); ?></p>
                    <h2 class="section-title section-title--md"><?php t('hub_title'); ?></h2>
                    <p class="section-sub"><?php t('hub_text'); ?></p>
                </div>
                <a class="btn btn-green" href="https://maps.google.com/?q=150+Long+Street,+Cape+Town,+South+Africa" target="_blank" rel="noopener noreferrer">
                    <?php icon('directions'); ?><?php t('hub_directions'); ?>
                </a>
            </div>

            <div class="map-card">
                <div class="map-frame">
                    <!-- To show a different place: on Google Maps click Share → Embed a map,
                         and paste its src="…" address here -->
                    <iframe src="https://www.google.com/maps/embed?origin=mfe&amp;pb=!1m3!2m1!1s150+Long+Street,+Cape+Town!6i16"
                            title="<?php t('hub_map_title'); ?>" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    <div class="map-overlay">
                        <p class="map-overlay-title"><?php icon('flag'); ?><?php t('hub_card_title'); ?></p>
                        <p class="card-meta-label"><?php t('hub_card_address'); ?></p>
                        <div class="map-overlay-foot">
                            <span class="online-status"><span class="dot" aria-hidden="true"></span><?php t('hub_open'); ?></span>
                            <span><?php icon('accessible'); ?><?php t('hub_accessible'); ?></span>
                        </div>
                    </div>
                </div>
                <ul class="map-facts">
                    <li><div class="icon-tile icon-tile--round icon-tile--sm"><?php icon('local_parking'); ?></div><div><strong><?php t('hub_parking'); ?></strong><span><?php t('hub_parking_text'); ?></span></div></li>
                    <li><div class="icon-tile icon-tile--round icon-tile--sm"><?php icon('coffee'); ?></div><div><strong><?php t('hub_coffee'); ?></strong><span><?php t('hub_coffee_text'); ?></span></div></li>
                    <li><div class="icon-tile icon-tile--round icon-tile--sm"><?php icon('map'); ?></div><div><strong><?php t('hub_maps'); ?></strong><span><?php t('hub_maps_text'); ?></span></div></li>
                </ul>
            </div>
        </div>
    </section>

</main>

<?php require_once 'includes/footer.php'; ?>
