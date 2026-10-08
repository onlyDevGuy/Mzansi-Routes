<?php
/* ==========================================================================
   Mzansi Routes — global configuration
   Loaded first on every page (via includes/header.php), before any HTML is
   sent, so it is allowed to set cookies.
   ========================================================================== */

$site_name = 'Mzansi Routes';

/* ---------- Language selection ------------------------------------------
   Only languages in this list can be loaded. Never build a file path straight
   from user input: "?lang=../../something" would let a visitor open other
   files on the server. To add a language later (e.g. isiZulu), create
   languages/zu.php and add 'zu' here. */
$supported_langs = ['en', 'af'];

if (isset($_GET['lang']) && in_array($_GET['lang'], $supported_langs, true)) {
    // The visitor clicked EN / AF: remember the choice for 30 days so every
    // page stays in that language without adding ?lang= to each link.
    $lang = $_GET['lang'];
    setcookie('lang', $lang, time() + 60 * 60 * 24 * 30, '/');
} elseif (isset($_COOKIE['lang']) && in_array($_COOKIE['lang'], $supported_langs, true)) {
    $lang = $_COOKIE['lang'];
} else {
    $lang = 'en';
}

$translations = require __DIR__ . "/../languages/{$lang}.php";
$tagline = $translations['tagline'];

/* ---------- Translation helpers ------------------------------------------
   tr('key') returns the translated text, HTML-escaped (safe to print).
   t('key')  prints it straight away.
   A missing key shows the key name itself, so gaps are easy to spot. */
function tr($key)
{
    global $translations;
    $text = isset($translations[$key]) ? $translations[$key] : $key;
    return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
}

function t($key)
{
    echo tr($key);
}

/* ---------- Icons ------------------------------------------------------------
   Prints a Google "Material Symbols" icon, e.g. icon('explore').
   Browse names at https://fonts.google.com/icons
   Icons are decorative (aria-hidden), so always put a text label or an
   aria-label next to them. Pass 'icon--filled' as $extra for a solid icon. */
function icon($name, $extra = '')
{
    echo '<span class="icon ' . $extra . '" aria-hidden="true">' . $name . '</span>';
}

/* ---------- Social media ---------------------------------------------------
   Used in the footer and on the Contact page.
   🔗 LINKS NEEDED: replace these with the real Mzansi Routes accounts. */
$social_links = [
    'facebook'  => ['url' => 'https://facebook.com/mzansiroutes',  'label' => 'social_facebook'],
    'x'         => ['url' => 'https://x.com/mzansiroutes',         'label' => 'social_x'],
    'instagram' => ['url' => 'https://instagram.com/mzansiroutes', 'label' => 'social_instagram'],
    'youtube'   => ['url' => 'https://youtube.com/@mzansiroutes',  'label' => 'social_youtube'],
];

/* Prints a small inline SVG brand icon (it takes the current text colour). */
function social_icon($name)
{
    $icons = [
        'facebook'  => '<path d="M13.5 21v-7.5h2.6l.4-3h-3V8.6c0-.9.3-1.5 1.6-1.5h1.6V4.4c-.3 0-1.2-.1-2.3-.1-2.3 0-3.9 1.4-3.9 4v2.2H7.9v3h2.6V21h3z" fill="currentColor"/>',
        'x'         => '<path d="M17.8 3.5h3l-6.6 7.5 7.8 9.5h-6.1l-4.8-5.9-5.5 5.9H2.6l7-7.9L2.2 3.5h6.2l4.3 5.4 5.1-5.4zm-1 15.3h1.7L7.3 5.1H5.5l11.3 13.7z" fill="currentColor"/>',
        'instagram' => '<rect x="3.5" y="3.5" width="17" height="17" rx="5" fill="none" stroke="currentColor" stroke-width="2"/><circle cx="12" cy="12" r="4" fill="none" stroke="currentColor" stroke-width="2"/><circle cx="17.2" cy="6.8" r="1.2" fill="currentColor"/>',
        'youtube'   => '<path d="M21.6 7.2a2.5 2.5 0 0 0-1.8-1.8C18.2 5 12 5 12 5s-6.2 0-7.8.4A2.5 2.5 0 0 0 2.4 7.2C2 8.8 2 12 2 12s0 3.2.4 4.8a2.5 2.5 0 0 0 1.8 1.8c1.6.4 7.8.4 7.8.4s6.2 0 7.8-.4a2.5 2.5 0 0 0 1.8-1.8c.4-1.6.4-4.8.4-4.8s0-3.2-.4-4.8zM10 15V9l5.2 3L10 15z" fill="currentColor"/>',
    ];
    echo '<svg viewBox="0 0 24 24" width="20" height="20" aria-hidden="true" focusable="false">' . $icons[$name] . '</svg>';
}

/* ---------- Current page ---------------------------------------------------
   e.g. "index", "destinations" — used to highlight the active menu link. */
$current_page = basename($_SERVER['PHP_SELF'], '.php');

/* Link to the current page in another language (used by the EN / AF pill). */
function lang_url($code)
{
    $params = $_GET;
    $params['lang'] = $code;
    return htmlspecialchars(basename($_SERVER['PHP_SELF']) . '?' . http_build_query($params), ENT_QUOTES, 'UTF-8');
}

/* ---------- YouTube video (Home page) --------------------------------------
   📹 VIDEO NEEDED: paste the ID of the YouTube video for the
   "See Mzansi in Motion" section on the Home page.
   Example: for https://www.youtube.com/watch?v=AbC123xYz the ID is AbC123xYz
   While this is empty, a styled placeholder is shown instead of the video. */
$youtube_video_id = 'https://www.youtube.com/embed/DHItTpJaDno?si=PMkR2syxhB4zj4X3';
