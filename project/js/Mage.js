class Mage extends Talent {
    constructor(level) {
        const mageStats = new Stat(8, 13, 15, 17, 10, 12);
        const firebolt = new Skill("Firebolt", "Launch a firebolt at enemies", 25, 2);
        const iceBarrier = new Skill("Ice Barrier", "Protect yourself with a magical shield", null, 3);
        const arcaneBlast = new Skill("Arcane Blast", "Deal magic damage in an area", 30, 4);

        super("Mage", level, mageStats);
        this.skills = [firebolt, iceBarrier, arcaneBlast];
    }

    // Override displayClassInfo method to include class-specific information
    displayClassInfo() {
        super.displayClassInfo();
    }
}
