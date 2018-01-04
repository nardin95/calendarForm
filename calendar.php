<!DOCTYPE html>
<?php
session_start();
ob_start();
if (!isset($_SESSION['username'])) {
  header('Location: login.php');
}
?>
<html>
<head>
  <meta charset = "utf-8">
  <title>My Schedule</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <script src="script.js"></script>
</head>
<body onload="loadData();">
  <div class="container">
    <header>
      <h1>Calendar</h1>
    </header>
    <nav>
      <ul>
        <li><a href="./calendar.php">Calendar</a></li>
        <li><a href="./form.php">Form</a></li>
        <li><a href="./logout.php">Logout</a></li>
      </ul>
    </nav>
    <article>
        <?php echo "Hello ".$_SESSION['username']."\n\n"; ?>
      <table id="table">
        <?php
        if(isset($_POST['eventname'])) {
          $data = '{'.
            '"eventname":"'.$_POST["eventname"].'",'.
            '"starttime":"'.$_POST["starttime"].'",'.
            '"endtime":"'.$_POST["endtime"].'",'.
            '"location":"'.$_POST["location"].'",'.
            '"day":"'.$_POST["day"].'"'.
            '}'."\n";
            $ret = file_put_contents('calendar.txt', $data, FILE_APPEND | LOCK_EX);
            if($ret === false) {
              die('There was an error writing this file');
            }
          }
          $firstRun = true;
          if(file_exists("calendar.txt")) {
            $firstRun = false;
          }
          $string = file_get_contents("calendar.txt");
          $lines = explode("\n", $string); //break up file into each entry
          $mondays = array();
          $tuesdays = array();
          $wednesdays = array();
          $thursdays = array();
          $fridays = array();

          foreach ($lines as $line) {
            $json = json_decode($line, true);
            if($json['day']=='Mon') {
              $mondays[] = $line; //this appends
            } else if($json['day']=='Tue') {
              $tuesdays[] = $line;
            } else if($json['day']=='Wed') {
              $wednesdays[] = $line;
            } else if($json['day']=='Thu') {
              $thursdays[] = $line;
            } else if($json['day']=='Fri'){
              $fridays[] = $line;
            }
          } //day arrays contain all entries in calendar.txt
          if($firstRun) {
            echo '<br><center><strong>No events yet,
              please use the Form page to enter events.</strong></center><br>';
          }
          echo '<tr><td><span class="dayOfWeek">Mon</span></td>';

          foreach ($mondays as $monday) {
            $json = json_decode($monday, true);
            echo '<td><span class="timeOfDay">'.$json['starttime'].' - '.$json['endtime'].
            '</span><br>'.$json['eventname'].'<br>'.$json['location'].'</td>';
          }

          echo '<tr><td><span class="dayOfWeek">Tue</span></td>';
          foreach ($tuesdays as $tuesday) {
            $json = json_decode($tuesday, true);
            echo '<td><span class="timeOfDay">'.$json['starttime'].' - '.$json['endtime'].
            '</span><br>'.$json['eventname'].'<br>'.$json['location'].'</td>';
          }

          echo '<tr><td><span class="dayOfWeek">Wed</span></td>';
          foreach ($wednesdays as $wednesday) {
            $json = json_decode($wednesday, true);
            echo '<td><span class="timeOfDay">'.$json['starttime'].' - '.$json['endtime'].
            '</span><br>'.$json['eventname'].'<br>'.$json['location'].'</td>';
          }

          echo '<tr><td><span class="dayOfWeek">Thu</span></td>';
          foreach ($thursdays as $thursday) {
            $json = json_decode($thursday, true);
            echo '<td><span class="timeOfDay">'.$json['starttime'].' - '.$json['endtime'].
            '</span><br>'.$json['eventname'].'<br>'.$json['location'].'</td>';
          }

          echo '<tr><td><span class="dayOfWeek">Fri</span></td>';
          foreach ($fridays as $friday) {
            $json = json_decode($friday, true);
            echo '<td><span class="timeOfDay">'.$json['starttime'].' - '.$json['endtime'].
            '</span><br>'.$json['eventname'].'<br>'.$json['location'].'</td>';
          }

          ?>

        </table>
        <br/> <br/>

      </article>
    </div>
    <footer>
      <h5>Tested in Chrome and FireFox</h5>
    </footer>
  </body>
  </html>
