class Rogue extends Talent {
    constructor(level) {
        const rogueStats = new Stat(8, 17, 14, 13, 13, 10);
        const stealth = new Skill("Stealth", "Ability to move unseen and unheard", 10, 2);
        const backstab = new Skill("Backstab", "Deal extra damage from behind", 30, 3);
        const poisonDagger = new Skill("Poison Dagger", "Throw poison dagger at enemy", null, 4);

        super("Rogue", level, rogueStats);
        this.skills = [stealth, backstab, poisonDagger];
    }

    // Override displayClassInfo method to include class-specific information
    displayClassInfo() {
        super.displayClassInfo();
    }
}
