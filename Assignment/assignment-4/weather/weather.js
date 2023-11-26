const submitButton = document.getElementById('submitButton');
const namneInput = document.getElementById('namneInput');
const resultContainer = document.getElementById('current_temp'); // Assuming you have a container to display the result

function getcurrentTemp(city) {
  fetch('path/to/your/php/file.php?city=' + city)
    .then(response => response.json())
    .then(data => {
      // Assuming your PHP file returns JSON, update this part based on your actual response format
      const currentTemp = data.currentTemp;
      current_temp.innerHTML = `Current Temperature in ${city}: ${currentTemp}`;
    })
    .catch(error => console.error('Error fetching data:', error));
}

submitButton.addEventListener('click', (e) => {
  e.preventDefault();
  const city = namneInput.value;
  getcurrentTemp(city);
});
