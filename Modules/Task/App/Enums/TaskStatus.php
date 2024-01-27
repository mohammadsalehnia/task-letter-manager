<?php

namespace Modules\Task\App\Enums;

enum TaskStatus: int
{
    case PENDING = 1;
    case DOING = 2;
    case DONE = 3;
}
