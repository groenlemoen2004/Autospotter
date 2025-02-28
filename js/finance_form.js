document.addEventListener('DOMContentLoaded', function() {
    const financeForm = document.getElementById('financeForm');
    const financeErrorBox = document.getElementById('financeErrorBox');
    const financeErrorMessage = document.getElementById('financeErrorMessage');

    financeForm.addEventListener('submit', function(event) {
        event.preventDefault();  // Prevent the form from submitting normally

        // Display a message in the console for debugging
        console.log('Form is being submitted...');

        const formData = new FormData(financeForm);

        // Log the form data
        for (let [key, value] of formData.entries()) {
            console.log(`${key}: ${value}`);
        }

        // Show the loading modal
        showLoadingModal();

        fetch('../php/submitApplication.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();  // Parse the JSON response from PHP
        })
        .then(data => {
            // Handle success response
            console.log('Form submitted successfully:', data);
            financeErrorMessage.textContent = 'Application submitted successfully!';
            financeErrorBox.style.display = 'block';
            financeErrorBox.style.backgroundColor = 'green';  // Optional: Change background color for success
            // Redirect or update UI based on the success response if needed
        })
        .catch(error => {
            // Handle error response
            console.error('Error submitting form:', error);
            financeErrorMessage.textContent = 'Error submitting form. Please try again.';
            financeErrorBox.style.display = 'block';
            financeErrorBox.style.backgroundColor = 'red';  // Optional: Change background color for error
        })
        .finally(() => {
            // Hide the loading modal
            hideLoadingModal();
            // Close the error box after 4 seconds
            setTimeout(() => {
                financeErrorBox.style.display = 'none';
            }, 4000);
        });
    });
});
