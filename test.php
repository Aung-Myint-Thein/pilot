<html>
	<head>
		<title>Pilot : Result</title>
		<link rel="icon" href="favicon.ico" type="image/gif"> 
	</head>
<body>

<h1>Hello!</h1>


<p>I used the tutorial and files from <a href="http://net.tutsplus.com/tutorials/php/how-to-generate-a-complete-excel-spreadsheet-from-mysql/">here</a>.</p>

<?php 

$start_time = time();

require_once('MySqlExcelBuilder.class.php');

// Intialize the object with the database variables
$database = 'test';
$user='insead';
$pwd='insead2012';
$mysql_xls = new MySqlExcelBuilder($database,$user,$pwd);

set_time_limit(0);

$choices = $_POST["table"];
if(empty($choices)){
	echo ("You didn't choose any data source.");
}
else{
	$from_db = "";
	for($i=0;$i<count($choices);$i++){
		if($i == count($choices)-1){
			$from_db .= $choices[$i]. ' ';
		}else{
			$from_db .= $choices[$i]. ', ';	
		}
	}
}

echo $from_db;

// Setup the SQL Statements
$sql_statement = 'select * from atmmachines;';

$after_sql = time();

// Add the SQL statements to the spread sheet
$mysql_xls->add_page('Data',$sql_statement,'','B',2);

$after_add_page = time();

// Get the spreadsheet after the SQL statements are built...
$phpExcel = $mysql_xls->getExcel(); // This needs to come after all the pages have been added.

// Write the spreadsheet file...
$objWriter = PHPExcel_IOFactory::createWriter($phpExcel, 'Excel5'); // 'Excel5' is the oldest format and can be read by old programs.
$fname = "DataFile_".date("Y-m-d His").".xls";

$after_write = time();

$objWriter->save("./downloads/".$fname);

$after_save = time();

// Make it available for download.
echo "Download <a href=\"./downloads/$fname\">Here</a>";

?>
<p>
You choose <?php //echo $_POST["table"]; ?> database.
</p>

Start to after sql = <?php echo $after_sql-$start_time; ?>
after sql to after add page = <?php echo $after_add_page-$after_sql; ?>
after add page to after write = <?php echo $after_write - $after_add_page; ?>
after write to after save = <?php echo $after_save - $after_write; ?>

</body>
</html>
