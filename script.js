var d = new Date();
var dayOfWeek = d.getDay();
var table = document.getElementById("table");

function replaceImage(tableCell) {
  var imageToLoad = tableCell.closest('td').cellIndex;
  if(imageToLoad <=0 || imageToLoad >=4) {
    imageToLoad = "me";
  }
  document.getElementById('picture').innerHTML = '<img src="images/' + imageToLoad +
  '.jpg" alt="building">';
}

function loadData() {
  var table = document.getElementById("table");
  if(dayOfWeek == 0 || dayOfWeek == 6) {
    document.getElementById('dynamicDay').innerHTML = "<marquee>It's the weekend, go party!</marquee>";
  } else {
    var marqueeText = "";
      for (var j = 0; j < table.rows[dayOfWeek - 1].cells.length; j++) {
        marqueeText += table.rows[dayOfWeek - 1].cells[j].innerText + " | ";
      }
    document.getElementById('dynamicDay').innerHTML = "<marquee>" + marqueeText
    +"</marquee>";
  }

  for (var i = 0; i < table.rows.length; i++) {
    for (var j = 0; j < table.rows[i].cells.length; j++)
    table.rows[i].cells[j].onclick = function () {
      replaceImage(this);
    };
  }
}

function alertErrors(errors) {
  var msg = "Form validation errors!\n\n";
  for (var i = 0; i<errors.length; i++) {
    msg += errors[i] + "\n";
  }
  alert(msg);
}

function validateForm() {
  var regexAlphaNumeric = /^[A-Za-z0-9\s]+$/;
  var errors = [];
  var x = document.forms["myForm"]["eventname"].value;

  if (x == "") {
    errors[errors.length] = "Event name must be filled out!"
  }
  if (!regexAlphaNumeric.test(x)) {
    errors[errors.length] = "Event name must be alpha-numeric!";
  }

  x = document.forms["myForm"]["starttime"].value;
  if (x == "") {
    errors[errors.length] = "Start time must be filled out!";
  }

  x = document.forms["myForm"]["endtime"].value;
  if (x == "") {
    errors[errors.length] = "End time must be filled out!";
  }

  x = document.forms["myForm"]["location"].value;
  if (x == "") {
    errors[errors.length] = "Location must be filled out!";
  }

  if (!regexAlphaNumeric.test(x)) {
    errors[errors.length] = "Location must be alpha-numeric!";
  }

  x = document.forms["myForm"]["day"].value;
  if (x == "") {
    errors[errors.length] = "Day of week must be filled out!";
  }
  if(errors.length > 0) {
    alertErrors(errors);
    return false;
  } else {
    return true;
  }
}
