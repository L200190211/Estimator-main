<?=
$uri = new \CodeIgniter\HTTP\URI();
$uri = service('uri');
?>

<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link <?= $title == 'Dashboard' ? '' : 'collapsed'; ?>" href="<?= base_url(''); ?>">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <!-- End Dashboard Nav -->

        <li class="nav-item">
            <a class="nav-link <?= $title == 'Produk' || $title == 'Wilayah Produk' || $title == 'Iklan Produk' ? '' : 'collapsed'; ?>" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-cart2"></i><span>Produk</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-nav" class="nav-content collapse <?= $title == 'Produk' || $title == 'Wilayah Produk' || $title == 'Iklan Produk' ? 'show' : ''; ?>" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="<?= base_url('produk') ?>" class="<?= $title == 'Produk' ? 'active' : ''; ?>">
                        <i class="bi bi-circle"></i><span>Produk</span>
                    </a>
                </li>
                <li>
                    <a class="<?= $title == 'Wilayah Produk' || $title == 'Edit Wilayah Produk' || $title == 'Tambah Wilayah Produk' ? 'active' : ' '; ?>" href="<?= base_url('/wilayah-produk'); ?>">
                        <i class="bi bi-circle"></i><span>Wilayah Produk</span>
                    </a>
                </li>
                <li>
                    <a class="<?= $title == 'Iklan Produk' || $title == 'Tambah Iklan Produk' ? 'active' : ' '; ?>" href="<?= base_url('/produk/iklan'); ?>">
                        <i class="bi bi-circle"></i><span>Paket Produk</span>
                    </a>
                </li>
            </ul>
        </li>
        <!-- End Produk Nav -->

        <li class="nav-item">
            <a class="nav-link <?= $title == 'Kategori Produk' ? '' : 'collapsed'; ?>" href="<?= base_url('kategori') ?>">

                <i class="bi bi-journal-text"></i><span>Kategori</span></i>
            </a>
        </li>
        <!-- End Kategori Nav -->

        <li class="nav-item">
            <a class="nav-link <?= $title == 'Ulasan Produk' || $title == 'Ulasan Suplier' ? '' : 'collapsed'; ?>" data-bs-target="#ulasan-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-star"></i><span>Ulasan</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="ulasan-nav" class="nav-content collapse <?= $title == 'Ulasan Produk' || $title == 'Ulasan Suplier' ? 'show' : ''; ?>" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="/ulasan-produk" class="<?= $title == 'Ulasan Produk' ? 'active' : ''; ?>">
                        <i class="bi bi-circle"></i><span>Ulasan Produk</span>
                    </a>
                </li>
                <li>
                    <a href="/ulasan-suplier" class="<?= $title == 'Ulasan Suplier' ? 'active' : ''; ?>">
                        <i class="bi bi-circle"></i><span>Ulasan Suplier</span>
                    </a>
                </li>
            </ul>
        </li>
        <!-- End Ulasan Nav -->

        <li class="nav-item">
            <a class="nav-link <?= $title == 'Profil Suplier' || $title == 'Wilayah Distribusi' ? '' : 'collapsed'; ?>" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-person"></i><span>Profil</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="charts-nav" class="nav-content collapse <?= $title == 'Profil Suplier' || $title == 'Wilayah Distribusi' ? 'show' : ''; ?>" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="/profile" class="<?= $title == 'Profil Suplier' ? 'active' : ''; ?>">
                        <i class="bi bi-circle"></i><span>Profile</span>
                    </a>
                </li>
                <li>
                    <a href="/wilayah-distribusi" class="<?= $title == 'Wilayah Distribusi' ? 'active' : ''; ?>">
                        <i class="bi bi-circle"></i><span>Wilayah Distributor Suplier</span>
                    </a>
                </li>
            </ul>
        </li>
        <!-- End Profile Nav -->

        <li class="nav-item">
            <a class="nav-link <?= $title == 'Riwayat Transaksi' || $title == 'Transaksi' || $title == 'Promo' ? '' : 'collapsed'; ?>" data-bs-target="#penjualan-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-currency-dollar"></i><span>Penjualan</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="penjualan-nav" class="nav-content collapse <?= $title == 'Transaksi' || $title == 'Promo' || $title == 'Produk Promo' || $title == 'Riwayat Transaksi' ? 'show' : ''; ?>" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="/transaksi" class="<?= $title == 'Transaksi' ? 'active' : ''; ?>">
                        <i class="bi bi-circle"></i><span>Transaksi</span>
                    </a>
                </li>
                <li>
                    <a href="/promo" class="<?= $title == 'Promo' ? 'active' : ''; ?>">
                        <i class="bi bi-circle"></i><span>Kode Promo</span>
                    </a>
                </li>
                <li>
                    <a href="/promo-produk" class="<?= $title == 'Produk Promo' ? 'active' : ''; ?>">
                        <i class="bi bi-circle"></i><span>Produk Promo</span>
                    </a>
                </li>
            </ul>
        </li>
        <!-- End Penjualan Nav -->
    </ul>
</aside>