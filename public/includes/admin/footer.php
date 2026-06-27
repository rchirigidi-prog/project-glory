<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

<script src="/assets/js/main.js"></script>

<?php
$page = $_GET['page'] ?? 'dashboard';

switch ($page) {

    case 'prayers':
         echo '<script src="/assets/js/modules/prayer.js"></script>';
        echo '<script src="/assets/js/modules/prayer-admin.js"></script>';
        break;

    case 'music':
        echo '<script src="/assets/js/modules/music.js"></script>';
        break;

    case 'bible':
        echo '<script src="/assets/js/modules/bible.js"></script>';
        break;

    case 'youtube':
        echo '<script src="/assets/js/modules/youtube.js"></script>';
        break;
}
?>

</body>
</html>