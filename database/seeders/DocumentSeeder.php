<?php

namespace Database\Seeders;

use App\Models\membership\Document;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DocumentSeeder extends Seeder
{
    public function run(): void
    {
        $documents = [
            [
                'file_number' => '12345678',
                'document_type_id' => 1,
                'lawyer_id' => 1,
                'user_id' => 1,
                'plaintiff_id' => 1,
                'court_branch_id' => 1,
                'court_class_number' => '123474152',
                'court_filing_number' => '546',
                'document_status_id' => 1 ,
                'description' => 'آقای م.ب با وکالت خانم و.الف به طرفیت خانم م.ص و م.م دادخواستی به خواسته الزام خوانده به حضور در دفترخانه طلاق شماره … تهران ری و ثبت واقعه رجوع و الزام به تمکین عام و خاص و مراجعت به زندگی مشترک تقدیم دادگاه های عمومی خانواده شهرری نموده و در متن دادخواست توضیح داده مطابق دادنامه ۰۰۱۹۲ مورخ ۹۲/۲/۱۰ شعبه ۶ خانواده شهرری حکم به طلاق خلعی صادر شده زوجه یک عدد سکه تمام بهار آزادی را بذل نموده و با وکالت از طرف وی قبول بذل نموده و به دفترخانه شماره … مراجعه اقدام به ثبت رسمی واقعه طلاق کرده است.'
            ],
            [
                'file_number' => '21354102',
                'document_type_id' => 2,
                'lawyer_id' => 2,
                'user_id' => 2,
                'plaintiff_id' => 2,
                'court_branch_id' => 2,
                'court_class_number' => '2345954126',
                'court_filing_number' => '741964120',
                'document_status_id' => 3 ,
                'description' => 'در خصوص دادخواست تقدیمی خواهان خانم م.ف فرزند م. به طرفیت خوانده آقای ح.م فرزند ج. به خواسته الزام خوانده به تحویل فرزند مشترک به اسامی م.ر ۶ ساله و م.پ ۴ساله جهت حضانت با توجه به اوراق و محتویات پرونده از جمله فتوکپی مصدق طلاق نامه رسمی به شماره ۰۹۰۱۳۲ صادره از دفتر طلاق شماره ۱۸۴ تهران و صفحات راجع به فرزند در شناسنامه های طرفین وجود رابطه پدر و مادری بین طرفین و فرزندان موسوم برای دادگاه محرز است و خواهان اعلام داشته به لحاظ وضعیت خاص و فقدان مسکن و چون منبع درآمدی ندارم،'
            ],
            [
                'file_number' => '52418463',
                'document_type_id' => 1,
                'lawyer_id' => 1,
                'user_id' => 3,
                'plaintiff_id' => 1,
                'court_branch_id' => 2,
                'court_class_number' => '412456012',
                'court_filing_number' => '741145820',
                'document_status_id' => 3 ,
                'description' => 'در خصوص دادخواست تقدیمی خواهان خانم م.ف فرزند م. به طرفیت خوانده آقای ح.م فرزند ج. به خواسته الزام خوانده به تحویل فرزند مشترک به اسامی م.ر ۶ ساله و م.پ ۴ساله جهت حضانت با توجه به اوراق و محتویات پرونده از جمله فتوکپی مصدق طلاق نامه رسمی به شماره ۰۹۰۱۳۲ صادره از دفتر طلاق شماره ۱۸۴ تهران و صفحات راجع به فرزند در شناسنامه های طرفین وجود رابطه پدر و مادری بین طرفین و فرزندان موسوم برای دادگاه محرز است و خواهان اعلام داشته به لحاظ وضعیت خاص و فقدان مسکن و چون منبع درآمدی ندارم،'
            ],
        ];

        foreach ($documents as $document) Document::create($document);
    }
}
