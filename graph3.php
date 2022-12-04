<?php
include("pdo.inc.php");
require_once ('../jpgraph/jpgraph/src/jpgraph.php');
require_once ('../jpgraph/jpgraph/src/jpgraph_bar.php');



$winteravg = 0;
$springavg = 0;
$summeravg = 0;
$autumnavg = 0;
$w = 0; $sp = 0; $su = 0; $au = 0;
$stmt = $pdo->query("SELECT date,temp FROM mehd1brahimov_weather.weather_all");
while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
  $datadate = explode("-",$row['date']);
  if($datadate[1] == '12' || $datadate[1] == '01' || $datadate[1] == '02'){
    $winteravg += $row['temp'];
    $w +=1;
  }
  if($datadate[1] == '03' || $datadate[1] == '04' || $datadate[1] == '05'){
    $springavg += $row['temp'];
    $sp +=1;
  }
  if($datadate[1] == '06' || $datadate[1] == '07' || $datadate[1] == '08'){
    $summeravg += $row['temp'];
    $su +=1;
  }
  if($datadate[1] == '09' || $datadate[1] == '10' || $datadate[1] == '11'){
    $autumnavg += $row['temp'];
    $au +=1;
  }
}

$winteravg = $winteravg / $w;
$springavg = $springavg / $sp;
$summeravg = $summeravg / $su;
$autumnavg = $autumnavg / $au;
$datay=array($winteravg,$springavg,$summeravg,$autumnavg);
// Create the graph. These two calls are always required
$graph = new Graph(500,400,'auto');
$graph->SetScale("textlin");

$theme_class=new UniversalTheme;
$graph->SetTheme($theme_class);

$graph->Set90AndMargin(70,40,40,40);
$graph->img->SetAngle(90);

// set major and minor tick positions manually
$graph->SetBox(false);

//$graph->ygrid->SetColor('gray');
$graph->ygrid->Show(false);
$graph->ygrid->SetFill(false);
$graph->xaxis->SetTickLabels(array('Winter','Spring','Summer','Autumn'));
$graph->yaxis->HideLine(false);
$graph->yaxis->HideTicks(false,false);

// For background to be gradient, setfill is needed first.
$graph->SetBackgroundGradient('#f54707','#2193cc', GRAD_HOR, BGRAD_PLOT);

// Create the bar plots
$b1plot = new BarPlot($datay);

// ...and add it to the graPH
$graph->Add($b1plot);
$graph->title->Set("Average Temperature");
$b1plot->SetWeight(0);
$b1plot->SetFillGradient("#808000","#90EE90",GRAD_HOR);
$b1plot->SetWidth(17);

// Display the graph
$graph->Stroke();
?>
