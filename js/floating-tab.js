document.addEventListener('DOMContentLoaded', () => {
    const floatingTab = document.getElementById('floatingTab');
    const closeTab = document.getElementById('closeTab');
    const vehicleName = document.getElementById('vehicleName');
    const mainImage = document.getElementById('mainImage');
    const thumbnailContainer = document.getElementById('thumbnailContainer');
    const tabs = document.querySelectorAll('.tab');
    const tabContents = document.querySelectorAll('.tab-content');

    // Use event delegation for dynamically loaded content
    document.addEventListener('click', (event) => {
        if (event.target.classList.contains('view-button')) {
            const vehicleCard = event.target.closest('.vehicle-card');
            if (!vehicleCard) return;
            const vehicleId = vehicleCard.getAttribute('data-id');

            fetchVehicleDetails(vehicleId);
            floatingTab.style.display = 'flex';
        }
    });

    // Close floating tab
    closeTab.addEventListener('click', () => {
        floatingTab.style.display = 'none';
    });

    // Tab functionality
    tabs.forEach((tab, index) => {
        tab.addEventListener('click', () => {
            tabs.forEach(t => t.classList.remove('active'));
            tabContents.forEach(tc => tc.classList.remove('active'));
            tab.classList.add('active');
            tabContents[index].classList.add('active');
        });
    });

    function fetchVehicleDetails(vehicleId) {
        fetch(`../php/get_vehicle_details.php?id=${vehicleId}`)
            .then(response => response.json())
            .then(data => {
                vehicleName.textContent = `${data.make} ${data.model}`;

                // Update main image
                if (data.images.length > 0) {
                    mainImage.src = data.images[0];
                    mainImage.alt = `${data.make} ${data.model}`;

                    // Populate thumbnails
                    thumbnailContainer.innerHTML = data.images.map(image =>
                        `<img src="${image}" alt="${data.make}" class="thumbnail">`
                    ).join('');

                    // Add click event to thumbnails
                    document.querySelectorAll('.thumbnail').forEach(img => {
                        img.addEventListener('click', () => {
                            mainImage.src = img.src;
                        });
                    });
                } else {
                    mainImage.src = '../img/Logo.jpg';
                }

                document.getElementById('specsContent').innerHTML = `
                    <p>Price: ${number_format(data.price)}</p>
                    <p>Year: ${data.year}</p>
                    <p>Mileage: ${data.mileage} km</p>
                    <p>Color: ${data.color}</p>
                    <p>Transmission: ${data.transmission}</p>
                    <p>Engine: ${data.engine}</p>
                    <p>Fuel Type: ${data.fuel_type}</p>
                `;
                document.getElementById('serviceHistoryContent').innerHTML = `<p>${data.service_history}</p>`;
                document.getElementById('additionalInfoContent').innerHTML = `<p>${data.additional_info}</p>`;
            })
            .catch(error => console.error('Error fetching vehicle details:', error));
    }

    function number_format(number) {
        return new Intl.NumberFormat('en-ZA', { style: 'currency', currency: 'ZAR' }).format(number);
    }
});
