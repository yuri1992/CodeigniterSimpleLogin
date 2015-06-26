#Codeigniter Simple Login

##What is This ?!?!
Simple login Implement to Codeigniter Framework.
In this code we using sesssion libary of codeigniter to store our session data.
Safe, Easy and Simple Login Implement.

##Code

###Controller Simplelogin
####->login
  Login Controller Method, Making a Simple validation of the form.
  Validiting POST Data with **login_model->is_login_valid**
  Making Call to private function **set_session_login**.
####->set_session_login
  Initilize Session Data, Store Email,Password,Date,is_login(flag)
####->logout
  Unset all User date, and remove all session privous data.
####->unset_session_login
  Private Function, Make the "diry" work
  
###Helper login_helper
####->on_success_session($url)
  If user is Valid and Succefull Login he Will redirect to the $url.
  use in pages that already login users not need to be (create new user)
####->on_invalid_session($url)
  If user in not login, and not have valid session he will redirect to $url.
  use in protected pages
