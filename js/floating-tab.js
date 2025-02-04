document.addEventListener('DOMContentLoaded', () => {
    const viewButtons = document.querySelectorAll('.view-button');
    const floatingTab = document.getElementById('floatingTab');
    const closeTab = document.getElementById('closeTab');
    const vehicleName = document.getElementById('vehicleName');
    const vehicleImages = document.getElementById('vehicleImages');
    const tabs = document.querySelectorAll('.tab');
    const tabContents = document.querySelectorAll('.tab-content');

    // Open floating tab on view button click
    viewButtons.forEach(button => {
        button.addEventListener('click', (event) => {
            const vehicleCard = event.target.closest('.vehicle-card');
            const vehicleId = vehicleCard.getAttribute('data-id');
            fetchVehicleDetails(vehicleId);
            floatingTab.style.display = 'flex';
        });
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
                vehicleImages.innerHTML = data.images.length > 0 ? data.images.map(image => `<img src="../img/Logo.jpg" alt="${data.make} ${data.model}">`).join('') : '<img src="../img/Logo.jpg" alt="Placeholder">';
                document.getElementById('specsContent').innerHTML = `
                    <p>Price: R ${number_format(data.price)}</p>
                    <p>Year: ${data.year}</p>
                    <p>Mileage: ${data.mileage} km</p>
                    <p>Color: ${data.color}</p>
                    <p>Transmission: ${data.transmission}</p>
                    <p>Engine: ${data.engine}</p>
                    <p>Fuel Type: ${data.fuel_type}</p>
                `;
                document.getElementById('serviceHistoryContent').innerHTML = `
                    <p>${data.service_history}</p>
                `;
                document.getElementById('additionalInfoContent').innerHTML = `
                    <p>${data.additional_info}</p>
                `;
            })
            .catch(error => console.error('Error fetching vehicle details:', error));
    }

    function number_format(number) {
        return new Intl.NumberFormat('en-ZA', { style: 'currency', currency: 'ZAR' }).format(number);
    }
});