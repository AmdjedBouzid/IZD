<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('metadata')->insert([
            'website_name' => 'Example Site',
            'huge_title' => 'Welcome to Example Site',
            'description' => 'This is a sample description for the Example Site.',
        ]);
    }
}
