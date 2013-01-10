<h1>Test Driving MySqlExcelBuilder</h1>
<?php 
require_once('MySqlExcelBuilder.class.php');

// Intialize the object with the database variables
$database = 'xls_sample';
$user='root';
$pwd='insead2012';
$mysql_xls = new MySqlExcelBuilder($database,$user,$pwd);

// Setup the SQL Statements
$sql_statement = 'select * from customer;';


$sql_statement2 = 'select * from order_item;';



// Add the SQL statements to the spread sheet
$mysql_xls->add_page('Gold Mugs',$sql_statement,'','B',2);
$mysql_xls->add_page('Tea',$sql_statement2,'','B',2);

// Get the spreadsheet after the SQL statements are built...
$phpExcel = $mysql_xls->getExcel(); // This needs to come after all the pages have been added.

$phpExcel->setActiveSheetIndex(0); // Set the sheet to the first page.
// Do some addtional formatting using PHPExcel
$sheet = $phpExcel->getActiveSheet();
$date = date('Y-m-d');
$cellKey = "A1"; 
$sheet->setCellValue($cellKey,"Gold Mugs Sold as Of $date");
$style = $sheet->getStyle($cellKey);                              
$style->getFont()->setBold(true);

$phpExcel->setActiveSheetIndex(1); // Set the sheet to the second page.
$sheet = $phpExcel->getActiveSheet(); 
$sheet->setCellValue($cellKey,"Tea Sold as Of $date");
$style = $sheet->getStyle($cellKey);                              
$style->getFont()->setBold(true);

$phpExcel->setActiveSheetIndex(0); // Set the sheet back to the first page.

// Write the spreadsheet file...
$objWriter = PHPExcel_IOFactory::createWriter($phpExcel, 'Excel5'); // 'Excel5' is the oldest format and can be read by old programs.
$fname = "TestFile.xls";
$objWriter->save($fname);

// Make it available for download.
echo "<a href=\"$fname\">Download $fname</a>";


?>