<?php

declare(strict_types=1);

namespace Src\Domain\Entities;

class Buyer
{
    public function __construct(public readonly string $name)
    {
    }
}
