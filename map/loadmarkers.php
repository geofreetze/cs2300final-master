<?php
function connect()
{
    //Nik testing - change
    $mysqli = new mysqli('localhost', 'admin', 'password', 'cs2300');

    return $mysqli;
}

//From https://developers.google.com/maps/documentation/javascript/mysql-to-maps#getting-started
//Copy-Paste
function parseToXML($htmlStr)
{
    $xmlStr=str_replace('<','&lt;',$htmlStr);
    $xmlStr=str_replace('>','&gt;',$xmlStr);
    $xmlStr=str_replace('"','&quot;',$xmlStr);
    $xmlStr=str_replace("'",'&#39;',$xmlStr);
    $xmlStr=str_replace("&",'&amp;',$xmlStr);
    return $xmlStr;
}


// Start XML file, create parent node

$mysqli = connect();

// Select all the rows in the markers table
$query = "SELECT * FROM markers WHERE 1";

$result = $mysqli->query($query);

if (!$result) {
    die('Invalid query: ' . $mysqli->error);
}

//Create a temporary XML sheet
header("Content-type: text/xml");

echo '<markers>';

// Iterate through the rows, adding XML nodes for each
while ($row = $result->fetch_assoc()) {
    // ADD TO XML DOCUMENT NODE
    echo '<marker ';
    echo 'id="' . $row['id'] . '" ';
    echo 'name="' . parseToXML($row['name']) . '" ';
    echo 'address="' . parseToXML($row['address']) . '" ';
    echo 'lat="' . $row['lat'] . '" ';
    echo 'lng="' . $row['lng'] . '" ';
    echo 'type="' . $row['type'] . '" ';
    echo '/>';
}

echo '</markers>';

?>