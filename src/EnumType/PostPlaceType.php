<?php

namespace App\EnumType;

enum PostPlaceType: string
{
    case Draft = "DRAFT";
    case Reviewed = 'REVIEWED';
    case Rejected = 'REJECTED';
    case Published = "PUBLISHED";
}
