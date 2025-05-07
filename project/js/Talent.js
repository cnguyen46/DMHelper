class Talent {
    constructor(name, level, stats) {
        this.name = name;  
        this.level = level;  
        this.stats = stats;  
        this.skills = []; 
    }

    // Method to be implemented in subclasses to display class-specific info
    displayClassInfo() {
        console.log(`Class: ${this.name}`);
        console.log(`Level: ${this.level}`);
        this.stats.displayStats(); 
        console.log("Skills:");
        this.skills.forEach(skill => skill.displaySkillInfo());
    }

    // Method to level up the talent, increasing the level
    levelUp() {
        this.level++;
        console.log(`${this.name} leveled up to level ${this.level}!`);
    }

    // Method to add a skill to the talent's list
    addSkill(skill) {
        this.skills.push(skill);
        console.log(`${skill.name} added to ${this.name}'s skills.`);
    }
}
