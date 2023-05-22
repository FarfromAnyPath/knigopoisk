<?php
// Проверяем, авторизован ли пользователь
session_start();
if (!isset($_SESSION['username'])) {
  // Если пользователь не авторизован, перенаправляем на страницу входа
  header("Location: login.php");
  exit();
}

// Обработка действий пользователя
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  if (isset($_POST['change-password'])) {
    // Действие "Изменить пароль" - обработка кода
    // ...
    echo "Изменение пароля";
  } elseif (isset($_POST['logout'])) {
    // Действие "Выход из аккаунта" - обработка кода
    // ...
    // Сброс сессии и перенаправление на страницу входа
    session_unset();
    session_destroy();
    header("Location: index.php");
    exit();
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Личный кабинет</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f2f2f2;
      margin: 0;
      padding: 0;
    }

    .container {
      max-width: 600px;
      margin: 100px auto;
      background-color: #fff;
      border-radius: 5px;
      padding: 30px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h1 {
      text-align: center;
      margin-bottom: 30px;
      font-size: 28px;
    }

    .button-container {
      display: flex;
      justify-content: space-between;
      margin-top: 30px;
    }

    .button {
      padding: 12px 20px;
      background-color: #797e81;
      color: #fff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      margin-bottom: 10px;
      display: inline-block;
      margin-right: 10px;
      font-size: 18px;
    }

    .button:hover {
      background-color: #95c2cf;
    }

    .form-group {
      margin-bottom: 30px;
    }

    .form-label {
      font-weight: bold;
      display: block;
      margin-bottom: 10px;
      font-size: 20px;
    }

    .form-input {
      padding: 12px;
      width: 94%;
      border-radius: 5px;
      border: 1px solid #ccc;
      font-size: 18px;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Личный кабинет</h1>
    <div class="form-group">
      <label class="form-label">Имя пользователя:</label>
      <input type="text" class="form-input" value="<?php echo $_SESSION['username']; ?>" disabled>
    </div>

    <div class="button-container">
      <form method="POST" action="">
        <input type="submit" name="change-password" value="Изменить пароль" class="button">
      </form>
      <form method="POST" action="">
        <input type="submit" name="logout" value="Выход из аккаунта" class="button">
      </form>
    </div>
  </div>
</body>
</html>