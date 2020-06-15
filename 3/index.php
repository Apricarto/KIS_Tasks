<?php
$input = fopen("input.txt",'r');
$positionsNumber = fgets($input);
$positionsArray = [];
for($i=0;$i<$positionsNumber;$i++){
    $positionsArray[fgets($input)] = 0;
}
$notesNumber = fgets($input);
for($i = 0;$i<$notesNumber;$i++){
    $delimiterArray = explode(" ",fgets($input));
    foreach ($positionsArray as $k => $v){
        if (strcmp($delimiterArray[1],$k) == 0){
            $positionsArray[$k]++;
        }
    }
}
fclose($input);
arsort($positionsArray);
foreach ($positionsArray as $k=>$v){
    $partOfTriangle[$k] = $v/($notesNumber-1);
}
$width = 800;
$height = 800;
$img = ImageCreate( $width, $height );

$white = ImageColorAllocate( $img, 255, 255, 255 );
$fakeWhite = ImageColorAllocate( $img, 255, 255, 250 );
$black = ImageColorAllocate( $img, 0, 0, 0 );

ImageRectAngle( $img, 0, 0, $width - 1, $height - 1, $white);
ImageLine( $img, 0, 0, $width/2, $height-1, $black );
ImageLine( $img, $width-1, 0, $width/2, $height - 1, $black);
ImageLine( $img, 0, 0, 0, $height - 1, $black );
$counter = 0.0;
foreach ($partOfTriangle as $v) {
    $counter += $v;
    ImageLine($img, 0, $height * $counter, $width - 1, $height * $counter, $fakeWhite);
    ImageFill($img, 400, $height * $counter - 3, ImageColorAllocate($img, time() * $v, 155 * $v, 155 * $v));
}
header('Content-type: image/png' );
ImagePng( $img);
ImagePng( $img ,'output.png');