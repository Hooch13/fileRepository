<?PHP
include("loginCheck.php");
include("nav.php");
include("db_connect.php");
// end session login
?>
<?php
$pSubjectQuery = "SELECT * FROM Primary_Subjects ORDER BY Subject ASC";
$results = $dbc->query($pSubjectQuery);
echo $pSubjectQuery;
while($row = $results->fetch_array())
{
    //echo "<tr>";
    // echo "<td class='rowID'>". $row["app_id"] . "</td>";
    echo "<br>". $row["Subject"] .  "</br>";
    //echo "<td>". $row["CompletedDate"] . "</td>";
    //echo "<td> <a style='text-decoration: none; color: red;' href='mailto:". $row["EMail1"] . "'/a>". $row["EMail1"]."</td>";
    //echo "<td style='border-bottom: none;'><a class ='viewButton' href='app.php?record=". $row["app_id"] . "' target='viewer'>View</a></td>";
    //echo "</tr>";
}
?>


