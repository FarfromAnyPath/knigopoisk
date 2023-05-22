<!DOCTYPE html>
<html>
<head>
  <title>Страница входа</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f2f2f2;
      margin: 0;
      padding: 0;
    }

    .container {
      max-width: 400px;
      margin: 100px auto;
      background-color: #fff;
      border-radius: 5px;
      padding: 20px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h1 {
      text-align: center;
      margin-bottom: 20px;
    }

    form {
      display: flex;
      flex-direction: column;
    }

    label {
      font-weight: bold;
      margin-bottom: 5px;
    }

    input[type="text"],
    input[type="password"] {
      padding: 10px;
      margin-bottom: 10px;
      border-radius: 3px;
      border: 1px solid #ccc;
    }

    input[type="submit"] {
      padding: 10px;
      background-color: #797e81;
      color: #fff;
      border: none;
      border-radius: 3px;
      cursor: pointer;
    }

    input[type="submit"]:hover {
      background-color: #797e81;
    }

    .forgot-password {
      text-align: center;
      margin-top: 10px;
    }

    .forgot-password a {
      color: #999;
      text-decoration: none;
    }

    .forgot-password a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Вход</h1>
    <form action="comein.php" method="post">
      <label for="username">Имя пользователя:</label>
      <input type="text" id="username" name="username" required>
      <label for="password">Пароль:</label>
      <input type="password" id="password" name="password" required>

      <input type="submit" value="Войти">
    </form>
    <div class="forgot-password">
      <a href="https://деменция.net">Забыли пароль?</a>
    </div>
  </div>
</body>
</html>