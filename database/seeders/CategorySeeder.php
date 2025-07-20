<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::insert([
            ['name' => 'Teknologi', 'desc' => '', 'status_id' => 1],
            ['name' => 'Komik', 'desc' => '', 'status_id' => 1],
            ['name' => 'IPA', 'desc' => '', 'status_id' => 1],
            ['name' => 'IPS', 'desc' => '', 'status_id' => 1],
            ['name' => 'Sejarah', 'desc' => '', 'status_id' => 1],
            ['name' => 'Fiksi', 'desc' => '', 'status_id' => 1],
            ['name' => 'Biografi', 'desc' => '', 'status_id' => 1],
            ['name' => 'Sastra', 'desc' => '', 'status_id' => 1],
            ['name' => 'Matematika', 'desc' => '', 'status_id' => 1],
            ['name' => 'Psikologi', 'desc' => '', 'status_id' => 1],
        ]);
    }
}
