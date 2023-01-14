<?
// Rijksdriehoek to GPS. based on https://www.roelvanlisdonk.nl/2012/11/21/simple-way-for-converting-rijksdriehoek-coordinates-to-lat-and-long-wgs84-in-c/ 
function rd2gps($x,$y){
    $result = [];

    // The city "Amsterfoort" is used as reference "Rijksdriehoek" coordinate.
    $referenceRdX = 155000.;
    $referenceRdY = 463000.;

    $dX = ($x - $referenceRdX) * pow(10,-5);
    $dY = ($y - $referenceRdY) * pow(10,-5);

    $sumN = 
        (3235.65389 * $dY) + 
        (-32.58297 * pow($dX, 2)) + 
        (-0.2475 * pow($dY, 2)) + 
        (-0.84978 * pow($dX, 2) * $dY) + 
        (-0.0655 * pow($dY, 3)) + 
        (-0.01709 * pow($dX, 2) * pow($dY, 2)) + 
        (-0.00738 * $dX) + 
        (0.0053 * pow($dX, 4)) + 
        (-0.00039 * pow($dX, 2) * pow($dY, 3)) + 
        (0.00033 * pow($dX, 4) * $dY) + 
        (-0.00012 * $dX * $dY);
    $sumE = 
        (5260.52916 * $dX) + 
        (105.94684 * $dX * $dY) + 
        (2.45656 * $dX * pow($dY, 2)) + 
        (-0.81885 * pow($dX, 3)) + 
        (0.05594 * $dX * pow($dY, 3)) + 
        (-0.05607 * pow($dX, 3) * $dY) + 
        (0.01199 * $dY) + 
        (-0.00256 * pow($dX, 3) * pow($dY, 2)) + 
        (0.00128 * $dX * pow($dY, 4)) + 
        (0.00022 * pow($dY, 2)) + 
        (-0.00022 * pow($dX, 2)) + 
        (0.00026 * pow($dX, 5));

    // The city "Amsterfoort" is used as reference "WGS84" coordinate.
    $referenceWgs84X = 52.15517;
    $referenceWgs84Y = 5.387206;

    $latitude = $referenceWgs84X + ($sumN / 3600);
    $longitude = $referenceWgs84Y + ($sumE / 3600);
    
    return [$latitude, $longitude];
}
?>
