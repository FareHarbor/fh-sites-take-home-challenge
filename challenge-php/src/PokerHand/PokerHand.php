<?php

namespace PokerHand;

class PokerHand
{

    private static $rankText = ['Royal Flush','Straight Flush','Four of a Kind',
    'Full House','Flush','Straight','Three of a Kind','Two Pair','One Pair','High Card'];

    private static $faceValue = ['J' => 11,'Q' => 12,'K' => 13,'A' => 14];


    private $pokerHand=[];


    public function __construct($hand)
    {

        if($this->validateHand($hand)){
            $this->pokerHand = explode(' ', $hand);
        }
    }

    public function getRank()
    {

        $sortedHand = $this->processHand();
        $isFlush = count(array_keys($sortedHand)) == 1;

        if($isFlush){ 
            return self::$rankText[4];
        }

        // TODO: Implement poker hand ranking
        return 'Royal Flush';
    }

    private function validateHand($hand){
        return true;
    }

    private function processHand(){
        
        $sortedHand = [];
        foreach($this->pokerHand as $card)
        {
            $suit = substr($card, -1);
            $cardValue = substr($card, 0, -1);
            if(!is_numeric($cardValue)){
                $cardValue = self::$faceValue[$cardValue];
            }
            $sortedHand[$suit] = $cardValue;
        }
        return $sortedHand;
    }
}
