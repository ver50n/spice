<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;

class admin_table_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $admins = [
            [
                'role' => 'super_admin',
                'id_number' => '1274012411900001',
                'branch_id' => '1',
                'name' => 'Hendra',
                'username' => 'hendra',
                'email' => 'hendraimz@gmail.org',
                'password' => bcrypt('admin123'),
                'gender' => 'male',
                'phone' => '09054419683',
                'dob' => '1990-11-24',
                'address' => 'Tokyo, Arakawa, MinamiSenju 1-6-8 302',
                'is_active' => 1,
                'start_work_at' => '2018-09-11 15:08:02',
                'end_work_at' => null,
                'created_at' => '2018-09-11 15:08:02',
                'updated_at' => '2018-09-11 15:08:03',
            ]
        ];
        foreach($admins as $admin) {
            $objAdmin = Admin::where('username', $admin['username'])->first();
            if($objAdmin)
                continue;
            $objAdmin = new Admin();
            $objAdmin->fill($admin);
            $objAdmin->save();
        }
    }
}
