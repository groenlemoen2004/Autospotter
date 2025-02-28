document.addEventListener('DOMContentLoaded', () => {
    const floatingTab = document.getElementById('floatingTab');
    const closeTab = document.getElementById('closeTab');
    const vehicleName = document.getElementById('vehicleName');
    const vehicleImages = document.getElementById('vehicleImages');
    const specsContent = document.getElementById('specsContent');
    const applyButton = document.getElementById('applyButton');
    const applicationForm = document.getElementById('applicationForm');

    // Function to open the floating tab
    window.viewDetails = (stockNumber) => {
        fetch(`../php/getVehicleDetails.php?stock_number=${stockNumber}`) // Fixed backticks
            .then(response => response.json())
            .then(data => {
                // Set vehicle name
                vehicleName.textContent = `${data.make} ${data.model}`;

                // Load images
                const imagePaths = Array.from({ length: 3 }, (_, i) => `../images/${stockNumber}/${stockNumber}_${i + 1}.jpg`);
                vehicleImages.innerHTML = `
                    <div class="image-container">
                        <img id="mainImage" src="${imagePaths[0]}" alt="${data.make} ${data.model}">
                    </div>
                    <div id="thumbnailContainer">
                        ${imagePaths.map((path, index) => `
                            <img class="thumbnail" src="${path}" alt="Thumbnail ${index + 1}" onclick="changeMainImage(this)">
                        `).join('')}
                    </div>
                `;

                // Load vehicle details
                specsContent.innerHTML = `
                    <p><strong>Year:</strong> ${data.year_model}</p>
                    <p><strong>Odometer:</strong> ${data.odometer} km</p>
                    <p><strong>Price:</strong> R${data.selling_price}</p>
                    <p><strong>Colour:</strong> ${data.colour}</p>
                    <p><strong>Body Style:</strong> ${data.body_style}</p>
                    <p><strong>Fuel Type:</strong> ${data.fuel_type}</p>
                    <p><strong>Transmission:</strong> ${data.transmission}</p>
                `;

                // Show the floating tab
                floatingTab.style.display = 'flex';
            });
    };

    // Function to change the main image
    window.changeMainImage = (thumbnail) => {
        const mainImage = document.getElementById('mainImage');
        mainImage.src = thumbnail.src;
    };

    // Close the floating tab
    closeTab.addEventListener('click', () => {
        floatingTab.style.display = 'none';
    });

    // Show application form
    applyButton.addEventListener('click', () => {
        applicationForm.style.display = 'block';
    });

    // Handle form submission
    document.getElementById('applyForm').addEventListener('submit', (e) => {
        e.preventDefault();
        alert('Application submitted successfully!');
        applicationForm.style.display = 'none';
    });
});