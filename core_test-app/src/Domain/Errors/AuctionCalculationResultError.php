<?php

declare(strict_types=1);

namespace Src\Domain\Errors;

use Exception;

class AuctionCalculationResultError extends Exception
{
    private const ERROR_CODE = 4;

    public function __construct()
    {
        parent::__construct('This auction has an unexpected error', self::ERROR_CODE, null);
    }
}
