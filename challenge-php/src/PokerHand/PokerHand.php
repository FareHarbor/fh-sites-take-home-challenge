<?php

namespace PokerHand;

class PokerHandException extends \Exception {};

class PokerHand
{

    private static $rankText = ['Royal Flush','Straight Flush','Four of a Kind',
    'Full House','Flush','Straight','Three of a Kind','Two Pair','One Pair','High Card'];

    private static $faceValue = ['J' => 11,'Q' => 12,'K' => 13,'A' => 14];

    private static $suits = ['c','d','h','s'];

    private $pokerHand;

    public function __construct($hand)
    {
        $this->validateHand($hand);
        $this->pokerHand = explode(' ', $hand);
    }


    /*
    * Determines the rank of a 5 card poker hand
    *
    */

    public function getRank()
    {

        $sortedHand = $this->processHand();
        $cardValues = array_merge(...array_values($sortedHand));
        $isFlush = count(array_keys($sortedHand)) == 1;
        $rank = $this->getSequentialRank($cardValues, $isFlush);

        return empty($rank) ? self::$rankText[9] || $rank;
        
    }

    /*
    * Validates that the string representation of the hand is in the basic proper format
    * of a space delinated string, with 5 substrings. Throws PokerHandException if invalid.
    *
    */
    private function validateHand($hand){
        if(!is_string($hand) || !(substr_count(trim($hand), ' ') == 4)){
            error_log("Invalid Hand Format: $hand");
            throw new PokerHandException("Invalid Hand Format");
        }
    }

    /*
    * Process the poker hand array into a assoc. array with the suits as keys
    * and the numeric values of the cards as array values.  
    *
    * @return sortedHand - hand sorted by suit and card value - associative array [string => [int]]
    *
    */
    private function processHand(){
        
        $sortedHand = [];
        foreach($this->pokerHand as $card)
        {

            $suit = $this->getSuit($card);
            $cardValue = $this->getNumericCardValue($card);
            
            if(empty($sortedHand[$suit])){
                $sortedHand[$suit] = [];
            }
            array_push($sortedHand[$suit], intVal($cardValue));
        }
        return $sortedHand;
    }

    /*
     * Gets the suit from the card, determines if the suit is a valid
     * 
     * @return suit - suit letter - string
     */
    private function getSuit($card){
        $suit = substr($card, -1);
            if (!in_array($suit, self::$suits)){
                error_log("Invalid Suit: $suit");
                throw new PokerHandException("Invalid Suit");
            }
        return $suit;
    }

    /*
    * Gets the value from the card, converting face cards to numeric values
    * and determines if the card value is valid.
    *
    * @return value - numeric card value - int 
    */
    private function getNumericCardValue($card){
        $cardValue = strtoupper(substr($card, 0, -1));   
                        
        if(isset(self::$faceValue[$cardValue])){
            $cardValue = self::$faceValue[$cardValue];
        }

        if ($cardValue < 2) {
            error_log("Invalid Card Value: $cardValue");
            throw new PokerHandException("Invalid Card Value");
        }
        return $cardValue;
    }

 /*
    * Determines whether the cardvalues in a hand are in sequential order and whether or not they are
    * sequential high cards.
    */
    private function getSequentialRank($cardValues, $isFlush){
        
        $sortedValues = $cardValues;
        sort($sortedValues);
        $previousValue = $sortedValues[0];

        //if first value in array is 10 all values are equal or higher
        $isRoyal = $previousValue >= 10;
        $isStraight = true;
        
        for($i=1; $i<sizeof($sortedValues); $i++)
        { 
            if ($sortedValues[$i] != $previousValue+1){
                $isStraight = false; 
                $isRoyal = false;
                break;
            }
            $previousValue = $sortedValues[$i];
        }
        
        if($isRoyal && $isFlush){
            return self::$rankText[0];
        }

        else if($isStraight && $isFlush){
            return self::$rankText[1];
        }

        else if($isFlush){ 
            return self::$rankText[4];
        }

        else if($isStraight){
            return self::$rankText[5];
        }
        else{
            return "";
        }
        
    }

}
