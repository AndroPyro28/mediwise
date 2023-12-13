<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!--=============== BOXICONS ===============-->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">

        <!--=============== CSS ===============-->
        <link rel="stylesheet" href="landing.css">

        <title>MediWise</title>
        <style>
            @keyframes slideToLeft {
                from {
                    margin-right: -99999px;
                }
                to {
                    margin-right: 0px;
                }
            }

            @keyframes slideToRight {
                from {
                    margin-left: -99999px;
                }
                to {
                    margin-left: 0px;
                }
            }

            .about {
                animation: slideToLeft 1s ;
            }
            .home {
                animation: slideToRight 1s ;
            }
            .services {
                animation: slideToLeft 1s ;
            }
            .contact {
                animation: slideToRight 1s ;

            }
        </style>
    </head>
    <body style=" background-color: #ffefd7; ">
        <!--=============== HEADER ===============-->
        <header class="header" id="header">
            <nav class="nav container" style="overflow:hidden;">
            <img src="./public/images/bhaLogo.png" alt="" style="height:100px">

            <img src="./public/images/mediwiseLogo.png" alt="" style="height:200px">


                <div class="nav__menu " id="nav-menu">
                    <ul class="nav__list sm:hidden block">
                        <li class="nav__item">
                            <a href="#home" class="nav__link active-link">Home</a>
                        </li>
                        <li class="nav__item">
                            <a href="#about" class="nav__link">About us</a>
                        </li>
                        <li class="nav__item">
                            <a href="#services" class="nav__link">Guidelines</a>
                        </li>
                        <li class="nav__item">
                            <a href="#contact" class="nav__link">Contact us</a>
                        </li>

                        <i class='bx bx-toggle-left change-theme' id="theme-button"></i>
                    </ul>
                </div>

                <button id="hamburger" data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-default" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
                    </svg>
                </button>

    <div class="hidden flex-col absolute top-7 right-20 md:right-5" id="hamburger-content">
      <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
        <li>
          <a href="home" class="block py-2 px-3 text-white bg-green-400 rounded md:bg-transparent md:text-blue-700 md:p-0 dark:text-white md:dark:text-blue-500" aria-current="page">Home</a>
        </li>
        
        <li>
          <a href="#about" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">About us</a>
        </li>
        <li>
          <a href="#services" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Guidelines</a>
        </li>
        <li>
          <a href="#contact" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Contact</a>
        </li>
        <li>
          <a href="login-patient.php" class="block py-2 px-3 text-white text-gray-900 rounded md:bg-transparent md:text-blue-700 md:p-0 dark:text-white md:dark:text-blue-500">Login</a>
        </li>
      </ul>
    </div>
    

                

                <div class="nav__toggle" id="nav-toggle">
                    <i class='bx bx-grid-alt'></i>
                </div>

                <a href="login-patient.php" class="button button__header">Login</a>
            </nav>

   


        </header>

        <main class="main">
            <!--=============== HOME ===============-->
            <section class="home section" id="home">
                <div class="home__container container grid " >
                    <img src="./clogo.png" alt="" >
                    <div class="home__data sm:ml-0 ml-[150px]">
                        <h1 class="home__title">A path to a  <br> better health</h1>
                        <p class="home__description">A platform gives healthcare providers the tools they need to manage medical inventory effectively,
                             ensuring that patients get the treatment they deserve, when they need it.</p>

                        <a href="login.php" class="button">Get Started</a>

                    </div>   
                </div>
            </section>

            <!--=============== ABOUT ===============-->
            <section class="about section container" id="about">
                <div class="about__container grid">
                    <div class="about__data">
                        <h2 class="section__title-center">Find Out A Little More  About Us</h2>
                        <p class="about__description">
                            MediWise, a meticulously designed web-based and mobile application, is tailor-made for use by the City Health Department and Barangays.
                            This essential intermediary platform fosters seamless communication, coordination, and information exchange within a city's healthcare framework. 
                            The innovative system significantly streamlines healthcare data, resource, and service flows, ultimately aiming to boost efficiency and effectiveness 
                            in delivering healthcare services to the community. Serving as a central repository for critical healthcare data and enabling real-time collaboration, 
                            MediWise empowers healthcare professionals and local authorities to join forces, ensuring residents receive optimal care. In an age where swift information
                            and resource exchange is pivotal, MediWise stands as a vital tool for enhancing the overall healthcare experience in a city.
                        </p>
                    </div>    
                <img src="./BGPNU.jpeg" alt="" style="height:400px; width:400px; border-radius:20px; object-fit: cover;;" class="left-image">
                </div>

            </section>

            <!--=============== SERVICES ===============-->
            <section class="services section container" id="services">
                <h2 class="section__title">A Few Guidelines On <br> How To Use It</h2>
                <div class="services__container grid">
                    <div class="services__data">
                        <h3 class="services__subtitle">LogIn/SignUp</h3>
                       <img src="1.png" alt="">
                        <p class="services__description">To get access to this application, you'll need to sign in or register.</p>
                       
                    </div>

                    <div class="services__data">
                        <h3 class="services__subtitle">Make an Appointment</h3>
                        <img src="2.png" alt="">
                        <p class="services__description">Make an appointment for your consultation in your barangay</p>
                    </div>

                    <div class="services__data">
                        <h3 class="services__subtitle">Go to your local Barangay.</h3>
                        <img src="3.png" alt="">
                        <p class="services__description">Wait for your appointment day and go to your barangay.</p>
                </div>
            </section>

            

            <!--=============== CONTACT US ===============-->
            <section class="contact section container" id="contact">
                <div class="contact__container grid">
                    <div class="contact__content">
                        <h2 class="section__title-center">Contact Us From  Here</h2>
                        <p class="contact__description">You can contact us from here, you can write a message to us, 
                            we will gladly assist you.</p>
                    </div>

                    <ul class="contact__content grid">
                        <li class="contact__address">Email:  <span class="contact__information">mediwise@email.com</span></li>
                        <li class="contact__address">Location: <span class="contact__information">Caloocan City North - Philippines</span></li>
                    </ul>

                    
                </div>
            </section>
        </main>

        <!--=============== FOOTER ===============-->
        
            </div>

            
        <footer class="footer section">
            <div class="footer__container container grid">
                <div class="footer__content">
                    <a href="#" class="footer__logo">MediWise</a>
                   
                </div>

                <div class="footer__content">
                    <h3 class="footer__title">Quick Links</h3>
                    <ul class="footer__links">
                        <li><a href="#home" class="footer__link">Home </a></li>
                        <li><a href="#about" class="footer__link">About Us</a></li>
                        <li><a href="#services" class="footer__link">Guidelines</a></li>
                        <li><a href="#contact" class="footer__link">Contact Us</a></li>
                    </ul>
                </div>

                <div class="footer__content">
                    <h3 class="footer__title">Our Team</h3>
                    <ul class="footer__links">
                        <li><a href="team.php" class="footer__link">Team</a></li>
                        <li><a href="#" class="footer__link">Our mision</a></li>
                      
                    </ul>
                </div>

                <div class="footer__content">
                    <h3 class="footer__title">Contact</h3>
                    <ul class="footer__links">
                        <li><a href="#" class="footer__link">Terms & Condition</a></li>
                        <li><a href="privacy.php" class="footer__link">Privacy Policy</a></li>
                       
                       
                    </ul>
                </div>

                <div class="footer__social">
                    <a href="https://www.facebook.com/" class="footer__social-link"><i class='bx bxl-facebook-circle '></i></a>
                    <a href="https://www.linkedin.com/" class="footer__social-link"><i class='bx bxl-linkedin'></i></a>
                    <a href="https://www.instagram.com/?hl=en" class="footer__social-link"><i class='bx bxl-instagram-alt'></i></a>
                </div>
            </div>
            <p class="footer__copy">&#169; MediWise. All right reserved</p>
        </footer>

        <!--=============== SCROLL UP ===============-->
        <a href="#" class="scrollup" id="scroll-up">
            <i class='bx bx-up-arrow-alt scrollup__icon'></i>
        </a>

        <!--=============== MAIN JS ===============-->
        <script src="landing.js"></script>
        <script src="navbar.js"></script>
    </body>
</html>