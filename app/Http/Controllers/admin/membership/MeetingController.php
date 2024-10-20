<?php

namespace App\Http\Controllers\admin\membership;

use App\Http\Controllers\Controller;
use App\Http\Requests\MeetingRequest;
use App\Http\Resources\membership\MeetingResource;
use App\Http\Resources\membership\SmsNotificationResource;
use App\Jobs\SendSms;
use App\Jobs\SendSmsNotification;
use App\Models\membership\Document;
use App\Models\membership\HoldingType;
use App\Models\membership\Meeting;
use App\Models\membership\MeetingStatus;
use App\Models\membership\SmsNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Morilog\Jalali\Jalalian;
use function App\Helpers\to_georgian;
use function App\Helpers\to_jalali;

class MeetingController extends Controller
{
    public function index(Document $document)
    {
        $meetings = $document->meetings()
            ->select(['id', 'title', 'start_time', 'end_time', 'location', 'description', 'notification', 'status', 'document_id', 'meeting_status_id', 'holding_type_id'])
            ->with(['files',
                'meetingStatus:id,name',
                'holdingType:id,name'])
            ->where('title', 'like', $this->search)
            ->paginate($this->first);

        return MeetingResource::collection($meetings);
    }


    public function store(MeetingRequest $request, Document $document)
    {
        $inputs = $request->all();
        $inputs['start_time'] = to_georgian($request->start_time);
        $inputs['end_time'] = $request->end_time ? to_georgian($request->end_time) : $inputs['start_time'];
        $inputs['description'] = $inputs['description'] ?? '';

        $meeting = $document->meetings()->create($inputs);

        if ($meeting->notification) {
            $shamsiDate = to_jalali($meeting->start_time);
            $textMessage = "یاداوری : جلسه شما در " . $shamsiDate . " شروع می شود";

            $mobile = $document->user->mobile;

            $sendTime = Carbon::parse($meeting->start_time)->subHours(2);

            SmsNotification::create([
                'text' => $textMessage,
                'model_id' => $meeting->id,
                'model_type' => get_class($meeting),
                'send_time' => $sendTime,
                'sms_notification_recipient_id' => $document->user->id
            ]);

            SendSmsNotification::dispatch($mobile, $textMessage)->delay($sendTime);
        }

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $fileName = uniqid() . '.' . $file->extension();
                $basePath = jdate($meeting->created_at)->format('Y/m/d');
                $path = "$basePath/document/$document->id/meeting/$meeting->id";

                Storage::putFileAs($path, $file, $fileName);

                $meeting->files()->create([
                    'mime_type' => $file->extension(),
                    'size' => $file->getSize() / 1024,
                    'path' => "storage/$path/$fileName",
                ]);
            }
        }

        return self::successResponse();
    }


    public function show(Document $document, Meeting $meeting)
    {
        return new MeetingResource($meeting->load(['files',
            'meetingStatus:id,name',
            'holdingType:id,name'
        ]));
    }


    public function update(MeetingRequest $request, Document $document, Meeting $meeting)
    {
        $inputs = $request->all();
        $inputs['start_time'] = to_georgian($request->start_time);
        $inputs['end_time'] = to_georgian($request->end_time);
        $inputs['description'] = $inputs['description'] ?? '';

        $meeting->update($inputs);

        if ($request->hasFile('files')) {
            foreach ($meeting->files as $file) {
                Storage::delete($file->path);
                $file->delete();
            }

            foreach ($request->file('files') as $file) {
                $fileName = uniqid() . '.' . $file->extension();
                $basePath = jdate($meeting->created_at)->format('Y/m/d');
                $path = "$basePath/document/$document->id/meeting/$meeting->id";


                Storage::putFileAs($path, $file, $fileName);

                $meeting->files()->create([
                    'mime_type' => $file->extension(),
                    'size' => $file->getSize() / 1024,
                    'path' => "storage/$path/$fileName"
                ]);
            }
        }

        return self::successResponse();
    }


//    public function update(MeetingRequest $request, Document $document, Meeting $meeting)
//    {
//        $inputs = $request->all();
//        $inputs['start_time'] = to_georgian($request->start_time);
//        $inputs['end_time'] = to_georgian($request->end_time);
//        $inputs['description'] = $inputs['description'] ?? '';
//
//        $originalStartTime = $meeting->start_time;
//
//        $meeting->update($inputs);
//
//
//        $existingJob = SmsNotification::where('model_id', $meeting->id)
//            ->where('model_type', Meeting::class)
//            ->first();
//
//        if ($existingJob){
//            $existingJob->delete();
//        }
//
//        if ($originalStartTime !== $meeting->start_time && $meeting->notification){
//            $shamsiDate = to_jalali($meeting->start_time);
//            $textMessage = "یاداوری : جلسه شما در " . $shamsiDate . " شروع می شود";
//
//            $mobile = $document->user->mobile;
//
//            $sendTime = Carbon::parse($meeting->start_time)->subHours(2);
//
//            SmsNotification::create([
//                'text' => $textMessage,
//                'model_id' => $meeting->id,
//                'model_type' => get_class($meeting),
//                'send_time' => $sendTime,
//                'sms_notification_recipient_id' => $document->user->id
//            ]);
//
//            SendSmsNotification::dispatch($mobile, $textMessage)->delay($sendTime);
//        }
//
//
//        if ($request->hasFile('files')) {
//            foreach ($meeting->files as $file) {
//                Storage::delete($file->path);
//                $file->delete();
//            }
//
//            foreach ($request->file('files') as $file) {
//                $fileName = uniqid() . '.' . $file->extension();
//                $basePath = jdate($meeting->created_at)->format('Y/m/d');
//                $path = "$basePath/document/$document->id/meeting/$meeting->id";
//
//
//                Storage::putFileAs($path, $file, $fileName);
//
//                $meeting->files()->create([
//                    'mime_type' => $file->extension(),
//                    'size' => $file->getSize() / 1024,
//                    'path' => "storage/$path/$fileName"
//                ]);
//            }
//        }
//
//        return self::successResponse();
//    }


    public function destroy(Document $document, Meeting $meeting)
    {
        if ($meeting->files) {
            foreach ($meeting->files as $file) {
                if (Storage::disk('public')->exists($file->path)) {
                    Storage::disk('public')->delete($file->path);
                }
                $file->delete();
            }
        }

        $meeting->delete();

        return self::successResponse();
    }


    public function smsNotification(Document $document, Meeting $meeting)
    {
        $smsNotifications = SmsNotification::where('model_id', $meeting->id)
            ->where('model_type', Meeting::class)
            ->select(['id', 'text', 'model_type', 'model_id', 'send_time', 'sms_notification_recipient_id', 'status'])
            ->with('recipient')
            ->paginate($this->first);

        return SmsNotificationResource::collection($smsNotifications);
    }


    public function upsertData()
    {
        return self::successResponse([
            'meetingStatuses' => MeetingStatus::select(['id', 'name'])->get(),
            'holdingTypes' => HoldingType::select(['id', 'name'])->get()
        ]);
    }


    public function calendar()
    {
        $meetings = Meeting::whereHas('document', function ($q) {
            $q->where('user_id', Auth::id());
        })
            ->select(['id', 'title', 'start_time', 'end_time', 'location', 'description', 'notification', 'status', 'document_id', 'meeting_status_id', 'holding_type_id'])
            ->with(['files',
                'meetingStatus:id,name',
                'holdingType:id,name'])
            ->where('title', 'like', $this->search)
            ->paginate($this->first);

        return MeetingResource::collection($meetings);
    }
}
