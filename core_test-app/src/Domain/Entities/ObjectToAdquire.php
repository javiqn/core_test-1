<?php

declare(strict_types=1);

namespace Src\Domain\Entities;

use Src\Domain\Errors\BidAlreadyDid;
use Src\Domain\Errors\InvalidNegativeBid;

class ObjectToAdquire
{
    public array $bids = [];

    public function __construct(public readonly int $price)
    {
    }

    public function addBid(Buyer $buyer, int ...$bidPrices): void
    {
        foreach ($bidPrices as $bidPrice) {
            if ($bidPrice < 0) throw new InvalidNegativeBid();
            if ($this->bidAlreadyExists($bidPrice)) throw new BidAlreadyDid();

            $this->bids[] = new Bid($buyer, $bidPrice);
        }
    }

    private function bidAlreadyExists(int $bidPrice): bool
    {
        foreach ($this->bids as $bid) {
            if ($bid->amount === $bidPrice) return true;
        }

        return false;
    }
}
