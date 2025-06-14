<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Supplier;

class supplier_table_seeder extends Seeder
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
                'email' => 'public@mail.com',
                'address' => 'Public address',
                'phone' => '000000000000',
                'is_active' => 1,
                'created_at' => '2018-09-11 15:08:02',
                'updated_at' => '2018-09-11 15:08:03',
            ],
        ];

        foreach($data as $datum) {
            $obj = new Supplier();
            $obj->fill($datum);
            $obj->save();
        }
    }
}
