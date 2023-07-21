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
    public function itCanRankAStraightFlush()
    {
        $hand = new PokerHand('4d 2d 3d 6d 5d');
        $this->assertEquals('Straight Flush', $hand->getRank());
    }

    /**
     * @test
    */ 
    public function itCanRankFourKind()
    {
        $hand = new PokerHand('Ah As Ac Ad 6h');
        $this->assertEquals('Four of a Kind', $hand->getRank());
    }

    /**
     * @test
     */
    public function itCanRankAFullHouse()
    {
        $hand = new PokerHand('Kh Kc Ks 4h 4d');
        $this->assertEquals('Full House', $hand->getRank());
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
     * @test
     */
    public function itCanRankAStraight()
    {
        $hand = new PokerHand('Ks Jh Qd Ad 10c');
        $this->assertEquals('Straight', $hand->getRank());
    }

    /**
     * @test
    */ 
    public function itCanRankThreeKind()
    {
        $hand = new PokerHand('Ah As Ac 7d 6h');
        $this->assertEquals('Three of a Kind', $hand->getRank());
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
    public function itCanRankAPair()
    {
        $hand = new PokerHand('Ah As 10c 7d 6s');
        $this->assertEquals('One Pair', $hand->getRank());
    }

    /**
     * @test
     */
    public function itCanRankHighCard(){
        $hand = new PokerHand('Kd 2c 3h 6d 5d');
        $this->assertEquals('High Card', $hand->getRank());
    }

    /**
     * @test
     */
    public function invalidHandFormat(){
        $this->expectException(PokerHandException::class);
        $hand = new PokerHand('asdflkajvg');
    }

    /**
     * @test
     */
    public function invalidHandSize(){
        $this->expectException(PokerHandException::class);
        $hand = new PokerHand('Kt 2c 3h 6d 5d 9d');
    }

    /**
     * @test
     */
    public function invalidCardSuit(){
        $hand = new PokerHand('Kt 2c 3h 6d 5d');
        $this->expectException(PokerHandException::class);
        $hand->getRank();
    }

    /**
     * @test
     */
    public function invalidCardNumericValue(){
        $hand = new PokerHand('Kc 1c 3h 6d 5d');
        $this->expectException(PokerHandException::class);
        $hand->getRank();
    }

    /**
     * @test
     */
    public function invalidCardFaceValue(){
        $hand = new PokerHand('Kc Lc 3h 6d 5d');
        $this->expectException(PokerHandException::class);
        $hand->getRank();
    }


}