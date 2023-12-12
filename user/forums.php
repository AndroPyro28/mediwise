<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Forums</title>
  <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1"><link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css'>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'><link rel="stylesheet" href="./Forums.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
<link rel="stylesheet" href="123.css">
<link rel="stylesheet" href="./notification.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">

</head>
<body>
<header class="header flex items-center sm:gap-0" id="header">
        <nav class="nav container flex items-center">
            <img src="../public/images/bhaLogo.png" class="w-16 h-16 object-cover" alt="">

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
                    <li class="nav__item">
                        <a href="upload-prescription.php" class="nav__link">Prescriptions</a>
                </li>
                </ul>
            </div>

            <div id="notification-icon" onclick="toggleNotificationList()" style="position:relative;">
            <div class="w-2 h-2 bg-yellow-500 rounded-full ml-auto hidden" id="notificationCircle"></div>
                <img
                    src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAWVJREFUSEvN1TFIlVEYxvGfuBkOitBQWgYKQkN7DYKKQ4uiiM6ubSm1qYMICo7i3BIi4ioqCgnuDgoOhkKgBIJB0BBUfPF9d/juPfc7V7noOz/n+T/nPe85p0Gdq6HO/moBjOFTGmgCmzHhYgBNmMQ8mlPTH5jDKn5VAxUB+vEZbQGT7xjFQQhSDTCMdTRiAyvYS4368A5D+I232KkECQEe4wyP8B7LgYQzmMUVuvAzrwsBljCFNYwXHOYWBkNBQoALdOAVjgoAA9jGIV7H7uBvKkz6/6cA0Ipr3KClVkDRlGV+WaAyfcgguCCwm4cFeIbzNGmtLXqOZEBKlTd4ii/oxDFexrw3OEEPvuINLrN1ecApuisJC0BP0mAv8sHygOyw2vEtMn0mq9jaEKBG7zJ5yTcP2EfvHd13kdzu/xU7JbdmxgI+YiFH+YDFInIsINElL+xIapj8D9PIhiLIiQUUBb0/wD/3oz4ZE6fqJQAAAABJRU5ErkJggg==" />
                <div id="notification-list" style="position:absolute; left:-90px;">
                    <!-- Add more notification items as needed -->
                </div>
            </div>
            <div class="dropdown">
                <button class="dropbtn">
                    <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAepJREFUSEu11UuoSFEUBuDvkphgIKG8ihCFgVAyQiEjjzEppZCipDBBjL1CKY+ZIlEiSYkMiJIByiMGSJJMGHi1tE9tu7Pvqau7Z/usf69/rb3+/Z8e/bx6+jm/LoJBWIllmI2JqaDXeITruIQftUJ7I1iME5jU0eUzbMTtNlyNYBf20dlhk/MntuNQSdJGsAd7+zibLTiany0JluBGH5PHsV+YjwdNjpxgAJ5gegvBF+zE5RRbjQMY2oK9i4VtBKGWi5Xq1+FsEdtUXkcWX4B7sc87uIBVFYKR+FTExuBdBX8YW0uCtxhXOTAKH4vYaLyv4B9iTknwDUMqB9bjdBEL7R+v4D9jREnwtTK0wMWQd6QhhxhiXgcxrEIQuYaXBM8x5T8kmh992qgxH/IZrG0hCG0/xn18SPG4/7mYheioXKewoexgOa4WyOhqBV5UOpuGa5kJNrBFuFUSxD4qnZlQvzEZrzqubSrC8JoVnc5rNqVVBPPNDHwe8ci+V0hCdeewJsXjOuMV/31kbR3Et3DS/VnCNziS/D+sZCBmJJ2HuY3NsJtxLC+mZte7k6N2/ZCaXGHX2xAv+J/VW4KlOInxHTMIIYRi7rThuiocnPwpFBbDn4AY/kuEHYSCriA6aF1dBB3Fd4f7neAPCe1UGWoE11UAAAAASUVORK5CYII=" />
                </button>
                <div class="dropdown-content">
                    <a href="history.php">History</a>
                    <a href="#">Settings</a>
                    <a href="#" id="logoutBtn">Logout</a>
                </div>
            </div>

            <button id="hamburger" data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-default" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
                    </svg>
                </button>

    <div class="hidden flex-col absolute top-7 right-0 md:hidden" id="hamburger-content">
      <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
        <li>
          <a href="home.php" class="block py-2 px-3 text-gray-900 rounded md:bg-transparent md:text-blue-700 md:p-0 dark:text-white md:dark:text-blue-500" aria-current="page">Home</a>
        </li>
        
        <li>
          <a href="appointment.php" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Appointment</a>
        </li>
        <li>
          <a href="forums.php" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent  bg-green-400">Announcement</a>
        </li>
        <li>
          <a href="doctor-list.php" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Doctors</a>
        </li>
        <li>
          <a href="upload-prescription.php" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Prescriptions</a>
        </li>
      </ul>
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
        <script src="./notification2.js"></script>
        <script src="../navbar.js"></script>

<!-- partial -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/livestamp/1.1.2/livestamp.min.js'></script>
</body>
</html>
