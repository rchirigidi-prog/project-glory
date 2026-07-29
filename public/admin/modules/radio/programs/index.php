<?php

declare(strict_types=1);

die('RADIO PROGRAMS MODULE LOADED');


use App\Controllers\RadioProgramController;
use App\Core\Flash;

require_once dirname(__DIR__, 4) . '/bootstrap.php';

$controller = new RadioProgramController();

/*
|--------------------------------------------------------------------------
| Delete Program
|--------------------------------------------------------------------------
*/

if (
    $_SERVER['REQUEST_METHOD'] === 'POST'
    && ($_POST['action'] ?? '') === 'delete'
) {
    $id = (int) ($_POST['id'] ?? 0);

    if ($id > 0) {
        $controller->delete($id);
    }

    exit;
}

/*
|--------------------------------------------------------------------------
| Load Programs
|--------------------------------------------------------------------------
*/

$programs = $controller->index();

/*
|--------------------------------------------------------------------------
| Filters
|--------------------------------------------------------------------------
*/

$search = trim((string) ($_GET['search'] ?? ''));
$language = trim((string) ($_GET['language'] ?? ''));
$category = trim((string) ($_GET['category'] ?? ''));
$status = trim((string) ($_GET['status'] ?? ''));

$filteredPrograms = array_filter($programs, static function (array $program) use (
    $search,
    $language,
    $category,
    $status
): bool {

    if (
        $search !== ''
        && stripos(
            ($program['name'] ?? '') . ' ' . ($program['description'] ?? ''),
            $search
        ) === false
    ) {
        return false;
    }

    if (
        $language !== ''
        && ($program['language'] ?? '') !== $language
    ) {
        return false;
    }

    if (
        $category !== ''
        && ($program['category'] ?? '') !== $category
    ) {
        return false;
    }

    if ($status !== '') {

        $active = !empty($program['is_active']);

        if ($status === 'active' && !$active) {
            return false;
        }

        if ($status === 'inactive' && $active) {
            return false;
        }
    }

    return true;
});

/*
|--------------------------------------------------------------------------
| Statistics
|--------------------------------------------------------------------------
*/

$totalPrograms = count($programs);

$totalActive = count(
    array_filter(
        $programs,
        static fn(array $row): bool => !empty($row['is_active'])
    )
);

$totalInactive = $totalPrograms - $totalActive;

$totalMinutes = array_sum(
    array_map(
        static fn(array $row): int => (int) ($row['estimated_duration'] ?? 0),
        $programs
    )
);

$totalHours = round($totalMinutes / 60, 1);

/*
|--------------------------------------------------------------------------
| Filter Lists
|--------------------------------------------------------------------------
*/

$languages = [];

$categories = [];

foreach ($programs as $program) {

    if (!empty($program['language'])) {
        $languages[$program['language']] = true;
    }

    if (!empty($program['category'])) {
        $categories[$program['category']] = true;
    }
}

ksort($languages);
ksort($categories);

$languages = array_keys($languages);
$categories = array_keys($categories);

/*
|--------------------------------------------------------------------------
| Page
|--------------------------------------------------------------------------
*/

$pageTitle = 'Radio Programs';

ob_start();
?>
<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h2 class="mb-1">
            <i class="fa-solid fa-radio me-2"></i>
            Radio Programs
        </h2>

        <p class="text-muted mb-0">
            Manage radio shows, worship sessions, Bible readings and special broadcasts.
        </p>
    </div>

    <a href="<?= htmlspecialchars($loader->url('radio/programs/create')) ?>"
       class="btn btn-primary">

        <i class="fa-solid fa-plus me-2"></i>

        Create Program
    </a>

</div>

<?php Flash::display(); ?>

<div class="row g-3 mb-4">

    <div class="col-lg-3 col-md-6">

        <div class="card shadow-sm border-0">

            <div class="card-body">

                <div class="text-muted small">
                    Total Programs
                </div>

                <h3 class="mb-0">
                    <?= $totalPrograms ?>
                </h3>

            </div>

        </div>

    </div>

    <div class="col-lg-3 col-md-6">

        <div class="card shadow-sm border-0">

            <div class="card-body">

                <div class="text-muted small">
                    Active
                </div>

                <h3 class="text-success mb-0">
                    <?= $totalActive ?>
                </h3>

            </div>

        </div>

    </div>

    <div class="col-lg-3 col-md-6">

        <div class="card shadow-sm border-0">

            <div class="card-body">

                <div class="text-muted small">
                    Inactive
                </div>

                <h3 class="text-danger mb-0">
                    <?= $totalInactive ?>
                </h3>

            </div>

        </div>

    </div>

    <div class="col-lg-3 col-md-6">

        <div class="card shadow-sm border-0">

            <div class="card-body">

                <div class="text-muted small">
                    Total Hours
                </div>

                <h3 class="text-primary mb-0">
                    <?= number_format($totalHours,1) ?>
                </h3>

            </div>

        </div>

    </div>

</div>

