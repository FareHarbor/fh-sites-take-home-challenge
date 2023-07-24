<?php

namespace PokerHand;

class PokerHandException extends \Exception
{
}
;

class PokerHand
{

    private static $faceValue = ['J' => 11, 'Q' => 12, 'K' => 13, 'A' => 14];

    private static $suits = ['c', 'd', 'h', 's'];

    private $rankHierarchy = [
        'Royal Flush' => false,
        'Straight Flush' => false,
        'Four of a Kind' => false,
        'Full House' => false,
        'Flush' => false,
        'Straight' => false,
        'Three of a Kind' => false,
        'Two Pair' => false,
        'One Pair' => false,
        'High Card' => true
    ];

    private $pokerHand;

    public function __construct($hand)
    {
        $this->validateHand($hand);
        $this->pokerHand = explode(' ', $hand);
    }

    /*
     * Determines the rank of a 5 card poker hand.
     *
     * Checks are split into 2 groups: Sequential & Flushes and Card Matches
     * 
     * sequential ranks are checked first as they are higher ranked and you cannot have both a flush and 
     * higher ranked matching value hand ex. you cannot have a flush & 4 of a kind  Only perform checks on matches if the previous ranking check returns an
     * empty string rank.
     *
     * @return rank - card ranking text - String
     */
    public function getRank()
    {
        $processedHand = $this->processHand();
        $cardValues = array_merge(...array_values($processedHand));
        $this->setRankHierarchy('Flush', count(array_keys($processedHand)) === 1);
        $this->setSequentialRankFlags($cardValues);
        $highRank = $this->getHighestRank();

        if ($highRank == 'High Card') {
            $this->setCardMatchRankFlags($cardValues);
            $highRank = $this->getHighestRank();
        }

        return $highRank;
    }

    /*
     * Validates that the string representation of the hand is in the basic proper format
     * of a space delinated string, with 5 substrings. Throws PokerHandException if invalid.
     *
     */
    private function validateHand($hand)
    {
        if (!is_string($hand) || !(substr_count(trim($hand), ' ') === 4)) {
            error_log("Invalid Hand Format: $hand");
            throw new PokerHandException("Invalid Hand Format");
        }
    }

    /*
     * Process the poker hand array into a assoc. array with the suits as keys
     * and the numeric values of the cards as array values.  
     *
     * ex: [Ac, Kh, 3h, 7c, 2d] will return [c => [14, 7], d=> [2], h => [13, 3]]
     *
     * @return sortedHand - cards in hand grouped by suit - associative array [string => [int]]
     *
     */
    private function processHand()
    {
        $processedHand = [];
        foreach ($this->pokerHand as $card) {
            $suit = $this->getSuit($card);
            $cardValue = $this->getNumericCardValue($card);

            if (empty($processedHand[$suit])) {
                $processedHand[$suit] = [];
            }
            if (in_array($cardValue, $processedHand[$suit])) {
                error_log("Duplicate Card: $suit, $cardValue");
                throw new PokerHandException("Duplicate Card");
            }
            array_push($processedHand[$suit], $cardValue);
        }
        return $processedHand;
    }

    /*
     * Gets the suit from the card, determines if the suit is a valid
     * 
     * @return suit - suit letter - string
     */
    private function getSuit($card)
    {
        $suit = substr($card, -1);
        if (!in_array($suit, self::$suits)) {
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
    private function getNumericCardValue($card)
    {
        $cardValue = strtoupper(substr($card, 0, -1));

        if (isset(self::$faceValue[$cardValue])) {
            $cardValue = self::$faceValue[$cardValue];
        }

        if ($cardValue < 2) {
            error_log("Invalid Card Value: $cardValue");
            throw new PokerHandException("Invalid Card Value");
        }

        return intVal($cardValue);
    }

    /*
     * Determines whether the cardvalues in a hand are in sequential 
     * order and whether or not they are sequential high cards. 
     * Sorts the array of cardValues first and sets the flags if conditions are met.
     *
     *  @param cardValues - array of card values - int[]
     */
    private function setSequentialRankFlags($cardValues)
    {
        $sortedValues = $cardValues;
        sort($sortedValues);
        $previousValue = $sortedValues[0];

        for ($i = 1; $i < sizeof($sortedValues); $i++) {

            if ($sortedValues[$i] != $previousValue + 1) {
                //edge case for Ace low straight
                if ($sortedValues[$i] === 14 && $sortedValues[0] === 2) {
                    break;
                }
                return;
            }
            $previousValue = $sortedValues[$i];
        }
        // if we reach here we at least have a straight
        //if first value in array is 10 all values are equal or higher
        $this->setRankHierarchy('Royal Flush', $sortedValues[0] === 10 && $this->rankHierarchy['Flush']);
        $this->setRankHierarchy('Straight Flush', $this->rankHierarchy['Flush']);
        $this->setRankHierarchy('Straight', true);

    }

    /*
     *
     * Determines if the cards in a hand have matches that pairs,
     * three of a kind, full house, or four of a kind and sets the rank to true.
     *
     * @param cardValues - array of card values - int[]fds
     */
    private function setCardMatchRankFlags($cardValues)
    {
        $cardMatches = array_count_values($cardValues);
        foreach (array_values($cardMatches) as $count) {
            switch ($count) {
                case 4:
                    $this->setRankHierarchy('Four of a Kind', true);
                    return;
                case 3:
                    $this->setRankHierarchy('Three of a Kind', true);
                    break;
                case 2:
                    $this->rankHierarchy['One Pair'] ? $this->setRankHierarchy('Two Pair', true) : $this->setRankHierarchy('One Pair', true);
                    break;
            }
        }
        $this->setRankHierarchy('Full House', $this->rankHierarchy['One Pair'] && $this->rankHierarchy['Three of a Kind']);
    }

    /*
     * 
     * Helper function to find the highest rank that is set to true. 
     *
     * @return highest rank - String
     */
    private function getHighestRank()
    {
        return array_search(true, $this->rankHierarchy);
    }

    /*
     * Helper function to set flag value for rank
     *
     *@param $key - key to update - String
     *@param $value - value to set rank - bool
     */
    private function setRankHierarchy($key, $value)
    {
        $this->rankHierarchy[$key] = $value;
    }
}