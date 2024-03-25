// Get the current page URL
const currentPageUrl = window.location.href;

// Get the buttons
const dayButton = document.getElementById('dayButton');
const weekButton = document.getElementById('weekButton');
const monthButton = document.getElementById('monthButton');

// Function to add "active" class to the clicked button
function setActiveButton(button) {
  // Remove "active" class from all buttons
  document.querySelectorAll('.calendar-buttons a').forEach(btn => {
    btn.classList.remove('active');
  });
  
  // Add "active" class to the clicked button
  button.classList.add('active');
}

// Check if the current page URL matches the href attribute of each button and add the "active" class accordingly
if (currentPageUrl.includes('calendar-dayview.html')) {
  setActiveButton(dayButton);
} else if (currentPageUrl.includes('calendar-weekview.html')) {
  setActiveButton(weekButton);
} else if (currentPageUrl.includes('calendar-monthview.html')) {
  setActiveButton(monthButton);
}

// Add click event listeners to the buttons to apply the "active" class when clicked
dayButton.addEventListener('click', function() {
  setActiveButton(dayButton);
});

weekButton.addEventListener('click', function() {
  setActiveButton(weekButton);
});

monthButton.addEventListener('click', function() {
  setActiveButton(monthButton);
});
