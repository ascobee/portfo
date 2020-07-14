from selenium import webdriver

chrome_browser = webdriver.Chrome('./chromedriver')

chrome_browser.maximize_window()
chrome_browser.get('https://austinscobee.com/contact.html')

elemSubmitButton = chrome_browser.find_element_by_class_name("btn-default")

elemUserEmail = chrome_browser.find_element_by_id("email")
elemUserEmail.clear()
elemUserEmail.send_keys("austin.scobee@yahoo.com")

elemUserSubject = chrome_browser.find_element_by_id("subject")
elemUserSubject.clear()
elemUserSubject.send_keys("This is a bot")

elemUserMessage = chrome_browser.find_element_by_name("message")
elemUserMessage.clear()
elemUserMessage.send_keys("This should not work")

elemCaptchaCheckbox = chrome_browser.find_element_by_class_name("g-recaptcha")
elemCaptchaCheckbox.click()

elemSubmitButton.click()

# chrome_browser.quit()
