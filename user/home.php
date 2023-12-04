<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!--=============== BOXICONS ===============-->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">

        <!--=============== CSS ===============-->
        <link rel="stylesheet" href="123.css">

        <title>MediWise</title>
    </head>
    <body>
        <!--=============== HEADER ===============-->
        <header class="header" id="header">
            <nav class="nav container">
                <a href="#" class="nav__logo">MediWise</a>

                <div class="nav__menu" id="nav-menu">
                    <ul class="nav__list">
                        <li class="nav__item">
                            <a href="#home" class="nav__link active-link">Home</a>
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
                        <a href="#" id="logoutBtn">Logout sss </a>
                    </div>
                </div>
                

                <div class="nav__toggle" id="nav-toggle">
                    <i class='bx bx-grid-alt'></i>
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
    </body>
</html>