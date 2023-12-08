<?php

namespace App\Enums;

enum E_ShortlistedApplicantStatus: string
{
    case PendingInterview = 'pending-interview';
    case Interviewed = 'interviewed';
    case Accepted = 'accepted';
    case Rejected = 'rejected';

}