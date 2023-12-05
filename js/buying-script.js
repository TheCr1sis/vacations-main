// Add this script to your HTML file or a separate JavaScript file

// Function to open the modal overlay
function openModal(id) {
  // Display the overlay and prevent scrolling
  document.getElementById('overlay').style.display = 'block';
  document.body.style.overflow = 'hidden';

  let xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function() {
    if (this.readyState == 4) {
      if (this.status == 200) {
        let data = JSON.parse(this.responseText);
        document.getElementById('vacation_id').value = id;
        // Check if data is empty or undefined
        if (Object.keys(data).length !== 0 && data.constructor === Object) {
          // Populate the Place, Price, Duration, Type, and Season elements with data
          document.getElementById("Place").innerText = data.place_name || 'Place name';
          document.getElementById("Price").innerText = `$${data.price}` || 'Price';
          document.getElementById("Duration").innerText = data.duration || 'Duration';
          document.getElementById("Type").innerText = data.vacation_type || 'Vacation type';
          document.getElementById("Season").innerText = data.season || 'Season';

          // Set the form action dynamically based on the ID
          let form = document.querySelector('form');
          form.action = `../php/purchase.php?id=${id}`;
        } else {
          // Handle case when no data is found
          console.log('No data found for the provided ID.');
        }
      } else {
        // Handle AJAX request error
        console.error('Error fetching data. Status:', this.status);
      }
    }
  };

  xhr.open("GET", `../php/get.vacation.data.php?id=${id}`, true);
  xhr.send();
}
  
  // Function to close the modal overlay
  function closeModal() {
    document.getElementById('overlay').style.display = 'none';
    document.body.style.overflow = 'auto'; // Allow scrolling
  }
  
  // Attach event listeners to your buttons to trigger the modal
  document.querySelectorAll('button[type="button"]').forEach(button => {
    button.addEventListener('click', openModal);
  });

  document.getElementById('expiry_date').addEventListener('input', function(event) {
    const input = event.target;
    const expiryDate = input.value;

    // Check if the input matches the desired format
    if (!/^\d{2}\/\d{2}$/.test(expiryDate)) {
        input.setCustomValidity('Please enter a valid expiration date (MM/YY)');
    } else {
        input.setCustomValidity('');
    }
});
  
  // Attach event listener to close button within the modal
  document.querySelector('.close-btn').addEventListener('click', closeModal);
  