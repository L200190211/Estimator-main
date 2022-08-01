<?php
// Function Time Ago
function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}
?>

<li class="nav-item dropdown">
    <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
        <i class="bi bi-bell"></i>
        <span class="badge bg-primary badge-number" id="total-notifikasi"><?= $unread != 0 ? $unread : '' ?></span> </a>

    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
        <li class="dropdown-header">
            Semua Notifikasi
            <a href="#" id="tandai-dibaca"><span class="badge rounded-pill bg-primary p-2 ms-2">Tandai semua dibaca</span></a>
        </li>
        <?php foreach($notifikasi as $data){ ?>
        <li>
            <hr class="dropdown-divider" />
        </li>

        <li class="notification-item" style="<?= $data->isRead == 0 ? 'background: rgba(26, 92, 238, 0.05)' : '' ?>">
            <i class="bi bi-exclamation-circle text-warning"></i>
            <div>
                <h4><?= $data->title ?></h4>
                <p><?= $data->content ?></p>
                <p><?= time_elapsed_string("$data->created_at") ?></p>
            </div>
        </li>

        <?php } ?>

        <li>
            <hr class="dropdown-divider" />
        </li>
        <li class="dropdown-footer">
            <a href="<?= base_url('notifikasi') ?>">Tampilkan semua notifikasi</a>
        </li>
    </ul>
</li>
<script>
    $('#tandai-dibaca').on('click', function(e) {
            e.preventDefault();
            var token = "<?= csrf_hash() ?>";
                $.ajax({
                    type: "POST",
                    url: "<?= base_url('notifikasi/sudah-dibaca'); ?>",
                    data: {
                        csrf_test_name: token,
                    },
                    success: function(data) {
                        $('.notification-item2').css({ 'background' : ''})
                        $('.notification-item').css({ 'background' : ''})
                        $('#total-notifikasi').text('')
                    }
                });
        });
</script>