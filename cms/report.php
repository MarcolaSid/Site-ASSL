<?php

	// Configurations
	$initial_year = 2009; // sets the first year to show on select options
	$ga_email = 'your_email@gmail.com'; // email with a google analytics account
	$ga_password = 'your_password';
	
	require_once("gapi.class.php");	
	
	// Authentication
	$ga = new gapi($ga_email, $ga_password);

	// Defines report period
	$month = isset($_POST['month']) ? $_POST['month'] : date("m", mktime()); //actual month
	$year = isset($_POST['year']) ? $_POST['year'] : date("Y", mktime()); // actual year
	
	$begin = $year.'-'.$month.'-01';
	$end = $year.'-'.$month.'-'.date("t", mktime(0, 0, 0, $month, 1, $year));

	if (isset($_POST['id'])) {
		// Gets total visits and pageviews
		$ga->requestReportData($_POST['id'], 'month', array('pageviews', 'visits'), null, null, $begin, $end);
		foreach ($ga->getResults() as $data) {
			$total_visits = $data->getVisits();
			$total_pageviews = $data->getPageviews();
		}

		// Gets selected month's visits and pageviews day by day
		$ga->requestReportData($_POST['id'], 'day', array('pageviews', 'visits'), 'day', null, $begin, $end, 1, 50);
		foreach ($ga->getResults() as $data) {
			// creating Flot data
			$d1 .= '['.$data.','.$data->getPageviews().'],';
			$d2 .= '['.$data.','.$data->getVisits().'],';
		}
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Analytics Report</title>
	<!--[if IE]><script language="javascript" type="text/javascript" src="flot/excanvas.min.js"></script><![endif]-->
	<script language="javascript" type="text/javascript" src="flot/jquery.js"></script>
	<script language="javascript" type="text/javascript" src="flot/jquery.flot.js"></script>
	<style>
		body {
			background:#EEE;
			font-family:sans-serif;
			font-size:12px;
			color: #666666;
		}
	</style>
</head>

<body>
	<form method="post">
		Statistics 
		<select name="id">
			<?php
				// Gets accounts listing
				$ga->requestAccountData();
				foreach($ga->getResults() as $result) {
					$selected = ($_POST['id'] == $result->getProfileId()) ? 'SELECTED' : '';
					echo '<option value="' . $result->getProfileId() . '" ' . $selected . '>' . $result . '</option>';
				}
			?>
		</select>
		<select name="month">
			<option value="01" <?php if ($month == "01") echo " SELECTED"; ?> >01</option>
			<option value="02" <?php if ($month == "02") echo " SELECTED"; ?> >02</option>
			<option value="03" <?php if ($month == "03") echo " SELECTED"; ?> >03</option>
			<option value="04" <?php if ($month == "04") echo " SELECTED"; ?> >04</option>
			<option value="05" <?php if ($month == "05") echo " SELECTED"; ?> >05</option>
			<option value="06" <?php if ($month == "06") echo " SELECTED"; ?> >06</option>
			<option value="07" <?php if ($month == "07") echo " SELECTED"; ?> >07</option>
			<option value="08" <?php if ($month == "08") echo " SELECTED"; ?> >08</option>
			<option value="09" <?php if ($month == "09") echo " SELECTED"; ?> >09</option>
			<option value="10" <?php if ($month == "10") echo " SELECTED"; ?> >10</option>
			<option value="11" <?php if ($month == "11") echo " SELECTED"; ?> >11</option>
			<option value="12" <?php if ($month == "12") echo " SELECTED"; ?> >12</option>
		</select>
		<select name="year">
			<?php
				// Shows years from $initial_year to actual
				for ($i=$initial_year; $i<=date("Y", mktime()); $i++) {
					$selected = ($i == $year) ? 'SELECTED' : '';
					echo '<option value="'.$i.'"'.  $selected  .'>'.$i.'</option>';
				}
			?>
		</select>
		<input type="submit" value="ok">
	</form>

	<?php if (isset($_POST['id'])) { ?>
	
		<div id="placeholder" style="width:800px;height:300px"></div>
		
		<script id="source" language="javascript" type="text/javascript">
			$(function () {
				
				var d1 = [<?php echo $d1; ?>];
				var d2 = [<?php echo $d2; ?>];
									
				$.plot($("#placeholder"), 
					[
						{
							data: d1,
							lines: { show: true, fill: true },
							points: { show: true, radius: 3 },
							label: "Pageviews (<?php echo $total_pageviews; ?>)"
						},
						{
							data: d2,
							lines: { show: true, fill: true },
							points: { show: true },
							label: "Visits (<?php echo $total_visits; ?>)"
						}
					], 
					{
						xaxis: {
							ticks: 27
						},
						grid: {
							backgroundColor: { colors: ["#999", "#BBB"] }
						}
					}
				);
			});
		</script>
	<?php } ?>
 </body>
</html>
