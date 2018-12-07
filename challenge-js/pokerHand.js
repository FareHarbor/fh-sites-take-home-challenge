class PokerHand {
  constructor(cards) {
    this.cards = cards;
    this.suitTypes = {
      heartCount: 0,
      spadeCount: 0,
      clubCount: 0,
      diamondCount: 0
    };
    this.cardTypes = {
      aceCount: 0,
      kingCount: 0,
      threeCount: 0
    };
  }

  getRank() {
    var userCards = this.cards.split(' ');

    console.log(userCards);

    if (userCards.length !== 5) return;

    userCards.forEach(card => {
      if (card.includes('A')) {
        return this.cardTypes.aceCount++;
      }
    });

    userCards.forEach(card => {
      if (card.includes('K')) {
        return this.cardTypes.kingCount++;
      }
    });

    userCards.forEach(card => {
      if (card.includes('3')) {
        return this.cardTypes.threeCount++;
      }
    });

    userCards.forEach(card => {
      if (card.includes('h')) {
        return this.suitTypes.heartCount++;
      }
    });

    if (this.cardTypes.aceCount === 2) {
      return 'One Pair';
    }

    if (this.cardTypes.aceCount === 3) {
      return 'Three of A Kind';
    }

    if (this.cardTypes.kingCount === 2 && this.cardTypes.threeCount === 2) {
      return 'Two Pair';
    }

    if (this.suitTypes.heartCount === 5) {
      return 'Flush';
    }
  }
}

module.exports = PokerHand;
