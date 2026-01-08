<?php
namespace PokerHand;

use PHPUnit\Framework\TestCase;

class PokerHandTest extends TestCase
{
    /**
     * @test
     */
    public function itCanRankARoyalFlush()
    {
        $hand = new PokerHand('As Ks Qs Js 10s');
        $this->assertEquals('Royal Flush', $hand->getRank());
    }

    /**
     * @test
     */
    public function itCanRankAPair()
    {
        $hand = new PokerHand('Ah As 10c 7d 6s');
        $this->assertEquals('One Pair', $hand->getRank());
    }

    /**
     * @test
     */
    public function itCanRankTwoPair()
    {
        $hand = new PokerHand('Kh Kc 3s 3h 2d');
        $this->assertEquals('Two Pair', $hand->getRank());
    }

    /**
     * @test
     */
    public function itCanRankAFlush()
    {
        $hand = new PokerHand('Kh Qh 6h 2h 9h');
        $this->assertEquals('Flush', $hand->getRank());
    }

    /**
       * @test Full House
       */
      public function itCanRankAFullHouse()
      {
          $hand = new PokerHand('Ah As Ac 5d 5s');
          $this->assertEquals('Full House', $hand->getRank());
      }


    /**
     * @test Four of a Kind
     */
    public function itCanRankFourOfAKind()
    {
        $hand = new PokerHand('9h 3c 3s 3h 3d');
        $this->assertEquals('Four of a Kind', $hand->getRank());
    }



    /**
       * @test Straight Flush
       */
      public function itCanRankAStraightFlush()
      {
          $hand = new PokerHand('5h 4h 6h 7h 8h');
          $this->assertEquals('Straight Flush', $hand->getRank());
      }

      /**
          * @test Three of a Kind
          */
         public function itCanRankThreeOfAKind()
         {
             $hand = new PokerHand('Kh Kc Ks 3h 2d');
             $this->assertEquals('Three of a Kind', $hand->getRank());
         }
         
    /**
     * @test
     */
    public function itCanRankAnEvilStraight()
    {
        $hand = new PokerHand('Ah 2s 3c 4d 5s');
        $this->assertEquals('Straight', $hand->getRank());
    }

    /**
     * @test
     */
    public function itCanRankAHighCard()
{
    $hand = new PokerHand('Kh 3d 4s Ah Jh');
    $this->assertEquals('High Card', $hand->getRank());
}


    // TODO: More tests go here
}
