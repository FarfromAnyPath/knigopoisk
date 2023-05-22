<?php
session_start();
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

// Обработка формы входа
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Получение данных из формы
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Поиск пользователя в базе данных
    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($query);

    if ($result->num_rows === 1) {
        // Пользователь найден, проверяем пароль
        $row = $result->fetch_assoc();
        if (password_verify($password, $row["password"])) {
            $_SESSION['username'] = $username;
            // Пароль верен, вход выполнен
            echo "Вход выполнен. Добро пожаловать, " . $row["username"];
            // Дополнительный код для предоставления доступа после успешного входа
            // ...

            // Редирект на защищенную страницу или дашборд
            header("Location: index.php");
            exit(); // Важно прервать выполнение скрипта после отправки заголовка редиректа
        } else {
            echo "Неверный пароль";
        }
    } else {
        echo "Пользователь не найден";
    }
}
?>

<!-- Форма для входа -->
<form method="POST" action="">
    <input type="text" name="username" placeholder="Имя пользователя" required>
    <input type="password" name="password" placeholder="Пароль" required>
    <input type="submit" value="Войти">
</form>