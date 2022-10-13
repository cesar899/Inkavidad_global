<?php

namespace App\Constants;

class CBatchStatus
{
    const BATCH_AVAILABLE = 0;
    const BATCH_RESERVED = 1;
    const BATCH_PARTIALLY_PAID = 2;
    const BATCH_PAID = 3;
    const BATCH_LEGAL = 4;
    const BATCH_LAWFUL_FAILED = 5;
    const BATCH_COMPLETED = 6;
}
