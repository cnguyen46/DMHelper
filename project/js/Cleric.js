class Cleric extends Talent {
    constructor(level) {
        const clericStats = new Stat(15, 10, 13, 8, 17, 12);
        const healingTouch = new Skill("Healing Touch", "Restore health to allies", 20, 2);
        const divineShield = new Skill("Divine Shield", "Create a shield that absorbs damage", null, 3);
        const holyFlame = new Skill("Holy Flame", "Deal radiant damage to enemies", 25, 4);

        super("Cleric", level, clericStats);
        this.skills = [healingTouch, divineShield, holyFlame];
    }

    // Override displayClassInfo method to include class-specific information
    displayClassInfo() {
        super.displayClassInfo();
    }
}
