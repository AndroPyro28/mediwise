<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Forums</title>
  <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1"><link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css'>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'><link rel="stylesheet" href="./Forums.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
<link rel="stylesheet" href="123.css">

</head>
<body>
  <header class="header" id="header">
    <nav class="nav container">
        <a href="#" class="nav__logo">MediWise</a>

        <div class="nav__menu" id="nav-menu">
            <ul class="nav__list">
                <li class="nav__item">
                <a href="home.php" class="nav__link active-link">Home</a>

                </li>
                <li class="nav__item">
                    <a href="calendar.php" class="nav__link">Appointment</a>
                </li>
                <li class="nav__item">
                    <a href="forums.php" class="nav__link">Announcement</a>
                </li>
                <li class="nav__item">
                    <a href="doctor-list.php" class="nav__link">Doctors</a>
                </li>


                </div>
            </div>
        </div>
                <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAWVJREFUSEvN1TFIlVEYxvGfuBkOitBQWgYKQkN7DYKKQ4uiiM6ubSm1qYMICo7i3BIi4ioqCgnuDgoOhkKgBIJB0BBUfPF9d/juPfc7V7noOz/n+T/nPe85p0Gdq6HO/moBjOFTGmgCmzHhYgBNmMQ8mlPTH5jDKn5VAxUB+vEZbQGT7xjFQQhSDTCMdTRiAyvYS4368A5D+I232KkECQEe4wyP8B7LgYQzmMUVuvAzrwsBljCFNYwXHOYWBkNBQoALdOAVjgoAA9jGIV7H7uBvKkz6/6cA0Ipr3KClVkDRlGV+WaAyfcgguCCwm4cFeIbzNGmtLXqOZEBKlTd4ii/oxDFexrw3OEEPvuINLrN1ecApuisJC0BP0mAv8sHygOyw2vEtMn0mq9jaEKBG7zJ5yTcP2EfvHd13kdzu/xU7JbdmxgI+YiFH+YDFInIsINElL+xIapj8D9PIhiLIiQUUBb0/wD/3oz4ZE6fqJQAAAABJRU5ErkJggg=="/>
                
            </ul>
        </div>
        <div class="dropdown">
            <button class="dropbtn">
                <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAepJREFUSEu11UuoSFEUBuDvkphgIKG8ihCFgVAyQiEjjzEppZCipDBBjL1CKY+ZIlEiSYkMiJIByiMGSJJMGHi1tE9tu7Pvqau7Z/usf69/rb3+/Z8e/bx6+jm/LoJBWIllmI2JqaDXeITruIQftUJ7I1iME5jU0eUzbMTtNlyNYBf20dlhk/MntuNQSdJGsAd7+zibLTiany0JluBGH5PHsV+YjwdNjpxgAJ5gegvBF+zE5RRbjQMY2oK9i4VtBKGWi5Xq1+FsEdtUXkcWX4B7sc87uIBVFYKR+FTExuBdBX8YW0uCtxhXOTAKH4vYaLyv4B9iTknwDUMqB9bjdBEL7R+v4D9jREnwtTK0wMWQd6QhhxhiXgcxrEIQuYaXBM8x5T8kmh992qgxH/IZrG0hCG0/xn18SPG4/7mYheioXKewoexgOa4WyOhqBV5UOpuGa5kJNrBFuFUSxD4qnZlQvzEZrzqubSrC8JoVnc5rNqVVBPPNDHwe8ci+V0hCdeewJsXjOuMV/31kbR3Et3DS/VnCNziS/D+sZCBmJJ2HuY3NsJtxLC+mZte7k6N2/ZCaXGHX2xAv+J/VW4KlOInxHTMIIYRi7rThuiocnPwpFBbDn4AY/kuEHYSCriA6aF1dBB3Fd4f7neAPCe1UGWoE11UAAAAASUVORK5CYII="/>
            </button>
            <div class="dropdown-content">
                <a href="history.php">History</a>
                <a href="#">Settings</a>
                <a href="#" id="logoutBtn">Logout</a>
            </div>
        </div>
        

        <div class="nav__toggle" id="nav-toggle">
            <i class='bx bx-grid-alt'></i>
        </div>

    </nav>
</header>

<main>


<!-- partial:index.partial.html -->
<div class="page-event">
  <div class="cover">
    <div class="heading">Forums</div>
  </div>
  <div class="container">
    <div class="upcoming-sec">
      <div class="heading">Upcoming Events</div>
    </div>
    <div class="upcoming-event-list">
      <div class="event-block">
        <div class="row">
          <div class="col-lg-2 sec-1">
            <table>
              <tr>
                <td>
                  <div class="month">jan</div>
                  <div class="month-date-devider"></div>
                  <div class="date">27</div>
                </td>
                <td class="title">Barangay Medical Mission</td>
              </tr>
            </table>
          </div>
         
          <div class="col-lg-5 sec-3">
            <div class="title">Barangay Medical Mission</div>
            <div class="venue">
              <table>
                <tr>
                  <td><i class="fa fa-map-marker"></i></td>
                  <td>
                    <div>Caloocan North City Hall</div>
                    <div class="dim-color">
                      <a href="https://www.google.co.in" target="blank"></a>
                    </div>
                  </td>
                </tr>
              </table>
            </div>
            <div class="time">
              <table>
                <tr>
                  <td><i class="fa fa-clock-o"></i></td>
                  <td>
                    <div>Saturday, Jan 27, 2023 at 8:00 AM to 5 PM</div>
                   
                  </td>
                </tr>
              </table>
            </div>
            <div class="sort-story">Healing begins with compassion, and in unity, we find strength. Thank you for joining hands in our Barangay medical mission to bring health and hope to our community.</div>
            <div class="group-of-btn">
              <a href="./home.php"  class="btn book-ticket">Back to homepage</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</main>

<script>
            const logoutBtn = document.querySelector('#logoutBtn');

            logoutBtn.addEventListener('click', () => {
                window.localStorage.removeItem('token')
                window.location.reload()
            })
        </script>
        <script src="./auth.js"></script>

<!-- partial -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/livestamp/1.1.2/livestamp.min.js'></script>
</body>
</html>
