<!DOCTYPE>
<html>
    <head>
    <meta charser="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Добавление нового работника</title>
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
    require_once 'connection.php';
      // POST запрос
      if(isset($_POST['name']) && isset($_POST['age']) && isset($_POST['salary']) && isset($_POST['id'])){
 
      $id = htmlentities(mysqli_real_escape_string($link, $_POST['id']));
      $name = htmlentities(mysqli_real_escape_string($link, $_POST['name']));
      $age = htmlentities(mysqli_real_escape_string($link, $_POST['age']));
      $salary = htmlentities(mysqli_real_escape_string($link, $_POST['salary']));

      //запрос на обновление         
      $query ="UPDATE staff SET name='$name', age='$age', salary='$salary' WHERE id='$id'";
      $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
           
      if($result)
        echo '<script language="javascript">';
        echo 'alert("Data updated successfully")';
        echo '</script>';
      }
      // GET запрос
      if(isset($_GET['red_id'])) {   
        $id = htmlentities(mysqli_real_escape_string($link, $_GET['red_id']));
           
        // запрос данных по выбранному id
        $query ="SELECT * FROM staff WHERE id = '$id'";
        $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
        //если в запросе более нуля строк, то выводим все строки
        if($result && mysqli_num_rows($result)>0) {
          $row = mysqli_fetch_row($result);
          $name = $row[1];
          $age = $row[2];
          $salary = $row[3]; 
          //форма редактирование данных
          echo "<div class='d-flex justify-content-center'>
              <form action='' method='post'>
              <input type='hidden' name='id' value='$id'>
              <div class='form-group'>
                <label for='name'>Name:</label>
                <input class='form-control' type='text' name='name' value='$name'>
              </div>
              <div class='form-group'>
                <label>Age:</label>
                <input class='form-control' type='number' name='age' size='2' value='$age'>
              </div>
              <div class='form-group'>
                <label>Salary:</label>
                <input class='form-control' type='number' name='salary' size='6' value='$salary'>
              </div>
              <button type='submit' class='btn btn-primary'>Edit</button>
              <a href='index.php' class='btn btn-dark stretched-link'>Back</a>
            </form>
          </div>";
        mysqli_free_result($result);
          }
        }
    mysqli_close($link);
    ?>
    </body>
</html>