<?php require_once __DIR__ . '/config.php'; ?>
<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php t('title_' . $current_page); ?></title>
    <meta name="description" content="<?php t('meta_description'); ?>">
    <link rel="icon" type="image/png" href="images/logo.png">

    <!-- Fonts: Plus Jakarta Sans (headings & labels), Inter (body text),
         Material Symbols (icons). Loaded from Google Fonts. -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,400,0..1,0&display=block">

    <link rel="stylesheet" href="css/style.css">
    <!-- "defer" runs the script after the page HTML has loaded -->
    <script src="js/script.js" defer></script>
</head>
<body class="page-<?php echo $current_page; ?>">
<!-- Keyboard users can jump past the menu straight to the page content -->
<a class="skip-link" href="#main"><?php t('skip_to_content'); ?></a>
