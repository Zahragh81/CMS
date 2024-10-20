<?php

namespace App\Http\Controllers\admin\membership;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangeStatusTicketRequest;
use App\Http\Requests\TicketRequest;
use App\Http\Resources\membership\TicketResource;
use App\Models\membership\Ticket;
use App\Models\membership\TicketGroup;
use App\Models\membership\TicketPriority;
use App\Models\membership\TicketStatus;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use function Symfony\Component\String\u;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::select(['id', 'title', 'description', 'user_id', 'ticket_group_id', 'ticket_priority_id', 'ticket_status_id', 'status'])
            ->with([
                'files',
                'user:id,username,first_name,last_name',
                'ticketGroup:id,name',
                'ticketPriority:id,name',
                'ticketStatus:id,name',
                'actions'
            ])
//            ->withAvg('actions', 'progress_percentage')
            ->where(function ($q) {
                $q->where('title', 'like', $this->search);
            })
            ->paginate($this->first);

        return TicketResource::collection($tickets);

    }


    public function store(TicketRequest $request)
    {
        $input = $request->all();
        $input['description'] = $input['description'] ?? '';
        $input['ticket_status_id'] = 1;

        $ticket = Ticket::create($input);

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $fileName = uniqid() . '.' . $file->extension();
                $basePath = jdate($ticket->created_at)->format('Y/m/d');
                $path = "$basePath/ticket/$ticket->id";

                Storage::putFileAs($path, $file, $fileName);

                $ticket->files()->create([
                    'mime_type' => $file->extension(),
                    'size' => $file->getSize() / 1024,
                    'path' => "storage/$path/$fileName"
                ]);
            }
        }

        return self::successResponse();
    }


    public function show(Ticket $ticket)
    {
        return new TicketResource($ticket->load(['files',
            'user:id,username,first_name,last_name',
            'ticketGroup:id,name',
            'ticketPriority:id,name',
            'ticketStatus:id,name',
            'actions'
        ]));
    }


    public function changeStatus(ChangeStatusTicketRequest $request, Ticket $ticket)
    {
        $newStatus = $request->ticket_status_id;

        $ticket->ticket_status_id = $newStatus;
        $ticket->save();

        return self::successResponse();
    }


    public function upsertData()
    {
        return self::successResponse([
            'users' => User::select(['id', 'username', 'first_name', 'last_name'])->get(),
            'ticketGroups' => TicketGroup::select(['id', 'name'])->get(),
            'ticketPriority' => TicketPriority::select(['id', 'name'])->get(),
            'ticketStatus' => TicketStatus::select(['id', 'name'])->get(),
        ]);
    }
}
