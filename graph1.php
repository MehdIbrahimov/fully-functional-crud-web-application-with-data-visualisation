<?php
include("pdo.inc.php");
require_once ('../jpgraph/jpgraph/src/jpgraph.php');
require_once ('../jpgraph/jpgraph/src/jpgraph_line.php');
//Graph 1

$dataX = array();
$dataY = array();
$stmt = $pdo->query("SELECT date,temp FROM mehd1brahimov_weather.weather_all");
$c=0;
while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
  $dataX[$c] = $row['date'];
  $dataY[$c] = intval($row['temp']);
  $c=$c+1;
}
sort($dataX);
// Setup the graph
$n = count($dataX);
$xmin = $dataX[0];
$xmax = $dataX[$n-1];
$graph = new Graph(500,400);
$graph->SetScale("linlin");
$theme_class=new UniversalTheme;
$graph->SetTheme($theme_class);
$graph->img->SetAntiAliasing(false);
$graph->title->Set('Temperature');
$graph->SetBox(false);
$graph->SetMargin(60,70,50,70);
$graph->img->SetAntiAliasing();
$graph->yaxis->HideZeroLabel();
$graph->yaxis->HideLine(false);
$graph->yaxis->HideTicks(false,false);
$graph->xaxis->SetLabelAngle(50);
$graph->xgrid->Show();
$graph->xaxis->SetFont(FF_ARIAL,FS_NORMAL,7.5);
$graph->xgrid->SetLineStyle("solid");
$graph->xaxis->SetTickLabels($dataX);
$graph->xgrid->SetColor('#E3E3E3');
// Create the first line
$p1 = new LinePlot($dataY);
$graph->Add($p1);
$p1->SetColor("#6495ED");
$p1->SetLegend(false);
$graph->legend->SetFrameWeight(1);

// Output line
#$fileName = "/tmp/imagefile.png";
#$graph->img->Stream($fileName);
#print '<img src="'.$filename.'" />';
$graph->Stroke();


?>
