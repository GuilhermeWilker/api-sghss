<?php

namespace App;

enum AppointmentStatus: string
{
    case Scheduled = 'agendada';
    case Completed = 'concluida';
    case Canceled = 'cancelada';
}
