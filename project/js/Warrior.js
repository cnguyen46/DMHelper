
class Warrior extends Talent {
    constructor(level) {
        const warriorStats = new Stat(17, 13, 15, 10, 12, 8);
        const powerStrike = new Skill("Power Strike", "Deal more damage", 15, 2);
        const taunt = new Skill("Taunt", "Force enemy to attack the target causing the taunt", null, 3);
        const defenseFormation = new Skill("Defense Formation", "Increases defense for a short time", 5, 4);

        super("Warrior", level, warriorStats);
        this.skills = [powerStrike, taunt, defenseFormation];
    }

    // Override displayClassInfo method to include class-specific information
    displayClassInfo() {
        super.displayClassInfo();
    }

}
