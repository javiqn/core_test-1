<?php

declare(strict_types=1);

namespace Src\Domain\Errors;

use Exception;

class BidAlreadyDid extends Exception
{
    private const ERROR_CODE = 3;

    public function __construct()
    {
        parent::__construct('Bid is already did', self::ERROR_CODE, null);
    }
}
