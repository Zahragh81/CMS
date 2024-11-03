<?php

namespace App\Http\Controllers\admin\membership;

use App\Http\Controllers\Controller;
use App\Http\Resources\membership\TicketResource;
use App\Models\membership\Organization;
use App\Models\membership\Ticket;
use App\Models\membership\TicketAction;
use App\Models\membership\TicketGroup;
use App\Models\membership\TicketStatus;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Morilog\Jalali\Jalalian;


class DashboardController extends Controller
{
    public function ticketPerYear()
    {
        $solarMonth = [
            1 => 'فروردین',
            2 => 'اردیبهشت',
            3 => 'خرداد',
            4 => 'تیر',
            5 => 'مرداد',
            6 => 'شهریور',
            7 => 'مهر',
            8 => 'آبان',
            9 => 'آذر',
            10 => 'دی',
            11 => 'بهمن',
            12 => 'اسفند'
        ];

        $tickets = Ticket::whereYear('created_at', date('Y'))
            ->whereNull('deleted_at')
            ->get()
            ->groupBy(function ($date) {
                return Jalalian::fromDateTime($date->created_at)->getMonth();
            });

        $ticketCount = array_fill(1, 12, 0);

        foreach ($tickets as $month => $ticketGroup){
            $ticketCount[$month] = $ticketGroup->count();
        }

        $result = [];

        foreach ($solarMonth as $mothIndex => $monthName){
            $result[] = [
                'month' => $monthName,
                'count' => (int) $ticketCount[$mothIndex]
             ];
        }

        return self::successResponse($result);
    }


    public function ticketStatus()
    {
        $statuses = TicketStatus::withCount('tickets')->get()->keyBy('id');

        $totalStatuses = Ticket::count();

        $statusDistribution = [];

        foreach ($statuses as $status) {
            $count = $status->tickets_count;
            $countValue = (int)$count;

            $percentage = $totalStatuses > 0 ? ($countValue / $totalStatuses) * 100 : 0;

            $statusDistribution[] = [
                'status' => $status->name,
                'count' => $countValue,
                'percentage' => round($percentage, 2)
            ];
        }

        return self::successResponse($statusDistribution);
    }


//    public function indexByLowestProgress()
//    {
//        $tickets = Ticket::select(['id', 'title', 'description', 'user_id', 'ticket_group_id', 'ticket_priority_id', 'ticket_status_id', 'status'])
//            ->with([
//                'files',
//                'user:id,username,first_name,last_name',
//                'ticketGroup:id,name',
//                'ticketPriority:id,name',
//                'ticketStatus:id,name',
//                'actions'
//            ])
//            ->withAvg('actions', 'progress_percentage')
//            ->orderBy('actions_avg_progress_percentage', 'asc')
//            ->limit(12)
//            ->simplePaginate($this->first);
//
//        return TicketResource::collection($tickets);
//    }


    public function indexByLowestProgress()
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
            ->withAvg('actions', 'progress_percentage')
            ->orderBy('actions_avg_progress_percentage', 'asc')
            ->take(50)
            ->get();

        $perPage = 10;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentItems = $tickets->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $paginatedItems = new LengthAwarePaginator($currentItems, $tickets->count(), $perPage, $currentPage, [
            'path' => LengthAwarePaginator::resolveCurrentPath()
        ]);

        return TicketResource::collection($paginatedItems);
    }


    public function ticketGroup()
    {
        $groups = TicketGroup::withCount('tickets')
            ->get();

        $totalTickets = Ticket::count();
        $groupDistribution = [];

        foreach ($groups as $group) {
            $count = (int)$group->tickets_count;
            $percentage = $totalTickets > 0 ? ($count / $totalTickets) * 100 : 0;

            $groupDistribution[] = [
                'group' => $group->name,
                'count' => $count,
                'percentage' => round($percentage, 2)
            ];
        }

        return self::successResponse($groupDistribution);
    }


    public function upsertData()
    {
        return self::successResponse([
            'organizations' => Organization::select(['id', 'name', 'national_id'])->get()
        ]);
    }


    public function ticketActionCountByOrganization()
    {
        $organizations = Organization::withCount('ticketActions')->get();

        $result = $organizations->map(function ($organization) {
            return [
                'name' => $organization->name,
                'ticket_action_count' => $organization->ticket_actions_count
            ];
        });

        return self::successResponse($result);
    }


    public function ticketActionCountByOrganizationAndMonth(Request $request)
    {
        $request->validate([
            'organization_id' => 'required|exists:organizations,id'
        ]);

        $organizationId = $request->organization_id;

        $ticketActionCounts = TicketAction::where('organization_id', $organizationId)
            ->get()
            ->groupBy(function ($item) {
                return Jalalian::fromCarbon(Carbon::parse($item->created_at))->getMonth();
            });

        $months = [
            1 => 'فرودین',
            2 => 'اردیبهشت',
            3 => 'خرداد',
            4 => 'تیر',
            5 => 'مرداد',
            6 => 'شهریور',
            7 => 'مهر',
            8 => 'ابان',
            9 => 'اذر',
            10 => 'دی',
            11 => 'بهمن',
            12 => 'اسفند'
        ];

        $result = [];

        for ($i = 1; $i <= 12; $i++) {
            $count = isset($ticketActionCounts[$i]) ? count($ticketActionCounts[$i]) : 0;

            $result[] = [
                'month' => $months[$i],
                'count' => (int)$count
            ];
        }

        return self::successResponse($result);
    }


    public function topOrganizationsByTicketAction()
    {
        $topOrganizations = Organization::withCount('ticketActions')
            ->orderBy('ticket_actions_count', 'desc')
            ->limit(4)
            ->get();

        $result = $topOrganizations->map(function ($organization) {
            return [
                'organization_name' => $organization->name,
                'ticket_action_count' => (int)$organization->ticket_actions_count,
            ];
        });

        return self::successResponse($result);
    }


    public function topReferralExpert()
    {
        $topExperts = User::withCount('receivedReferrals')
//            ->with('avatar')
            ->orderBy('received_referrals_count', 'desc')
            ->limit(4)
            ->get();

        $result = $topExperts->map(function ($expert) {
            return [
                'expert_id' => $expert->id,
                'expert_userName' => $expert->username,
                'expert_firstName' => $expert->first_name,
                'expert_lastName' => $expert->last_name,
                'referral_count' => $expert->received_referrals_count,
//                'avatar_url' => $expert->avatar ? $expert->avatar->url : null,
            ];
        });

        return self::successResponse($result);
    }


    public function topTicketByReferral()
    {
        $topTickets = Ticket::withCount('actions')
            ->with(['ticketStatus'])
            ->orderBy('actions_count', 'desc')
            ->limit(4)
            ->get();

        $result = $topTickets->map(function ($ticket) {
            return [
                'ticket_id' => $ticket->id,
                'ticket_title' => $ticket->title,
                'ticket_description' => $ticket->description,
                'ticket_status' => $ticket->ticketStatus->name ?? null,
                'referral_count' => $ticket->actions_count,
                'description_action' => $ticket->actions->first()->description_action ?? null
            ];
        });

        return self::successResponse($result);
    }


}
