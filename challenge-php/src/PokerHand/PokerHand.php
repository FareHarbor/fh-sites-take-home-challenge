<?php namespace PokerHand;
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



class PokerHand
{
  public $cardsString;
  public static $cardsArray = array();

  //stores how many cards of each suit are in the hand
  public static $suitsArray = array(
        "diamonds" => 0,
        "hearts" => 0,
        "clubs" => 0,
        "spades" => 0,
  );

  //stores how many cards of each value are in the hand
  public static $valuesArray = array
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

      public function __construct($hand)
      {
//divides string into array
        $this->cardsString = explode(" ", $hand);

//creates new card objects, pushes to cards array
        self::$cardsArray[] = new Card($this->cardsString[0]);
        self::$cardsArray[] = new Card($this->cardsString[1]);
        self::$cardsArray[] = new Card($this->cardsString[2]);
        self::$cardsArray[] = new Card($this->cardsString[3]);
        self::$cardsArray[] = new Card($this->cardsString[4]);


//sorts hand by value
        usort(self::$cardsArray, array($this, "compareValues"));


        $this->consolidateSuits();
        $this->consolidateValues();

        //echo print_r(self::$valuesArray) . "<br>";
        //echo print_r(self::$suitsArray) . "<br>";

//prints cards
        $this->printCards();

        echo $this->getRank();
        //echo  $this->compareSuits($this->card1, $this->card2);
      }

      private function getRank()
      {
          if ($this->testRoyalFlush()){
            return "Royal Flush!";
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
            return "Pair";
          } else {
            return "High Card";
          }
      }

//tests for each possible hand.


      public function testRoyalFlush(){
          return ($this->testStraight(10) && $this->testFlush());
      }

      public function testStraightFlush(){
        return ($this->testStraight() && $this->testFlush());
      }

      public function test4oak(){
          return (array_search(4, self::$valuesArray));
      }

      public function testFullHouse(){
        return (array_search(3, self::$valuesArray) && array_search(2, self::$valuesArray));
      }

      public function testFlush(){
        foreach (self::$suitsArray as $suit => $total){
          if ($total==5){
            return true;
          }
        }
        return false;
      }


      public function testStraight($start = 2){
        for ($i=$start; $i<=10; $i++){
          if (self::$valuesArray[$i] == 1 && self::$valuesArray[$i + 1] == 1 && self::$valuesArray[$i + 2] == 1 && self::$valuesArray[$i + 3] == 1 && self::$valuesArray[$i + 4] == 1){
            return true;
          }
        }
        return false;
      }

      public function test3oak(){
        return (array_search(3, self::$valuesArray) && array_search(2, self::$valuesArray) == 0);
      }


      public function test2pair(){
        $temp = array_count_values(self::$valuesArray);
        if (count($temp) > 2){
        return ($temp[2] == 2);
      }
      }

      public function testPair(){
        $temp = array_count_values(self::$valuesArray);
        if (count($temp) > 2){
        return ($temp[2] == 1);
      }
      }

//iteratres through cards and counts how many of each suit there are, stores in suitsArray
      public function consolidateSuits(){
        foreach (self::$cardsArray as $card){
          switch (strtolower($card->getSuit())){
            case 'h' :
              self::$suitsArray["hearts"]++;
              break;
            case 's' :
              self::$suitsArray["spades"]++;
              break;
            case 'c' :
              self::$suitsArray["clubs"]++;
              break;
            case 'd' :
              self::$suitsArray["diamonds"]++;
              break;
          }
        }
      }

//iterates through cards and counts how many of each value there are , stores in valuesarray
      public function consolidateValues(){
            foreach (self::$cardsArray as $card){
              switch($card->getValue()){
                case 2 :
                  self::$valuesArray["2"]++;
                  break;
                case 3 :
                  self::$valuesArray["3"]++;
                  break;
                case 4 :
                  self::$valuesArray["4"]++;
                  break;
                case 5 :
                  self::$valuesArray["5"]++;
                  break;
                case 6 :
                  self::$valuesArray["6"]++;
                  break;
                case 7 :
                  self::$valuesArray["7"]++;
                  break;
                case 8 :
                  self::$valuesArray["8"]++;
                  break;
                case 9 :
                  self::$valuesArray["9"]++;
                  break;
                case 10 :
                  self::$valuesArray["10"]++;
                  break;
                case 11 :
                  self::$valuesArray["11"]++;
                  break;
                case 12 :
                  self::$valuesArray["12"]++;
                  break;
                case 13 :
                  self::$valuesArray["13"]++;
                  break;
                case 14 :
                  self::$valuesArray["14"]++;
                  break;
              }


            }

      }

//compares two card objects by their value
      public function compareValues(Card $a, Card $b)
      {
          if ($a->getValue() == $b->getValue()) {
              return 0;
            }
          return ($a->getValue() < $b->getValue()) ? -1 : 1;
      }

//compares two card objects by their suit
      public function compareSuits(Card $a, Card $b){
        if ($a->getSuit() == $b->getSuit()){
          return 1;
        } else {
          return 0;
        }
      }


//prints cards in hand
      public function printCards(){
        foreach (self::$cardsArray as $card){
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

$myHand = new PokerHand('9s 9S KS QS js');

?>
