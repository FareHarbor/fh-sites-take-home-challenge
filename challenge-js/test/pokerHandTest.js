var assert = require('assert');
var PokerHand = require('../pokerHand.js');

/**
 * test
 */
describe('Rank a Royal Flush', function() {
  it('Return royal flush when hand given', function() {
    var hand = new PokerHand('As Ks Qs Js 10s');
    assert.equal(hand.getRank(), 'Royal Flush');
  });
});

/**
 * test
 */
describe('Rank a Pair', function() {
  it('Return one pair when hand given', function() {
    var hand = new PokerHand('Ah As 10c 7d 6s');

    assert.equal(hand.getRank(), 'One Pair');
  });
});

/**
 * test
 */
describe('Rank Two Pair', function() {
  it('Return two pair when hand given', function() {
    var hand = new PokerHand('Kh Kc 3s 3h 2d');

    assert.equal(hand.getRank(), 'Two Pair');
  });
});

/**
 * test
 */
describe('Rank A Flush', function() {
  var hand = new PokerHand('Kh Qh 6h 2h 9h');

  it('Return flush when hand given', function() {
    assert.equal(hand.getRank(), 'Flush');
  });
});

describe('Three of A Kind', function() {
  var hand = new PokerHand('Ah As Ad 2h 9h');

  it('Return Three of A Kind when hand given', function() {
    assert.equal(hand.getRank(), 'Three of A Kind');
  });
});

describe('Four of A Kind', function() {
  var hand = new PokerHand('Ah As Ad Ac 9h');

  it('Return Four of A Kind when hand given', function() {
    assert.equal(hand.getRank(), 'Four of A Kind');
  });
});
// More tests go here
