<?php

use Illuminate\Database\Seeder;

class ComparatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Comparator::class, 100)->create();
    }
}
