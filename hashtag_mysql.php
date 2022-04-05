<?php

//Step1
 $db = mysqli_connect('localhost','root','','hashtag_api')
 or die('Error connecting to MySQL server.');
?>

<html>
 <head>
 </head>
 <body>
 <h1>PHP connecting to MySQL</h1>

<?php
   
$string = file_get_contents("./notification_tasks.json");
$json_a = json_decode($string, true);
// $m = 0;
// $qry = '';
foreach($json_a['result_data'] as $val) {
    $fields = '';
    $values = '';
    $k = 0;
    foreach($val as $key => $v) {
        $k++;
        if($k >= count($val)) {
            $fields .= "`".$key."` ";
            $values .= "'".$v."' ";
        }
        else {
            $fields .= "`".$key."`, ";
            $values .= "'".$v."', ";
        }
    }
    // if($m == 0) {
    //     $qry = "INSERT INTO `notification_tasks` (". $fields .") VALUES (" . $values . ")";
    // }
    // else {
    //     $qry .= ", (" . $values . ")";
    // }
    // $m++;
    $qry = "INSERT INTO `notification_tasks` (". $fields .") VALUES (" . $values . ")";
    mysqli_query($db, $qry) or die('Error insert querying database.' . $qry);
}
// if($qry != '') {
//     mysqli_query($db, $qry) or die('Error insert querying database.' . $qry);
// }


$query = "SELECT * FROM `notification_tasks`";
mysqli_query($db, $query) or die('Error querying database.');

//Step3
$result = mysqli_query($db, $query);

while ($row = mysqli_fetch_array($result)) {
    $rst = '';
    foreach($row as $kk => $vv) {
        if(!is_numeric($kk)) {
            $rst .= $kk . ":  " . $vv . "  ";
        }
    }
    echo $rst .'<br />';
}

// $string = file_get_contents("./hashtags.json");
// // $json_a = json_decode($string, true);
// $jsonIterator = new RecursiveIteratorIterator(
//     new RecursiveArrayIterator(json_decode($string, TRUE)),
//     RecursiveIteratorIterator::SELF_FIRST);

// foreach ($jsonIterator as $key => $val) {
//     if(is_array($val)) {
//         echo "$key:\n";
//     } else {
//         echo "$key => $val\n";
//     }
// }
//Step 4
mysqli_close($db);
?>

</body>
</html>