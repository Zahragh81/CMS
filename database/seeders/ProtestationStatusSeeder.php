<?php

namespace Database\Seeders;

use App\Models\membership\ProtestationStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProtestationStatusSeeder extends Seeder
{
    public function run(): void
    {
        $protestationStatusNames = [
            'در دست بررسی',
            'پذیرفته شده',
            'رد شده',
        ];

        foreach ($protestationStatusNames as $name) ProtestationStatus::create(['name' => $name]);
    }
}
