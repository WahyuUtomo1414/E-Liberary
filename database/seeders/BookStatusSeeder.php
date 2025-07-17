<?php

namespace Database\Seeders;

use App\Models\StatusType;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Status;

class BookStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $listStatusType = [
            "id" => 2,
            "name" => "Book Status",
            "desc" => "New status",
            "active" => 1,
        ];
        StatusType::insert($listStatusType);

        $listStatus = [
            [
                'id' => 4,
                'status_type_id' => 2,
                'name' => 'TERSEDIA',
                "desc" => 'Buku bisa dipinjam',
                'active' => true,
            ],
            [
                'id' => 5,
                'status_type_id' => 2,
                'name' => 'DIPINJAM',
                "desc" => 'Buku sedang dipinjam',
                'active' => true,
            ],
            [
                'id' => 6,
                'status_type_id' => 2,
                'name' => 'RUSAK',
                "desc" => 'Buku rusak',
                'active' => true,
            ],
            [
                'id' => 7,
                'status_type_id' => 2,
                'name' => 'HILANG',
                "desc" => 'Buku hilang',
                'active' => true,
            ],
        ];
        Status::insert($listStatus);
    }
}
