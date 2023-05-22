<?php
// Подключение к базе данных
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "basebooks";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

// Получение значения запроса из параметра 'q'
$query = $_GET['q'];

// Формирование SQL-запроса
$sql = "SELECT * FROM tablebooks WHERE title LIKE '%$query%'";

$result = $conn->query($sql);

// Создание массива для хранения результатов поиска
$books = array();

if ($result->num_rows > 0) {
    // Получение данных из результата запроса
    while ($row = $result->fetch_assoc()) {
        $books[] = $row;
    }
}

// Возвращаем результаты поиска в формате JSON
echo json_encode($books);

$conn->close();
?>