<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Asset;

class asset_table_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $assets = [
            [
                'branch_id' => '1',
                'purchase_cd' => '',
                'asset_cd' => 'AST-20250227121325',
                'asset_category' => 'operational',
                'asset_name' => 'Mesin Yanmar 1.5L',
                'initial_price' => '17000000',
                'current_price' => '5000000',
                'lifespan' => '240',
                'purchase_dt' => '2023-01-01',
                'expire_dt' => '2043-01-01',
                'desc' => '',
                'asset_status' => 'in_use',
                'is_active' => '1',
            ]
        ];
        foreach($assets as $asset) {
            $objAsset = new Asset();
            $objAsset->fill($asset);
            $objAsset->save();
        }
    }
}