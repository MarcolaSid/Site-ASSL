<?php
setlocale(LC_ALL,"portuguese-brazil");
require('gapi.class.php');

/* Define variables */
//UA-42237223-2
$ga_email       = 'leoncioquinteiro@gmail.com';
$ga_password    = 'meu cavalo e doido';
$ga_profile_id  = '74219407';
$ga_url			= $_SERVER['REQUEST_URI'];

//phpinfo();
//var_dump($_SERVER);
//var_dump($_HTTP_SERVER_VARS);

/* Create a new Google Analytics request and pull the results */
$ga = new gapi($ga_email,$ga_password);
$ga->requestReportData($ga_profile_id, array('date'),array('pageviews', 'uniquePageviews', 'exitRate', 'avgTimeOnPage', 'entranceBounceRate', 'newVisits'), 'date');

$results = $ga->getResults();
?>   

<!-- Create an empty div that will be filled using the Google Charts API and the data pulled from Google -->
<div id="chart"></div>

<!-- Include the Google Charts API -->
<script type="text/javascript" src="https://www.google.com/jsapi"></script>

<!-- Create a new chart and plot the pageviews for each day -->
<script type="text/javascript">
  google.load("visualization", "1", {packages:["corechart"]});
  google.setOnLoadCallback(drawChart);
  function drawChart() {
    var data = new google.visualization.DataTable();

    <!-- //Create the data table -->
    data.addColumn('string', 'Dia');
    data.addColumn('number', 'Visualizações');

    <!-- //Fill the chart with the data pulled from Analtyics. Each row matches the order setup by the columns: day then pageviews -->
    data.addRows([
      <?php
      foreach($results as $result) {
		setlocale(LC_ALL,"portuguese-brazil");
          echo '["'.strftime(date('d M',strtotime($result->getDate()))).'", '.$result->getPageviews().'],';
      }
      ?>
    ]);

    var chart = new google.visualization.AreaChart(document.getElementById('chart'));
    chart.draw(data, {width: 682, height: 180, title: '<?php echo strftime(date('d M, Y',strtotime('-30 day'))).' - '.strftime(date('d M, Y')); ?>',
                      colors:['#058dc7','#e6f4fa'],
                      areaOpacity: 0.1,
                      hAxis: {textPosition: 'in', showTextEvery: 5, slantedText: false, textStyle: { color: '#058dc7', fontSize: 10 } },
                      pointSize: 5,
                      legend: 'none',
                      chartArea:{left:0,top:30,width:"100%",height:"100%"}
    });
  }
</script>

<?php
$ga->requestReportData($ga_profile_id, array('date'), array('pageviews', 'uniquePageviews', 'exitRate', 'avgTimeOnPage', 'entranceBounceRate', 'newVisits'), 'date');
$results = $ga->getResults();

function secondMinute($seconds) {
    $minResult = floor($seconds/60);
    if($minResult < 10){$minResult = 0 . $minResult;}
    $secResult = ($seconds/60 - $minResult)*60;
    if($secResult < 10){$secResult = 0 . round($secResult);}
    else { $secResult = round($secResult); }
    return $minResult.":".$secResult;
}
echo '<div id="page-analtyics">
	<br/>
	<strong>Taxa de rejeição:</strong> É porcentagem de visitas em que alguém sai do site na mesma página em que entrou.
	<br/><br/>
	<strong>Taxa de Saída:</strong> É o percentual de visitantes que saem de uma página, mas que já visitaram outras páginas.
	<br/><br/>';

$ga->requestReportData(
    $ga_profile_id,
    array('browser'),
    array('pageviews','visits'),
    array('-visits'), 
    null, 
    '2012-05-12',
    null,
    1,
    30
);
?>
 
<table>
<tr>
  <th><strong>Total de Visualizações:</strong></th>
  <td><?php echo number_format($ga->getPageviews()) ?>
</tr>
<tr>
  <th><strong>Total de Visitas Únicas:</strong></th>
  <td><?php echo number_format($ga->getVisits()) ?></td>
</tr>
<tr>
  <th><strong>Resultados Atualizados em:</strong></th>
  <td><?php echo $ga->getUpdated() ?></td>
</tr>
</table>
