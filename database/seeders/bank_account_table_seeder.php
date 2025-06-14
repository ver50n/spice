<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BankAccount;

class bank_account_table_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bankAccounts = [
            [
                'bank_name' => 'Mandiri',
                'branch_name'=> 'Online',
                'account_type' => 'regular',
                'account_number' => '1680003709779',
                'account_name' => 'HENDRA',
            ],
        ];
        foreach($bankAccounts as $bankAccount) {
            $objBankAccount = new BankAccount();
            $objBankAccount->fill($bankAccount);
            $objBankAccount->save();
        }
    }
}
