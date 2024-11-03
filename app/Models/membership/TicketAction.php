<?php

namespace App\Models\membership;

use App\Models\BaseModel;
use App\Models\User;

class TicketAction extends BaseModel
{
    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    public function referralType()
    {
        return $this->belongsTo(ReferralType::class);
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function actionStatus()
    {
        return $this->belongsTo(TicketStatus::class);
    }

    public function referrer()
    {
        return $this->belongsTo(User::class, 'referrer_id');
    }

    public function referralRecipient()
    {
        return $this->belongsTo(User::class, 'referral_recipient_id');
    }

    public function referrals()
    {
        return $this->hasMany(TicketAction::class, 'ticket_id');
    }

    public function files()
    {
        return $this->morphMany(File::class, 'model');
    }
}
