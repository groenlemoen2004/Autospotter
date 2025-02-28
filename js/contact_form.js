document.addEventListener('DOMContentLoaded', function() {
    const contactForm = document.getElementById('contactForm');

    contactForm.addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent normal form submission

        console.log('Form is being submitted...');

        const formData = new FormData(contactForm);

        for (let [key, value] of formData.entries()) {
            console.log(`${key}: ${value}`);
        }

        fetch('../php/submit_form.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json(); // Parse the JSON response from PHP
        })
        .then(data => {
            if (data.success) {  // Corrected condition
                console.log('Form submitted successfully:', data.message);
                alert(data.message); // Show success message
                contactForm.reset(); // Reset form fields on success
            } else {
                console.error('Form submission failed:', data.message);
                alert(data.message); // Show error message
            }
        })
        .catch(error => {
            console.error('Error submitting form:', error);
            alert('Error submitting form. Please try again.');
        })
        .finally(() => {
            setTimeout(() => {
                financeErrorBox.style.display = 'none'; // Hide error box after timeout
            }, 4000);
        });
    });
});
