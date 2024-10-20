<?php

namespace Database\Seeders;

use App\Models\membership\Meeting;
use App\Models\membership\MeetingStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MeetingStatusSeeder extends Seeder
{
    public function run(): void
    {
        $meetingStatusNames = [
            'در انتظار',
            'برگزار شده',
            'کنسل شده'
        ];
        foreach ($meetingStatusNames as $name) MeetingStatus::create(['name' => $name]);
    }
}
