<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Branch;

class branch_table_seeder extends Seeder
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
                'name' => 'Veteran',
                'address' => 'Jl. Veteran No.73, Indra Sakti, Tanjungbalai Selatan, Kota Tanjung Balai, Sumatera Utara, Indonesia',
                'phone' => '09054419683',
                'map_url' => 'https://maps.app.goo.gl/BBuXMwJrj4u4QCCb8',
                'operation_day' => '1,2,3,4,5,6',
                'operation_start_time' => '05:30',
                'operation_end_time' => '16:00',
                'is_active' => 1,
                'created_at' => '2018-09-11 15:08:02',
                'updated_at' => '2018-09-11 15:08:03',
            ],
        ];

        foreach($data as $datum) {
            $obj = new Branch();
            $obj->fill($datum);
            $obj->save();
        }
    }
}
