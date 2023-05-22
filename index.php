<!DOCTYPE html>
<html>
<head>
  <title>База данных книг</title>
  <style>
    /* Стили для хедера */
    header {
      background-color: #333;
      color: white;
      padding: 20px;
      text-align: center;
    }

    /* Стили для кнопок */
    .button {
      display: inline-block;
      padding: 10px 20px;
      background-color: #797e81;
      color: white;
      border: none;
      border-radius: 5px;
      font-size: 18px;
      cursor: pointer;
      text-decoration: none;
    }

    .button:hover {
      background-color: #95c2cf;
    }

    /* Стили для формы поиска */
    form {
      display: flex;
      justify-content: center;
      margin-top: 20px;
    }

    input[type=text] {
      padding: 10px;
      font-size: 18px;
      border-radius: 5px;
      border: none;
      width: 50%;
      margin-right: 10px;
    }

    input[type=submit] {
      padding: 10px 20px;
      background-color: #797e81;
      color: white;
      border: none;
      border-radius: 5px;
      font-size: 18px;
      cursor: pointer;
    }

    input[type=submit]:hover {
      background-color: #95c2cf;
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
  </style>
</head>
<body>
  <header>
    <h1>КНИГОПОИСК</h1>
    <?php
      session_start();
      if(isset($_SESSION['username'])) {
        // Если пользователь авторизован, выводим ссылку на личный кабинет
        echo "<h2><a href='profile.php' class='button'>Личный кабинет</a></h2>";
      } else {
        // Если пользователь не авторизован, выводим кнопки "Регистрация" и "Вход"
      echo "<h2><a href='registration.php' class='button' style='margin-right: 10px;'>Регистрация</a>";
      echo "<a href='login.php' class='button' style='margin-left: 10px;'>Вход</a></h2>";
      }
    ?>
  </header>
  
  <form action="search-results.php" method="GET">
    <input type="text" name="q" placeholder="Введите название книги...">
    <input type="submit" value="Поиск">
  </form>
  <table>
    <tr>
      <th>Название книги</th>
      <th>Автор</th>
      <th>Год выпуска</th>
    </tr>
    <?php
      // Подключение к базе данных
      $host = "localhost";
      $username = "root";
      $password = "";
      $dbname = "basebooks";

      $connection = new mysqli($host, $username, $password, $dbname);

      // Проверка наличия ошибок при подключении
      if ($connection->connect_error) {
        die("Ошибка подключения к базе данных: " . $connection->connect_error);
      }

      // Запрос на выборку данных из таблицы tablebooks
      $query = "SELECT * FROM tablebooks";
      $result = $connection->query($query);

      // Обработка результата выборки
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo "<tr>";
          echo "<td>" . $row['title'] . "</td>";
          echo "<td>" . $row['author'] . "</td>";
          echo "<td>" . $row['year'] . "</td>";
          echo "</tr>";
        }
      } else {
        echo "<tr><td colspan='3'>Нет доступных записей</td></tr>";
      }

      // Закрытие соединения с базой данных
      $connection->close();
    ?>
  </table>

  <footer>
   <p>&copy; 2023 КНИГОПОИСК. Все права защищены.
    Created by Чемпики
   </p>
  </footer>
  <script>
    // Находим форму и поле для ввода запроса
    const searchForm = document.getElementById("search-form");
    const searchInput = document.getElementById("search-input");

    // Добавляем обработчик события "submit" для формы
    searchForm.addEventListener("submit", function(event) {
      event.preventDefault(); // Отменяем стандартное поведение отправки формы
      const query = searchInput.value.trim(); // Получаем значение запроса

      // Если значение запроса не пустое
      if (query !== "") {
        const searchUrl = "search.php?q=" + encodeURIComponent(query); // Формируем ссылку для поиска
        // Отправляем AJAX-запрос к серверу
        const xhr = new XMLHttpRequest();
        xhr.open("GET", searchUrl);
        xhr.onload = function() {
          if (xhr.status === 200) {
            const results = JSON.parse(xhr.responseText); // Разбираем ответ сервера
            displayResults(results); // Отображаем результаты на странице
          }
        };
        xhr.send();
      }
    });

    // Функция для отображения результатов на странице
    function displayResults(results) {
      const searchResults = document.getElementById("search-results");
      searchResults.innerHTML = ""; // Очищаем содержимое контейнера для результатов
      if (results.length === 0) {
        searchResults.innerHTML = "<p>Ничего не найдено</p>";
      } else {
        for (let i = 0; i < results.length; i++) {
          const result = results[i];
          const resultElement = document.createElement("div");
          resultElement.classList.add("search-result");
          resultElement.innerHTML = "<h3>" + result.title + "</h3>" + "<p>" + result.description + "</p>" + "<a href=\"" + result.url + "\">Подробнее</a>";
          searchResults.appendChild(resultElement);
        }
      }
    }
  </script>
</body>
</html>

