document.addEventListener("DOMContentLoaded", function() {
    const sidebar = document.getElementById("sidebar");
    const toggleButton = document.getElementById("toggleSidebar");
    const mainContent = document.querySelector("main");
    const header = document.querySelector("header");
    const vehicles = document.getElementById("vehicles");
    const vehiclesPage = document.querySelector(".vehicles-page");

    // Check the current page
    const currentPage = window.location.pathname.split("/").pop();

    if (currentPage === "vehicles.php") {
        toggleButton.addEventListener("click", function() {
            sidebar.classList.toggle("active");
            vehicles.classList.toggle("active");
            if (vehiclesPage) {
                vehiclesPage.classList.toggle("active");
            }
        });
    } else if (document.body.id === "home") {
        toggleButton.addEventListener("click", function() {
            sidebar.classList.toggle("active");
            mainContent.classList.toggle("active");
            header.classList.toggle("active");
        });
    } else if (document.body.id === "about") {
        toggleButton.addEventListener("click", function() {
            sidebar.classList.toggle("active");
            header.classList.toggle("active");
            mainContent.classList.toggle("active");
        });
    } else if (document.body.id === "contact") {
        toggleButton.addEventListener("click", function() {
            sidebar.classList.toggle("active");
            header.classList.toggle("active");
            mainContent.classList.toggle("active");
        });
    }

    const themeToggleButton = document.getElementById("themeToggleButton");

    if (themeToggleButton) {
        themeToggleButton.addEventListener("click", function(e) {
            e.preventDefault();

            const currentTheme = document.documentElement.getAttribute("data-theme");
            const newTheme = currentTheme === "light" ? "dark" : "light";

            window.location.href = window.location.pathname + "?theme=" + newTheme;
        });
    }
});

// Function to show the loading modal
function showLoadingModal() {
    document.getElementById('loadingModal').style.display = 'flex';
}

// Function to hide the loading modal
function hideLoadingModal() {
    document.getElementById('loadingModal').style.display = 'none';
}

