<?php
include("pdo.inc.php");
require_once ('../jpgraph/jpgraph/src/jpgraph.php');
require_once ('../jpgraph/jpgraph/src/jpgraph_bar.php');
$dataSu = 0;
$dataSn = 0;
$dataW = 0;
$dataR = 0;
$dataC = 0;
$stmt = $pdo->query("SELECT condit FROM mehd1brahimov_weather.weather_all");
while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
  if($row['condit'] == 'Sunny'){
    $dataSu += 1;
  }
  if($row['condit'] == 'Snowy'){
    $dataSn += 1;
  }
  if($row['condit'] == 'Windy'){
    $dataW += 1;
  }
  if($row['condit'] == 'Rainy'){
    $dataR += 1;
  }
  if($row['condit'] == 'Cloudy'){
    $dataC += 1;
  }
}
$datay=array($dataSu,$dataSn,$dataW,$dataR,$dataC);


// Create the graph. These two calls are always required
$graph = new Graph(500,400,'auto');
$graph->SetScale("textlin");

//$theme_class="DefaultTheme";
//$graph->SetTheme(new $theme_class());

// set major and minor tick positions manually
$graph->yaxis->SetTickPositions(array(1,5,10,max($dataSu,$dataSn,$dataW,$dataR,$dataC)));
$graph->SetBox(false);

//$graph->ygrid->SetColor('gray');
$graph->ygrid->SetFill(false);
$graph->xaxis->SetTickLabels(array('Sunny','Snowy','Windy','Rainy','Cloudy'));
$graph->yaxis->HideLine(false);
$graph->yaxis->HideTicks(false,false);

// Create the bar plots
$b1plot = new BarPlot($datay);

// ...and add it to the graPH
$graph->Add($b1plot);


$b1plot->SetColor("yellow ");
$b1plot->SetFillGradient("#96701e","yellow",GRAD_LEFT_REFLECTION);
$b1plot->SetWidth(45);
$graph->title->Set("Condition");

// Display the graph
$graph->Stroke();
?>
