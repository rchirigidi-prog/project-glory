<?php

die('DASHBOARD.PHP IS EXECUTING');

session_start();

/*==================================================
Dashboard Statistics
==================================================*/

function countJsonItems($file)
{
    if (!file_exists($file)) {
        return 0;
    }

    $json = file_get_contents($file);
    $data = json_decode($json, true);

    return is_array($data) ? count($data) : 0;
}

$prayerCount = countJsonItems(__DIR__ . '/storage/prayers.json');
$musicCount = countJsonItems(__DIR__ . '/storage/music.json');
$bibleCount = countJsonItems(__DIR__ . '/storage/bible.json');
$announcementCount = countJsonItems(__DIR__ . '/storage/announcements.json');



/*
|--------------------------------------------------------------------------
| Temporary Login
|--------------------------------------------------------------------------
|
| We will replace this with a secure login system later.
|
*/

$_SESSION['admin_logged_in'] = true;

if (!isset($_SESSION['admin_logged_in'])) {

    header("Location: /");

    exit;

}

include 'includes/admin/header.php';
include 'includes/admin/sidebar.php';
include 'includes/admin/navbar.php';
?>
<div class="cms-content">

    <div class="container-fluid">

       <?php

            $page = $_GET['page'] ?? 'dashboard';

            switch ($page) {

                case 'prayers':
                    include 'modules/prayers/index.php';
                    break;

                case 'music':
                    include 'modules/music/index.php';
                    break;

                case 'dashboard':
                default:
                    include 'modules/dashboard/header.php';
                    include 'modules/dashboard/statistics.php';
                    break;

            }

        ?>

    </div>

</div>


<?php
include 'includes/admin/footer.php';
?>



