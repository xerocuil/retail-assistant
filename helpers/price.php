<?php
if ($cresults == "Appliances"){
	$multiplier = 1.3;
} elseif ($cresults == "Ashley"){
	$multiplier = 2.2;
} elseif ($cresults == "Closeout"){
	$multiplier = 1.5;
} elseif ($cresults == "Crossroads"){
	$multiplier = 2.8;
} elseif ($cresults == "Default"){
	$multiplier = 1.8;
} elseif ($cresults == "England"){
	$multiplier = 1.8;
} elseif ($cresults == "Flexsteel"){
	$multiplier = 2.2;
} elseif ($cresults == "Hot Buy") {
	$multiplier = 1.75;
} elseif ($cresults == "Klaussner"){
	$multiplier = 2.5;
} elseif ($cresults == "Other"){
	$multiplier = 2.5;
} elseif ($cresults == "Smith Bros") {
	$multiplier = 2.2;
} elseif ($cresults == "So. Motion"){
	$multiplier = 1.8;
} elseif ($cresults == "Sealy"){
	$multiplier = 2.0;
} elseif ($cresults == "White Dove"){
	$multiplier = 2.5;
} elseif ($cresults == "Winesburg"){
	$multiplier = 2.3;
} elseif ($cresults == "Not in Inventory"){
	$multiplier = 1.0;
} else {
	$multiplier = 2.5;
}

$markup=ceil($multiplier*(($cost)/10))*10;
$penny=0.01;
if ($markup < 1){
	$price = "n/a";
} else {
	$price=$markup-$penny;
}
?>