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
    <title>History Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="123.css">
    <link rel="stylesheet" href="./notification.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">


    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
        }
        h2 {
            color: #333;
        }
        #historyTable {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #f5f5f5;
        }
    </style>
</head>

<body>
    <header class="header" id="header">
        <nav class="nav container">
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
                        <a href="upload-prescription.php" class="nav__link">Upload prescriptions</a>
                    </li>


                    </div>
                </div>
            </div>

            <div id="notification-icon" onclick="toggleNotificationList()" style="position:relative;">
            <div class="w-2 h-2 bg-yellow-500 rounded-full ml-auto hidden" id="notificationCircle"></div>

                <img
                    src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAWVJREFUSEvN1TFIlVEYxvGfuBkOitBQWgYKQkN7DYKKQ4uiiM6ubSm1qYMICo7i3BIi4ioqCgnuDgoOhkKgBIJB0BBUfPF9d/juPfc7V7noOz/n+T/nPe85p0Gdq6HO/moBjOFTGmgCmzHhYgBNmMQ8mlPTH5jDKn5VAxUB+vEZbQGT7xjFQQhSDTCMdTRiAyvYS4368A5D+I232KkECQEe4wyP8B7LgYQzmMUVuvAzrwsBljCFNYwXHOYWBkNBQoALdOAVjgoAA9jGIV7H7uBvKkz6/6cA0Ipr3KClVkDRlGV+WaAyfcgguCCwm4cFeIbzNGmtLXqOZEBKlTd4ii/oxDFexrw3OEEPvuINLrN1ecApuisJC0BP0mAv8sHygOyw2vEtMn0mq9jaEKBG7zJ5yTcP2EfvHd13kdzu/xU7JbdmxgI+YiFH+YDFInIsINElL+xIapj8D9PIhiLIiQUUBb0/wD/3oz4ZE6fqJQAAAABJRU5ErkJggg==" />

                <div id="notification-list" style="position:absolute; left:-90px;">
                    <!-- Add more notification items as needed -->
                </div>
            </div>

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


<h2>History Page</h2>

<!-- History Table -->
<table id="historyTable">
    <thead>
        <tr>
            <th>Date</th>
            <th>Doctor name</th>
            <th>Description</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <!-- Data will be populated dynamically using JavaScript -->
    </tbody>
    
</table>

<div class="no_data" style="text-align: center;"></div>
</main>
<script>
// Use JavaScript to fetch and populate data here
// Get the table body
const getHistory = async () => {
    const token = window.localStorage.getItem("token");
    const result = await fetch("http://localhost:3001/appointments/history", {
      method: "GET",
      headers: { token },
    });
    
    const data = await result.json();
    const dateAndTimeParser = (dateTimeLocal) => {
  const date = new Date(dateTimeLocal)?.toISOString().slice(0, 10);

  const time = new Date(dateTimeLocal)?.toLocaleString("en-US", {
    timeZone: "Asia/Manila",
    hour: "numeric",
    minute: "numeric",
    hour12: true,
  });

  return {
    date,
    time,
  };
};
    const {data: history} = data
    const tableBody = document.querySelector('#historyTable tbody');

// Populate the table with data
if(history.length > 0) {
    history.forEach(entry => {
        const {date, time} = dateAndTimeParser(entry.date)
    const row = document.createElement('tr');
    row.innerHTML = `
        <td>${date} ${time} </td>
        <td>${entry.doctor_name}</td>
        <td>${entry.description}</td>
        <td>${entry.request_status}</td>
    `;
    tableBody.appendChild(row);

  })
} else {
    const divMessageContainer = document.querySelector('.no_data');
    divMessageContainer.innerHTML += `<h2>No past appointment found!</h2>`
}

}
window.addEventListener('load', getHistory)

</script>

<script>
    const logoutBtn = document.querySelector('#logoutBtn');
    
    logoutBtn.addEventListener('click', () => {
        window.localStorage.removeItem('token')
        window.location.reload()
    })
    </script>

<script src="./auth.js"></script>

<script src="./notification2.js"></script>
</body>
</html>