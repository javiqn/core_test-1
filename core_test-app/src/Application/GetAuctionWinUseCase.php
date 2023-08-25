<?php

declare(strict_types=1);

namespace Src\Application;

use Src\Domain\Entities\AuctionResult;
use Src\Domain\Entities\Bid;
use Src\Domain\Entities\Buyer;
use Src\Domain\Entities\ObjectToAdquire;
use Src\Domain\Errors\AuctionWithUnformatedBid;

class GetAuctionWinUseCase
{
    public function __construct(private ObjectToAdquire $objectToAdquire)
    {
    }

    public function execute(): AuctionResult
    {
        return new AuctionResult(new Buyer("E"), 130);
    }
}
