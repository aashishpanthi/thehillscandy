<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel='stylesheet' href='../css/login.css'>
  <title>Login</title>
</head>
<body>
  <div class="login__login-page">
  <div class="login__form">
      <form class="login-form" method='post' action='../hidden/loginHandle.php'>
        <input type="text" name='email' placeholder="Email"/>
        <input type="password" name='pass' placeholder="password"/>
        <button type='submit' name='loginSubmit'>login</button>
        <p class="message">Not registered? <a href="./register.php">Create an account</a></p>
      </form>
    </div>
  </div>
</body>
</html>