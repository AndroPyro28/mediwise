<?php
include './connectMySQL.php';
include './loginverification.php';
if (logged_in()) {
  $session_user_id = $_SESSION['user_id'];

  if ($_SESSION['role'] === 'Admin') {
    header("location:./admin/index.php");
  }
  if ($_SESSION['role'] === 'Doctor') {
    header("location:./doctor/index.php");
  }
} else {
  header('location/mediwise/index.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Registration Form</title>
  <link href="https://fonts.googleapis.com/css?family=Poppins:400,600&display=swap" rel="stylesheet">
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css'>
  <link rel="stylesheet" href="./user reg.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

<body style="background-color: #ffefd7;">
  <!-- partial:index.partial.html -->
  <!--PEN HEADER-->
  <header class="header">

  </header>
  <!--PEN CONTENT     -->
  <div class="content">
    <!--content inner-->
    <div class="content__inner">
      <div class="container">
        <!--content title-->
      </div>
      </form>
      <!--content title-->

    </div>
    <div class="container overflow-hidden">
      <!--multisteps-form-->
      <div class="multisteps-form">
        <!--progress bar-->
        <div class="row">
          <div class="col-12 col-lg-8 ml-auto mr-auto mb-4">
            <div class="multisteps-form__progress">
              <button class="multisteps-form__progress-btn js-active" type="button" title="User Info">1</button>
              <button class="multisteps-form__progress-btn" type="button" title="Order Info">2</button>
            </div>
          </div>
        </div>
        <!--form panels-->
        <div class="row">
          <div class="col-12 col-lg-8 m-auto">
            <form class="multisteps-form__form">
              <!--single form panel-->
              <div class="multisteps-form__panel shadow p-4 rounded bg-white js-active" data-animation="scaleIn">
                <h3 class="multisteps-form__title">Personal Information</h3>
                <div class="multisteps-form__content">
                  <div class="form-row mt-4">

                    <div class="col-12 col-sm-6" style="flex flex-direction: column;">
                      <label for=""> Firstname</label>
                      <input class="multisteps-form__input form-control" type="text" placeholder="First Name"
                        id="first_name" required />
                      <span style="color:red;" class="first_name_error_message"></span>
                    </div>

                    <div class="col-12 col-sm-6 mt-4 mt-sm-0" style="flex flex-direction: column;">
                      <label for=""> Middlename (optional)</label>
                      <input class="multisteps-form__input form-control" type="text" placeholder="Middle Name"
                        id="middle_name" />
                      <span style="color:red;" class="middle_name_error_message"></span>

                    </div>

                  </div>

                  <div class="form-row mt-4">

                    <div class="col-12 col-sm-6" style="flex flex-direction: column;">
                      <label for=""> Lastname</label>
                      <input class="multisteps-form__input form-control" type="text" placeholder="Last Name" required
                        id="last_name" />
                      <span style="color:red;" class="last_name_error_message"></span>

                    </div>

                    <div class="col-12 col-sm-6 mt-4 mt-sm-0" style="flex flex-direction: column;">
                      <label for=""> Suffix (optional)</label>
                      <input class="multisteps-form__input form-control" type="text" placeholder="Suffix" id="suffix" />
                      <span style="color:red;" class="suffix_error_message"></span>

                    </div>

                  </div>

                  <div class="form-row mt-4">
                    <div class="col-12 col-sm-6" style="flex flex-direction: column;">
                      <label for=""> Birthdate</label>
                      <input class="multisteps-form__input form-control" type="date" placeholder="Birthdate" required
                        id="birthdate" />
                      <span style="color:red;" class="birthdate_error_message"></span>

                    </div>
                    <div class="col-12 col-sm-6 mt-4 mt-sm-0"
                      style="display: flex; justify-content: space-evenly; flex-direction: column;">
                      <label for="" style="text-align:center;"> Gender</label>
                      <div style="display: flex; justify-content: space-evenly;">
                        <div>
                          <label for="">Male</label>
                          <input type="radio" placeholder="Gender" name="gender" id="gender" value="male" required />
                        </div>
                        <div>
                          <label for="">Female</label>
                          <input type="radio" placeholder="Gender" name="gender" id="gender" value="female" required />
                        </div>
                        <span style="color:red;" class="gender_error_message"></span>
                      </div>
                    </div>
                  </div>

                  <div class="form-row mt-4">

                    <div class="col" style="flex flex-direction: column;">
                      <label for="">House no.</label>
                      <input class="multisteps-form__input form-control" type="number" placeholder="House no."
                        id="homeNo" name="homeNo" required />
                      <span style="color:red;" class="homeNo_error_message"></span>

                    </div>


                    <div class="col-12 col-sm-6" style="flex flex-direction: column;">
                      <label for="">Street</label>
                      <input class="multisteps-form__input form-control" type="text" placeholder="Street" id="street"
                        required name="street" />
                      <span style="color:red;" class="street_error_message"></span>

                    </div>

                  </div>

                  <div class="form-row mt-4">
                    <div class="col-12 col-sm-6" style="flex flex-direction: column;">
                      <label for="">Contact No.</label>
                      <input class="multisteps-form__input form-control" type="number" placeholder="contact Number"
                        required id="contactNo" name="contactNo" required maxlength="11" />
                      <span style="color:red;" class="contactNo_error_message"></span>
                    </div>
                    <div class="col-12 col-sm-6" style="flex flex-direction: column;">
                      <label for="">Barangay</label>
                      <!-- <div class="col-6 col-sm-6 mt-4 mt-sm-0">   -->
                      <select class="multisteps-form__select form-control" id="barangay" name="barangay" required>
                        <option selected="">Barangay</option>
                        <option value="1">174</option>
                        <option value="2">175</option>
                        <option value="3">176</option>
                        <option value="4">178</option>
                      </select>
                      <span style="color:red;" class="barangay_error_message"></span>
                    </div>

                  </div>

                  <div class="form-row mt-4">
                    <div class="col-12 col-sm-6" style="flex flex-direction: column;">
                      <label for="">Zip</label>
                      <input class="multisteps-form__input form-control" type="number" placeholder="Zip" value="1400"
                        id="zip" name="zip" disabled required />
                      <span style="color:red;" class="zip_error_message"></span>

                    </div>
                    <div class="col-12 col-sm-6" style="flex flex-direction: column;">
                      <label for="">City</label>
                      <input class="multisteps-form__input form-control" type="text" placeholder="City" value="Caloocan"
                        id="city" disabled name="city" />
                      <span style="color:red;" class="city_error_message"></span>
                    </div>

                  </div>

                  <div class="form-row mt-4" style="flex flex-direction: column;">
                    <!-- </div>  -->
                  </div>

                  <div class="button-row d-flex mt-4">
                    <button class="btn btn-primary ml-auto js-btn-next" type="button" title="Next">Next</button>
                  </div>
                  <center> <a href="login-patient.php">
                      <p>Already have an account? Click here to login</p>
                    </a></center>
                </div>
              </div>
              <!--single form panel-->

              <!--single form panel-->
              <div class="multisteps-form__panel shadow p-4 rounded bg-white" data-animation="scaleIn">
                <h3 class="multisteps-form__title">Account Information</h3>
                <div class="multisteps-form__content">
                  <div class="form-row mt-4">
                    <div class="col" style="flex flex-direction: column;">
                      <label for="">Username</label>
                      <input class="multisteps-form__input form-control" type="text" placeholder="Username" required
                        id="username" nam="username" />
                    </div>
                  </div>
                  <div class="form-row mt-4">
                    <div class="col" style="flex flex-direction: column;">
                      <label for="">Email</label>
                      <input class="multisteps-form__input form-control" type="email" placeholder="Email " id="email"
                        nam="email" required />
                      <span style="color:red;" class="email_error_message"></span>
                    </div>
                  </div>
                  <div class="form-row mt-4">
                    <div class="col" style="flex flex-direction: column;">
                      <label for="">Password</label>
                      <input class="multisteps-form__input form-control" type="password" placeholder="Password "
                        required id="password" nam="password" />
                      <span style="color:red;" class="password_error_message"></span>
                    </div>
                  </div>
                  <center>
                    <!-- <p>Please check your email to verify your account.</p></center> -->
                    <div class="button-row d-flex mt-4">
                      <button class="btn btn-primary js-btn-prev" type="button" title="Prev">Prev</button>
                      <a href=""></a> <button class="btn btn-primary ml-auto" id="registerBtn">Done</button>
                    </div>
                </div>
              </div>

          </div>
        </div>
      </div>
    </div>

  </div>
  </div>
  </form>
  </div>
  </div>
  </div>
  </div>
  </div>
  </div>
  <!-- partial -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js'></script>
  <script src="./user reg.js"></script>
  <script src="./user/reverseAuth.js"></script>

  <script>
    const registerBtn = document.querySelector('#registerBtn');
    const first_name_node = document.querySelector('#first_name')
    const middle_name_node = document.querySelector('#middle_name')
    const last_name_node = document.querySelector('#last_name')
    const suffix_node = document.querySelector('#suffix')
    const birthdate_node = document.querySelector('#birthdate')
    const contactNo_node = document.querySelector('#contactNo')
    const city_node = document.querySelector('#city')
    const barangay_node = document.querySelector('#barangay')
    const zip_node = document.querySelector('#zip')
    const username_node = document.querySelector('#username')
    const email_node = document.querySelector('#email')
    const password_node = document.querySelector('#password')
    const gender_node = document.querySelector('#gender')
    const street_node = document.querySelector('#street')
    const homeNo_node = document.querySelector('#homeNo')

    first_name_node.addEventListener('input', (e) => {
      let pattern = /^[A-Za-z\s]*$/;
      e.target.value = e.target.value.replace(/[^A-Za-z ]/g, '');
      if (!pattern.test(e.target.value) || e.target.value.length <= 0) {
        document.querySelector('.first_name_error_message').textContent = "Letter only"
      } else {
        document.querySelector('.first_name_error_message').textContent = ""
      }
    })

    middle_name_node.addEventListener('input', (e) => {
      let pattern = /^[A-Za-z\s]*$/;
      e.target.value = e.target.value.replace(/[^A-Za-z ]/g, '');
      if (!pattern.test(e.target.value || e.target.value.length <= 0)) {
        document.querySelector('.middle_name_error_message').textContent = "Letter only"
      } else {
        document.querySelector('.middle_name_error_message').textContent = ""
      }
    })

    suffix_node.addEventListener('input', (e) => {
      let pattern = /^[A-Za-z\s]*$/;
      e.target.value = e.target.value.replace(/[^A-Za-z ]/g, '');
      if (!pattern.test(e.target.value || e.target.value.length <= 0)) {
        document.querySelector('.suffix_error_message').textContent = "Letter only"
      } else {
        document.querySelector('.suffix_error_message').textContent = ""
      }
    })

    last_name_node.addEventListener('input', (e) => {
      let pattern = /^[A-Za-z\s]*$/;

      e.target.value = e.target.value.replace(/[^A-Za-z ]/g, '');

      if (!pattern.test(e.target.value) || e.target.value.length <= 0) {
        document.querySelector('.last_name_error_message').textContent = "Letter only"
      } else {
        document.querySelector('.last_name_error_message').textContent = ""
      }
    })

    contactNo_node.addEventListener('input', (e) => {
      document.querySelector('.contactNo_error_message').textContent = ""

      if (e.target.value.length > 11) {
        e.target.value = e.target.value.slice(0, 11); // Trim input to 11 characters
      }


      if (!e.target.value.startsWith('09') || e.target.value.length <= 0) {
        document.querySelector('.contactNo_error_message').textContent = "should start with 09*********"
      }
      else if (e.target.value.length < 11 || e.target.value.length > 11) {
        document.querySelector('.contactNo_error_message').textContent = "11 digits number only"
      }
    })

    email_node.addEventListener('input', (e) => {
      let pattern = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/
      if (!pattern.test(e.target.value) || e.target.value.length <= 0) {
        document.querySelector('.email_error_message').textContent = "Invalid email"
      }
      else {
        document.querySelector('.email_error_message').textContent = ""
      }
    })
    password_node.addEventListener('input', (e) => {
      let pattern = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/
      if (!pattern.test(e.target.value) || e.target.value.length <= 0) {
        document.querySelector('.password_error_message').textContent = "Minimum eight characters, at least one letter, one number and one special character"
      } else {
        document.querySelector('.password_error_message').textContent = ""
      }
    })

    registerBtn.addEventListener('click', async () => {

      // document.querySelector('.password_error_message').textContent
      // const isSubmittable = document.querySelector('.first_name_error_message').textContent.length > 0 ||
      // document.querySelector('.middle_name_error_message').textContent.length > 0 ||
      // document.querySelector('.suffix_error_message').textContent.length > 0 ||
      // document.querySelector('.last_name_error_message').textContent.length > 0 ||
      // document.querySelector('.contactNo_error_message').textContent.length > 0 ||
      // document.querySelector('.email_error_message').textContent.length > 0 ||
      // document.querySelector('.password_error_message').textContent.length > 0

      // if(!first_name) {
      //  return document.querySelector('.first_name_error_message').textContent = "required"
      // }

      // if(!last_name) {
      //  return document.querySelector('.last_name_error_message').textContent = "required"
      // }
      // if(!birthdate) {
      //  return document.querySelector('.birthdate_error_message').textContent = "required"
      // }
      // if(!contactNo) {
      //  return document.querySelector('.contactNo_error_message').textContent = "required"
      // }

      // if(!city) {
      //  return document.querySelector('.city_error_message').textContent = "required"
      // }

      // if(!barangay) {
      //  return document.querySelector('.barangay_error_message').textContent = "required"
      // }

      // if(!zip) {
      //  return document.querySelector('.zip_error_message').textContent = "required"
      // }

      // if(!username) {
      //   return document.querySelector('.username_error_message').textContent = "required"
      // }

      // if(!email) {
      //   return document.querySelector('.email_error_message').textContent = "required"
      // }
      // if(!password) {
      //   return document.querySelector('.password_error_message').textContent = "required"
      // }
      // if(!gender) {
      //  return document.querySelector('.gender_error_message').textContent = "required"
      // }

      // if(!street) {
      //   return document.querySelector('.street_error_message').textContent = "required"
      // }

      // if(!homeNo) {
      //   return document.querySelector('.homeNo_error_message').textContent = "required"
      // }


      const values = {
        first_name: first_name_node.value,
        middle_name: middle_name_node.value,
        last_name: last_name_node.value,
        suffix: suffix_node.value,
        birthdate: birthdate_node.value,
        contactNo: contactNo_node.value,
        city: city_node.value,
        barangay: barangay_node.value,
        zip: zip_node.value,
        username: username_node.value,
        email: email_node.value,
        password: password_node.value,
        gender: gender_node.value,
        street: street_node.value,
        homeNo: homeNo_node.value,
      }

      const result = await fetch('http://localhost:3001/register', { // sending data to the server
        method: 'POST',
        body: JSON.stringify({ ...values }),
        headers: { 'Content-type': 'application/json' }
      }) // getting the data from server

      const data = await result.json();
      if (result.status === 200 && data.success) {
        alert("registration successful")
        window.location.assign('login-patient.php');
      } else {
        alert(data.message)
      }
    })
  </script>
</body>

</html>