<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // ! Please do not remove this account, it is used for support purposes.
        User::create([
            'name' => 'izdtech',
            'email' => 'izdtech@gmail.com',
            'password' => Hash::make('izdtech2025'),
        ]);

        DB::table('metadata')->insert([
            'website_logo_path' => 'logos/3x8B5CTBbZxEu2Bp7yZoTfwr766lcP0YewFRkrNl.png',
            'website_name' => 'Example Site',
            'huge_title' => 'Welcome to Example Site',
            'description' => 'This is a sample description for the Example Site.',
        ]);
        DB::table('footer_colors')->insert([
            'primary' => '#3b2ed0',
            'secondary' => '#4ed0fc',
            'items' => '#FFFFFF',
        ]);
    }
}
