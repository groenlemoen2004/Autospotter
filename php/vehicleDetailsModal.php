<div id="vehicleModal" class="modal">
  <div class="modal-content">
    <span class="close" onclick="closeVehicleModal()">&times;</span>
    <div class="vehicle-details">
      <div class="main-image-section">
        <h2 id="vehicleMakeModel"></h2>
        <img id="mainImage" src="../img/vehicles/default.jpg" alt="Main Vehicle Image">
        <!-- Next image button -->
        <button id="nextImageBtn" onclick="nextImage()">Next Image</button>
      </div>
      <div class="details-section">
      <input type="hidden" id="vehicleStockNumber" value="<?php echo $stockNumber; ?>">
        <p><strong>Make:</strong> <span id="vehicleMake"></span></p>
        <p><strong>Model:</strong> <span id="vehicleModel"></span></p>
        <p><strong>Price:</strong> <span id="vehiclePrice"></span></p>
        <p><strong>Mileage:</strong> <span id="vehicleMileage"></span></p>
        <p><strong>Color:</strong> <span id="vehicleColor"></span></p>
        <p><strong>Service History:</strong> <span id="vehicleServiceHistory"></span></p>
        <p><strong>Year:</strong> <span id="vehicleYear"></span></p>
        <p><strong>Transmission:</strong> <span id="vehicleTransmission"></span></p>
        <p><strong>Fuel Type:</strong> <span id="vehicleFuelType"></span></p>
        <p><strong>Body Style:</strong> <span id="vehicleBodyStyle"></span></p>
        <p><strong>Interior:</strong> <span id="vehicleInterior"></span></p>
      </div>
      <div class="thumbnail-section">
        <!-- Thumbnails will be dynamically inserted here -->
      </div>
    </div>
    <button id="applyNowBtn" onclick="openFinanceModalWithDetails()">Apply Now</button>

    <script>
    function openFinanceModalWithDetails() {
      const stockNumber = document.getElementById('vehicleStockNumber').value;
      const make = document.getElementById('vehicleMake').innerText;
      const model = document.getElementById('vehicleModel').innerText;

      document.getElementById('vehicleStockNumber1').value = stockNumber;
      document.getElementById('vehicleMake1').value = make;
      document.getElementById('vehicleModel1').value = model;


      openFinanceModal();
    }
    </script>
  </div>
</div>
