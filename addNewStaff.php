<!DOCTYPE>
<html>
    <head>
        <meta charser="utf-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <title>Adding a new employee</title>
        </style>
    </head>
    <body>
        <header>
            <nav class="navbar navbar-expand-md navbar-dark" style="background-color: black">
                <ul class="navbar-nav">
                     <li><a href="index.php" class="nav-link">Staff</a></li>
                </ul>
            </nav>
        </header> <br>
        <!-- Форма добавление записи в таблицу-->
        <div class="d-flex justify-content-center">
            <form action="" method="post">
            <div class="form-group">
                <label for="name">Name:</label>
                <input class="form-control" type="text" name="name" value="<?= isset($_GET['red_id']) ? $staff['name'] : ''; ?>">
            </div>
            <div class="form-group">
                <label>Age:</label>
                <input class="form-control" type="number" name="age" size="2" value="<?= isset($_GET['red_id']) ? $staff['age'] : ''; ?>">
            </div>
            <div class="form-group">
                <label>Salary:</label>
            <input class="form-control" type="number" name="salary" size="6" value="<?= isset($_GET['red_id']) ? $staff['salary'] : ''; ?>">
            </div>
            <button type="submit" class="btn btn-primary">Add new person</button>
            <a href="index.php" class="btn btn-dark stretched-link">Back</a>
            </form>
        </div>
    <?php
    require_once 'connection.php';
            //Если переменная Name передана
        if (isset($_POST["name"])) {
            //Вставляем данные, подставляя их в запрос
            $sql = mysqli_query($link, "INSERT INTO `staff` (`name`, `age`, `salary`) VALUES ('{$_POST['name']}', '{$_POST['age']}', '{$_POST['salary']}')");
        //Если вставка прошла успешно
        if ($sql) {
            echo '<script language="javascript">';
            echo 'alert("New person has been successfully added.")';
            echo '</script>';
        } else {
          echo mysqli_error($link);
        }
      }
    mysqli_close($link);
    ?>
    </body>
</html>