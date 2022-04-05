<?php

//Step1
 $db = mysqli_connect('localhost','root','','gta')
 or die('Error connecting to MySQL server.');
?>

<html>
 <head>
 </head>
 <body>
 <h1>PHP connecting to MySQL</h1>

<?php
$date = '2007-01-01';
$end_date = '2030-12-31';

$dateentry = array();
$id = 1; // required by your MySQL insert statement

// populate $dateentry array with dates
while (strtotime($date) <= strtotime($end_date)) {
    $dateentry[] =  date("Y-m-d", strtotime($date));
    $date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));
} // end while

// loop through $dateentry and insert each date into database
foreach($dateentry as $entry) {
    $qry = "INSERT INTO gta_base_dates 
    (date_values)  VALUES('{$entry}')";
    mysqli_query($db, $qry)
        or die('Error querying database.');
} 

 mysqli_close($db);
?>

</body>
</html>