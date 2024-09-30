<?php

namespace Database\Seeders;

use App\Models\membership\CourtBranch;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourtBrancheSeeder extends Seeder
{
    public function run(): void
    {
        $CourtBranches = [
          [
              'name' => 'شعبه دادگستری بیرجند',
              'city_id' => 33,
              'branch_code' => '123456789',
              'address' => 'مدرس 60 پلاک 11',
              'phone' => '05631622275',
              'branch_type_id' => 1,
          ],
            [
                'name' => 'شعبه دادگستری مشهد',
                'city_id' => 32,
                'branch_code' => '123512489',
                'address' => 'معلم 98پلاک 10',
                'phone' => '05631622285',
                'branch_type_id' => 2,
            ],
        ];

        foreach ($CourtBranches as $courtBranch) CourtBranch::create($courtBranch);
    }
}
