<?php
include '../connectMySQL.php';
include '../loginverification.php';
if (logged_in()) {
    $session_user_id = $_SESSION['user_id'];
    if($_SESSION['role'] === 'Admin')  {
        header("location:../admin/index.php");
      }
      if($_SESSION['role'] === 'Doctor') {
        header("location:../doctor/index.php");
      }
} 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">

    <!--=============== BOXICONS ===============-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">

    <!--=============== CSS ===============-->
    <link rel="stylesheet" href="123.css">

    <title>MediWise</title>

    <link rel="stylesheet" href="./notification.css">
</head>

<body style="background-color: #ffefd7;">
    <!--=============== HEADER ===============-->
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
          <a href="home.php" class="block py-2 px-3 text-white bg-green-400 rounded md:bg-transparent md:text-blue-700 md:p-0 dark:text-white md:dark:text-blue-500" aria-current="page">Home</a>
        </li>
        
        <li>
          <a href="calendar.php" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Appointment</a>
        </li>
        <li>
          <a href="forums.php" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Announcement</a>
        </li>
        <li>
          <a href="doctor-list.php" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Doctors</a>
        </li>
        <li>
          <a href="upload-prescription.php" class="block py-2 px-3 text-white text-gray-900 rounded md:bg-transparent md:text-blue-700 md:p-0 dark:text-white md:dark:text-blue-500">Prescriptions</a>
        </li>
      </ul>
    </div>
        </nav>
    </header>

    <main class="main">
        <!--=============== HOME ===============-->
        <section class="home section" id="home">
            <div class="home__container container grid">
                <img src="Clogo.png" alt="">

                <div class="home__data">
                    <h3 class="home__title">Welcome To Barangay Health Center </h3>

                </div>
            </div>
        </section>




        <!--=============== MAIN JS ===============-->
        <!-- <script src="./123.js"></script> -->
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
</body>

</html>