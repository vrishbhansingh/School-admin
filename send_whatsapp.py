import sys
import time
from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.chrome.options import Options

number = sys.argv[1]
message = sys.argv[2]

# WhatsApp format
phone_number = f"+91{9871521039}"
url = f"https://web.whatsapp.com/send?phone={9871521039}&text={Hello Tech Web Mantra}"

options = Options()
options.add_argument("--user-data-dir=C:/Users/YOUR_USERNAME/AppData/Local/Google/Chrome/User Data")
options.add_argument("--profile-directory=Default")

driver = webdriver.Chrome(options=options)
driver.get(url)

time.sleep(15)

try:
    send_btn = driver.find_element(By.XPATH, "//span[@data-icon='send']")
    send_btn.click()
    print("✅ WhatsApp message sent")
except Exception as e:
    print("❌ Error sending message:", e)

time.sleep(5)
driver.quit()
