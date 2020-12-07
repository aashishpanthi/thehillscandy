<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel='stylesheet' href='./css/login.css'>
  <title>Register ~ The HillsCandy</title>
</head>
<body>
  <div class="login__login-page">
  <div class="login__form">
      <form class="login-form" method='get' action='../hidden/registerHandle.php'>
        <input type="text" name='email' placeholder="Email"/>
        <input type="password" name='pass' placeholder="password"/>
        <input type="password" name='confirmPass' placeholder="Confirm password"/>
        <button type='submit' name='registerSubmit'>Register</button>
        <p class="message">Not registered? <a href="login">Create an account</a></p>
      </form>
    </div>
  </div>
</body>
</html>