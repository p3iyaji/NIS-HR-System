<?php

namespace App\Enums;

enum E_LeaveStatus: string
{
    case Pending = 'Pending';
    case Approved = 'Approved';
    case Rejected = 'Rejected';

}
