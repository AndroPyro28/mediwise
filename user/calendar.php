<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="" content="" />
  <meta name="keywords" content="calendar, events, reminders, javascript, html, css, " />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
    integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="calendar.css" />
  <title>Calendar</title>
</head>

<body style="display: flex; flex-direction: column;">

  <div class="container">
    <a href="home.php" style="color: white; margin: 5px; text-decoration:none;">Back</a>
    <div class="left">
      <div class="calendar">
        <div class="month">
          <i class="fas fa-angle-left prev"></i>
          <div class="date">December 2015</div>
          <i class="fas fa-angle-right next"></i>
        </div>
        <div class="weekdays">
          <div>Sun</div>
          <div>Mon</div>
          <div>Tue</div>
          <div>Wed</div>
          <div>Thu</div>
          <div>Fri</div>
          <div>Sat</div>
        </div>
        <div class="days"></div>
        <div class="goto-today">
          <div class="goto">
            <input type="text" placeholder="mm/yyyy" class="date-input" />
            <button class="goto-btn">Go</button>
          </div>
          <button class="today-btn">Today</button>
        </div>
      </div>
    </div>
    <div class="right">
      <div class="today-date">
        <div class="event-day">wed</div>
        <div class="event-date">12th december 2022</div>
      </div>
      <div class="events "></div>
      <div class="add-event-wrapper">
        <div class="add-event-header">
          <div class="title">Create Appointment</div>
          <i class="fas fa-times close"></i>
        </div>
        <div class="add-event-body">
          <div class="add-event-input">
            <input type="text" placeholder="title or description" class="event-name" />

          </div>
          <div class="add-event-input">
            <input type="text" placeholder="Name of Doctor" class="doctor-name" />
          </div>
          <div class="add-event-input">
            <input type="text" placeholder="Time" class="event-time-from" />
          </div>
        </div>
        <div class="add-event-footer">
          <button class="add-event-btn">Add Event</button>
        </div>
      </div>
    </div>
    <button class="add-event">
      <i class="fas fa-plus"></i>
    </button>
  </div>



  <script src="calendar.js"></script>
  <script src="auth.js"></script>


  <script>
  </script>

</body>

</html>