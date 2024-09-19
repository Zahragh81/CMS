<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrganizationSeeder extends Seeder
{
    public function run(): void
    {
        $organizations = [
            [
//                'id' => 1,
                'name' => 'سازمان بهزیستی',
                'national_id' => '123456789',
                'parent_id' => null,
                'status' => true,
            ],
            [
//                'id' => 2,
                'name' => 'سازمان تامین اجتمایی',
                'national_id' => '789654123',
                'parent_id' => null,
                'status' => true,
            ],
        ];

        DB::table('organizations')->insert($organizations);
    }
}
