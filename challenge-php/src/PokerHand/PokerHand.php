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
        return "High Card";
        
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

}
