<?php

declare(strict_types=1);

use Tests\TestCase;
use Src\Domain\Entities\ObjectToAdquire;
use Src\Domain\Errors\InvalidNegativeBid;
use Src\Domain\Entities\Buyer;
use Src\Application\GetAuctionWinUseCase;
use Src\Domain\Errors\BidAlreadyDid;

class AuctionTest extends TestCase
{
    public function test_with_invalid_bid_exception(): void
    {
        $this->expectException(InvalidNegativeBid::class);

        $objectToAdquire = new ObjectToAdquire(price: 100);

        $objectToAdquire->addBid(new Buyer(name: "A"), -100);
    }

    public function test_with_bid_already_did(): void
    {
        $this->expectException(BidAlreadyDid::class);

        $objectToAdquire = new ObjectToAdquire(price: 100);

        $buyerA = new Buyer(name: "A");
        $buyerC = new Buyer(name: "C");

        $objectToAdquire->addBid($buyerA, 110, 130);
        $objectToAdquire->addBid($buyerC, 110);
    }

    public function test_success(): void
    {
        $objectToAdquire = new ObjectToAdquire(price: 100);

        $buyerA = new Buyer(name: "A");
        $buyerC = new Buyer(name: "C");
        $buyerD = new Buyer(name: "D");
        $buyerE = new Buyer(name: "E");

        $objectToAdquire->addBid($buyerA, 110, 130);
        $objectToAdquire->addBid($buyerC, 125);
        $objectToAdquire->addBid($buyerD, 105, 115, 90);
        $objectToAdquire->addBid($buyerE, 132, 135, 140);

        $useCase = new GetAuctionWinUseCase($objectToAdquire);
        $result = $useCase->execute();

        $this->assertEquals("E", $result->winner->name);
        $this->assertEquals(130, $result->price);
    }
}
