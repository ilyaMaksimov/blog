<?php

use Illuminate\Database\Seeder;
use phpDocumentor\Reflection\DocBlock\TagFactory;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(CategorySeeder::class);
         $this->call(TagSeeder::class);
    }
}
