<html>
	<head>
		<title>Pilot Program</title>
	</head>
<body>
Hello, Happy New Year 2013.


<?php
$con = mysql_connect("localhost","root","insead2012");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("test", $con);

$result = mysql_query("SELECT * FROM ATMMachines where year = 2009");

echo "<table border='1'>
<tr>
<th>ISO3</th>
<th>Country</th>
<th>ATMMachines for year 2009</th>
</tr>";

while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td>" . $row['ISO3'] . "</td>";
  echo "<td>" . $row['Country'] . "</td>";
  echo "<td>" . $row['ATMMachines'] . "</td>";
  echo "</tr>";
  }
echo "</table>";

mysql_close($con);
?> 


</body>
</html>