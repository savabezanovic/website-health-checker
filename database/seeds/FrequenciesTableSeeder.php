<?php

use Illuminate\Database\Seeder;

class FrequenciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Frequency::class, 5)->create();
    }
}
