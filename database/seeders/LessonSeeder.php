<?php

namespace Database\Seeders;

use App\Models\membership\Lesson;

use Illuminate\Database\Seeder;

class LessonSeeder extends Seeder
{
    public function run(): void
    {
        $lessonTitles = [
              'امار و احتمال',
              'برنامه نویسی مقدماتی',
              'تحلیل کلان داده',
              'ریاضیات مهندسی',
              'ازمایشگاه مدار منطقی',
              'روش تحقیق',
              'زبان عمومی',
              'اندیشه اسلامی',
              'طراحی الگوریتم',
              'ساختمان داده'
        ];

        foreach ($lessonTitles as $title) Lesson::create(['title' => $title]);
    }
}
