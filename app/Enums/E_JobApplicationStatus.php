<?php

namespace App\Enums;

enum E_JobApplicantionStatus: string
{
    case Pending = 'pending';
    case InReview = 'in-review';
    case Accepted = 'accepted';
    case Rejected = 'rejected';

}