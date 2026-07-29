<?php

/**
 * ---------------------------------------------------------
 * Admin Form Layout
 * ---------------------------------------------------------
 *
 * Expected variables:
 *
 * $pageTitle
 * $pageIcon
 * $backUrl
 * $backLabel
 */

$pageTitle = $pageTitle ?? '';
$pageIcon  = $pageIcon ?? 'fa-solid fa-file';
$backUrl   = $backUrl ?? 'index.php';
$backLabel = $backLabel ?? 'Back';

require ADMIN_COMPONENTS . '/page-header.php';
?>

<div class="container-fluid">

    <?php
    // Page content starts here.
    // The calling page will continue rendering after this file.
    ?>