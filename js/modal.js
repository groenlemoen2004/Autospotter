// Global variables to store image data for the current vehicle
let currentVehicleImages = [];
let currentImageIndex = 0;
let currentImageDirectory = '';

function openVehicleModal(stockNumber) {
  fetch(`../php/getVehicleDetails.php?stockNumber=${encodeURIComponent(stockNumber)}`)
    .then(response => {
      if (!response.ok) {
        throw new Error('Network response was not ok');
      }
      return response.json();
    })
    .then(data => {
      if (data.error) {
        console.error(data.error);
        return;
      }

      // Update vehicle details in the modal
      document.getElementById("vehicleMake").textContent = data.make;
      document.getElementById("vehicleModel").textContent = data.model;
      document.getElementById("vehiclePrice").textContent = data.selling_price;
      document.getElementById("vehicleMileage").textContent = data.odometer;
      document.getElementById("vehicleColor").textContent = data.colour;
      document.getElementById("vehicleServiceHistory").textContent = data.serviceHistory || '';
      document.getElementById("vehicleYear").textContent = data.year_model || '';
      document.getElementById("vehicleTransmission").textContent = data.transmission || '';
      document.getElementById("vehicleFuelType").textContent = data.fuel_type || '';
      document.getElementById("vehicleBodyStyle").textContent = data.body_style || '';
      document.getElementById("vehicleInterior").textContent = data.interior || '';
      document.getElementById("vehicleMakeModel").textContent = `${data.make} ${data.model}`;

      // Show the modal
      document.getElementById("vehicleModal").style.display = "block";

      // Set up image directory
      currentImageDirectory = `../img/vehicles/${stockNumber}/`;

      // Clear any existing thumbnails
      const thumbnailSection = document.querySelector('.thumbnail-section');
      thumbnailSection.innerHTML = '';

      // Fetch the list of images for the vehicle
      fetch(`../php/getVehicleImages.php?stockNumber=${encodeURIComponent(stockNumber)}`)
        .then(response => response.json())
        .then(images => {
          currentVehicleImages = images;
          currentImageIndex = 0;

          if (images && images.length > 0) {
            // Set main image to the first image
            document.getElementById("mainImage").src = currentImageDirectory + images[0];

            // Create thumbnails for each image (limit to 7)
            images.slice(0, 7).forEach((img, index) => {
              const thumb = document.createElement("img");
              thumb.src = currentImageDirectory + img;
              thumb.alt = `Vehicle thumbnail ${index + 1}`;
              thumb.classList.add("thumbnail");
              thumb.addEventListener("click", function() {
                currentImageIndex = index;
                document.getElementById("mainImage").src = currentImageDirectory + img;
              });
              thumbnailSection.appendChild(thumb);
            });
          } else {
            // Fallback if no images are found
            document.getElementById("mainImage").src = "../img/vehicles/default.jpg";
          }
        })
        .catch(error => {
          console.error("Error fetching images:", error);
          document.getElementById("mainImage").src = "../img/vehicles/default.jpg";
        });
    })
    .catch(error => console.error('Error fetching vehicle details:', error));
}

function nextImage() {
  if (currentVehicleImages.length > 0) {
    // Move to the next image (cycling back to the start if needed)
    currentImageIndex = (currentImageIndex + 1) % currentVehicleImages.length;
    document.getElementById("mainImage").src = currentImageDirectory + currentVehicleImages[currentImageIndex];
  }
}

function closeVehicleModal() {
  document.getElementById("vehicleModal").style.display = "none";
}
