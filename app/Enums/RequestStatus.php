<?php

namespace App\Enums;

enum RequestStatus: int
{
    case Pending = 0;
    case Rejected = 1;
    case Accepted = 2;

    public function label(): string
    {
        return match ($this) {
            self::Rejected => __('enums.request_statuses.reject'),
            self::Accepted => __('enums.request_statuses.accepted'),
            self::Pending => __('enums.request_statuses.pending'),
        };
    }
}
