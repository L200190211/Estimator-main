<?= $this->extend('layout/layout_page'); ?>
<?= $this->section('content'); ?>
<?php
// Function Time Ago
function time_elapsed_string2($datetime, $full = false) {
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
    <div class="row">
        <div class="col">

            <div class="card">
                <div class="card-body">
                    <div class="d-flex bd-highlight">
                        <div class="p-2 flex-grow-1 bd-highlight">
                            <h5 class="card-title"><?= $title; ?></h5>
                        </div>
                        <div class="p-2 bd-highlight ">
                            <a href="<?= base_url('produk/create'); ?>" class="" style="margin: 10px 0 10px 0;">
                                <h5 class="card-title" id="sudah-dibaca">Sudah Dibaca</h5>
                            </a>
                        </div>
                    </div>
                    <ul class="notifications2">
                        <?php foreach($notifikasi as $data){ ?>
                        <li>
                            <hr class="dropdown-divider" />
                        </li>
                        <a href="">
                            <li class="notification-item2" style="<?= $data->isRead == 0 ? 'background: rgba(26, 92, 238, 0.05)' : '' ?>">
                                <i class="bi bi-exclamation-circle text-warning"></i>
                                <div>
                                    <h4><?= $data->title ?></h4>
                                    <p><?= $data->content ?></p>
                                    <p><?= time_elapsed_string2("$data->created_at") ?></p>
                                </div>
                            </li>
                        </a>

                        <?php } ?>
                        
                    </ul>
                </div>
            </div>
        </div>
    </div>
<?= $this->endSection(); ?>
<?= $this->section('js'); ?>
<script>
    $('#sudah-dibaca').on('click', function(e) {
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
<?= $this->endSection(); ?>
