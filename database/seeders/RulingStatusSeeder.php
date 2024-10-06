<?php

namespace Database\Seeders;

use App\Models\membership\RulingStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RulingStatusSeeder extends Seeder
{
    public function run(): void
    {
        $rulingStatusNames = [
              'در دست اجرا',
               'اجرا شده',
        ];

        foreach ($rulingStatusNames as $name) RulingStatus::create(['name' => $name]);
    }
}
