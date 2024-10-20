<?php

namespace Database\Seeders;

use App\Models\membership\Meeting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Morilog\Jalali\Jalalian;

class MeetingSeeder extends Seeder
{
    public function run(): void
    {
        $meetings = [
            [
                'title' => 'بررسی احکام',
                'start_time' => Jalalian::fromDateTime(now()->setHour(20)->setMinute(22))->toCarbon(),
                'end_time' => Jalalian::fromDateTime(now()->setHour(21)->setMinute(0))->toCarbon(),
                'location' => 'اداره کل بازرسی',
                'description' => 'حضور در جلسه اجباری است.',
                'document_id' => 1,
                'meeting_status_id' => 1,
                'holding_type_id' => 1,
            ],
            [
                'title' => 'بررسی امور مالیاتی',
                'start_time' => Jalalian::fromDateTime(now()->setHour(8)->setMinute(22))->toCarbon(),
                'end_time' => Jalalian::fromDateTime(now()->setHour(10)->setMinute(0))->toCarbon(),
                'location' => ' بیرجند اداره کل بازرسی',
                'description' => 'حضور در جلسه اجباری است.',
                'document_id' => 1,
                'meeting_status_id' => 1,
                'holding_type_id' => 1,
            ],

        ];

        foreach ($meetings as $meeting) Meeting::create($meeting);
    }
}
