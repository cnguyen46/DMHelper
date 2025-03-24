class Stat {
    constructor(strength, dexterity, constitution, intelligence, wisdom, charisma) {
        this.strength = strength || 8;
        this.dexterity = dexterity || 8;
        this.constitution = constitution || 8;
        this.intelligence = intelligence || 8;
        this.wisdom = wisdom || 8;
        this.charisma = charisma || 8;
    }

    // Display stats
    displayStats() {
        console.log(`Strength: ${this.strength}`);
        console.log(`Dexterity: ${this.dexterity}`);
        console.log(`Constitution: ${this.constitution}`);
        console.log(`Intelligence: ${this.intelligence}`);
        console.log(`Wisdom: ${this.wisdom}`);
        console.log(`Charisma: ${this.charisma}`);
    }
}
