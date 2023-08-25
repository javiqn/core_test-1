<?php

declare(strict_types=1);

namespace Src\Domain\Errors;

use Exception;

class InvalidNegativeBid extends Exception
{
    private const ERROR_CODE = 2;

    public function __construct()
    {
        parent::__construct('The bid cannot be less than 0', self::ERROR_CODE, null);
    }
}
