<!-- Vehicle Finance Application Modal -->
<div id="financeModal" class="vehicle-finance-modal">
  <div class="vehicle-finance-modal-content">
    <span class="vehicle-finance-modal-close" onclick="closeFinanceModal()">&times;</span>
    <h2>Apply for Vehicle Finance</h2>
    <form id="financeForm" class="vehicle-finance-form" autocomplete="off">
      <div class="vehicle-finance-form-group">
        <label for="financeFullName">Full Name</label>
        <input type="text" id="financeFullName" name="fullName" placeholder="Enter your full name" required autocomplete="off">
        <input type="text" name="honeypot" style="display:none">
      </div>
      <div class="vehicle-finance-form-group">
        <label for="financeEmail">Email Address</label>
        <input type="email" id="financeEmail" name="email" placeholder="Enter your email" required autocomplete="off">
      </div>
      <div class="vehicle-finance-form-group">
        <label for="financePhone">Phone Number</label>
        <input type="tel" id="financePhone" name="phone" placeholder="Enter your phone number" required autocomplete="off">
      </div>
      <div class="vehicle-finance-form-group">
        <label for="financeDownPayment">Down Payment</label>
        <input type="number" id="financeDownPayment" name="downPayment" placeholder="Enter your down payment" required autocomplete="off">
      </div>
      <div class="vehicle-finance-form-group">
        <label for="financeIncome">Is your income above R8 000?</label>
        <input type="text" id="financeIncome" name="income" placeholder="Yes/No" required autocomplete="off">
      </div>
      <div class="vehicle-finance-form-group">
        <label for="financeDebtReview">Are you under debt review?</label>
        <input type="text" id="financeDebtReview" name="debtReview" placeholder="Yes/No" required autocomplete="off">
      </div>
      <div class="vehicle-finance-form-group">
        <label for="financeLicense">Do you have a valid drivers license?</label>
        <input type="text" id="financeLicense" name="license" placeholder="Yes/No" required autocomplete="off">
      </div>
      <div class="vehicle-finance-form-group">
        <label for="financeMessage">Additional Information</label>
        <textarea id="financeMessage" name="message" placeholder="Enter any additional information" rows="4"></textarea>
      </div>
      <input type="hidden" name="stockNumber" id="vehicleStockNumber1">
      <input type="hidden" name="vehicleMake" id="vehicleMake1">
      <input type="hidden" name="vehicleModel" id="vehicleModel1">

      <button type="submit" name="submit" class="vehicle-finance-submit-btn">Submit Application</button>
    </form>
  </div>
</div>
<!-- Vehicle Finance Application Modal -->
<div id="financeModal" class="vehicle-finance-modal">
    <div class="vehicle-finance-modal-content">
        <span class="vehicle-finance-modal-close" onclick="closeFinanceModal()">&times;</span>
        <h2>Apply for Vehicle Finance</h2>
        <form id="financeForm" class="vehicle-finance-form" autocomplete="off">
            <!-- Form fields here -->
            <button type="submit" name="submit" class="vehicle-finance-submit-btn">Submit Application</button>
        </form>
    </div>
</div>

<!-- Error Message Box -->
<div id="financeErrorBox" class="vehicle-finance-error-box" style="display: none;">
  <p id="financeErrorMessage"></p>
</div>