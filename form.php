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
  <script src="script.js"></script>
  <meta charset = "utf-8">
  <title>My Form</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <header>
    <h1>Form</h1>
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
    <form action="calendar.php"
    name="myForm" onsubmit="return validateForm()" method="post">
    Event Name:<br>
    <input type="text" name="eventname">
    <br><br>
    Start Time:<br>
    <input type="time" name="starttime">
    <br><br>
    End Time:<br>
    <input type="time" name="endtime">
    <br><br>
    Location:<br>
    <input type="text" name="location">
    <br><br>
    Day of Week:<br>
    <select name="day">
      <option value="Mon">Monday</option>
      <option value="Tue">Tuesday</option>
      <option value="Wed">Wednesday</option>
      <option value="Thu">Thursday</option>
      <option value="Fri">Friday</option>
    </select>
    <br><br>
    <input type="submit" value="Submit">
    <br>
    <h3><a href="?delete=1">Clear</a></h3>

<?php
    if(isset($_GET['delete']))
    {
        file_put_contents("calendar.txt", "");
    }
?>
  </form>
</article>
<footer>
  <h5>Tested in Chrome and FireFox</h5>
</footer>
</body>
</html>
