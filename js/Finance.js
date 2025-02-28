// Function to toggle the floating tab
function toggleTab() {
    const tab = document.getElementById('floatingTab');
    tab.classList.toggle('collapsed');
  }

  // Function to calculate the monthly installment
  function calculateInstallment() {
    // Get input values
    const amount = parseFloat(document.getElementById('amount').value);
    const interestRate = parseFloat(document.getElementById('interest').value);
    const period = parseFloat(document.getElementById('period').value);

    // Validate inputs
    if (isNaN(amount) || isNaN(interestRate) || isNaN(period)) {
      alert("Please enter valid numbers for all fields.");
      return;
    }

    // Convert interest rate to monthly rate
    const monthlyInterestRate = (interestRate / 100) / 12;

    // Calculate monthly installment using loan amortization formula
    const installment =
      (amount * monthlyInterestRate) /
      (1 - Math.pow(1 + monthlyInterestRate, -period));

    // Display the result
    document.getElementById('installment').textContent = `R ${installment.toFixed(2)}`;
    }