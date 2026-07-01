<div class="card shadow border-0 h-100">

    <div class="card-header bg-warning">

        <h5 class="mb-0">
            🙏 Recent Prayer Requests
        </h5>

    </div>

    <div class="card-body">

        <?php

        $file = __DIR__ . '/../../storage/prayers.json';

        if(file_exists($file)){

            $prayers = json_decode(file_get_contents($file), true);

            $prayers = array_reverse($prayers);

            $count = 0;

            foreach($prayers as $prayer){

                if($count==5) break;

                ?>

                <div class="border-bottom pb-2 mb-2">

                    <strong><?= htmlspecialchars($prayer['name']) ?></strong>

                    <br>

                    <small>

                      <?php

$name = htmlspecialchars($prayer['name'] ?? 'Anonymous');

$status = htmlspecialchars($prayer['status'] ?? 'New');

$request = htmlspecialchars(
    mb_strimwidth(
        $prayer['request'] ?? 'No prayer request available.',
        0,
        70,
        '...'
    )
);

?>

<div class="border-bottom pb-3 mb-3">

    <div class="d-flex justify-content-between">

        <strong><?= $name ?></strong>

        <span class="badge bg-warning">

            <?= $status ?>

        </span>

    </div>

    <small class="text-muted">

        <?= $request ?>

    </small>

</div>

                    </small>

                </div>

                <?php

                $count++;

            }

        }

        ?>

    </div>

</div>
