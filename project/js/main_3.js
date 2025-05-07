/************
Player 3
************/

// Define the function that will update the stats when a class is selected
document.getElementById('class-selector-3').addEventListener('change', function() {
  const selectedClass = this.value;
  let classInstance;

  // Instantiate the selected class based on the option chosen
  switch(selectedClass) {
      case 'cleric':
          classInstance = new Cleric(1); 
          break;
      case 'mage':
          classInstance = new Mage(1); 
          break;
      case 'warrior':
          classInstance = new Warrior(1);
          break;
      case 'ranger':
          classInstance = new Ranger(1);
          break;
      case 'rogue':
          classInstance = new Rogue(1);
          break;
  }

  // Update class name and stats dynamically
  document.getElementById('class-name-3').innerText;
  updateStatsTable_3(classInstance.stats);
});

// Function to update the stats table dynamically
function updateStatsTable_3(stats) {
  const statsTable = document.getElementById('stats-table-3');
  statsTable.innerHTML = `
      <tr><td>Strength</td><td>${stats.strength}</td></tr>
      <tr><td>Dexterity</td><td>${stats.dexterity}</td></tr>
      <tr><td>Constitution</td><td>${stats.constitution}</td></tr>
      <tr><td>Intelligence</td><td>${stats.intelligence}</td></tr>
      <tr><td>Wisdom</td><td>${stats.wisdom}</td></tr>
      <tr><td>Charisma</td><td>${stats.charisma}</td></tr>
  `;
}

// Trigger the change event once on page load to display default stats (optional)
document.getElementById('class-selector-3').dispatchEvent(new Event('change'));
