/*
    Skill class.
*/
class Skill {
    constructor(name, description, damage, cooldown) {
        this.name = name;
        this.description = description;
        this.damage = damage; 
        this.cooldown = cooldown;
    }

    // Display skill information
    displaySkillInfo() {
        console.log(`Skill: ${this.name}`);
        console.log(`Description: ${this.description}`);
        if (this.damage) {
            console.log(`Damage: ${this.damage}`);
        }
        if (this.cooldown) {
            console.log(`Cooldown: ${this.cooldown} turns`);
        }
    }
}
