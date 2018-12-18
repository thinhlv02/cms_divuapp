<?php
/**
 * Created by PhpStorm.
 * User: conga1411
 * Date: 7/21/2018
 * Time: 9:02 AM
 */
if (isset($message)) {
    $this->load->view('admin/message', $this->data);
}
//starttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttt

$username = "root";
$password = "";
$database = "divuapp";
// Start XML file, create parent node

$dom = new DOMDocument("1.0");
$node = $dom->createElement("markers");
$parnode = $dom->appendChild($node);

// Opens a connection to a MySQL server

$connection = mysqli_connect('localhost', $username, $password);
if (!$connection) {
    die('Not connected : ' . mysql_error());
}

// Set the active MySQL database

$db_selected = mysqli_select_db($connection, $database);
if (!$db_selected) {
    die ('Can\'t use db : ' . mysql_error());
}

// Select all the rows in the markers table

$query = "SELECT * FROM `divuapp`.`markers`  WHERE 1";
$result2 = mysqli_query($connection, $query) or die('error dcm');
if (!$result2) {
    die('Invalid query: ' . mysql_error());
}
//echo 'sl -----'. mysqli_num_rows($result2);
//die();

//header("Content-type: text/xml", '', '');
header("Content-type: text/xml");
//header("Content-type: text/php");
//header("Content-Type: text/html;charset=ISO-8859-1");

//die();

// Iterate through the rows, adding XML nodes for each

while ($row = @mysqli_fetch_assoc($result2)) {
//    echo $row['id'] . '-' . $row['name'] . '<br>';
    // Add to XML document node
    $node = $dom->createElement("marker");
    $newnode = $parnode->appendChild($node);
    $newnode->setAttribute("id", $row['id']);
    $newnode->setAttribute("name", $row['name']);
    $newnode->setAttribute("address", $row['address']);
    $newnode->setAttribute("lat", $row['lat']);
    $newnode->setAttribute("lng", $row['lng']);
    $newnode->setAttribute("type", $row['type']);
}
echo $dom->saveXML();