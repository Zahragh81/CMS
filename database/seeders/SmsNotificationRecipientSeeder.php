<?php

namespace Database\Seeders;

use App\Models\membership\SmsNotificationRecipient;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SmsNotificationRecipientSeeder extends Seeder
{
    public function run(): void
    {
        $smsNotificationRecipients = [
            [
                'user_id' => 1,
            ],
            [
                'user_id' => 2,
            ],
            [
                'user_id' => 3,
            ]

        ];

        foreach ($smsNotificationRecipients as $smsNotificationRecipient) SmsNotificationRecipient::create($smsNotificationRecipient);
    }
}
