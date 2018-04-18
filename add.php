<?php
$pageCurrent="add";
include("includes/init.php");

$dramas = exec_sql_query($db, "SELECT DISTINCT synopsis FROM dramas", NULL)->fetchAll(PDO::FETCH_COLUMN);
if (isset($_POST["addInsert"])) {
  $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
  $year = filter_input(INPUT_POST, 'year', FILTER_SANITIZE_STRING);
  $genre = filter_input(INPUT_POST, 'genre', FILTER_SANITIZE_STRING);
  $country = filter_input(INPUT_POST, 'country', FILTER_SANITIZE_STRING);
  $synopsis = filter_input(INPUT_POST, 'synopsis', FILTER_SANITIZE_STRING);
  $invalidAdd = FALSE;
  if (in_array($synopsis, $dramas)) {
    $invalidAdd = TRUE;
  }
  else {
    $sql = "INSERT INTO dramas (title, year, genre, country, synopsis) VALUES (:title, :year, :genre, :country, :synopsis);";
    $params = array(
      "title" => $title,
      "year" => $year,
      "genre" => $genre,
      "country" => $country,
      "synopsis" => $synopsis,
    );
    $result = exec_sql_query($db, $sql, $params);
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <link rel="stylesheet" type="text/css" href="styles/all.css" media="all"/>
  <title>Drama Add</title>
</head>

<body>
  <div id="stickyHeader">
    <div id="navigationBar">
      <span class="navigationHome"><a href="index.php">East Asian Drama List</a></span>
      <?php include("includes/header.php"); ?>
    </div> <!-- end of navigationBar div -->
  </div> <!-- end of stickyHeader div -->

  <div id="container">
    <div id="content">
      <h1 id="titleStyle">DRAMA ADD</h1>

      <div id="addResults">
        <?php
          global $result, $invalidAdd;
          if ($result) {
            echo "<h2>The drama has been added. Thank you!</h2>";
          }
          else {
            if ($invalidAdd) {
              echo "<h2>The synopsis already exists. Please try again.</h2>";
            }
          }
        ?>
      </div> <!-- end of addResults div -->

      <form id="addForm" action="add.php" method="post">
        <ul>
          <li>
            <label>Name of Drama</label>
            <input type="text" name="title" required/>
          </li>
          <li>
            <label>Production Year</label>
            <select name="year" required>
              <?php
                echo "<option value='' selected disabled>Select Year</option>";
                for ($x = 2000; $x <= 2018; $x++) {
                  echo "<option value=$x>$x</option>";
                }
              ?>
            </select>
          </li>
          <li>
            <label>Genre(s)</label>
            <input type="text" name="genre" required/>
          </li>
          <li>
            <label>Production Country</label>
            <select name="country" required>
              <option value="" selected disabled>Select Country</option>
              <option value="China">China</option>
              <option value="Japan">Japan</option>
              <option value="Korea">Korea</option>
              <option value="Taiwan">Taiwan</option>
            </select>
          </li>
          <li>
            <label for="synopsis">Synopsis</label>
            <textarea id="synopsis" name="synopsis" cols="40" rows="5" required></textarea>
          </li>
        </ul>
        <button name="addInsert" type="submit">Add Drama</button>
      </form> <!-- end of addForm form -->

    </div> <!-- end of content div -->
  </div> <!-- end of container div -->

  <?php include("includes/footer.php");?>

</body>
</html>
