<?php

class Utils extends Controller
{
    public static function printEcho($value)
    {
        echo '<pre>';
        print_r($value);
        echo '</pre>';
    }

    public static function generateBreadcrumb($items)
    {
        $breadcrumb = '<ol class="breadcrumb float-sm-right">';
        foreach ($items as $index => $item) {
            if ($index == count($items) - 1) {
                // Jika ini item terakhir, tambahkan kelas 'active'
                $breadcrumb .= '<li class="breadcrumb-item active">' . $item['label'] . '</li>';
            } else {
                // Jika bukan item terakhir, tambahkan link
                $breadcrumb .= '<li class="breadcrumb-item"><a href="' . $item['url'] . '">' . $item['label'] . '</a></li>';
            }
        }
        $breadcrumb .= '</ol>';
        return $breadcrumb;
    }

    public static function urlNow()
    {
        $currentUrl = $_SERVER['REQUEST_URI'];
        $lastSegment = basename($currentUrl);
        return $lastSegment;
    }

    public static function fullUrl()
    {
        $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
        $host = $_SERVER['HTTP_HOST'];
        $uri = $_SERVER['REQUEST_URI'];
        $url = $protocol . "://" . $host . $uri;
        return $url;
    }

    public static function urlRouting()
    {
        $fullUrl = Utils::fullUrl();
        $parsed_url = parse_url($fullUrl);
        $simplified_url = $parsed_url['scheme'] . '://' . $parsed_url['host'] . $parsed_url['path'];
        return $simplified_url;
    }

    public static function uploadFile($nama_file, $direktori, $nama_gambar_pengaturan)
    {
        $upload_dir = $direktori;
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        $file_path = $upload_dir . $nama_gambar_pengaturan;
        if (file_exists($file_path)) {
            unlink($file_path);
        }

        $file = $_FILES[$nama_file];
        if ($file['size'] > 0) {
            $nama_file = explode('.', $file['name']);
            $nama_file = $nama_file[0];

            $new_filename = str_replace(' ', '_', strtolower($nama_file)) . '_' . date('Y-m-d_H-i-s') . '_' . uniqid() . '.' . pathinfo($file['name'], PATHINFO_EXTENSION);

            $upload_path = $upload_dir . $new_filename;
            if (move_uploaded_file($file['tmp_name'], $upload_path)) {
                $data[$nama_file] = $new_filename;
            } else {
                $data[$nama_file] = 'default.png';
            }

            return $data[$nama_file];
        } else {
            if ($nama_gambar_pengaturan != '') {
                return $nama_gambar_pengaturan;
            }
        }
        return 'default.png';
    }

    public function settingApp()
    {
        $settingModel = $this->model('Pengaturan_model');
        $getSetting = $settingModel->getAll()[0];
        $data = $getSetting;
        return $data;
    }

    public function alreadyLogin()
    {
        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
            header('Location: ' . BASEURL . '/Dashboard');
            exit;
        }

