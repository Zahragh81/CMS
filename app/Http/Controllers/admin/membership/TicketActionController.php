<?php

namespace App\Http\Controllers\admin\membership;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangeStatusTicketActionRequest;
use App\Http\Requests\TicketActionRequest;
use App\Http\Resources\membership\TicketActionResource;
use App\Http\Resources\membership\TicketStatusResource;
use App\Models\membership\Organization;
use App\Models\membership\ReferralType;
use App\Models\membership\Ticket;
use App\Models\membership\TicketAction;
use App\Models\membership\TicketStatus;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TicketActionController extends Controller
{
    public function index($ticketId)
    {
        $userId = Auth::id();
        $ticket = Ticket::find($ticketId);

        $ticketActions = TicketAction::select(['id', 'referral_order', 'description_action', 'progress_percentage', 'referral_type_id', 'referrer_id', 'organization_id', 'referral_recipient_id', 'action_status_id', 'status'])
            ->with(['referralType:id,name',
                'organization:id,name,national_id',
                'referralRecipient:id,username,first_name,last_name',
                'actionStatus:id,name',
                'files',
                ])
            ->where(function($q) use ($userId){
                $q->where('referrer_id', $userId)
                    ->orWhere('referral_recipient_id', $userId);
            })
            ->where('ticket_id', $ticketId)
            ->paginate($this->first);

        return TicketActionResource::collection($ticketActions);
    }

//    public function index()
//    {
//        $userId = Auth::id();
////        $ticketId = $request->input('ticket_id');
////        \Log::info($ticketId);
//
//        $ticketActions = TicketAction::select(['id', 'referral_order', 'description_action', 'progress_percentage', 'referral_type_id', 'referrer_id', 'organization_id', 'referral_recipient_id', 'action_status_id', 'ticket_id', 'status'])
//            ->with(['referralType:id,name',
//                'organization:id,name,national_id',
//                'referralRecipient:id,username,first_name,last_name',
//                'actionStatus:id,name',
//                'files',
//                'ticket:id,title'
//            ])
//            ->whereHas('ticket', function ($q) use  ($userId){
//                $q->where('referrer_id', $userId)
//                    ->orWhere('referral_recipient_id', $userId);
//            })
//            ->paginate($this->first);
//
//        return TicketActionResource::collection($ticketActions);
//    }


    public function store(TicketActionRequest $request, Ticket $ticket, TicketAction $ticketAction)
    {
        $input = $request->all();
        $input['action_status_id'] = 1;
        $input['referrer_id'] = Auth::id();
        $input['ticket_id'] = $ticket->id;

        $ticketAction = TicketAction::create($input);

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $fileName = uniqid() . '.' . $file->extension();
                $basePath = jdate($ticketAction->created_at)->format('Y/m/d');
                $path = "$basePath/ticket/$ticket->id/ticketAction/$ticketAction->id";

                Storage::putFileAs($path, $file, $fileName);

                $ticketAction->files()->create([
                    'mime_type' => $file->extension(),
                    'size' => $file->getSize() / 1024,
                    'path' => "storage/$path/$fileName"
                ]);
            }
        }

        return self::successResponse();

    }


    public function show(Ticket $ticket, TicketAction $ticketAction)
    {
      return new TicketActionResource($ticketAction->load(['files',
          'referralType:id,name',
          'organization:id,name,national_id',
          'referralRecipient:id,username,first_name,last_name',
          'actionStatus:id,name',
      ]));
    }

//یکی اصلی
    public function update(TicketActionRequest $request, Ticket $ticket, TicketAction $ticketAction)
    {
        $input = $request->all();
         $ticketAction->update($input);

        if ($request->hasFile('files')) {
            foreach ($ticketAction->files as $file) {
                Storage::delete($file->path);
                $file->delete();
            }

            foreach ($request->file('files') as $file) {
                $fileName = uniqid() . '.' . $file->extension();
                $basePath = jdate($ticketAction->created_at)->format('Y/m/d');
                $path = "$basePath/ticket/$ticket->id/ticketAction/$ticketAction->id";

                Storage::putFileAs($path, $file, $fileName);

                $ticketAction->files()->create([
                    'mime_type' => $file->extension(),
                    'size' => $file->getSize() / 1024,
                    'path' => "storage/$path/$fileName"
                ]);
            }
        }

        return self::successResponse();
    }


    public function changeStatusTicketAction(ChangeStatusTicketActionRequest $request, TicketAction $ticketAction)
    {
        $newStatus = $request->action_status_id;

        $ticketAction->action_status_id = $newStatus;
        $ticketAction->save();

        return self::successResponse();
    }


    public function organizationUser(Request $request)
    {
        $request->validate([
            'organization_id' => 'required|exists:organizations,id',
        ]);

        $organizationId = $request->organization_id;

        return self::successResponse([
            'referralRecipient' => User::select(['id', 'username', 'first_name', 'last_name'])
                ->where('organization_id', $organizationId)
                ->get(),
        ]);

    }


    public function upsertData()
    {
        return self::successResponse([
            'referralTypes' => ReferralType::select(['id', 'name'])->get(),
            'organizations' => Organization::select(['id', 'name', 'national_id'])->get(),
            'actionStatuses' => TicketStatus::select(['id', 'name'])->get(),
        ]);
    }
}
