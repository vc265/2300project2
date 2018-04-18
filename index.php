<?php
$pageCurrent="search";
include("includes/init.php");

const CATEGORY = ["title", "year", "genre", "country"];
if (isset($_GET['searchInput']) and isset($_GET['searchCategory'])) { //if search provided
  $searchDatabase = TRUE;
  $searchCategory = filter_input(INPUT_GET, 'searchCategory', FILTER_SANITIZE_STRING);
  if (in_array($searchCategory, CATEGORY)) {
    $searchSubmit = $searchCategory;
  }
  else {
    $searchSubmit = NULL;
    $searchDatabase = FALSE;
    echo "Invalid category for search.";
  }
  $searchInput = filter_input(INPUT_GET, 'searchInput', FILTER_SANITIZE_STRING);
  $searchInput = trim($searchInput);
}
else { //if no search provided
  $searchDatabase = FALSE;
  $searchCategory = NULL;
  $searchInput = NULL;
}

//display search results
function displayResults($records) {
  echo "<table>
    <tr>
      <th>TITLE</th>
      <th>YEAR</th>
      <th>GENRE</th>
      <th>COUNTRY</th>
      <th>SYNOPSIS</th>
    </tr>";
  for ($x = 0; $x < count($records); $x++) {
    $row = $records[$x];
    echo "<tr>";
    $title = htmlspecialchars($row["title"]);
    echo "<td>$title</td>";
    $year = htmlspecialchars($row["year"]);
    echo "<td>$year</td>";
    $genre = htmlspecialchars($row["genre"]);
    echo "<td>$genre</td>";
    $country = htmlspecialchars($row["country"]);
    echo "<td>$country</td>";
    $synopsis = htmlspecialchars($row["synopsis"]);
    echo "<td>$synopsis</td>";
    echo "</tr>";
  }
  echo "</table>";
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <link rel="stylesheet" type="text/css" href="styles/all.css" media="all"/>
  <title>"Drama Search"</title>
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
      <h1 id="titleStyle">DRAMA SEARCH</h1>

      <form id="searchForm" action="index.php" method="get">
        <select name="searchCategory" required>
          <option value="" selected disabled>Select Category</option>
          <?php
            foreach(CATEGORY as $category) {
              echo "<option value='$category'>$category</option>";
            }
          ?>
        </select>
        <input type="text" name="searchInput"/>
        <button type="submit">Search Drama</button>
      </form> <!-- end of searchForm form -->

      <div id="searchResults">
        <?php
          if ($searchDatabase) { //if search provided
            echo "<h2>Search Results</h2>";
            $sql = "SELECT * FROM dramas WHERE " . $searchCategory . " LIKE '%' || :searchInput || '%'";
            $params = array(':searchInput' => $searchInput);
          }
          else { //if no search provided, return all results
            echo "<h2>All Dramas</h2>";
            $sql = "SELECT * FROM dramas";
            $params = array();
          }
          $records = exec_sql_query($db, $sql, $params)->fetchAll();
          if (isset($records) and !empty($records)) {
            displayResults($records);
          }
          else {
            echo "<p>No drama found.</p>";
          }
        ?>
      </div> <!-- end of searchResults div -->
    </div> <!-- end of content div -->
  </div> <!-- end of container div -->

  <?php include("includes/footer.php");?>

</body>
</html>
