class Player {
    constructor(name, characterClass) {
        this.name = name;
        this.characterClass = characterClass;
    }

    // Assign a talent (class) to the player
    assignClass(characterClass) {
        this.characterClass = characterClass;
        console.log(`${this.name} has chosen the ${this.characterClass.name} class!`);
    }

    // Display player and class info
    displayPlayerInfo() {
        console.log(`Player: ${this.name}`);
        console.log(`Class: ${this.characterClass.name}`);
        this.characterClass.displayClassInfo();
    }
}
