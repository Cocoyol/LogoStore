<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->truncateTables(array(
            'users',
            'password_resets',
            'customers',
            'categories',
            'logos',
            'orders',
            'requirements_logos',
            'keywords',
            'keyword_logos'
        ));

        $this->call(UsersTableSeeder::class);
        $this->call(CustomersTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(LogosTableSeeder::class);
        $this->call(OrdersTableSeeder::class);
        $this->call(RequirementsLogosTableSeeder::class);
        $this->call(KeywordsTableSeeder::class);
        $this->call(KeywordLogosTableSeeder::class);
    }

    private function truncateTables(array $tables)
    {
        $this->checkForeignKeys(false);

        foreach ($tables as $table) {
            DB::table($table)->truncate();
        }

        $this->checkForeignKeys(true);
    }

    private function checkForeignKeys($check)
    {
        $check = $check ? '1' : '0';
        DB::statement("SET FOREIGN_KEY_CHECKS = $check;");
    }
}
