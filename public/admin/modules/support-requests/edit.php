<?php

declare(strict_types=1);

require_once __DIR__ . '/../../bootstrap.php';

ob_start();

use App\Services\SupportRequestService;

$id = (int)($_GET['id'] ?? 0);

$service = new SupportRequestService();

$request = $service->find($id);

if (!$request) {
?>

<div class="container-fluid">

    <div class="alert alert-danger mt-4">

        <i class="fa-solid fa-circle-exclamation me-2"></i>

        Support request not found.

    </div>

</div>

<?php

$content = ob_get_clean();

require ADMIN_LAYOUTS . '/app.php';

return;

}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $status = trim($_POST['status'] ?? '');

    $notes = trim($_POST['admin_notes'] ?? '');

    if ($service->updateRequest($id, $status, $notes)) {

        header(
            'Location: ?module=support-requests&action=view&id=' . $id
        );

        exit;

    }

}

$typeBadge = match ($request['request_type']) {

    'prayer'     => 'primary',

    'financial'  => 'success',

    'volunteer'  => 'warning',

    'sponsor'    => 'info',

    default      => 'secondary',

};

?>

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2 class="mb-1">

                <i class="fa-solid fa-pen-to-square text-warning me-2"></i>

                Edit Support Request

            </h2>

            <p class="text-muted mb-0">

                Request #<?= (int)$request['id']; ?>

            </p>

        </div>

        <a
            href="?module=support-requests&action=view&id=<?= (int)$request['id']; ?>"
            class="btn btn-secondary">

            <i class="fa-solid fa-arrow-left me-2"></i>

            Back

        </a>

    </div>

    <div class="card shadow-sm border-0 mb-4">

        <div class="card-body">

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Full Name

                    </label>

                    <input
                        type="text"
                        class="form-control"
                        value="<?= htmlspecialchars($request['full_name']); ?>"
                        readonly>

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Email Address

                    </label>

                    <input
                        type="text"
                        class="form-control"
                        value="<?= htmlspecialchars($request['email']); ?>"
                        readonly>

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Phone

                    </label>

                    <input
                        type="text"
                        class="form-control"
                        value="<?= htmlspecialchars($request['phone']); ?>"
                        readonly>

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Country

                    </label>

                    <input
                        type="text"
                        class="form-control"
                        value="<?= htmlspecialchars($request['country']); ?>"
                        readonly>

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Request Type

                    </label>

                    <div>

                        <span class="badge bg-<?= $typeBadge ?>">

                            <?= ucfirst($request['request_type']) ?>

                        </span>

                    </div>

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Status

                    </label>

                    <select
                        name="status"
                        class="form-select">
                            <option value="new"
                                <?= $request['status'] === 'new' ? 'selected' : ''; ?>>
                                New
                            </option>

                            <option value="contacted"
                                <?= $request['status'] === 'contacted' ? 'selected' : ''; ?>>
                                Contacted
                            </option>

                            <option value="in_progress"
                                <?= $request['status'] === 'in_progress' ? 'selected' : ''; ?>>
                                In Progress
                            </option>

                            <option value="completed"
                                <?= $request['status'] === 'completed' ? 'selected' : ''; ?>>
                                Completed
                            </option>

                        </select>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <form method="post">

        <input
            type="hidden"
            name="status"
            value="<?= htmlspecialchars($request['status']); ?>"
            id="selectedStatus">

        <div class="card shadow-sm border-0 mb-4">

            <div class="card-header bg-light">

                <h5 class="mb-0">

                    <i class="fa-solid fa-file-lines me-2"></i>

                    Request Details

                </h5>

            </div>

            <div class="card-body">

                <div class="mb-3">

                    <label class="form-label">

                        Subject

                    </label>

                    <input
                        type="text"
                        class="form-control"
                        value="<?= htmlspecialchars($request['subject']); ?>"
                        readonly>

                </div>

                <div class="mb-3">

                    <label class="form-label">

                        Ministry Area

                    </label>

                    <input
                        type="text"
                        class="form-control"
                        value="<?= htmlspecialchars($request['ministry_area']); ?>"
                        readonly>

                </div>

                <div class="mb-0">

                    <label class="form-label">

                        Message

                    </label>

                    <textarea
                        class="form-control"
                        rows="8"
                        readonly><?= htmlspecialchars($request['message']); ?></textarea>

                </div>

            </div>

        </div>

        <div class="card shadow-sm border-0 mb-4">

            <div class="card-header bg-light">

                <h5 class="mb-0">

                    <i class="fa-solid fa-note-sticky me-2"></i>

                    Admin Notes

                </h5>

            </div>

            <div class="card-body">

                <textarea
                    name="admin_notes"
                    class="form-control"
                    rows="6"
                    placeholder="Internal ministry notes..."><?= htmlspecialchars($request['admin_notes'] ?? ''); ?></textarea>

            </div>

        </div>

        <div class="d-flex justify-content-between">

            <a
                href="?module=support-requests&action=view&id=<?= (int)$request['id']; ?>"
                class="btn btn-secondary">

                <i class="fa-solid fa-arrow-left me-2"></i>

                Cancel

            </a>

            <div>

                <a
                    href="?module=support-requests&action=delete&id=<?= (int)$request['id']; ?>"
                    class="btn btn-danger me-2"
                    onclick="return confirm('Are you sure you want to delete this request?');">

                    <i class="fa-solid fa-trash me-2"></i>

                    Delete

                </a>

                <button
                    type="submit"
                    class="btn btn-success">

                    <i class="fa-solid fa-floppy-disk me-2"></i>

                    Save Changes

                </button>

            </div>

        </div>

    </form>

</div>

<script>

document.addEventListener('DOMContentLoaded', function () {

    const statusSelect = document.querySelector('.form-select');
    const hiddenStatus = document.getElementById('selectedStatus');

    if (statusSelect && hiddenStatus) {

        statusSelect.addEventListener('change', function () {

            hiddenStatus.value = this.value;

        });

    }

});

</script>

<?php

$content = ob_get_clean();

require ADMIN_LAYOUTS . '/app.php';
                        