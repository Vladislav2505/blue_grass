<?php

namespace App\Enums;

enum RequestStatus: string
{
    case Accepted = 'Принята';
    case Rejected = 'Отклонена';
    case Pending = 'В ожидании';
}
