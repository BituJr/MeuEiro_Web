<?php

session_start();

include('db.php');

include('Functions.php');

include ('notification.php');

$UserId=$_SESSION['UserId'];
$GetUserInfo = "SELECT * FROM user WHERE UserId = $UserId";
$UserInfo = mysqli_query($mysqli, $GetUserInfo);
$ColUser = mysqli_fetch_assoc($UserInfo);

$query 				   = "select * from assets where UserId = $UserId ";
$assetstocalender      = mysqli_query($mysqli, $query);
$events = array();
$sum = 0;
while ($row = mysqli_fetch_assoc($assetstocalender)) {
    $start = $row['Date'];
    $end   = $row['Date'];
    $amount = $ColUser['Currency'].' '.number_format($row['Amount']);
    $title = $row['Title'];
    $sum+= $row['Amount'];
    
    $eventsArray['title'] = $title;
    $eventsArray['start'] = $start;
    $eventsArray['end'] = $end;
    $eventsArray['names'] = $amount;
    $events[] = $eventsArray;
}
$eventsArray['sum'] = $sum;
echo json_encode($events);	

?>
