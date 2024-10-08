<?php

namespace Modules\Income\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Income\Database\Seeders\IncomeTableSeeder;
class IncomeDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(IncomeTableSeeder::class);
    }
}
