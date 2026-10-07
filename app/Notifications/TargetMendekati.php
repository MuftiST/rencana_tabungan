<?php

namespace App\Notifications;

class TargetMendekati extends GoalReminderNotification
{
    public function __construct($tabungan)
    {
        parent::__construct($tabungan, 'deadline');
    }
}