        if (isset($_COOKIE['remember_token'])) {
            $users = $this->model('Users_model');
            $user = $users->getUserByToken($_COOKIE['remember_token']);

            if ($user) {
                $current_time = time();
                if ($user['token_expiration'] > $current_time) {
                    $_SESSION['logged_in'] = true;
                    $_SESSION['users_id'] = $user['id'];
                    header('Location: /Dashboard');
                    exit;
                } else {
                    unset($_SESSION['logged_in']);
                    unset($_SESSION['users_id']);
                    setcookie('remember_token', '', time() - 3600, '/', null, null, true);
                    header('Location: /Logout');
                    exit;
                }
            } else {
                unset($_SESSION['logged_in']);
                unset($_SESSION['users_id']);
                setcookie('remember_token', '', time() - 3600, '/', null, null, true);
                header('Location: /Logout');
                exit;
            }
        }
    }

    public function notLogin()
    {
        if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
            header('Location: ' . BASEURL . '/Login');
            exit;
        }
    }

    public function myProfile()
    {
        $myProfile = $this->model('Users_model')->myProfile($_SESSION['users_id']);
        return $myProfile;
    }

    public static function perhitunganAHP($data, $datastatis)
    {
        $save_metode = [];
        // matriks perbandingan
        $matrix = $data['matrix'];
        $matrixOriginal = $data['matrix_original'];

        $save_metode['matriks_perbandingan'] = $matrix;
        $save_metode['matriks_perbandingan_original'] = $matrixOriginal;

        $matrix_perbandingan = [];
        foreach ($matrix as $kriteria_id1 => $item1) {
            foreach ($item1 as $kriteria_id2 => $item2) {
                $matrix_perbandingan[$kriteria_id2][$kriteria_id1] = $item2;
            }
        }
        // hasil perhitungan kriteria
        $sum_matrix = [];
        foreach ($matrix_perbandingan as $kriteria_id2 => $item) {
            $sum_matrix[$kriteria_id2] = array_sum($item);
        }
        $save_metode['hasil_perhitungan'] = $sum_matrix;

        // normalisasi kriteria
        $normalisasi_kriteria = [];
        foreach ($matrix_perbandingan as $kriteria_id1 => $item1) {
            foreach ($item1 as $kriteria_id2 => $item2) {
                $get_sum_matrix = $sum_matrix[$kriteria_id1];
                $normalisasi_kriteria[$kriteria_id1][$kriteria_id2] = $item2 / $get_sum_matrix;
            }
        }

        // total normalisasi kriteria
        $total_normalisasi_kriteria = [];
        foreach ($normalisasi_kriteria as $kriteria_id1 => $item1) {
            $total_normalisasi_kriteria[$kriteria_id1] = round(array_sum($item1));
        }

        // perhitungan bobot prioritas
        $invers_normalisasi_kriteria = [];
        foreach ($normalisasi_kriteria as $kriteria_id1 => $item1) {
            foreach ($item1 as $kriteria_id2 => $item2) {
                $invers_normalisasi_kriteria[$kriteria_id2][$kriteria_id1] = $item2;
            }
        }
        $save_metode['normalisasi'] = $invers_normalisasi_kriteria;

        $bobot_prioritas = [];
        foreach ($invers_normalisasi_kriteria as $kriteria_id2 => $item1) {
            $bobot_prioritas[$kriteria_id2] = array_sum($item1);
        }
        $save_metode['row_normalisasi'] = $bobot_prioritas;
        $save_metode['jumlah_row_normalisasi'] = array_sum($bobot_prioritas);


        $bobot_prioritas_fix = [];
        foreach ($bobot_prioritas as $kriteria_id2 => $item1) {
            $bobot_prioritas_fix[$kriteria_id2] = $item1 / array_sum($total_normalisasi_kriteria);
        }
        $total_bobot_prioritas_fix = array_sum($bobot_prioritas_fix);
        $save_metode['perhitungan_bobot_prioritas'] = $bobot_prioritas_fix;
        $save_metode['jumlah_perhitungan_bobot_prioritas'] = $total_bobot_prioritas_fix;

        $eigen_max = [];
        foreach ($bobot_prioritas_fix as $kriteria_id2 => $item) {
            $eigen_max[$kriteria_id2] = $item * $sum_matrix[$kriteria_id2];
        }
        $total_eigen_max = array_sum($eigen_max);
        $save_metode['eigen_max'] = $eigen_max;
        $save_metode['jumlah_eigen_max'] = array_sum($eigen_max);

        $count_matrix = count($matrix_perbandingan);
        $ci = ($total_eigen_max - $count_matrix) / ($count_matrix - 1);
        $cr = $ci / $datastatis['random_index'][$count_matrix];

        $save_metode['ci'] = $ci;
        $save_metode['cr'] = $cr;

        return $save_metode;
    }

    public static function formatRupiah($value)
    {
        return number_format($value, 3, '.', ',');
    }

    public static function formatTanggal($tanggalWaktu)
    {
        $tanggalAwal = $tanggalWaktu;
        $dateTime = new DateTime($tanggalAwal);

        $tanggalFormatted = $dateTime->format('j F Y H:i');

        $bulanIndonesia = [
            "January" => "Januari",
            "February" => "Februari",
            "March" => "Maret",
            "April" => "April",
            "May" => "Mei",
            "June" => "Juni",
            "July" => "Juli",
            "August" => "Agustus",
            "September" => "September",
            "October" => "Oktober",
            "November" => "November",
            "December" => "Desember"
        ];

        list($hari, $bulan, $tahun, $jam) = explode(' ', $tanggalFormatted);

        $bulanIndonesiaFormatted = $bulanIndonesia[$bulan];

        $tanggalAkhir = "{$hari} {$bulanIndonesiaFormatted} {$tahun} {$jam}";

        return $tanggalAkhir;
    }
    public static function formatDateView($tanggalWaktu)
    {
        $originalDate = $tanggalWaktu;
        $dateTime = new DateTime($originalDate);

        $formattedDate = $dateTime->format('d/m/Y H:i');
        return $formattedDate;
    }

    public static function urlFormat($setUrl)
    {
        $url = explode('?', $setUrl);
        return $url[0];
    }
}
