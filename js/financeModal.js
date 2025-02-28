// Function to open the finance modal
function openFinanceModal() {
    document.getElementById("financeModal").style.display = "flex";
  }
  
  // Function to close the finance modal
  function closeFinanceModal() {
    document.getElementById("financeModal").style.display = "none";
  }
  
  // Optional: Close the modal if clicking outside of the content
  window.addEventListener("click", function(event) {
    const modal = document.getElementById("financeModal");
    if (event.target === modal) {
      modal.style.display = "none";
    }
  });
  