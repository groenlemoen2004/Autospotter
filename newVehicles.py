from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.chrome.options import Options
import pandas as pd
from bs4 import BeautifulSoup
import time

# Set login URL and credentials
LOGIN_URL = "https://sc41.pipelineguru.co.za/autoslm/Login/login.cfm?errmsg=3"
DATA_URL = "https://sc41.pipelineguru.co.za/autoslm/App/sf.cfm?x=B2E1EF2C47ag13Dtbag126AA9DE05E99A23A644021luafedag13Degapag126ED3DA118041ESag13Dtuag126mfcag12Et532012090936"
USERNAME = "Marindae"
PASSWORD = "Marindae123"

# Setup Selenium Chrome options
chrome_options = Options()
chrome_options.add_argument("--headless")  # Run in headless mode (no GUI)
chrome_options.add_argument("--disable-gpu")

# Initialize the Chrome driver (make sure chromedriver is in your PATH)
driver = webdriver.Chrome(options=chrome_options)

try:
    # Open the login page and wait for it to load
    driver.get(LOGIN_URL)
    time.sleep(10)  # wait for the page to load

    # Fill in the login form (adjust the selectors to match the page's HTML)
    username_field = driver.find_element(By.NAME, "username")
    password_field = driver.find_element(By.NAME, "password")
    username_field.send_keys(USERNAME)
    password_field.send_keys(PASSWORD)
    
    # Click the login button (adjust the selector as needed)
    login_button = driver.find_element(By.XPATH, "//input[@type='submit']")
    login_button.click()
    time.sleep(10)  # wait for login to process

    # Navigate to the data page and wait for the content to load
    driver.get(DATA_URL)
    time.sleep(10)  # adjust as necessary for the page/JS to load

    # Retrieve the fully rendered HTML and parse it
    html = driver.page_source
    soup = BeautifulSoup(html, 'html.parser')

    # Find all tables on the page
    tables = soup.find_all("table")
    if tables:
        # Use a context manager to create an Excel writer for saving multiple sheets
        with pd.ExcelWriter("all_tables.xlsx", engine="openpyxl") as writer:
            # Process each table found on the page
            for idx, table in enumerate(tables, start=1):
                # Extract headers (if present)
                headers = [th.get_text(strip=True) for th in table.find_all("th")]
                
                # Extract table rows
                rows = table.find_all("tr")
                data = []
                for row in rows:
                    cells = row.find_all("td")
                    if cells:
                        data.append([cell.get_text(strip=True) for cell in cells])
                
                # Only process if the table contains data rows
                if data:
                    # Create a DataFrame. If headers exist and match the number of columns, use them.
                    if headers and len(headers) == len(data[0]):
                        df = pd.DataFrame(data, columns=headers)
                    else:
                        df = pd.DataFrame(data)
                    # Save the DataFrame to a separate sheet in the Excel file
                    sheet_name = f"Table_{idx}"
                    df.to_excel(writer, sheet_name=sheet_name, index=False)
        print("All table data has been saved to all_tables.xlsx")
    else:
        print("No tables found on the page.")
        
finally:
    driver.quit()
