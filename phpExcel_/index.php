<html>
<head>
		<title>Pilot Program</title>
		<link rel="icon" href="favicon.ico" type="image/gif"> 
</head>
<body>

<form action="test.php" method="post">

  <label class="radio" for="txtContact">Choose Database</label>
  <input class="radio" type="radio" name="db" value="ATM machines" checked /> <span>ATM machines</span>
  <input class="radio" type="radio" name="db" value="Percent of Internet Users" /> <span>Percent of Internet Users</span>


<input type="submit" value="Choose">
</form>

Hello, Happy New Year 2013.


<form action="test.php" method="post">
<?php
$con = mysql_connect("localhost","insead","insead2012");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("test", $con);

$result = mysql_query("SELECT * FROM data_tables;");

echo "<table border='1'>
<tr>
<th></th>
<th>Indicator Name</th>
<th>Number of countries coverage</th>
<th>Years of coverage</th>
<th>Source</th>
<th>Description</th>
</tr>";

while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><input class=\"radio\" type=\"radio\" name=\"table\" value=\"". $row['table_name']."\" /></td>";
  echo "<td>" . $row['name'] . "</td>";
  echo "<td>" . $row['countries'] . "</td>";
  echo "<td>" . $row['year_start'] . " - " . $row['year_end'] . "</td>";
  echo "<td>" . $row['source'] . "</td>";
  echo "<td>" . $row['description'] . "</td>";
  echo "</tr>";
  }
echo "</table>";

mysql_close($con);
?>

<input type="submit" value="Choose">
</form>


</body>
</html> 