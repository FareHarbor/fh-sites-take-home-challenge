<?php namespace PokerHand;
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class PokerHand
{
  public $cardsString;
  public $cardsArray;

  //stores how many cards of each suit are in the hand
  public $suitsArray;

  //stores how many cards of each value are in the hand
  public $valuesArray;

      public function __construct($hand)
      {
        $this->valuesArray = array
       (
             "2" => 0,
             "3" => 0,
             "4" => 0,
             "5" => 0,
             "6" => 0,
             "7" => 0,
             "8" => 0,
             "9" => 0,
             "10" => 0,
             "11" => 0,
             "12" => 0,
             "13" => 0,
             "14" => 0,
       );

       $this->suitsArray = array(
            "d" => 0,
            "h" => 0,
            "c" => 0,
            "s" => 0,
      );
//divides string into array
        $this->cardsString = explode(" ", $hand);


//creates new card objects, pushes to cards array
        $this->cardsArray = array();
        $this->cardsArray[] = new Card($this->cardsString[0]);
        $this->cardsArray[] = new Card($this->cardsString[1]);
        $this->cardsArray[] = new Card($this->cardsString[2]);
        $this->cardsArray[] = new Card($this->cardsString[3]);
        $this->cardsArray[] = new Card($this->cardsString[4]);

        $this->consolidateSuits();
        $this->consolidateValues();
      }

      public function getRank()
      {
          if ($this->testRoyalFlush()){
            return "Royal Flush";
          } else if ($this->testStraightFlush()){
            return "Straight Flush";
          } else if ($this->test4oak()){
            return "4 of a kind";
          } else if ($this->testFullHouse()){
            return "Full House";
          } else if ($this->testFlush()){
            return "Flush";
          } else if ($this->testStraight()){
            return "Straight";
          } else if ($this->test3oak()){
            return "Three of a kind";
          } else if ($this->test2pair()){
            return "Two Pair";
          } else if ($this->testPair()){
            return "One Pair";
          } else {
            return "High Card";
          }
      }

//methods to test for each possible hand.
      public function testRoyalFlush(){
          return ($this->testStraight(10) && $this->testFlush());
      }

      public function testStraightFlush(){
        return ($this->testStraight() && $this->testFlush());
      }

      public function test4oak(){
          return (array_search(4, $this->valuesArray));
      }

      public function testFullHouse(){
        return (array_search(3, $this->valuesArray) && array_search(2, $this->valuesArray));
      }

      public function testFlush(){
        foreach ($this->suitsArray as $suit => $total){
          if ($total==5){
            return true;
          }
        }
        return false;
      }

      public function testStraight($start = 2){
        for ($i=$start; $i<=10; $i++){
          if ($this->valuesArray[$i] == 1 && $this->valuesArray[$i + 1] == 1 && $this->valuesArray[$i + 2] == 1 && $this->valuesArray[$i + 3] == 1 && $this->valuesArray[$i + 4] == 1){
            return true;
          }
        }
        return false;
      }

      public function test3oak(){
        return (array_search(3, $this->valuesArray) && array_search(2, $this->valuesArray) == 0);
      }

      public function test2pair(){
        $temp = array_count_values($this->valuesArray);
        if (count($temp) > 2){
        return ($temp[2] == 2);
      }
      }

      public function testPair(){
        $temp = array_count_values($this->valuesArray);
        if (count($temp) > 2){
        return ($temp[2] == 1);
      }
      }

//iterates through cards and counts how many of each suit there are, stores in suitsArray
      public function consolidateSuits(){
        foreach ($this->cardsArray as $card){
          $this->suitsArray[strtolower($card->getSuit())]++;
        }
      }
//iterates through cards and counts how many of each value there are , stores in valuesarray
      public function consolidateValues(){
            foreach ($this->cardsArray as $card){
              $this->valuesArray[$card->getValue()]++;
            }
      }

//prints cards in hand
      public function printCards(){
        foreach ($this->cardsArray as $card){
            echo $card->getValue() . " of " . $card->getSuit() . " </br> ";
        }
      }
}

//class for each card, contains a value and suit property
class Card
{
public $value;
public $suit;

//takes in short string and sets value and suit based on character and position in string
  public function __construct($card){
    //handles face cards
      switch (strtolower($card[0])){
        case 'a' :
          $this->value = 14;
          $this->suit = $card[1];
          break;
        case 'k' :
          $this->value = 13;
          $this->suit = $card[1];
          break;
        case 'q' :
          $this->value = 12;
          $this->suit = $card[1];
          break;
        case 'j' :
          $this->value = 11;
          $this->suit = $card[1];
          break;
        default:
        //Handles 2-9
          $this->value = $card[0];
          $this->suit = $card[1];
      }
      //handles 10
      if ($card[1] == '0'){
          $this->value = 10;
          $this->suit = $card[2];
      }
  }

//helper functions
  public function getValue(){
    return $this->value;
  }

  public function getSuit(){
    return $this->suit;
  }

public function getCard(){
  return $this->value . " of " . $this->suit . "</br>";
}
}


$hand2 = new PokerHand('Ah As 10c 7d 6s');
$hand3 = new PokerHand('Kh Kc 3s 3h 2d');
$hand4 = new PokerHand('Kh Qh 6h 2h 9h');

?>
