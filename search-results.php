<!DOCTYPE html>
<html>
<head>
  <title>Результаты поиска</title>
  <style>
    /* Стили для хедера */
    header {
      background-color: #333;
      color: white;
      padding: 20px;
      text-align: center;
    }

    /* Стили для таблицы */
    table {
      font-family: Arial, Helvetica, sans-serif;
      border-collapse: collapse;
      width: 80%;
      margin: 20px auto;
      box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
    }

    td, th {
      border: 1px solid #ddd;
      padding: 8px;
    }

    tr:nth-child(even) {
      background-color: #f2f2f2;
    }

    th {
      padding-top: 12px;
      padding-bottom: 12px;
      text-align: left;
      background-color: #95c2cf;
      color: white;
    }

    /* Стили для футера */
    footer {
      background-color: #333;
      color: white;
      padding: 10px;
      text-align: center;
      position: absolute;
      bottom: 0;
      width: 100%;
      height: 50px;
      line-height: 50px;
    }

    /* Дополнительные стили для страницы с результатами поиска */
    body {
      background-color: #f2f2f2;
    }

    h1 {
      text-align: center;
      margin-top: 30px;
      color: #333;
    }
  </style>
</head>
<body>
  <header>
    <!-- ... хедер ... -->
  </header>

  <h1>Результаты поиска</h1>

  <table>
    <tr>
      <th>Название книги</th>
      <th>Автор</th>
      <th>Год выпуска</th>
    </tr>
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

      $conn->close();
      
      if (count($books) > 0) {
        foreach ($books as $book) {
          echo "<tr>";
          echo "<td>" . $book['title'] . "</td>";
          echo "<td>" . $book['author'] . "</td>";
          echo "<td>" . $book['year'] . "</td>";
          echo "</tr>";
        }
      } else {
        echo "<tr><td colspan='3'>Нет доступных записей</td></tr>";
      }
    ?>
  </table>

  <footer>
    <!-- ... футер ... -->
  </footer>
</body>
</html>