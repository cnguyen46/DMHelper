class Ranger extends Talent {
    constructor(level) {
        const rangerStats = new Stat(12, 17, 13, 8, 15, 10); 
        const precision = new Skill("Precision Shot", "Mastery with bows and ranged attacks", 20, 2);
        const evasiveManeuver = new Skill("Evasive Maneuver", "Dodge attacks with agility", null, 3);
        const multipleShot = new Skill("Multiple Shot", "Low damage but can shot multiple targets", 25, 4);

        super("Ranger", level, rangerStats);
        this.skills = [precision, evasiveManeuver, multipleShot];
    }

    // Override displayClassInfo method to include class-specific information
    displayClassInfo() {
        super.displayClassInfo();
    }
}