<div class="card shadow-sm border-0 mb-4">

    <div class="card-body">

        <form method="get">

            <input type="hidden"
                   name="module"
                   value="radio/programs">

            <div class="row g-3">

                <div class="col-lg-3">

                    <input
                        type="text"
                        class="form-control"
                        name="search"
                        placeholder="Search programs..."
                        value="<?= htmlspecialchars($search) ?>">

                </div>

                <div class="col-lg-2">

                    <select
                        name="language"
                        class="form-select">

                        <option value="">All Languages</option>

                        <?php foreach ($languages as $item): ?>

                            <option
                                value="<?= htmlspecialchars($item) ?>"
                                <?= $language === $item ? 'selected' : '' ?>>

                                <?= htmlspecialchars($item) ?>

                            </option>

                        <?php endforeach; ?>

                    </select>

                </div>

                <div class="col-lg-2">

                    <select
                        name="category"
                        class="form-select">

                        <option value="">All Categories</option>

                        <?php foreach ($categories as $item): ?>

                            <option
                                value="<?= htmlspecialchars($item) ?>"
                                <?= $category === $item ? 'selected' : '' ?>>

                                <?= htmlspecialchars($item) ?>

                            </option>

                        <?php endforeach; ?>

                    </select>

                </div>

                <div class="col-lg-2">

                    <select
                        name="status"
                        class="form-select">

                        <option value="">All Status</option>

                        <option value="active"
                            <?= $status === 'active' ? 'selected' : '' ?>>
                            Active
                        </option>

                        <option value="inactive"
                            <?= $status === 'inactive' ? 'selected' : '' ?>>
                            Inactive
                        </option>

                    </select>

                </div>

                <div class="col-lg-3 d-grid">

                    <button
                        class="btn btn-primary">

                        <i class="fa-solid fa-search me-2"></i>

                        Search

                    </button>

                </div>

            </div>

        </form>

    </div>

</div>

<div class="card shadow-sm border-0">

    <div class="table-responsive">

        <table class="table table-hover align-middle mb-0">

            <thead class="table-light">

            <tr>

                <th>Program</th>
                <th>Language</th>
                <th>Category</th>
                <th>Duration</th>
                <th>Priority</th>
                <th>Status</th>
                <th width="170">Actions</th>

            </tr>

            </thead>

            <tbody>

<?php if (empty($filteredPrograms)): ?>

<tr>

    <td colspan="7" class="text-center py-5">

        <i class="fa-solid fa-radio fa-3x text-secondary mb-3"></i>

        <h5>No Radio Programs Found</h5>

        <p class="text-muted mb-3">

            Create your first radio program to begin building your automation.

        </p>

        <a href="<?= htmlspecialchars($loader->url('radio/programs/create')) ?>"
           class="btn btn-primary">

            <i class="fa-solid fa-plus me-2"></i>

            Create Program

        </a>

    </td>

</tr>

<?php else: ?>

<?php foreach ($filteredPrograms as $program): ?>
    <tr>

    <td>
        <div class="fw-semibold">
            <?= htmlspecialchars((string)($program['name'] ?? '')) ?>
        </div>

        <?php if (!empty($program['description'])): ?>
            <small class="text-muted">
                <?= htmlspecialchars((string)$program['description']) ?>
            </small>
        <?php endif; ?>
    </td>

    <td>
        <?= htmlspecialchars((string)($program['language'] ?? '-')) ?>
    </td>

    <td>
        <?= htmlspecialchars((string)($program['category'] ?? '-')) ?>
    </td>

    <td>
        <?= (int)($program['estimated_duration'] ?? 0) ?> min
    </td>

    <td>
        <?= (int)($program['priority'] ?? 0) ?>
    </td>

    <td>

        <?php if (!empty($program['is_active'])): ?>

            <span class="badge bg-success">
                Active
            </span>

        <?php else: ?>

            <span class="badge bg-secondary">
                Inactive
            </span>

        <?php endif; ?>

    </td>

    <td>

        <a href="<?= htmlspecialchars($loader->url('radio/programs/edit')) ?>&id=<?= (int)$program['id'] ?>"
           class="btn btn-sm btn-outline-primary">

            <i class="fa-solid fa-pen"></i>

        </a>

        <form method="post"
              class="d-inline delete-program-form">

            <input type="hidden"
                   name="action"
                   value="delete">

            <input type="hidden"
                   name="id"
                   value="<?= (int)$program['id'] ?>">

            <button
                type="submit"
                class="btn btn-sm btn-outline-danger">

                <i class="fa-solid fa-trash"></i>

            </button>

        </form>

    </td>

</tr>

<?php endforeach; ?>

<?php endif; ?>

            </tbody>

        </table>

    </div>

</div>

<script>

document.querySelectorAll('.delete-program-form').forEach(function(form){

    form.addEventListener('submit', function(e){

        if(!confirm('Are you sure you want to delete this program?')){

            e.preventDefault();

        }

    });

});

</script>

<?php

$content = ob_get_clean();

require ADMIN_LAYOUTS . '/app.php';