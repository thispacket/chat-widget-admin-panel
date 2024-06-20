<?php

namespace App\Enum;

enum MessageSender: string
{
    case Operator = 'operator';
    case Client = 'client';
}
