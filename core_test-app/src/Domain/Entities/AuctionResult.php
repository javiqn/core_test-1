<?php

declare(strict_types=1);

namespace Src\Domain\Entities;

class AuctionResult
{
    public function __construct(
        public readonly Buyer $winner,
        public readonly int $price
    ) {
    }
}
