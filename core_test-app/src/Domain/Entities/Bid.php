<?php

declare(strict_types=1);

namespace Src\Domain\Entities;

use Src\Domain\Errors\InvalidNegativeBid;

class Bid
{
    public function __construct(
        public readonly Buyer $buyer,
        public readonly int $amount
    ) {
        $this->guard();
    }

    private function guard(): void
    {
        if ($this->amount < 0) throw new InvalidNegativeBid();
    }
}
