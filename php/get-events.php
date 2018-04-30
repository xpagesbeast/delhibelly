<?php
//echo '<br />started.';
//--------------------------------------------------------------------------------------------------
// This script reads event data from a JSON file and outputs those events which are within the range
// supplied by the "start" and "end" GET parameters.
//
// An optional "timezone" GET parameter will force all ISO8601 date stings to a given timezone.
//
// Requires PHP 5.2.0 or higher.
//--------------------------------------------------------------------------------------------------

// Require our Event class and datetime utilities
//require dirname(__FILE__) . 'utils.php';
require_once 'utils.php';
//echo '<br />utils.php loaded';

if (!isset($_GET['start']) || !isset($_GET['end'])) {
   // echo '<br />trying to set first and last day of this month.';
    $range_start = new DateTime('first day of this month');
    $range_end = new DateTime('last day of this month');
}else{
    // Parse the start/end parameters.
// These are assumed to be ISO8601 strings with no time nor timezone, like "2013-12-29".
// Since no timezone will be present, they will parsed as UTC.
   // echo '<br />getting first and last day of this month from GET params';
    $range_start = parseDateTime($_GET['start']);
    $range_end = parseDateTime($_GET['end']);
}

//echo '<br /> working with this date range ' . $range_start->format('Y-m-d H:i:s') . " to " . $range_end->format('Y-m-d H:i:s');
/*
// Short-circuit if the client did not give us a date range.
if (!isset($_GET['start']) || !isset($_GET['end'])) {
 // echo '<br />die no date range.';
    die("Please provide a date range.");
}
//echo '<br />did not die';
*/
//echo '<br /> getting time zone';
// Parse the timezone parameter if it is present.
$timezone = null;
if (isset($_GET['timezone'])) {
   // echo '<br /> getting time zone from get params.';
  $timezone = new DateTimeZone($_GET['timezone']);
}

// Read and parse our events JSON file into an array of event data arrays.
//$json = file_get_contents(dirname(__FILE__) . '/../json/events.json');

/* Get from database */



  //  echo "<br /> building events from data from mysql";
    if (!empty($myreservations_array)) {
      //  echo '<br /> we have data in from database.';
        foreach ($myreservations_array as $key => $value) {
            //echo '<br />'.$myreservations_array[$key]["DATE"];
            //echo '<br />'.$myreservations_array[$key]["START_TIME"];
            //echo '<br />'.$myreservations_array[$key]["PURPOSE"];

            // Convert the input array into a useful Event object
            $event = new Event($array, $timezone);
            $event->id = $myreservations_array[$key]["ID"];

            $event->start = parseDateTime($myreservations_array[$key]["DATE"]." ".$myreservations_array[$key]['START_TIME']);
            $event->time = $myreservations_array[$key]['START_TIME'];

            $event->end =  parseDateTime($myreservations_array[$key]["DATE"]);
            $event->title = $myreservations_array[$key]['PURPOSE'];

        //    echo '<br /> Event dates from databse ' . $event->start->format('Y-m-d H:i:s') . " " . $event->end->format('Y-m-d H:i:s');

            $event->user_id = $myreservations_array[$key]['USER_ID'];
            $event->guests = $myreservations_array[$key]['GUESTS'];

         //   echo '<br /> determine if event needs to be included.';
            try{
         //       echo '<br /> working with this date range ' . $range_start->format('Y-m-d H:i:s') . " to " . $range_end->format('Y-m-d H:i:s');
            // If the event is in-bounds, add it to the output
            if ($event->isWithinDayRange($range_start, $range_end)) {
         //       echo '<br /> include the event';
                $output_arrays[] = $event->toArray();
            }
            }catch(Exception $e){
          //      echo ' TRY CATCH ' . $e->getMessage();
            }


        //    echo '<br / fetch next record.';
        }
    }else{
     //   echo "no data using query " . $queryReservations;
    }




/*
$db_handle = new DBController();
//$reservations = $db_handle->runQuery("SELECT * FROM reservation");

$stmt = $db_handle->getPDOHandle()->prepare("SELECT * FROM reservations LEFT OUTER JOIN users on reservations.USER_ID = users.user_id");
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();

while($record = $stmt->fetch()) {
    print_r($record);
    echo $record['ID'].'<br />';
    echo $record['username'];

    // Convert the input array into a useful Event object
    $event = new Event($array, $timezone);
    $event->id = $record['ID'];

    $event->start = $record['DATE'];
    $event->time = $record['START_TIME'];
    $event->user_id = $record['USER_ID'];
    $event->guests = $record['GUESTS'];
    

    // If the event is in-bounds, add it to the output
    if ($event->isWithinDayRange($range_start, $range_end)) {
        $output_arrays[] = $event->toArray();
    }


}
*/


//$db_handle->close();

/*
$input_arrays = json_decode($json, true);

// Accumulate an output array of event data arrays.
$output_arrays = array();
foreach ($input_arrays as $array) {

  // Convert the input array into a useful Event object
  $event = new Event($array, $timezone);

  // If the event is in-bounds, add it to the output
  if ($event->isWithinDayRange($range_start, $range_end)) {
    $output_arrays[] = $event->toArray();
  }
}
*/
// Send JSON to the client.
//echo "<br /> outputting the json arrays.";
$calEvents = json_encode($output_arrays);