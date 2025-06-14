<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $seedList = [
            'admin',
            'branch',
            'bankAccount',
            'product',
            'supplier',
            'customer',
            'asset',
        ];
        if(in_array('admin', $seedList))
            $this->call(admin_table_seeder::class);
        if(in_array('branch', $seedList))
            $this->call(branch_table_seeder::class);
        if(in_array('bankAccount', $seedList))
            $this->call(bank_account_table_seeder::class);
        if(in_array('product', $seedList))
            $this->call(product_table_seeder::class);
        if(in_array('supplier', $seedList))
            $this->call(supplier_table_seeder::class);
        if(in_array('customer', $seedList))
            $this->call(customer_table_seeder::class);
        if(in_array('asset', $seedList))
            $this->call(asset_table_seeder::class);
            
    }
}
