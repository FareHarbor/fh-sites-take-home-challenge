<h2>JS Take Home Challenge</h2>

#### Make sure you are in the `/challenge-js` directory.

This repository includes a `package.json` file which will install Mocha. [If you don't have npm, you can find instructions on installing it here.](https://www.npmjs.com/get-npm) It also includes a default mocha configuration. After running `npm install` you should be able to run:

- `npm test`

Please be sure all included unit tests are passing before you submit your solution.

# Poker Hand Ranker
To run the provided tests, run `npm test`.

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

