<?php

namespace App\Domain\EnumType;

enum Order: string
{
    case Asc = "ASC";
    case Desc = "DESC";
}
