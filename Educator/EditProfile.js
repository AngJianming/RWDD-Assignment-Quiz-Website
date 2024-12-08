function toggleEdit() {
  const isEditing = document.getElementById('editName').style.display === 'block';
  
  // Toggle display between text and input fields
  document.getElementById('displayName').style.display = isEditing ? 'block' : 'none';
  document.getElementById('editName').style.display = isEditing ? 'none' : 'block';
  
  document.getElementById('displayContact').style.display = isEditing ? 'block' : 'none';
  document.getElementById('editContact').style.display = isEditing ? 'none' : 'block';
  
  document.getElementById('displaySchool').style.display = isEditing ? 'block' : 'none';
  document.getElementById('editSchool').style.display = isEditing ? 'none' : 'block';
  
  document.getElementById('displayAddress').style.display = isEditing ? 'block' : 'none';
  document.getElementById('editAddress').style.display = isEditing ? 'none' : 'block';
  
  document.getElementById('saveButton').style.display = isEditing ? 'none' : 'block';
}

function saveProfile() {
  const name = document.getElementById('editName').value;
  const contact = document.getElementById('editContact').value;
  const school = document.getElementById('editSchool').value;
  const address = document.getElementById('editAddress').value;

  // Update the displayed information with the new values
  document.getElementById('displayName').textContent = name;
  document.getElementById('displayContact').textContent = contact;
  document.getElementById('displaySchool').textContent = school;
  document.getElementById('displayAddress').textContent = address;

  // Toggle back to the display mode
  toggleEdit();
}