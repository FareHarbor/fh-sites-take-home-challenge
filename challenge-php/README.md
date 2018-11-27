<h2>Congratulations for making it to the next stage of the FareHarbor Sites interview!</h2>

This challenge is designed to give us a sense of your style as a programmer as well as your ability to solve problems.

Like real life, we expect that you may need or want to look at some solutions online to this problem in order to inspire your solution. Please keep in mind that in any stage of the interview process, we may ask you to make alterations to your code to solve for different use-cases and/or edge-cases, so please make sure to write something that you fully understand.

Feel free to write additional tests and take into account as make edge cases as you would like to show us how to you problem solve. 
<h2>Submission Steps</h2>

This is what you'll need to do to submit your challenge:

1. Fork this repo
2. Once you're finished, email us a link to your repo

<h2>Testing and Additional Notes</h2>

This repository includes a `composer.json` file which will install PHPUnit. [If you don't have composer, you can find instructions on installing it here.](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-macos) It also includes a default phpunit configuration. After running `composer install` you should be able to run:

- `composer test-poker`

Please be sure all included unit tests are passing before you submit your solution.

# Poker Hand Ranker
To run the provided tests, run `composer test-poker`.

Write code that will take in a poker hand, evaluate it and determine its
rank.

Example:

Hand: As Ks Qs Js 10s (Royal Flush)

Hand: Ah As 10c 7d 6s (One Pair)

Hand: Kh Kc 3s 3h 2d (Two Pair)

Hand: Kh Qh 6h 2h 9h (Flush)

It should handle the following hand ranks:
* Royal Flush
* Straight Flush
* Four of a Kind
* Full House
* Flush
* Straight
* Three of a Kind
* Two Pair
* One Pair
* High Card

