-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 24, 2022 at 04:14 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `estimator`
--

-- --------------------------------------------------------

--
-- Table structure for table `foto_produk`
--

CREATE TABLE `foto_produk` (
  `id` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `file_name` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `foto_produk`
--

INSERT INTO `foto_produk` (`id`, `id_produk`, `file_name`) VALUES
(29, 127, '3c.jpg'),
(30, 127, '3b.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `iklan_produk`
--

CREATE TABLE `iklan_produk` (
  `id_iklan` int(11) UNSIGNED NOT NULL,
  `id_produk` int(11) NOT NULL,
  `id_paket` int(11) NOT NULL,
  `expired` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `kategori_produk`
--

CREATE TABLE `kategori_produk` (
  `id_kategori` int(11) NOT NULL,
  `kategori` varchar(100) NOT NULL,
  `icon` varchar(25) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori_produk`
--

INSERT INTO `kategori_produk` (`id_kategori`, `kategori`, `icon`) VALUES
(1, 'Penutup Lantai', 'th-list'),
(2, 'Penutup Dinding', 'th-list'),
(3, 'Struktur Dinding', 'th-list'),
(4, 'Pintu, Jendela dan Asesoris', 'th-list'),
(5, 'Penutup Atap', 'th-list'),
(6, 'Struktur Penutup Atap ', 'th-list'),
(7, 'Sanitair dan Asesoris', 'th-list'),
(8, 'Mekanikal dan Elektrikal', 'th-list'),
(9, 'Plumbing', 'th-list'),
(10, 'Alat dan Perlengkapan', 'th-list'),
(11, 'Struktur Lain', 'th-list');

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE `keranjang` (
  `id_keranjang` int(11) UNSIGNED NOT NULL,
  `id_pengguna` int(11) NOT NULL,
  `id_promo` int(11) NOT NULL,
  `status` enum('belum checkout','sudah checkout') NOT NULL DEFAULT 'belum checkout',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `keranjang_item`
--

CREATE TABLE `keranjang_item` (
  `id_keranjang_item` int(11) UNSIGNED NOT NULL,
  `id_keranjang` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `kuantitas` varchar(20) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(33, '2022-05-10-040914', 'App\\Database\\Migrations\\Tags', 'default', 'App', 1656036847, 1),
(34, '2022-05-18-023016', 'App\\Database\\Migrations\\IklanProduk', 'default', 'App', 1656036847, 1),
(35, '2022-06-22-080012', 'App\\Database\\Migrations\\KeranjangItem', 'default', 'App', 1656036847, 1),
(36, '2022-06-22-081235', 'App\\Database\\Migrations\\Keranjang', 'default', 'App', 1656036847, 1),
(37, '2022-06-22-111831', 'App\\Database\\Migrations\\Transaksi', 'default', 'App', 1656036847, 1),
(38, '2022-06-22-112210', 'App\\Database\\Migrations\\PromoProduk', 'default', 'App', 1656036847, 1),
(39, '2022-06-22-112904', 'App\\Database\\Migrations\\Promo', 'default', 'App', 1656036847, 1),
(40, '2022-06-22-130658', 'App\\Database\\Migrations\\Notifikasi', 'default', 'App', 1656036847, 1);

-- --------------------------------------------------------

--
-- Table structure for table `notifikasi`
--

CREATE TABLE `notifikasi` (
  `id_notifikasi` int(11) UNSIGNED NOT NULL,
  `id_pengguna` int(11) NOT NULL,
  `content` varchar(255) NOT NULL,
  `isRead` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `id_pengguna` int(11) NOT NULL,
  `nama_pengguna` varchar(50) DEFAULT NULL,
  `profil` text NOT NULL,
  `alamat` text DEFAULT NULL,
  `id_wilayah` varchar(7) NOT NULL,
  `perusahaan` varchar(100) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `no_telp` varchar(15) DEFAULT NULL,
  `no_wa` varchar(15) NOT NULL,
  `website` varchar(50) NOT NULL,
  `password` varchar(64) DEFAULT NULL,
  `foto` varchar(250) DEFAULT NULL,
  `kategori_akun` char(1) NOT NULL,
  `status` char(1) DEFAULT NULL,
  `kode_verifikasi` varchar(20) NOT NULL,
  `status_verifikasi` char(1) NOT NULL,
  `tags` varchar(100) NOT NULL,
  `tgl_daftar` date DEFAULT NULL,
  `jam_daftar` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id_pengguna`, `nama_pengguna`, `profil`, `alamat`, `id_wilayah`, `perusahaan`, `email`, `no_telp`, `no_wa`, `website`, `password`, `foto`, `kategori_akun`, `status`, `kode_verifikasi`, `status_verifikasi`, `tags`, `tgl_daftar`, `jam_daftar`) VALUES
(2, 'Indofon', 'CV Indonesia Plafon Semesta adalah sebuah perusahaan swasta yang bergerak di bidang pengadaan bahan plafon berbahan Polivinil Clorida (PVC). Berdiri secara resmi pada awal Maret 2015, CV Indonesia Plafon Semesta telah bekerjasama dengan beberapa perusahaan khususnya wilayah Yogyakarta, Semarang, Bali, Lombok, dan area lain. Bersamaan dengan perkembangan waktu dan semakin banyaknya persaingan produksi dan jasa pemasangan plafon. Dengan dibekali pengalaman dan tenaga-tenaga kerja yang profesional kami berharap akan memberikan pelayanan yang memuaskan bagi para pelanggan-pelanggan pengguna jasa kami. Visi menjadi perusahaan yang mampu menyediakan kebutuhan design interior spesialis plafon yang berkualitas bagi perusahaan, instansi, maupun individu. Misi 1. Menjadi merk terbaik dengan mengedepankan kualitas; 2. Mampu memenuhi kebutuhan yang diperlukan klien; 3. Menyediakan barang dan jasa yang berkualitas dengan harga bersaing; 4. Bekerja secara profesional dan tepat waktu.\r\n', 'Jalan Gedongan Tempel Km 2.5 Jaban RT 06 RW 37 Sendangrejo Minggir Sleman Yogyakarta 55562\r\n', '3404', 'CV Indonesia Plafon Semesta', 'indofonpvc@gmail.com', '0274-2822833', '082138579056', 'www.indofon.com', '$2y$10$Vei81jBRBVAM3MG8l32BQOsXnUFFn8nBb9PrPY4BSSw0ECHtlbwMG', 'logo-indofon.jpg', '3', '1', '', '1', 'plavon, pvc', '2019-07-23', '03:02:06'),
(3, 'Alumetalec', 'Kami adalah distributor tunggal produk Aluminium Composite Panel dengan merk Alumetalec Evo di Indonesia sejak tahun 2008.', 'Ruko Peterongan Plaza B-5, Jalan MT. Haryono 719 Semarang', '3374', 'PT Almindo Jaya Abadi (Alumetalec Evo)', 'almindo-smg@almindo.com', '024-8412700', '08882573469', 'www.alumetalec.com', '$2y$10$5EOeme8cJmfImUQjL8qQHeRFiUWBvTzQfrzs4qcMfhNRNLmiElS5G', 'logo-alumetalec.jpg', '3', '1', '', '1', 'alumunium, panel', '2019-07-23', '03:17:19'),
(4, 'Opple', 'Opple merupakan perusahaan lighting multinational terbesar di China yang memiliki fasilitas pabrikasi terbesar di China dan sudah beroperasi di 70 negara. \r\n', 'Jalan Pluit Selatan Raya No. 1 \r\nRuko CBD Pluit Blok A No. 21\r\nJakarta Utara', '3175', 'Opple', 'admin@gmail.com', '08119400490', '08119400490', 'www.opple.com', '$2y$10$mRXsGgHJzQV/s6p425T0L.YEGhksqqkLus8yJo.Q93sAYTTkaXjfK', 'logo-opple.jpg', '3', '1', '', '1', 'lighting, lampu, led', '2019-07-19', '08:17:19'),
(5, 'KH Beton', 'KH Beton adalah perusahaan manufaktur yang bergerak di bidang Industri Beton Mutu Tinggi (High Performance Concrete. Sebagai badan usaha swasta, KH Beton lahir dan memulai usaha industri beton pracetak pada tahun 2014 dengan mengembangkan produk-produknya yang didasari oleh semangat “INNOVATIVE CONCRETE INDUSTRI”. Pengembangan produk-produk tersebut telah berhasil menghasilkan beberapa produk yang inovatif. Dalam perkembangan produk-produknya, KH Beton selalu mengedepankan mutu dan kualitas beton, dengan cara memilih bahan baku material yang berkualitas, menggunakan peralatan yang mendukung, serta memiliki sumber daya manusia yang berpengalaman dan profesional. panel\r\n\r\n', 'Jalan Boyolali-Magelang Km. 5 Kel. Jelok, Kec.Cepogo, Kab.Boyolali', '3309', 'KH Beton', 'khbetonhpc@gmail.com', '0276-320015', '085786777333', 'www.khbeton.com', '$2y$10$JGmX47xUPwOyz3FYmx1LhudaODMWUX.oAZ8RqBaqwSchz2FLaIPFa', 'logo-khbeton.jpg', '3', '1', '', '1', 'paving, beton', '2019-08-07', '11:54:00'),
(6, 'Sarana Cipta Graha', 'Sarana Cipta Graha', 'Jalan KH. Agus Salim Blok D/18 A Semarang', '3374', 'CV Sarana Cipta Graha', 'saranaciptagraha_smg@yahoo.com', '024-3513666 ', '081228336336', '', '$2y$10$Beo8dAQ5IfjAvfscSCzcXuY49ylnxg1e7T6Xp0z4FXJcvDXIZ7kEC', 'logo-scg.jpg', '3', '1', '', '1', 'keramik, roman', '2019-08-07', '11:58:00'),
(262, 'ABB', '', '7th Floor, CCM Building Jl. Cikini Raya No. 95 Jakarta 10330', '3100', 'PT. ABB SAKTI INDUSTRI', 'wagner.manurung@id.abb.com', '021-29290255', '8129002672', 'www.abb.com', '$2y$10$wiUHp6fXfiuQ0au3JA851OFaqAPxUf5QpGM5DizhnK3zU74rdezNe', 'no_foto.jpg', '3', '1', '', '1', '', '2019-11-02', '13:00:00'),
(263, 'Alumetalec', '', 'Ruko Peterongan Plaza B5 Jl. MT.Haryono 719', '3374', 'PT. ALMINDO JAYA ABADI', 'almindo-smg@almindo.com', '024-8412700', '85726866688', 'www.alumetalec.com', '$2y$10$wiUHp6fXfiuQ0au3JA851OFaqAPxUf5QpGM5DizhnK3zU74rdezNe', 'no_foto.jpg', '3', '1', '', '1', '', '2019-11-02', '13:00:00'),
(264, 'American Standard', '', 'Alamanda Tower Building 31 Floor Jl. TB . Simatupang Kav. 22-26 Cilandak', '3171', 'PT. AMERICAN STANDARD INDONESIA', 'tisa.kusdiantinah@lixil.com', '021-29660296', '87838857059', 'www.americanstandard.co.id', '$2y$10$wiUHp6fXfiuQ0au3JA851OFaqAPxUf5QpGM5DizhnK3zU74rdezNe', 'no_foto.jpg', '3', '1', '', '1', '', '2019-11-02', '13:00:00'),
(265, 'Bluescope', '', 'Gedung BRI II Lantai 9 Jl. Jend.Sudirman Kav.44-46', '3173', 'PT. NS BLUESCOPE INDONESIA', 'monika.frederika@bluescope.com', '021-57905415', '8121007659', 'www.bluescopesteel.co.id', '$2y$10$wiUHp6fXfiuQ0au3JA851OFaqAPxUf5QpGM5DizhnK3zU74rdezNe', 'no_foto.jpg', '3', '1', '', '1', '', '2019-11-02', '13:00:00'),
(266, 'BROMINDO', '', 'Jl. Magelang No. 32-34 Bumijo Jetis', '3400', 'PT. BROMINDO MEKAR MITRA', 'salesdiy@bromindo.com', '0274-517585', '88999850888', 'www.bromindo.com', '$2y$10$wiUHp6fXfiuQ0au3JA851OFaqAPxUf5QpGM5DizhnK3zU74rdezNe', 'no_foto.jpg', '3', '1', '', '1', '', '2019-11-02', '13:00:00'),
(267, 'BJ HOME', '', 'Jl. Raya Janti No. 96 Blok O Banguntapan', '3402', 'PT. BANGUNAN JAYA MANDIRI', 'puriwigatilistiyati@gmail.com', '0274-4932288', '85229841525', 'www.bjhome.jogja.com', '$2y$10$wiUHp6fXfiuQ0au3JA851OFaqAPxUf5QpGM5DizhnK3zU74rdezNe', 'no_foto.jpg', '3', '1', '', '1', '', '2019-11-02', '13:00:00'),
(268, 'Cahaya Mas Cemerlang', '', 'Jl. Perum Menganti Permai Blok B-1 No.1 Menganti', '3525', 'PT. CAHAYA MAS CEMERLANG', 'info@cahayamascemerlang.com', '031-7871245', '', 'www.cahayamascemerlang.com', '$2y$10$wiUHp6fXfiuQ0au3JA851OFaqAPxUf5QpGM5DizhnK3zU74rdezNe', 'no_foto.jpg', '3', '1', '', '1', '', '2019-11-02', '13:00:00'),
(269, 'Conwood', '', 'Menara Jamsostek, North Tower 14th Fl,Jl. Jend. Gatot Subroto No.38, South Jakarta 12710 ', '3100', 'PT. CONWOOD INDONESIA', 'hedhy.kurnianti@siamcitycement.com', '021-52962146', '87781869451', 'www.conwood.co.id', '$2y$10$wiUHp6fXfiuQ0au3JA851OFaqAPxUf5QpGM5DizhnK3zU74rdezNe', 'no_foto.jpg', '3', '1', '', '1', '', '2019-11-02', '13:00:00'),
(270, 'Daiken Door', '', 'Jl. Ngemplak No.30 Komplek Ambengan Plaza Blok B.21', '3578', 'PT. SUMBER SETIA ABADI', 'indragunawan81@gmail.com', '031-5451133', '817301027', 'www.daiken-ad.com', '$2y$10$wiUHp6fXfiuQ0au3JA851OFaqAPxUf5QpGM5DizhnK3zU74rdezNe', 'no_foto.jpg', '3', '1', '', '1', '', '2019-11-02', '13:00:00'),
(271, 'Daikin AC', '', 'Jl. Magelang No.76 RT.052 RW.14 Karangwaru Tegalrejo', '3400', 'PT. DAIKIN AIRCONDITIONING INDONESIA', 'febrian.mahmud@daikin.co.id', '0274-551321', '8995190532', 'www.daikin.co.id', '$2y$10$wiUHp6fXfiuQ0au3JA851OFaqAPxUf5QpGM5DizhnK3zU74rdezNe', 'no_foto.jpg', '3', '1', '', '1', '', '2019-11-02', '13:00:00'),
(272, 'Dekkson', '', 'Jl. Daan Mogot KM.12,8Kompleks Daan Mogot Prima Kav.3 No.2', '3174', 'PT. FAJAR LESTARI ADIPERKASA', 'marketing@dekkson.com', '021-6190255', '811809596', 'www.dekkson.com', '$2y$10$wiUHp6fXfiuQ0au3JA851OFaqAPxUf5QpGM5DizhnK3zU74rdezNe', 'no_foto.jpg', '3', '1', '', '1', '', '2019-11-02', '13:00:00'),
(273, 'Geasindo', '', 'Jl. Kaji Raya No.25 Jakarta Pusat 10130', '3100', 'PT. GEASINDO TEKNIK PRIMA', 'radenridwanwahyudi@gmail.com', '021-6329462', '81289482804', 'www.geasindo.co.id', '$2y$10$wiUHp6fXfiuQ0au3JA851OFaqAPxUf5QpGM5DizhnK3zU74rdezNe', 'no_foto.jpg', '3', '1', '', '1', '', '2019-11-02', '13:00:00'),
(274, 'Magna', '', 'Komplek Green Lake City Ruko Crown Blok K no.26-27 Kel.Petir Kec.Cipondoh', '3671', 'PT. BAJA BAHANA UTAMA', 'rony@gigasteel.co.id', '021-22522853', '8121085827', 'www.magnasystem.co.id', '$2y$10$wiUHp6fXfiuQ0au3JA851OFaqAPxUf5QpGM5DizhnK3zU74rdezNe', 'no_foto.jpg', '3', '1', '', '1', '', '2019-11-02', '13:00:00'),
(275, 'Indosteel', '', 'Jl. Petung No.3 Caturtunggal Depok', '3404', 'CV. FADJAR ABADI SEDJAHTERA', 'fasbaru2018@gmail.com', '0274-560979', '85878210555', 'www.indozteel.com', '$2y$10$wiUHp6fXfiuQ0au3JA851OFaqAPxUf5QpGM5DizhnK3zU74rdezNe', 'no_foto.jpg', '3', '1', '', '1', '', '2019-11-02', '13:00:00'),
(276, 'Jiyu ACP', '', 'KOMPLEKS ERAPRIMA BLOK P.17-18 JL. DAAN MOGOT KM.21 BATU CEPER Tangerang', '3600', 'PT. KREASI MARGANDA SEJAHTERA', 'henrywisnususanto36@gmail.com', '021-55727175', '82242560575', 'www.jiyuindonesia.com', '$2y$10$wiUHp6fXfiuQ0au3JA851OFaqAPxUf5QpGM5DizhnK3zU74rdezNe', 'no_foto.jpg', '3', '1', '', '1', '', '2019-11-02', '13:00:00'),
(277, 'JOTUN', '', 'Kawasan Industri MM2100, Jl. Irian III Blok KK, Kec. Cikarang Barat, Jalan Irian 3, Jatiwangi, Cikarang Barat', '3275', 'PT. JOTUN INDONESIA', 'antonius.purnomo@jotun.com', '089982657', '8170002720', 'www.jotun.com', '$2y$10$wiUHp6fXfiuQ0au3JA851OFaqAPxUf5QpGM5DizhnK3zU74rdezNe', 'no_foto.jpg', '3', '1', '', '1', '', '2019-11-02', '13:00:00'),
(278, 'Kansai Paint', '', 'Sahid Sudirman Center Lt. 47 Unit E dan F Jl. Jend. Sudirman No.86', '3100', 'PT. KANSAI PRAKARSA COATING', 'andreas.prasetyo@kansaicoatings.co.id', '021-2520409', '82298483837', 'www.kansaicoatings.com', '$2y$10$wiUHp6fXfiuQ0au3JA851OFaqAPxUf5QpGM5DizhnK3zU74rdezNe', 'no_foto.jpg', '3', '1', '', '1', '', '2019-11-02', '13:00:00'),
(279, 'Kends', '', 'Jl. Arteri Kaliwungu Semarang Kendal No. 2 Kel. Sumberejo Kec.Kaliwungu', '3324', 'PT. TERRYHAM PROPLAS INDONESIA', 'info@kendsupvc.com', '024-76433657', '82341088557', 'www.kendsupvc.com', '$2y$10$wiUHp6fXfiuQ0au3JA851OFaqAPxUf5QpGM5DizhnK3zU74rdezNe', 'no_foto.jpg', '3', '1', '', '1', '', '2019-11-02', '13:00:00'),
(280, 'KH Beton', '', 'DESA JOMBORAN, MOJOSONGO, BOYOLALI', '3309', 'PT. KH. BETON', 'khbetonhp@gmail.com', '0276-320015', '81527855785', 'www.khbeton.com', '$2y$10$wiUHp6fXfiuQ0au3JA851OFaqAPxUf5QpGM5DizhnK3zU74rdezNe', 'no_foto.jpg', '3', '1', '', '1', '', '2019-11-02', '13:00:00'),
(281, 'Knauf', '', 'Prisma II Blok B 2 No. 27 Kebon Jeruk', '3174', 'CV. Bintang Artha Cemerlang', 'hardanto.k@gmail.com', '021-5357301', '817827018', 'www.knauf.co.id', '$2y$10$wiUHp6fXfiuQ0au3JA851OFaqAPxUf5QpGM5DizhnK3zU74rdezNe', 'no_foto.jpg', '3', '1', '', '1', '', '2019-11-02', '13:00:00'),
(282, 'LG', '', 'Gandaria 8 Office Tower, Lantai 31 Jl. Sultan Iskandar Muda Kebayoran Lama', '3100', 'PT. LG Electronics Indonesia', 'haning.budiutomo@lge.com', '021-29304000', '81234314113', 'www.lg.com', '$2y$10$wiUHp6fXfiuQ0au3JA851OFaqAPxUf5QpGM5DizhnK3zU74rdezNe', 'no_foto.jpg', '3', '1', '', '1', '', '2019-11-02', '13:00:00'),
(283, 'Nusaboard', '', 'JL. RAYA SEMARANG-DEMAK KM.17 DESA WONOKERTO DEMAK 59561', '3321', 'PT. NUSANTARA BUILDING INDUSTRIES', 'marketing@nusaboard.co.id', '0291-686050', '82232441234', 'www.nusaboard.co.id', '$2y$10$wiUHp6fXfiuQ0au3JA851OFaqAPxUf5QpGM5DizhnK3zU74rdezNe', 'no_foto.jpg', '3', '1', '', '1', '', '2019-11-02', '13:00:00'),
(284, 'NVC', '', 'Ruko Pandega No.7 Ring Road Utara', '3404', 'PT. MEGA KARYA MITRA PERSADA', 'sales@mk-mp.com', '0274-4399792', '8122743463', 'www.mk-mp.com', '$2y$10$wiUHp6fXfiuQ0au3JA851OFaqAPxUf5QpGM5DizhnK3zU74rdezNe', 'no_foto.jpg', '3', '1', '', '1', '', '2019-11-02', '13:00:00'),
(285, 'Omni Electrindo', '', 'Jl. Sidodadi Timur No. 22 A', '3374', 'PT. OMNI ELECTRINDO', 'marketing@omnielectrindo.com', '024-8451435', '81228712202', 'www.omnielectrindo.com', '$2y$10$wiUHp6fXfiuQ0au3JA851OFaqAPxUf5QpGM5DizhnK3zU74rdezNe', 'no_foto.jpg', '3', '1', '', '1', '', '2019-11-02', '13:00:00'),
(286, 'Onduline', '', 'Jl. Raya Tajem No.2 Maguwoharjo', '3404', 'PT. SURYA GRAHA ARTHAMAS', 'sgajogja@gmail.com', '0274-4462472', '82227381636', 'www.sgajogja.com', '$2y$10$wiUHp6fXfiuQ0au3JA851OFaqAPxUf5QpGM5DizhnK3zU74rdezNe', 'no_foto.jpg', '3', '1', '', '1', '', '2019-11-02', '13:00:00'),
(287, 'Opple', '', 'Jl. Pluit Selatan Raya No. 1 Ruko CBD Pluit Blok A No.21', '3175', 'PT. OPPLE LIGHTING INDONESIA INTERNATIONAL', 'arip@opple.com', '081281850387', '8119400490', 'www.opple.com', '$2y$10$wiUHp6fXfiuQ0au3JA851OFaqAPxUf5QpGM5DizhnK3zU74rdezNe', 'no_foto.jpg', '3', '1', '', '1', '', '2019-11-02', '13:00:00'),
(288, 'Prima Tunggal Javaland', '', 'Komplek Ruko Mutiara Taman Palem Blok A6 No. 23-25 Jl. Kamal Raya Outer Ring Road Cengkareng', '3174', 'PT. PRIMA TUNGGAL JAVALAND', 'nasikinamin10@gmail.com', '021-54355888', '81314093862', 'www.primatunggal.web.indotrading.com', '$2y$10$wiUHp6fXfiuQ0au3JA851OFaqAPxUf5QpGM5DizhnK3zU74rdezNe', 'no_foto.jpg', '3', '1', '', '1', '', '2019-11-02', '13:00:00'),
(289, 'Propan', '', 'Jl. Madujoro Blok AA/BB No.3', '3374', 'PT. PROPAN RAYA', 'heri.kurniawan@propanraya.com', '024-7622117', '81325851168', 'www.propanraya.com', '$2y$10$wiUHp6fXfiuQ0au3JA851OFaqAPxUf5QpGM5DizhnK3zU74rdezNe', 'no_foto.jpg', '3', '1', '', '1', '', '2019-11-02', '13:00:00'),
(290, 'Rainbow', '', 'JL. PAJAJARAN 55 GANDASARI', '3671', 'PT. TIMUR MAS ABADI', 'rani@tma.co.id', '02155658080', '8179968841', 'www.rainbow-roof.co.id', '$2y$10$wiUHp6fXfiuQ0au3JA851OFaqAPxUf5QpGM5DizhnK3zU74rdezNe', 'no_foto.jpg', '3', '1', '', '1', '', '2019-11-02', '13:00:00'),
(291, 'Sindotech', '', 'Jl. Parangtritis KM. 4,5 Salakan 2 No. 222 Bangunharjo Sewon', '3402', 'PT. Sindotech Utama', 'sdt274@sindotechutama.com', '0274-413616', '8112653755', 'www.sindotechutama.com', '$2y$10$wiUHp6fXfiuQ0au3JA851OFaqAPxUf5QpGM5DizhnK3zU74rdezNe', 'no_foto.jpg', '3', '1', '', '1', '', '2019-11-02', '13:00:00'),
(292, 'Sundha Plafon', '', 'JL. HOS COKROAMINOTO NO. 157 B', '3400', 'PT. SUNDHA PLAFOND JATENG', 'shunda.yk@gmail.com', '0274-620452', '', 'www.sundhajateng.diy', '$2y$10$wiUHp6fXfiuQ0au3JA851OFaqAPxUf5QpGM5DizhnK3zU74rdezNe', 'no_foto.jpg', '3', '1', '', '1', '', '2019-11-02', '13:00:00'),
(293, 'Toscar Perkasa Indonesia', '', 'Komplek Pertokoan Permata I Blok B-8 Jl. HR.Muhammad Kav.360-380 Surabaya 60226', '3578', 'PT. TOSCARINDO', 'ifan@toscarindo.com', '031-7342189', '81803066155', 'www.toscarindo.com', '$2y$10$wiUHp6fXfiuQ0au3JA851OFaqAPxUf5QpGM5DizhnK3zU74rdezNe', 'no_foto.jpg', '3', '1', '', '1', '', '2019-11-02', '13:00:00'),
(294, 'ZKTeco', '', 'Jl. Gunung Batu Dalam No.43 Pasirkaliki Utara – Cimahi', '3277', 'CV. Tri Daya Berkat Abadi', 'tridaya_bdg@yahoo.com', '022-2027 8082', '8122047199', 'www.zkteco.co.id', '$2y$10$wiUHp6fXfiuQ0au3JA851OFaqAPxUf5QpGM5DizhnK3zU74rdezNe', 'no_foto.jpg', '3', '1', '', '1', '', '2019-11-02', '13:00:00'),
(295, 'Volkslift', '', 'APL TOWER, 20th Floor Jl. Letjen S. Parman Kav-28', '3100', 'PT. UOLA PRIMA SEJAHTERA', 'sales03@uolaps.com', NULL, '85608568182', 'www.uola-volkslift.com', '$2y$10$wiUHp6fXfiuQ0au3JA851OFaqAPxUf5QpGM5DizhnK3zU74rdezNe', 'no_foto.jpg', '3', '1', '', '1', '', '2019-11-02', '13:00:00'),
(296, 'Valentino', '', 'Jl. Percetakan Negara C 253 Rawasari', '3173', 'PT. CAHAYA LESTARI PERMAI ABADI', 'projects@valentinogress.com', '021-4208405', '8121057735', 'www.valentinogress.com', '$2y$10$wiUHp6fXfiuQ0au3JA851OFaqAPxUf5QpGM5DizhnK3zU74rdezNe', 'no_foto.jpg', '3', '1', '', '1', '', '2019-11-02', '13:00:00'),
(297, 'YKK AP', '', 'Panin Dai-ichi Life Jl. S. Parman Kav.91 3A Floor', '3100', 'PT. YKK AP INDONESIA', 'y-hamada@ykkap.co.id', '021-56956333', '85655530800', 'www.ykkap.co.id', '$2y$10$wiUHp6fXfiuQ0au3JA851OFaqAPxUf5QpGM5DizhnK3zU74rdezNe', 'no_foto.jpg', '3', '1', '', '1', '', '2019-11-02', '13:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `id_pengguna` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `nama_produk` varchar(200) NOT NULL,
  `deskripsi` text NOT NULL,
  `spesifikasi` text NOT NULL,
  `merk` varchar(100) NOT NULL,
  `satuan` varchar(15) NOT NULL,
  `harga_dasar` double NOT NULL,
  `tgl_update_harga_dasar` date DEFAULT NULL,
  `min_order` float NOT NULL,
  `free_ongkir` char(1) NOT NULL,
  `garansi` text NOT NULL,
  `status` char(1) NOT NULL,
  `paket` char(1) NOT NULL,
  `tgl_berlaku_paket` date DEFAULT NULL,
  `foto` text NOT NULL,
  `foto_utama` int(2) NOT NULL,
  `tags` varchar(100) NOT NULL,
  `tgl_dibuat` date NOT NULL,
  `tgl_update` date NOT NULL,
  `jam_dibuat` time NOT NULL,
  `dilihat` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `id_pengguna`, `id_kategori`, `nama_produk`, `deskripsi`, `spesifikasi`, `merk`, `satuan`, `harga_dasar`, `tgl_update_harga_dasar`, `min_order`, `free_ongkir`, `garansi`, `status`, `paket`, `tgl_berlaku_paket`, `foto`, `foto_utama`, `tags`, `tgl_dibuat`, `tgl_update`, `jam_dibuat`, `dilihat`) VALUES
(159, 4, 2, 'gg', '<p>gg</p>', '<p>gg</p>', 'gg', 'kg', 1000000, '2022-06-22', 2.5, '1', '<p>gg</p>', '', '3', '2022-06-20', '[\"1655694127_f93d06b3b16b30dcf63b.png\",\"1655863038_f7451f6356a7bbf9cdd2.png\"]', 0, 'gg', '0000-00-00', '0000-00-00', '00:00:00', 0),
(158, 4, 5, 'alksmdlakfm', 'lskdmflsdkmf                                    ', 'lskdmflsm                                    ', 'lskdmflsf', 'sldkfmsd', 123, '2022-06-17', 1, '0', 'lskdmf                                    ', '1', '3', '2022-06-17', '[\"1655451265_324cf340bec78493fbdf.png\"]', 0, 'slkdf', '0000-00-00', '0000-00-00', '00:00:00', 0),
(160, 4, 1, 'mslkdls', 'LKSDLAK                                    ', 'slkasl                                    ', 'ldkslkdLK', 'kg', 11212, '2022-06-20', 2, '0', 'lak                                    ', '1', '3', '2022-06-20', '[\"1655694930_74b9b8b9c22547b22bfc.png\",\"1655694930_1375735967ef10c542c4.png\",\"1655694930_c4047b296be11a96b243.png\"]', 0, 'ldkls,lkd,lskdls', '0000-00-00', '0000-00-00', '00:00:00', 0),
(164, 4, 2, 'haha', '<p>haha</p>', '<p>jaja</p>', 'jaja', 'kg', 20000, '2022-06-22', 20001, '0', '<p>asd</p>', '1', '3', '2022-06-22', '[\"1655871075_3261673aa448362d916f.png\"]', 0, 'asd', '0000-00-00', '0000-00-00', '00:00:00', 0),
(165, 4, 2, 'kaka', '<p>kakak</p>', '<p>kakak</p>', 'kakak', 'kg', 2000, '2022-06-22', 2001, '0', '<p>a</p>', '1', '3', '2022-06-22', '[\"1655871104_1886c2f867120b5ffb81.png\"]', 0, 'ads', '0000-00-00', '0000-00-00', '00:00:00', 0),
(166, 4, 1, 'lala', '<p>lalal</p>', '<p>lalal</p>', 'lala', 'kg', 2100, '2022-06-22', 2000.5, '0', '<p>lala</p>', '1', '3', '2022-06-22', '[\"1655871223_2c274e17669a17499c5b.png\"]', 0, 'asd', '0000-00-00', '0000-00-00', '00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `promo`
--

CREATE TABLE `promo` (
  `id_promo` int(11) UNSIGNED NOT NULL,
  `kode_promo` varchar(30) NOT NULL,
  `diskon` varchar(30) NOT NULL,
  `tgl_mulai` datetime DEFAULT NULL,
  `tgl_akhir` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `promo_produk`
--

CREATE TABLE `promo_produk` (
  `id_promo_produk` int(11) UNSIGNED NOT NULL,
  `id_promo` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `rating_produk`
--

CREATE TABLE `rating_produk` (
  `id_rating` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `id_pengguna` int(11) NOT NULL,
  `rating` char(1) NOT NULL,
  `ulasan` text NOT NULL,
  `tgl_dibuat` date NOT NULL,
  `jam_dibuat` time NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rating_produk`
--

INSERT INTO `rating_produk` (`id_rating`, `id_produk`, `id_pengguna`, `rating`, `ulasan`, `tgl_dibuat`, `jam_dibuat`) VALUES
(17, 39, 0, '5', 'Produk berkualitas', '2019-11-11', '20:34:35');

-- --------------------------------------------------------

--
-- Table structure for table `rating_suplier`
--

CREATE TABLE `rating_suplier` (
  `id_rating` int(11) NOT NULL,
  `id_suplier` int(11) NOT NULL,
  `id_pengguna` int(11) NOT NULL,
  `rating` char(1) NOT NULL,
  `ulasan` text NOT NULL,
  `tgl_dibuat` date NOT NULL,
  `jam_dibuat` time NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rating_suplier`
--

INSERT INTO `rating_suplier` (`id_rating`, `id_suplier`, `id_pengguna`, `rating`, `ulasan`, `tgl_dibuat`, `jam_dibuat`) VALUES
(4, 4, 0, '5', 'Suplier Lampu Terkemuka di Indonesia', '2019-10-21', '15:52:30');

-- --------------------------------------------------------

--
-- Table structure for table `tags_produk`
--

CREATE TABLE `tags_produk` (
  `id_tags` int(11) UNSIGNED NOT NULL,
  `tags` varchar(50) DEFAULT NULL,
  `id_produk` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) UNSIGNED NOT NULL,
  `id_keranjang` int(11) NOT NULL,
  `status` enum('belum dikirim','Input resi','selesai','ditolak') NOT NULL DEFAULT 'belum dikirim',
  `total_harga` int(11) NOT NULL,
  `resi` varchar(30) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `wilayah`
--

CREATE TABLE `wilayah` (
  `id_wilayah` varchar(4) NOT NULL,
  `wilayah` varchar(30) NOT NULL,
  `kategori` char(1) NOT NULL,
  `id_prov` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wilayah`
--

INSERT INTO `wilayah` (`id_wilayah`, `wilayah`, `kategori`, `id_prov`) VALUES
('1100', 'Aceh', '1', '1100'),
('1101', 'Kab Simeulue', '2', '1100'),
('1102', 'Kab Aceh Singkil', '2', '1100'),
('1103', 'Kab Aceh Selatan', '2', '1100'),
('1104', 'Kab Aceh Tenggara', '2', '1100'),
('1105', 'Kab Aceh Timur', '2', '1100'),
('1106', 'Kab Aceh Tengah', '2', '1100'),
('1107', 'Kab Aceh Barat', '2', '1100'),
('1108', 'Kab Aceh Besar', '2', '1100'),
('1109', 'Kab Pidie', '2', '1100'),
('1110', 'Kab Bireuen', '2', '1100'),
('1111', 'Kab Aceh Utara', '2', '1100'),
('1112', 'Kab Aceh Barat Daya', '2', '1100'),
('1113', 'Kab Gayo Lues', '2', '1100'),
('1114', 'Kab Aceh Tamiang', '2', '1100'),
('1115', 'Kab Nagan Raya', '2', '1100'),
('1116', 'Kab Aceh Jaya', '2', '1100'),
('1117', 'Kab Bener Meriah', '2', '1100'),
('1118', 'Kab Pidie Jaya', '2', '1100'),
('1171', 'Kota Banda Aceh', '2', '1100'),
('1172', 'Kota Sabang', '2', '1100'),
('1173', 'Kota Langsa', '2', '1100'),
('1174', 'Kota Lhokseumawe', '2', '1100'),
('1175', 'Kota Subulussalam', '2', '1100'),
('1200', 'Sumatera Utara', '1', '1200'),
('1201', 'Kab Nias', '2', '1200'),
('1202', 'Kab Mandailing Natal', '2', '1200'),
('1203', 'Kab Tapanuli Selatan', '2', '1200'),
('1204', 'Kab Tapanuli Tengah', '2', '1200'),
('1205', 'Kab Tapanuli Utara', '2', '1200'),
('1206', 'Kab Toba Samosir', '2', '1200'),
('1207', 'Kab Labuhan Batu', '2', '1200'),
('1208', 'Kab Asahan', '2', '1200'),
('1209', 'Kab Simalungun', '2', '1200'),
('1210', 'Kab Dairi', '2', '1200'),
('1211', 'Kab Karo', '2', '1200'),
('1212', 'Kab Deli Serdang', '2', '1200'),
('1213', 'Kab Langkat', '2', '1200'),
('1214', 'Kab Nias Selatan', '2', '1200'),
('1215', 'Kab Humbang Hasundutan', '2', '1200'),
('1216', 'Kab Pakpak Bharat', '2', '1200'),
('1217', 'Kab Samosir', '2', '1200'),
('1218', 'Kab Serdang Bedagai', '2', '1200'),
('1219', 'Kab Batu Bara', '2', '1200'),
('1220', 'Kab Padang Lawas Utara', '2', '1200'),
('1221', 'Kab Padang Lawas', '2', '1200'),
('1222', 'Kab Labuhan Batu Selatan', '2', '1200'),
('1223', 'Kab Labuhan Batu Utara', '2', '1200'),
('1224', 'Kab Nias Utara', '2', '1200'),
('1225', 'Kab Nias Barat', '2', '1200'),
('1271', 'Kota Sibolga', '2', '1200'),
('1272', 'Kota Tanjung Balai', '2', '1200'),
('1273', 'Kota Pematang Siantar', '2', '1200'),
('1274', 'Kota Tebing Tinggi', '2', '1200'),
('1275', 'Kota Medan', '2', '1200'),
('1276', 'Kota Binjai', '2', '1200'),
('1277', 'Kota Padangsidimpuan', '2', '1200'),
('1278', 'Kota Gunungsitoli', '2', '1200'),
('1300', 'Sumatera Barat', '1', '1300'),
('1301', 'Kab Kepulauan Mentawai', '2', '1300'),
('1302', 'Kab Pesisir Selatan', '2', '1300'),
('1303', 'Kab Solok', '2', '1300'),
('1304', 'Kab Sijunjung', '2', '1300'),
('1305', 'Kab Tanah Datar', '2', '1300'),
('1306', 'Kab Padang Pariaman', '2', '1300'),
('1307', 'Kab Agam', '2', '1300'),
('1308', 'Kab Lima Puluh Kota', '2', '1300'),
('1309', 'Kab Pasaman', '2', '1300'),
('1310', 'Kab Solok Selatan', '2', '1300'),
('1311', 'Kab Dharmasraya', '2', '1300'),
('1312', 'Kab Pasaman Barat', '2', '1300'),
('1371', 'Kota Padang', '2', '1300'),
('1372', 'Kota Solok', '2', '1300'),
('1373', 'Kota Sawah Lunto', '2', '1300'),
('1374', 'Kota Padang Panjang', '2', '1300'),
('1375', 'Kota Bukittinggi', '2', '1300'),
('1376', 'Kota Payakumbuh', '2', '1300'),
('1377', 'Kota Pariaman', '2', '1300'),
('1400', 'Riau', '1', '1400'),
('1401', 'Kab Kuantan Singingi', '2', '1400'),
('1402', 'Kab Indragiri Hulu', '2', '1400'),
('1403', 'Kab Indragiri Hilir', '2', '1400'),
('1404', 'Kab Pelalawan', '2', '1400'),
('1405', 'Kab Siak', '2', '1400'),
('1406', 'Kab Kampar', '2', '1400'),
('1407', 'Kab Rokan Hulu', '2', '1400'),
('1408', 'Kab Bengkalis', '2', '1400'),
('1409', 'Kab Rokan Hilir', '2', '1400'),
('1410', 'Kab Kepulauan Meranti', '2', '1400'),
('1471', 'Kota Pekanbaru', '2', '1400'),
('1473', 'Kota Dumai', '2', '1400'),
('1500', 'Jambi', '1', '1500'),
('1501', 'Kab Kerinci', '2', '1500'),
('1502', 'Kab Merangin', '2', '1500'),
('1503', 'Kab Sarolangun', '2', '1500'),
('1504', 'Kab Batang Hari', '2', '1500'),
('1505', 'Kab Muaro Jambi', '2', '1500'),
('1506', 'Kab Tanjung Jabung Timur', '2', '1500'),
('1507', 'Kab Tanjung Jabung Barat', '2', '1500'),
('1508', 'Kab Tebo', '2', '1500'),
('1509', 'Kab Bungo', '2', '1500'),
('1571', 'Kota Jambi', '2', '1500'),
('1572', 'Kota Sungai Penuh', '2', '1500'),
('1600', 'Sumatera Selatan', '1', '1600'),
('1601', 'Kab Ogan Komering Ulu', '2', '1600'),
('1602', 'Kab Ogan Komering Ilir', '2', '1600'),
('1603', 'Kab Muara Enim', '2', '1600'),
('1604', 'Kab Lahat', '2', '1600'),
('1605', 'Kab Musi Rawas', '2', '1600'),
('1606', 'Kab Musi Banyuasin', '2', '1600'),
('1607', 'Kab Banyu Asin', '2', '1600'),
('1608', 'Kab Ogan Komering Ulu Selatan', '2', '1600'),
('1609', 'Kab Ogan Komering Ulu Timur', '2', '1600'),
('1610', 'Kab Ogan Ilir', '2', '1600'),
('1611', 'Kab Empat Lawang', '2', '1600'),
('1612', 'Kab Penukal Abab Lematang Ilir', '2', '1600'),
('1613', 'Kab Musi Rawas Utara', '2', '1600'),
('1671', 'Kota Palembang', '2', '1600'),
('1672', 'Kota Prabumulih', '2', '1600'),
('1673', 'Kota Pagar Alam', '2', '1600'),
('1674', 'Kota Lubuklinggau', '2', '1600'),
('1700', 'Bengkulu', '1', '1700'),
('1701', 'Kab Bengkulu Selatan', '2', '1700'),
('1702', 'Kab Rejang Lebong', '2', '1700'),
('1703', 'Kab Bengkulu Utara', '2', '1700'),
('1704', 'Kab Kaur', '2', '1700'),
('1705', 'Kab Seluma', '2', '1700'),
('1706', 'Kab Mukomuko', '2', '1700'),
('1707', 'Kab Lebong', '2', '1700'),
('1708', 'Kab Kepahiang', '2', '1700'),
('1709', 'Kab Bengkulu Tengah', '2', '1700'),
('1771', 'Kota Bengkulu', '2', '1700'),
('1800', 'Lampung', '1', '1800'),
('1801', 'Kab Lampung Barat', '2', '1800'),
('1802', 'Kab Tanggamus', '2', '1800'),
('1803', 'Kab Lampung Selatan', '2', '1800'),
('1804', 'Kab Lampung Timur', '2', '1800'),
('1805', 'Kab Lampung Tengah', '2', '1800'),
('1806', 'Kab Lampung Utara', '2', '1800'),
('1807', 'Kab Way Kanan', '2', '1800'),
('1808', 'Kab Tulang Bawang', '2', '1800'),
('1809', 'Kab Pesawaran', '2', '1800'),
('1810', 'Kab Pringsewu', '2', '1800'),
('1811', 'Kab Mesuji', '2', '1800'),
('1812', 'Kab Tulang Bawang Barat', '2', '1800'),
('1813', 'Kab Pesisir Barat', '2', '1800'),
('1871', 'Kota Bandar Lampung', '2', '1800'),
('1872', 'Kota Metro', '2', '1800'),
('1900', 'Kepulauan Bangka Belitung', '1', '1900'),
('1901', 'Kab Bangka', '2', '1900'),
('1902', 'Kab Belitung', '2', '1900'),
('1903', 'Kab Bangka Barat', '2', '1900'),
('1904', 'Kab Bangka Tengah', '2', '1900'),
('1905', 'Kab Bangka Selatan', '2', '1900'),
('1906', 'Kab Belitung Timur', '2', '1900'),
('1971', 'Kota Pangkal Pinang', '2', '1900'),
('2100', 'Kepulauan Riau', '1', '2100'),
('2101', 'Kab Karimun', '2', '2100'),
('2102', 'Kab Bintan', '2', '2100'),
('2103', 'Kab Natuna', '2', '2100'),
('2104', 'Kab Lingga', '2', '2100'),
('2105', 'Kab Kepulauan Anambas', '2', '2100'),
('2171', 'Kota Batam', '2', '2100'),
('2172', 'Kota Tanjung Pinang', '2', '2100'),
('3100', 'DKI Jakarta', '1', '3100'),
('3101', 'Kab Kepulauan Seribu', '2', '3100'),
('3171', 'Kota Jakarta Selatan', '2', '3100'),
('3172', 'Kota Jakarta Timur', '2', '3100'),
('3173', 'Kota Jakarta Pusat', '2', '3100'),
('3174', 'Kota Jakarta Barat', '2', '3100'),
('3175', 'Kota Jakarta Utara', '2', '3100'),
('3200', 'Jawa Barat', '1', '3200'),
('3201', 'Kab Bogor', '2', '3200'),
('3202', 'Kab Sukabumi', '2', '3200'),
('3203', 'Kab Cianjur', '2', '3200'),
('3204', 'Kab Bandung', '2', '3200'),
('3205', 'Kab Garut', '2', '3200'),
('3206', 'Kab Tasikmalaya', '2', '3200'),
('3207', 'Kab Ciamis', '2', '3200'),
('3208', 'Kab Kuningan', '2', '3200'),
('3209', 'Kab Cirebon', '2', '3200'),
('3210', 'Kab Majalengka', '2', '3200'),
('3211', 'Kab Sumedang', '2', '3200'),
('3212', 'Kab Indramayu', '2', '3200'),
('3213', 'Kab Subang', '2', '3200'),
('3214', 'Kab Purwakarta', '2', '3200'),
('3215', 'Kab Karawang', '2', '3200'),
('3216', 'Kab Bekasi', '2', '3200'),
('3217', 'Kab Bandung Barat', '2', '3200'),
('3218', 'Kab Pangandaran', '2', '3200'),
('3271', 'Kota Bogor', '2', '3200'),
('3272', 'Kota Sukabumi', '2', '3200'),
('3273', 'Kota Bandung', '2', '3200'),
('3274', 'Kota Cirebon', '2', '3200'),
('3275', 'Kota Bekasi', '2', '3200'),
('3276', 'Kota Depok', '2', '3200'),
('3277', 'Kota Cimahi', '2', '3200'),
('3278', 'Kota Tasikmalaya', '2', '3200'),
('3279', 'Kota Banjar', '2', '3200'),
('3300', 'Jawa Tengah', '1', '3300'),
('3301', 'Kab Cilacap', '2', '3300'),
('3302', 'Kab Banyumas', '2', '3300'),
('3303', 'Kab Purbalingga', '2', '3300'),
('3304', 'Kab Banjarnegara', '2', '3300'),
('3305', 'Kab Kebumen', '2', '3300'),
('3306', 'Kab Purworejo', '2', '3300'),
('3307', 'Kab Wonosobo', '2', '3300'),
('3308', 'Kab Magelang', '2', '3300'),
('3309', 'Kab Boyolali', '2', '3300'),
('3310', 'Kab Klaten', '2', '3300'),
('3311', 'Kab Sukoharjo', '2', '3300'),
('3312', 'Kab Wonogiri', '2', '3300'),
('3313', 'Kab Karanganyar', '2', '3300'),
('3314', 'Kab Sragen', '2', '3300'),
('3315', 'Kab Grobogan', '2', '3300'),
('3316', 'Kab Blora', '2', '3300'),
('3317', 'Kab Rembang', '2', '3300'),
('3318', 'Kab Pati', '2', '3300'),
('3319', 'Kab Kudus', '2', '3300'),
('3320', 'Kab Jepara', '2', '3300'),
('3321', 'Kab Demak', '2', '3300'),
('3322', 'Kab Semarang', '2', '3300'),
('3323', 'Kab Temanggung', '2', '3300'),
('3324', 'Kab Kendal', '2', '3300'),
('3325', 'Kab Batang', '2', '3300'),
('3326', 'Kab Pekalongan', '2', '3300'),
('3327', 'Kab Pemalang', '2', '3300'),
('3328', 'Kab Tegal', '2', '3300'),
('3329', 'Kab Brebes', '2', '3300'),
('3371', 'Kota Magelang', '2', '3300'),
('3372', 'Kota Surakarta', '2', '3300'),
('3373', 'Kota Salatiga', '2', '3300'),
('3374', 'Kota Semarang', '2', '3300'),
('3375', 'Kota Pekalongan', '2', '3300'),
('3376', 'Kota Tegal', '2', '3300'),
('3400', 'DI Yogyakarta', '1', '3400'),
('3401', 'Kab Kulon Progo', '2', '3400'),
('3402', 'Kab Bantul', '2', '3400'),
('3403', 'Kab Gunung Kidul', '2', '3400'),
('3404', 'Kab Sleman', '2', '3400'),
('3471', 'Kota Yogyakarta', '2', '3400'),
('3500', 'Jawa Timur', '1', '3500'),
('3501', 'Kab Pacitan', '2', '3500'),
('3502', 'Kab Ponorogo', '2', '3500'),
('3503', 'Kab Trenggalek', '2', '3500'),
('3504', 'Kab Tulungagung', '2', '3500'),
('3505', 'Kab Blitar', '2', '3500'),
('3506', 'Kab Kediri', '2', '3500'),
('3507', 'Kab Malang', '2', '3500'),
('3508', 'Kab Lumajang', '2', '3500'),
('3509', 'Kab Jember', '2', '3500'),
('3510', 'Kab Banyuwangi', '2', '3500'),
('3511', 'Kab Bondowoso', '2', '3500'),
('3512', 'Kab Situbondo', '2', '3500'),
('3513', 'Kab Probolinggo', '2', '3500'),
('3514', 'Kab Pasuruan', '2', '3500'),
('3515', 'Kab Sidoarjo', '2', '3500'),
('3516', 'Kab Mojokerto', '2', '3500'),
('3517', 'Kab Jombang', '2', '3500'),
('3518', 'Kab Nganjuk', '2', '3500'),
('3519', 'Kab Madiun', '2', '3500'),
('3520', 'Kab Magetan', '2', '3500'),
('3521', 'Kab Ngawi', '2', '3500'),
('3522', 'Kab Bojonegoro', '2', '3500'),
('3523', 'Kab Tuban', '2', '3500'),
('3524', 'Kab Lamongan', '2', '3500'),
('3525', 'Kab Gresik', '2', '3500'),
('3526', 'Kab Bangkalan', '2', '3500'),
('3527', 'Kab Sampang', '2', '3500'),
('3528', 'Kab Pamekasan', '2', '3500'),
('3529', 'Kab Sumenep', '2', '3500'),
('3571', 'Kota Kediri', '2', '3500'),
('3572', 'Kota Blitar', '2', '3500'),
('3573', 'Kota Malang', '2', '3500'),
('3574', 'Kota Probolinggo', '2', '3500'),
('3575', 'Kota Pasuruan', '2', '3500'),
('3576', 'Kota Mojokerto', '2', '3500'),
('3577', 'Kota Madiun', '2', '3500'),
('3578', 'Kota Surabaya', '2', '3500'),
('3579', 'Kota Batu', '2', '3500'),
('3600', 'Banten', '1', '3600'),
('3601', 'Kab Pandeglang', '2', '3600'),
('3602', 'Kab Lebak', '2', '3600'),
('3603', 'Kab Tangerang', '2', '3600'),
('3604', 'Kab Serang', '2', '3600'),
('3671', 'Kota Tangerang', '2', '3600'),
('3672', 'Kota Cilegon', '2', '3600'),
('3673', 'Kota Serang', '2', '3600'),
('3674', 'Kota Tangerang Selatan', '2', '3600'),
('5100', 'Bali', '1', '5100'),
('5101', 'Kab Jembrana', '2', '5100'),
('5102', 'Kab Tabanan', '2', '5100'),
('5103', 'Kab Badung', '2', '5100'),
('5104', 'Kab Gianyar', '2', '5100'),
('5105', 'Kab Klungkung', '2', '5100'),
('5106', 'Kab Bangli', '2', '5100'),
('5107', 'Kab Karangasem', '2', '5100'),
('5108', 'Kab Buleleng', '2', '5100'),
('5171', 'Kota Denpasar', '2', '5100'),
('5200', 'Nusa Tenggara Barat', '1', '5200'),
('5201', 'Kab Lombok Barat', '2', '5200'),
('5202', 'Kab Lombok Tengah', '2', '5200'),
('5203', 'Kab Lombok Timur', '2', '5200'),
('5204', 'Kab Sumbawa', '2', '5200'),
('5205', 'Kab Dompu', '2', '5200'),
('5206', 'Kab Bima', '2', '5200'),
('5207', 'Kab Sumbawa Barat', '2', '5200'),
('5208', 'Kab Lombok Utara', '2', '5200'),
('5271', 'Kota Mataram', '2', '5200'),
('5272', 'Kota Bima', '2', '5200'),
('5300', 'Nusa Tenggara Timur', '1', '5300'),
('5301', 'Kab Sumba Barat', '2', '5300'),
('5302', 'Kab Sumba Timur', '2', '5300'),
('5303', 'Kab Kupang', '2', '5300'),
('5304', 'Kab Timor Tengah Selatan', '2', '5300'),
('5305', 'Kab Timor Tengah Utara', '2', '5300'),
('5306', 'Kab Belu', '2', '5300'),
('5307', 'Kab Alor', '2', '5300'),
('5308', 'Kab Lembata', '2', '5300'),
('5309', 'Kab Flores Timur', '2', '5300'),
('5310', 'Kab Sikka', '2', '5300'),
('5311', 'Kab Ende', '2', '5300'),
('5312', 'Kab Ngada', '2', '5300'),
('5313', 'Kab Manggarai', '2', '5300'),
('5314', 'Kab Rote Ndao', '2', '5300'),
('5315', 'Kab Manggarai Barat', '2', '5300'),
('5316', 'Kab Sumba Tengah', '2', '5300'),
('5317', 'Kab Sumba Barat Daya', '2', '5300'),
('5318', 'Kab Nagekeo', '2', '5300'),
('5319', 'Kab Manggarai Timur', '2', '5300'),
('5320', 'Kab Sabu Raijua', '2', '5300'),
('5321', 'Kab Malaka', '2', '5300'),
('5371', 'Kota Kupang', '2', '5300'),
('6100', 'Kalimantan Barat', '1', '6100'),
('6101', 'Kab Sambas', '2', '6100'),
('6102', 'Kab Bengkayang', '2', '6100'),
('6103', 'Kab Landak', '2', '6100'),
('6104', 'Kab Pontianak', '2', '6100'),
('6105', 'Kab Sanggau', '2', '6100'),
('6106', 'Kab Ketapang', '2', '6100'),
('6107', 'Kab Sintang', '2', '6100'),
('6108', 'Kab Kapuas Hulu', '2', '6100'),
('6109', 'Kab Sekadau', '2', '6100'),
('6110', 'Kab Melawi', '2', '6100'),
('6111', 'Kab Kayong Utara', '2', '6100'),
('6112', 'Kab Kubu Raya', '2', '6100'),
('6171', 'Kota Pontianak', '2', '6100'),
('6172', 'Kota Singkawang', '2', '6100'),
('6200', 'Kalimantan Tengah', '1', '6200'),
('6201', 'Kab Kotawaringin Barat', '2', '6200'),
('6202', 'Kab Kotawaringin Timur', '2', '6200'),
('6203', 'Kab Kapuas', '2', '6200'),
('6204', 'Kab Barito Selatan', '2', '6200'),
('6205', 'Kab Barito Utara', '2', '6200'),
('6206', 'Kab Sukamara', '2', '6200'),
('6207', 'Kab Lamandau', '2', '6200'),
('6208', 'Kab Seruyan', '2', '6200'),
('6209', 'Kab Katingan', '2', '6200'),
('6210', 'Kab Pulang Pisau', '2', '6200'),
('6211', 'Kab Gunung Mas', '2', '6200'),
('6212', 'Kab Barito Timur', '2', '6200'),
('6213', 'Kab Murung Raya', '2', '6200'),
('6271', 'Kota Palangka Raya', '2', '6200'),
('6300', 'Kalimantan Selatan', '1', '6300'),
('6301', 'Kab Tanah Laut', '2', '6300'),
('6302', 'Kab Kota Baru', '2', '6300'),
('6303', 'Kab Banjar', '2', '6300'),
('6304', 'Kab Barito Kuala', '2', '6300'),
('6305', 'Kab Tapin', '2', '6300'),
('6306', 'Kab Hulu Sungai Selatan', '2', '6300'),
('6307', 'Kab Hulu Sungai Tengah', '2', '6300'),
('6308', 'Kab Hulu Sungai Utara', '2', '6300'),
('6309', 'Kab Tabalong', '2', '6300'),
('6310', 'Kab Tanah Bumbu', '2', '6300'),
('6311', 'Kab Balangan', '2', '6300'),
('6371', 'Kota Banjarmasin', '2', '6300'),
('6372', 'Kota Banjar Baru', '2', '6300'),
('6400', 'Kalimantan Timur', '1', '6400'),
('6401', 'Kab Paser', '2', '6400'),
('6402', 'Kab Kutai Barat', '2', '6400'),
('6403', 'Kab Kutai Kartanegara', '2', '6400'),
('6404', 'Kab Kutai Timur', '2', '6400'),
('6405', 'Kab Berau', '2', '6400'),
('6409', 'Kab Penajam Paser Utara', '2', '6400'),
('6411', 'Kab Mahakam Hulu', '2', '6400'),
('6471', 'Kota Balikpapan', '2', '6400'),
('6472', 'Kota Samarinda', '2', '6400'),
('6474', 'Kota Bontang', '2', '6400'),
('6500', 'Kalimantan Utara', '1', '6500'),
('6501', 'Kab Malinau', '2', '6500'),
('6502', 'Kab Bulungan', '2', '6500'),
('6503', 'Kab Tana Tidung', '2', '6500'),
('6504', 'Kab Nunukan', '2', '6500'),
('6571', 'Kota Tarakan', '2', '6500'),
('7100', 'Sulawesi Utara', '1', '7100'),
('7101', 'Kab Bolaang Mongondow', '2', '7100'),
('7102', 'Kab Minahasa', '2', '7100'),
('7103', 'Kab Kepulauan Sangihe', '2', '7100'),
('7104', 'Kab Kepulauan Talaud', '2', '7100'),
('7105', 'Kab Minahasa Selatan', '2', '7100'),
('7106', 'Kab Minahasa Utara', '2', '7100'),
('7107', 'Kab Bolaang Mongondow Utara', '2', '7100'),
('7108', 'Kab Siau Tagolandang Biaro', '2', '7100'),
('7109', 'Kab Minahasa Tenggara', '2', '7100'),
('7110', 'Kab Bolaang Mongondow Selatan', '2', '7100'),
('7111', 'Kab Bolaang Mongondow Timur', '2', '7100'),
('7171', 'Kota Manado', '2', '7100'),
('7172', 'Kota Bitung', '2', '7100'),
('7173', 'Kota Tomohon', '2', '7100'),
('7174', 'Kota Kotamobagu', '2', '7100'),
('7200', 'Sulawesi Tengah', '1', '7200'),
('7201', 'Kab Banggai Kepulauan', '2', '7200'),
('7202', 'Kab Banggai', '2', '7200'),
('7203', 'Kab Morowali', '2', '7200'),
('7204', 'Kab Poso', '2', '7200'),
('7205', 'Kab Donggala', '2', '7200'),
('7206', 'Kab Toli-Toli', '2', '7200'),
('7207', 'Kab Buol', '2', '7200'),
('7208', 'Kab Parigi Moutong', '2', '7200'),
('7209', 'Kab Tojo Una-Una', '2', '7200'),
('7210', 'Kab Sigi', '2', '7200'),
('7211', 'Kab Banggai Laut', '2', '7200'),
('7212', 'Kab Morowali Utara', '2', '7200'),
('7271', 'Kota Palu', '2', '7200'),
('7300', 'Sulawesi Selatan', '1', '7300'),
('7301', 'Kab Selayar', '2', '7300'),
('7302', 'Kab Bulukumba', '2', '7300'),
('7303', 'Kab Bantaeng', '2', '7300'),
('7304', 'Kab Jeneponto', '2', '7300'),
('7305', 'Kab Takalar', '2', '7300'),
('7306', 'Kab Gowa', '2', '7300'),
('7307', 'Kab Sinjai', '2', '7300'),
('7308', 'Kab Maros', '2', '7300'),
('7309', 'Kab Pangkajene Dan Kepulauan', '2', '7300'),
('7310', 'Kab Barru', '2', '7300'),
('7311', 'Kab Bone', '2', '7300'),
('7312', 'Kab Soppeng', '2', '7300'),
('7313', 'Kab Wajo', '2', '7300'),
('7314', 'Kab Sidenreng Rappang', '2', '7300'),
('7315', 'Kab Pinrang', '2', '7300'),
('7316', 'Kab Enrekang', '2', '7300'),
('7317', 'Kab Luwu', '2', '7300'),
('7318', 'Kab Tana Toraja', '2', '7300'),
('7322', 'Kab Luwu Utara', '2', '7300'),
('7325', 'Kab Luwu Timur', '2', '7300'),
('7326', 'Kab Toraja Utara', '2', '7300'),
('7371', 'Kota Makassar', '2', '7300'),
('7372', 'Kota Parepare', '2', '7300'),
('7373', 'Kota Palopo', '2', '7300'),
('7400', 'Sulawesi Tenggara', '1', '7400'),
('7401', 'Kab Buton', '2', '7400'),
('7402', 'Kab Muna', '2', '7400'),
('7403', 'Kab Konawe', '2', '7400'),
('7404', 'Kab Kolaka', '2', '7400'),
('7405', 'Kab Konawe Selatan', '2', '7400'),
('7406', 'Kab Bombana', '2', '7400'),
('7407', 'Kab Wakatobi', '2', '7400'),
('7408', 'Kab Kolaka Utara', '2', '7400'),
('7409', 'Kab Buton Utara', '2', '7400'),
('7410', 'Kab Konawe Utara', '2', '7400'),
('7411', 'Kab Kolaka Timur', '2', '7400'),
('7412', 'Kab Konawe Kepulauan', '2', '7400'),
('7413', 'Kab Muna Barat', '2', '7400'),
('7414', 'Kab Buton Tengah', '2', '7400'),
('7415', 'Kab Buton Selatan', '2', '7400'),
('7471', 'Kota Kendari', '2', '7400'),
('7472', 'Kota Bau-Bau', '2', '7400'),
('7500', 'Gorontalo', '1', '7500'),
('7501', 'Kab Boalemo', '2', '7500'),
('7502', 'Kab Gorontalo', '2', '7500'),
('7503', 'Kab Pohuwato', '2', '7500'),
('7504', 'Kab Bone Bolango', '2', '7500'),
('7505', 'Kab Gorontalo Utara', '2', '7500'),
('7571', 'Kota Gorontalo', '2', '7500'),
('7600', 'Sulawesi Barat', '1', '7600'),
('7601', 'Kab Majene', '2', '7600'),
('7602', 'Kab Polewali Mandar', '2', '7600'),
('7603', 'Kab Mamasa', '2', '7600'),
('7604', 'Kab Mamuju', '2', '7600'),
('7605', 'Kab Mamuju Utara', '2', '7600'),
('7606', 'Kab Mamuju Tengah', '2', '7600'),
('8100', 'Maluku', '1', '8100'),
('8101', 'Kab Maluku Tenggara Barat', '2', '8100'),
('8102', 'Kab Maluku Tenggara', '2', '8100'),
('8103', 'Kab Maluku Tengah', '2', '8100'),
('8104', 'Kab Buru', '2', '8100'),
('8105', 'Kab Kepulauan Aru', '2', '8100'),
('8106', 'Kab Seram Bagian Barat', '2', '8100'),
('8107', 'Kab Seram Bagian Timur', '2', '8100'),
('8108', 'Kab Maluku Barat Daya', '2', '8100'),
('8109', 'Kab Buru Selatan', '2', '8100'),
('8171', 'Kota Ambon', '2', '8100'),
('8172', 'Kota Tual', '2', '8100'),
('8200', 'Maluku Utara', '1', '8200'),
('8201', 'Kab Halmahera Barat', '2', '8200'),
('8202', 'Kab Halmahera Tengah', '2', '8200'),
('8203', 'Kab Kepulauan Sula', '2', '8200'),
('8204', 'Kab Halmahera Selatan', '2', '8200'),
('8205', 'Kab Halmahera Utara', '2', '8200'),
('8206', 'Kab Halmahera Timur', '2', '8200'),
('8207', 'Kab Pulau Morotai', '2', '8200'),
('8208', 'Kab Pulau Taliabu', '2', '8200'),
('8271', 'Kota Ternate', '2', '8200'),
('8272', 'Kota Tidore Kepulauan', '2', '8200'),
('9100', 'Papua Barat', '1', '9100'),
('9101', 'Kab Fak-Fak', '2', '9100'),
('9102', 'Kab Kaimana', '2', '9100'),
('9103', 'Kab Teluk Wondama', '2', '9100'),
('9104', 'Kab Teluk Bintuni', '2', '9100'),
('9105', 'Kab Manokwari', '2', '9100'),
('9106', 'Kab Sorong Selatan', '2', '9100'),
('9107', 'Kab Sorong', '2', '9100'),
('9108', 'Kab Raja Ampat', '2', '9100'),
('9109', 'Kab Tambrauw', '2', '9100'),
('9110', 'Kab Maybrat', '2', '9100'),
('9111', 'Kab Manokwari Selatan', '2', '9100'),
('9112', 'Kab Pegunungan Arfak', '2', '9100'),
('9171', 'Kota Sorong', '2', '9100'),
('9400', 'Papua', '1', '9400'),
('9401', 'Kab Merauke', '2', '9400'),
('9402', 'Kab Jayawijaya', '2', '9400'),
('9403', 'Kab Jayapura', '2', '9400'),
('9404', 'Kab Nabire', '2', '9400'),
('9408', 'Kab Yapen Waropen', '2', '9400'),
('9409', 'Kab Biak Numfor', '2', '9400'),
('9410', 'Kab Paniai', '2', '9400'),
('9411', 'Kab Puncak Jaya', '2', '9400'),
('9412', 'Kab Mimika', '2', '9400'),
('9413', 'Kab Boven Digoel', '2', '9400'),
('9414', 'Kab Mappi', '2', '9400'),
('9415', 'Kab Asmat', '2', '9400'),
('9416', 'Kab Yahukimo', '2', '9400'),
('9417', 'Kab Pegunungan Bintang', '2', '9400'),
('9418', 'Kab Tolikara', '2', '9400'),
('9419', 'Kab Sarmi', '2', '9400'),
('9420', 'Kab Keerom', '2', '9400'),
('9426', 'Kab Waropen', '2', '9400'),
('9427', 'Kab Supiori', '2', '9400'),
('9428', 'Kab Memberamo Raya', '2', '9400'),
('9429', 'Kab Nduga', '2', '9400'),
('9430', 'Kab Lanny Jaya', '2', '9400'),
('9431', 'Kab Memberamo Tengah', '2', '9400'),
('9432', 'Kab Yalimo', '2', '9400'),
('9433', 'Kab Puncak', '2', '9400'),
('9434', 'Kab Dogiyai', '2', '9400'),
('9435', 'Kab Intan Jaya', '2', '9400'),
('9436', 'Kab Deiyai', '2', '9400'),
('9471', 'Kota Jayapura', '2', '9400');

-- --------------------------------------------------------

--
-- Table structure for table `wilayah_distribusi`
--

CREATE TABLE `wilayah_distribusi` (
  `id` int(11) NOT NULL,
  `id_pengguna` int(11) NOT NULL,
  `id_wilayah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `wilayah_produk`
--

CREATE TABLE `wilayah_produk` (
  `id` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `id_wilayah` int(11) NOT NULL,
  `harga_dasar` double NOT NULL,
  `utama` char(1) NOT NULL,
  `tgl_dibuat` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wilayah_produk`
--

INSERT INTO `wilayah_produk` (`id`, `id_produk`, `id_wilayah`, `harga_dasar`, `utama`, `tgl_dibuat`) VALUES
(67, 20, 3404, 23000, '1', '2019-09-28'),
(68, 20, 3402, 37000, '0', '2019-09-28'),
(69, 20, 3403, 17000, '0', '2019-09-28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `foto_produk`
--
ALTER TABLE `foto_produk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `iklan_produk`
--
ALTER TABLE `iklan_produk`
  ADD PRIMARY KEY (`id_iklan`);

--
-- Indexes for table `kategori_produk`
--
ALTER TABLE `kategori_produk`
  ADD PRIMARY KEY (`id_kategori`),
  ADD KEY `idx_kategori_produk` (`id_kategori`,`kategori`) USING BTREE;

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id_keranjang`);

--
-- Indexes for table `keranjang_item`
--
ALTER TABLE `keranjang_item`
  ADD PRIMARY KEY (`id_keranjang_item`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD PRIMARY KEY (`id_notifikasi`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id_pengguna`),
  ADD KEY `idx_pengguna` (`id_pengguna`,`nama_pengguna`,`password`,`id_wilayah`) USING BTREE;

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`,`id_kategori`,`id_pengguna`) USING BTREE,
  ADD KEY `idx_produk` (`nama_produk`,`id_kategori`,`id_pengguna`);

--
-- Indexes for table `promo`
--
ALTER TABLE `promo`
  ADD PRIMARY KEY (`id_promo`);

--
-- Indexes for table `promo_produk`
--
ALTER TABLE `promo_produk`
  ADD PRIMARY KEY (`id_promo_produk`);

--
-- Indexes for table `rating_produk`
--
ALTER TABLE `rating_produk`
  ADD PRIMARY KEY (`id_rating`,`id_produk`);

--
-- Indexes for table `rating_suplier`
--
ALTER TABLE `rating_suplier`
  ADD PRIMARY KEY (`id_rating`,`id_suplier`);

--
-- Indexes for table `tags_produk`
--
ALTER TABLE `tags_produk`
  ADD PRIMARY KEY (`id_tags`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indexes for table `wilayah`
--
ALTER TABLE `wilayah`
  ADD PRIMARY KEY (`id_wilayah`),
  ADD KEY `idx_wilayah` (`id_wilayah`,`wilayah`);

--
-- Indexes for table `wilayah_distribusi`
--
ALTER TABLE `wilayah_distribusi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wilayah_produk`
--
ALTER TABLE `wilayah_produk`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `foto_produk`
--
ALTER TABLE `foto_produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `iklan_produk`
--
ALTER TABLE `iklan_produk`
  MODIFY `id_iklan` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kategori_produk`
--
ALTER TABLE `kategori_produk`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id_keranjang` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `keranjang_item`
--
ALTER TABLE `keranjang_item`
  MODIFY `id_keranjang_item` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `notifikasi`
--
ALTER TABLE `notifikasi`
  MODIFY `id_notifikasi` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id_pengguna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=298;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=167;

--
-- AUTO_INCREMENT for table `promo`
--
ALTER TABLE `promo`
  MODIFY `id_promo` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `promo_produk`
--
ALTER TABLE `promo_produk`
  MODIFY `id_promo_produk` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rating_produk`
--
ALTER TABLE `rating_produk`
  MODIFY `id_rating` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `rating_suplier`
--
ALTER TABLE `rating_suplier`
  MODIFY `id_rating` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tags_produk`
--
ALTER TABLE `tags_produk`
  MODIFY `id_tags` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wilayah_distribusi`
--
ALTER TABLE `wilayah_distribusi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `wilayah_produk`
--
ALTER TABLE `wilayah_produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
