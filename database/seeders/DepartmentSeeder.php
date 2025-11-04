<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Department;

class DepartmentSeeder extends Seeder
{
    public function run(): void
    {
        $departments = [
            ['name' => 'Inspektorat Daerah', 'email' => 'inspektorat@bantulkab.go.id', 'head_name' => 'Drs. Ahmad Prasetya', 'head_phone' => '+62 812-3456-7801'],
            ['name' => 'Badan Perencanaan Pembangunan Daerah', 'email' => 'bappeda@bantulkab.go.id', 'head_name' => 'Ir. Siti Marlina', 'head_phone' => '+62 812-3456-7802'],
            ['name' => 'Badan Kepegawaian dan Pengembangan Sumber Daya Manusia', 'email' => 'bkpsdm@bantulkab.go.id', 'head_name' => 'H. Bambang Supriadi', 'head_phone' => '+62 812-3456-7803'],
            ['name' => 'Badan Pengelolaan Keuangan, Pendapatan dan Aset Daerah', 'email' => 'bpkpad@bantulkab.go.id', 'head_name' => 'Dr. Maria Hartati', 'head_phone' => '+62 812-3456-7804'],
            ['name' => 'Badan Penanggulangan Bencana Daerah', 'email' => 'bpbd@bantulkab.go.id', 'head_name' => 'Basuki Rahardjo', 'head_phone' => '+62 812-3456-7805'],
            ['name' => 'Dinas Pendidikan, Kepemudaan dan Olahraga', 'email' => 'disdikpora@bantulkab.go.id', 'head_name' => 'Siti Nur Aulia, M.Pd', 'head_phone' => '+62 812-3456-7806'],
            ['name' => 'Dinas Kesehatan', 'email' => 'dinkes@bantulkab.go.id', 'head_name' => 'Dr. Andi Wijaya', 'head_phone' => '+62 812-3456-7807'],
            ['name' => 'Dinas Pekerjaan Umum, Perumahan dan Kawasan Permukiman', 'email' => 'dpupr@bantulkab.go.id', 'head_name' => 'Ir. Yulianto Santoso', 'head_phone' => '+62 812-3456-7808'],
            ['name' => 'Dinas Pertanahan dan Tata Ruang', 'email' => 'dipertaru@bantulkab.go.id', 'head_name' => 'Drs. H. Raden Putra', 'head_phone' => '+62 812-3456-7809'],
            ['name' => 'Satuan Polisi Pamong Praja', 'email' => 'satpolpp@bantulkab.go.id', 'head_name' => 'AKP. Mario Kurniawan', 'head_phone' => '+62 812-3456-7810'],
            ['name' => 'Dinas Sosial', 'email' => 'dinsos@bantulkab.go.id', 'head_name' => 'Nina Lestari', 'head_phone' => '+62 812-3456-7811'],
            ['name' => 'Dinas Tenaga Kerja dan Transmigrasi', 'email' => 'disnakertrans@bantulkab.go.id', 'head_name' => 'Drs. H. Surya Wijaya', 'head_phone' => '+62 812-3456-7812'],
            ['name' => 'Dinas Ketahanan Pangan dan Pertanian', 'email' => 'dinaspertanian@bantulkab.go.id', 'head_name' => 'Ir. Lestari Putri', 'head_phone' => '+62 812-3456-7813'],
            ['name' => 'Dinas Lingkungan Hidup', 'email' => 'dlh@bantulkab.go.id', 'head_name' => 'Dr. Budi Santika', 'head_phone' => '+62 812-3456-7814'],
            ['name' => 'Dinas Kependudukan dan Pencatatan Sipil', 'email' => 'disdukcapil@bantulkab.go.id', 'head_name' => 'Ratna Dewi, S.Si', 'head_phone' => '+62 812-3456-7815'],
            ['name' => 'Dinas Pemberdayaan Masyarakat dan Kalurahan', 'email' => 'dpmk@bantulkab.go.id', 'head_name' => 'M. Fajar Pratama', 'head_phone' => '+62 812-3456-7816'],
            ['name' => 'Dinas Perhubungan', 'email' => 'dishub@bantulkab.go.id', 'head_name' => 'Ir. H. Agus Santoso', 'head_phone' => '+62 812-3456-7817'],
            ['name' => 'Dinas Komunikasi dan Informatika', 'email' => 'diskominfo@bantulkab.go.id', 'head_name' => 'Siti Haryati, M.Kom', 'head_phone' => '+62 812-3456-7818'],
            ['name' => 'Dinas Koperasi UKM, Perindustrian dan Perdagangan', 'email' => 'diskopukmperindag@bantulkab.go.id', 'head_name' => 'Hendra Prasetyo', 'head_phone' => '+62 812-3456-7819'],
            ['name' => 'Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu', 'email' => 'dpmptsp@bantulkab.go.id', 'head_name' => 'Dewi Kartika', 'head_phone' => '+62 812-3456-7820'],
            ['name' => 'Dinas Kebudayaan (Kundha Kabudayan)', 'email' => 'disbud@bantulkab.go.id', 'head_name' => 'Drs. H. Sumarno', 'head_phone' => '+62 812-3456-7821'],
            ['name' => 'Dinas Perpustakaan dan Kearsipan', 'email' => 'dispusip@bantulkab.go.id', 'head_name' => 'Lina Marlina', 'head_phone' => '+62 812-3456-7822'],
            ['name' => 'Dinas Pariwisata', 'email' => 'dispar@bantulkab.go.id', 'head_name' => 'Arief Pranata', 'head_phone' => '+62 812-3456-7823'],
            ['name' => 'RSUD Panembahan Senopati', 'email' => 'rsudps@bantulkab.go.id', 'head_name' => 'Dr. Rina Safitri', 'head_phone' => '+62 812-3456-7824'],
            ['name' => 'Badan Kesatuan Bangsa dan Politik', 'email' => 'bakesbangpol@bantulkab.go.id', 'head_name' => 'Drs. Agus Wiranto', 'head_phone' => '+62 812-3456-7825'],
            ['name' => 'Bagian Tata Pemerintahan', 'email' => 'bagtatapem@bantulkab.go.id', 'head_name' => 'Nurul Hidayah', 'head_phone' => '+62 812-3456-7826'],
            ['name' => 'Bagian Hukum', 'email' => 'baghukum@bantulkab.go.id', 'head_name' => 'Muhammad Ilham, S.H.', 'head_phone' => '+62 812-3456-7827'],
            ['name' => 'Bagian Perekonomian Pembangunan dan SDA', 'email' => 'bagekonomi@bantulkab.go.id', 'head_name' => 'Dr. Eka Wijanarko', 'head_phone' => '+62 812-3456-7828'],
            ['name' => 'Bagian Perencanaan dan Keuangan', 'email' => 'bagrenkeu@bantulkab.go.id', 'head_name' => 'Siti Aminah', 'head_phone' => '+62 812-3456-7829'],
            ['name' => 'Bagian Pengadaan Barang dan Jasa', 'email' => 'bagpbj@bantulkab.go.id', 'head_name' => 'Yusuf Rahman', 'head_phone' => '+62 812-3456-7830'],
            ['name' => 'Bagian Kesejahteraan Rakyat', 'email' => 'bagkesra@bantulkab.go.id', 'head_name' => 'Dian Puspita', 'head_phone' => '+62 812-3456-7831'],
            ['name' => 'Bagian Organisasi', 'email' => 'bagorganisasi@bantulkab.go.id', 'head_name' => 'Rizky Maulana', 'head_phone' => '+62 812-3456-7832'],
            ['name' => 'Bagian Umum dan Protokol', 'email' => 'bagumumprotokol@bantulkab.go.id', 'head_name' => 'Tuti Herawati', 'head_phone' => '+62 812-3456-7833'],
            ['name' => 'Sekretariat DPRD', 'email' => 'sekdprd@bantulkab.go.id', 'head_name' => 'Drs. H. M. Zulkarnain', 'head_phone' => '+62 812-3456-7834'],
            ['name' => 'Dinas Pemberdayaan Perempuan dan Perlindungan Anak, Pengendalian Penduduk dan Keluarga Berencana', 'email' => 'dp3appkb@bantulkab.go.id', 'head_name' => 'Dr. Maya Sari', 'head_phone' => '+62 812-3456-7835'],
            ['name' => 'Dinas Kelautan dan Perikanan', 'email' => 'dkp@bantulkab.go.id', 'head_name' => 'Ir. H. Joko Prabowo', 'head_phone' => '+62 812-3456-7836'],
            ['name' => 'RSUD Saras Adyatma', 'email' => 'rsudsaras@bantulkab.go.id', 'head_name' => 'Dr. Siska Anindya', 'head_phone' => '+62 812-3456-7837'],
            ['name' => 'Sekretariat Daerah Kabupaten Bantul', 'email' => 'setda@bantulkab.go.id', 'head_name' => 'Drs. H. Sutrisno', 'head_phone' => '+62 812-3456-7838'],
        ];

        foreach ($departments as $dept) {
            Department::create($dept);
        }
    }
}
