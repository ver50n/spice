<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer;

class customer_table_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'Public',
                'email' => '',
                'address' => 'Public address',
                'phone' => '000000000000',
                'is_active' => 1,
                'created_at' => '2018-09-11 15:08:02',
                'updated_at' => '2018-09-11 15:08:03',
            ],
            [
                'name' => 'Nenek',
                'email' => '',
                'address' => 'Jl. Ahmad Yani. Depan King lama, jualan air kacang hijau kalau malam',
                'phone' => '000000000000',
                'is_active' => 1,
                'created_at' => '2018-09-11 15:08:02',
                'updated_at' => '2018-09-11 15:08:03',
            ],
            [
                'name' => 'Sosial',
                'email' => '',
                'address' => 'Jl. WR. Supratman. Sebelah Yayasan Sosial',
                'phone' => '000000000000',
                'is_active' => 1,
                'created_at' => '2018-09-11 15:08:02',
                'updated_at' => '2018-09-11 15:08:03',
            ],
            [
                'name' => 'Ahiok',
                'email' => '',
                'address' => 'Jl. Teuku Umar. rumah botak hin, depan supermarket yang sudah tutup',
                'phone' => '000000000000',
                'is_active' => 1,
                'created_at' => '2018-09-11 15:08:02',
                'updated_at' => '2018-09-11 15:08:03',
            ],
            [
                'name' => 'Murni',
                'email' => '',
                'address' => 'Jl. H.O.S. Cokroaminoto. Depan Yanse',
                'phone' => '000000000000',
                'is_active' => 1,
                'created_at' => '2018-09-11 15:08:02',
                'updated_at' => '2018-09-11 15:08:03',
            ],
            [
                'name' => 'Yanse',
                'email' => '',
                'address' => 'Jl. H.O.S. Cokroaminoto. Depan Murni',
                'phone' => '000000000000',
                'is_active' => 1,
                'created_at' => '2018-09-11 15:08:02',
                'updated_at' => '2018-09-11 15:08:03',
            ],
            [
                'name' => 'Jam 9',
                'email' => '',
                'address' => 'Jl. Sisingamangaraja. Buka hanya sampai jam 9 pagi',
                'phone' => '000000000000',
                'is_active' => 1,
                'created_at' => '2018-09-11 15:08:02',
                'updated_at' => '2018-09-11 15:08:03',
            ],
            [
                'name' => 'Bu Tati',
                'email' => '',
                'address' => 'Jl. Bu Tati',
                'phone' => '000000000000',
                'is_active' => 1,
                'created_at' => '2018-09-11 15:08:02',
                'updated_at' => '2018-09-11 15:08:03',
            ],
            [
                'name' => 'Fitri',
                'email' => '',
                'address' => 'Jl. Sisingamangaraja. Sekolah Singamangaraja',
                'phone' => '000000000000',
                'is_active' => 1,
                'created_at' => '2018-09-11 15:08:02',
                'updated_at' => '2018-09-11 15:08:03',
            ],
            [
                'name' => 'Onten',
                'email' => '',
                'address' => 'Jl. Onten',
                'phone' => '000000000000',
                'is_active' => 1,
                'created_at' => '2018-09-11 15:08:02',
                'updated_at' => '2018-09-11 15:08:03',
            ],
            [
                'name' => 'Puloh',
                'email' => '',
                'address' => 'Jl. Puloh',
                'phone' => '000000000000',
                'is_active' => 1,
                'created_at' => '2018-09-11 15:08:02',
                'updated_at' => '2018-09-11 15:08:03',
            ],
            [
                'name' => 'Ledong',
                'email' => '',
                'address' => 'Jl. Ledong',
                'phone' => '000000000000',
                'is_active' => 1,
                'created_at' => '2018-09-11 15:08:02',
                'updated_at' => '2018-09-11 15:08:03',
            ],
            [
                'name' => 'Ale Sudirman',
                'email' => '',
                'address' => 'Jl. Sudirman, rumah Ale',
                'phone' => '000000000000',
                'is_active' => 1,
                'created_at' => '2018-09-11 15:08:02',
                'updated_at' => '2018-09-11 15:08:03',
            ],
            [
                'name' => 'Bumbu Akie',
                'email' => '',
                'address' => 'Jl. Pajak Bahagia Tanjung Balai Asahan, Sumatera Utara',
                'phone' => '000000000000',
                'is_active' => 1,
                'created_at' => '2018-09-11 15:08:02',
                'updated_at' => '2018-09-11 15:08:03',
            ],
        ];

        foreach($data as $datum) {
            $obj = new Customer();
            $obj->fill($datum);
            $obj->save();
        }
    }
}
