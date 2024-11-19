<?php

namespace Database\Seeders;

use App\Http\Resources\membership\ProtestationStatusResource;
use App\Models\membership\UnitSelectionStatus;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {
        $this->call([
            GenderSeeder::class,
            OrganizationSeeder::class,

            RoleGroupSeeder::class,
            PermissionGroupSeeder::class,

            PermissionSeeder::class,
            RoleSeeder::class,

            UserSeeder::class,

            ProvinceSeeder::class,
            CitySeeder::class,

            BranchTypeSeeder::class,
            CourtBrancheSeeder::class,

            OrganizationalPostSeeder::class,

            JudgesSeeder::class,

            DegreeSeeder::class,
            LawyerSeeder::class,

            DocumentTypeSeeder::class,
            DocumentStatusSeeder::class,
            DocumentSeeder::class,

            PetitionSeeder::class,

            RulingStatusSeeder::class,
            RulingSeeder::class,

            ProtestationStatusSeeder::class,
            ProtestationSeeder::class,

            HoldingTypeSeeder::class,
            MeetingStatusSeeder::class,
            MeetingSeeder::class,

            SmsNotificationRecipientSeeder::class,

            TicketGroupSeeder::class,
            TicketPrioritySeeder::class,
            TicketStatusSeeder::class,
            TicketSeeder::class,

            ReferralTypeSeeder::class,
            TicketActionSeeder::class,

            LessonSeeder::class,
            SemesterSeeder::class,
            MasterSeeder::class,
            LessonOfferedSeeder::class,
            UnitSelectionStatusSeeder::class,
            UnitSelectionSeeder::class
        ]);
    }
}
