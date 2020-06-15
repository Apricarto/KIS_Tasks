<?php
DEFINE("ARRIVAL",1);
DEFINE("DEPARTURE",0);
$input = fopen("input.txt",'r');
$output = fopen("output.txt", 'w');
$format = 'd.m.Y_H:i:sT';
$flights = fgets($input);

for($i=0; $i<$flights; $i++){
    $currentFlight = fgets($input);
    $flightTime = [];
    $info = explode(" ", $currentFlight);
    for($j=0;$j<count($info);$j=$j+2) {
        $date = DateTime::createFromFormat($format,
                                     $info[$j] . parseToRightForm($info[$j+1]),
                                            new DateTimeZone('UTC'));
        array_push($flightTime, $date->format("U"));
    }
    fwrite($output,$flightTime[ARRIVAL]-$flightTime[DEPARTURE]."\n");
}

fclose($input);
fclose($output);

echo "Сохранено в output.txt";

function parseToRightForm($timezone){
    if ($timezone>=0){
        return "+".(int)$timezone;
    }
    else
        return (int)$timezone;
}