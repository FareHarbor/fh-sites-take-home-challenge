class PokerHand {
  constructor(cards) {
    this.cards = cards;
    this.cardType = {
      aceCount: 0,
      kingCount: 0,
      threeCount: 0
    };
  }

  getRank() {
    var userCards = this.cards.split(' ');

    if (userCards.length !== 5) return;

    userCards.forEach(card => {
      if (card.includes('A')) {
        return this.cardType.aceCount++;
      }
    });

    userCards.forEach(card => {
      if (card.includes('K')) {
        return this.cardType.kingCount++;
      }
    });

    userCards.forEach(card => {
      if (card.includes('3')) {
        return this.cardType.threeCount++;
      }
    });

    if (this.cardType.aceCount === 2) {
      return 'One Pair';
    }

    if (this.cardType.aceCount === 3) {
      return 'Three of A Kind!';
    }

    if (this.cardType.kingCount === 2 && this.cardType.threeCount === 2) {
      return 'Two Pair';
    }
  }
}

module.exports = PokerHand;
