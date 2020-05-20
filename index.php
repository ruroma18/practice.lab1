<!DOCTYPE>
<html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <title>Employee table</title>
</head>
<body>
  <header>
      <nav class="navbar navbar-expand-md navbar-dark" style="background-color: black">
        <ul class="navbar-nav">
          <li><a href="index.php" class="nav-link">Staff</a></li>
        </ul>
      </nav>
  </header> <br>
    <?php
    //подключение к БД
    require_once 'connection.php';

    // Выводим ошибку, если не удалось подключится
    if (!$link) {
      echo 'Не могу соединиться с БД. Код ошибки: ' . mysqli_connect_errno() . ', ошибка: ' . mysqli_connect_error();
    exit;
    }
    ?>
    <!-- таблица и заголовки таблицы в html-->
    <table class=table>
      <thead class="thead-dark">
        <tr>
          <th scope="col">id</th>
            <th scope="col">Name</th>
            <th scope="col">Age</th>
            <th scope="col">Salary</th>
            <th scope="col"></th>
            <th scope="col"></th>
          </tr>
      </thead>
    <?php
     //вывод данных в таблицу из БД
      $sql = mysqli_query($link, 'SELECT `id`, `name`, `age`, `salary` FROM `staff`');
      while ($result = mysqli_fetch_array($sql)) {
        echo '<tr>' .
          "<td>{$result['id']}</td>" .
          "<td>{$result['name']}</td>" .
          "<td>{$result['age']}</td>" .
          "<td>{$result['salary']}</td>" .
          "<td><a href='?del_id={$result['id']}'>Delete</a></td>" .
          "<td><a href='edit.php?red_id={$result['id']}'>Edit</a></td>" .
          '</tr>';
      }
    ?>
    </table>
        <!--Переход на страницу добавление работника-->
    <p style="text-align:center">
        <a href="addNewStaff.php" class="btn btn-dark stretched-link">Add new person</a>
    </p>
    
    <?php
      //удаление записи из БД
      if (isset($_GET['del_id'])) { //проверяем, есть ли переменная
        //удаляем строку из таблицы
        $sql = mysqli_query($link, "DELETE FROM `staff` WHERE `id` = {$_GET['del_id']}");
        header ("Location: index.php");
        if ($sql) {
          echo '<script language="javascript">';
          echo 'alert("The employee record has been deleted.")';
          echo '</script>';
        } else {
          echo mysqli_error($link);
        }
      }
    ?>
      
</body>
</html>