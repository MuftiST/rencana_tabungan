<?php

namespace App\Notifications;

class ReminderMenabung extends GoalReminderNotification
{
    public function __construct($tabungan, string $reason = 'inactive')
    {
        parent::__construct($tabungan, $reason);
    }
}
