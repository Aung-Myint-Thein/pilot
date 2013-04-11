<!DOCTYPE html>
<html lang="en">
  <head>
	<meta charset="utf-8">
	<title>Pilot : Result</title>
	<link rel="icon" href="favicon.ico" type="image/gif">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	<!-- Le styles -->
	<link href="bootstrap/css/bootstrap.css" rel="stylesheet">
	<style type="text/css">
	  /* Sticky footer styles
	  -------------------------------------------------- */
	  html,
	  body {
		height: 100%;
		/* The html and body elements cannot have any padding or margin. */
	  }
	  /* Wrapper for page content to push down footer */
	  #wrap {
		min-height: 100%;
		height: auto !important;
		height: 100%;
		/* Negative indent footer by it's height */
		margin: 0 auto -60px;
	  }
	  /* Set the fixed height of the footer here */
	  #push,
	  #footer {
		height: 60px;
	  }
	  /* Lastly, apply responsive CSS fixes as necessary */
	  @media (max-width: 767px) {
		#footer {
		  margin-left: -20px;
		  margin-right: -20px;
		  padding-left: 20px;
		  padding-right: 20px;
		}
	  }
	  /* end of Sticky footer styles
	  -------------------------------------------------- */
	  /* Custom container */
	  .container-narrow {
		margin: 0 auto;
		max-width: 700px;
	  }
	  .container-narrow > hr {
		margin: 30px 0;
	  }

	  /* Main marketing message and sign up button */
	  .jumbotron {
		margin: 60px 0;
		text-align: center;
	  }
	  .jumbotron h1 {
		font-size: 72px;
		line-height: 1;
	  }
	  .jumbotron .btn {
		font-size: 21px;
		padding: 14px 24px;
	  }
	  /* Supporting marketing content */
	  .marketing {
		margin: 60px 0;
	  }
	  .marketing p + h4 {
		margin-top: 28px;
	  }
	</style>
	<link href="bootstrap/css/bootstrap-responsive.css" rel="stylesheet">
	<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- Fav and touch icons -->
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
	<link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">
	<link rel="shortcut icon" href="../assets/ico/favicon.png">
  </head>

  <body>
	<div id="wrap">
	<div class="container-narrow">
	  <div class="masthead">
		<ul class="nav nav-pills pull-right">
		  <li><a href="home.php">Home</a></li>
		  <li><a href="about.php">About</a></li>
		</ul>
		<h3 class="muted">INSEAD eLab Pilot Program</h3>
	  </div>
	  
	  <hr>
		
		<?php
		  
		  $start_time = time();
		  
		  require_once('MySqlExcelBuilder.class.php');
		  
		  // Intialize the object with the database variables
		  $database = 'test';
		  $user='insead';
		  $pwd='insead2012';
		  $mysql_xls = new MySqlExcelBuilder($database,$user,$pwd);
		  
		  //set time limit to wait for the query
		  set_time_limit(0);
		  
		  $choices = $_POST["table"];
		  $start_year = $_POST["start_year"];
		  $end_year = $_POST["end_year"];	
		  
		  if(empty($choices)) {
			echo ("You didn't choose any data source.");
		  } else {
			//constructing pieces of SQL statements
			$from_db = "";
			$from_to_print = "";
			$where = "";
			$select_columns = "";
			$duration = "";
			
			for($i=0;$i<count($choices);$i++){
			  $select_columns .= ",".$choices[$i];
			  $from_db .= " LEFT OUTER JOIN ".$choices[$i]." ON Country.ISO3 = ".$choices[$i].".ISO3 AND Country.year = ".$choices[$i].".year ";			  
			  $from_to_print .= $choices[$i] . ' ';				
			}
			
			if($start_year > 0 && $end_year > 0){ } else {			
			  //default time series is from 2003 to 2013
			  $start_year = 2003;
			  $end_year = 2013;			
			}
			
			$duration .= 'year >= '.$start_year.' AND year <= '.$end_year;
		  }
		  ?>
		  
		  <p>You choose <?php echo $from_to_print. 'databases from ' . $start_year . ' to ' . $end_year .'.'; ?></p>
		  
		  <?php
		  //constructing sql statement
		  $sql_statement = 'SELECT Country.Country, Country.ISO3, Country.year'.$select_columns.' FROM (SELECT * FROM Country JOIN year WHERE '.$duration.') Country'.$from_db.';';
		  
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
		  echo "<p><h5>Download your excel <a href=\"./downloads/$fname\">here</a></h5></p>";
		  
		?>
		
		<hr>
		
		<h4>Performance</h4>
		
		Executing SQL statement : <?php echo number_format(($after_sql-$start_time), 0, '.', ''); ?> seconds
		<br/>
		Adding sheets to Excel : <?php echo number_format(($after_add_page-$after_sql), 0, '.',''); ?> seconds
		<br/>
		Writing to file : <?php echo number_format(($after_write - $after_add_page), 0, '.', ''); ?> seconds
		<br/>
		Saving to file : <?php echo number_format(($after_save - $after_write),0, '.', ''); ?> seconds
		<br/>
		
		<hr>
		
		<h4>For Dev.</h4>
		
		<p class="muted"><?php echo $sql_statement; ?></p>
		
		<hr>
		
		<h5>Credit:</h5>
		
		<p>I used the tutorial from <a href="http://net.tutsplus.com/">net tuts+</a> and link for full tutorial is available <a href="http://net.tutsplus.com/tutorials/php/how-to-generate-a-complete-excel-spreadsheet-from-mysql/">here</a>.</p>
		
	</div> <!-- /container -->
	</div> <!-- /wrap -->
	<div id="footer">
	  <div class="container">
		<p class="muted credit">&copy; INSEAD eLab 2013</p>
	  </div>
	</div>

	<!-- Le javascript
	================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<script src="http://code.jquery.com/jquery-1.8.3.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
