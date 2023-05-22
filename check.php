<?php
// Подключение к базе данных
$servername = "localhost"; // Адрес сервера базы данных
$username = "root"; // Имя пользователя базы данных
$password = ""; // Пароль пользователя базы данных
$dbname = "register"; // Имя базы данных

// Создание соединения
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка соединения
if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

// Обработка формы регистрации
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Получение данных из формы
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Проверка наличия пользователя в базе данных
    $checkQuery = "SELECT * FROM users WHERE username = '$username'";
    $checkResult = $conn->query($checkQuery);

    if ($checkResult->num_rows > 0) {
        echo "Пользователь уже существует";
    } else {
        // Хэширование пароля
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Создание новой записи пользователя
        $insertQuery = "INSERT INTO users (`username`, `email`, `password`) VALUES ('$username', '$email', '$hashedPassword')";
        if ($conn->query($insertQuery) === true) {
            // Регистрация успешна
            header("Location: uspeh.php"); // Перенаправление на страницу uspeh.php
            exit(); // Завершение скрипта

            // Предоставление доступа к базе данных
            // Можно использовать сохраненные данные о пользователе для проверки и аутентификации

            // Дополнительный код для предоставления доступа к базе данных
            // ...

        } else {
            echo "Ошибка регистрации: " . $conn->error;
        }
    }
}
?>