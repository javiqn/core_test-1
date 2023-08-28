<?php

declare(strict_types=1);

namespace Src\Application;

use Src\Domain\Entities\AuctionResult;
use Src\Domain\Entities\Bid;
use Src\Domain\Entities\Buyer;
use Src\Domain\Entities\ObjectToAdquire;
use Src\Domain\Errors\AuctionCalculationResultError;

class GetAuctionWinUseCase
{
    public function __construct(private ObjectToAdquire $objectToAdquire)
    {
    }

    public function execute(): ?AuctionResult
    {
        try {
            $validBids = $this->getValidBids();
            if (empty($validBids)) throw new AuctionCalculationResultError();

            $highestBid = $this->getHighestBid($validBids);
            $secondHighestBid = $this->getSecondHighestBid($validBids, $highestBid->buyer);

            return new AuctionResult($highestBid->buyer, $secondHighestBid->amount);
        } catch (\Throwable $th) {
            throw new AuctionCalculationResultError();
        }
    }

    private function getValidBids(): array
    {
        $objectToAuction = $this->objectToAdquire;

        $effectiveBids = array_filter($objectToAuction->bids, function ($b) use ($objectToAuction) {
            return $b->amount >= $objectToAuction->price;
        });

        return array_values($effectiveBids);
    }

    private function getHighestBid(array $validBids): Bid
    {
        $highestBid = array_reduce($validBids, function ($highest, $bid) {
            return ($bid->amount > $highest->amount) ? $bid : $highest;
        }, $validBids[0]);

        return $highestBid;
    }

    function getSecondHighestBid(array $validBids, Buyer $highestBuyer)
    {
        $filteredBids = array_filter($validBids, function ($b) use ($highestBuyer) {
            return $b->buyer !== $highestBuyer;
        });

        usort($filteredBids, function ($a, $b) {
            return $b->amount - $a->amount;
        });

        return $filteredBids[0];
    }
}
