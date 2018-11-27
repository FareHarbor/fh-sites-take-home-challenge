<h2>PHP Take Home Challenge</h2>

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

