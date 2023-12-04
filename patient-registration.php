<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Registration Form</title>
  <link href="https://fonts.googleapis.com/css?family=Poppins:400,600&display=swap" rel="stylesheet"><link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css'><link rel="stylesheet" href="./user reg.css">

</head>
<body>
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
              <button class="multisteps-form__progress-btn" type="button" title="Address">2</button>
              <button class="multisteps-form__progress-btn" type="button" title="Order Info">3</button>
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
                    <div class="col-12 col-sm-6">
                      <input class="multisteps-form__input form-control" type="text" placeholder="First Name" id="first_name"/>
                    </div>
                    <div class="col-12 col-sm-6 mt-4 mt-sm-0">
                      <input class="multisteps-form__input form-control" type="text" placeholder="Middle Name" id="middle_name"/>
                    </div>
                  </div>
                  <div class="form-row mt-4">
                    <div class="col-12 col-sm-6">
                      <input class="multisteps-form__input form-control" type="text" placeholder="Last Name" id="last_name"/>
                    </div>
                    <div class="col-12 col-sm-6 mt-4 mt-sm-0">
                      <input class="multisteps-form__input form-control" type="email" placeholder="Suffix" id="suffix"/>
                    </div>
                  </div>

                  <div class="form-row mt-4">
                    <div class="col-12 col-sm-6">
                      <input class="multisteps-form__input form-control" type="date" placeholder="Birthdate" id="birthdate"/>
                    </div>
                    <div class="col-12 col-sm-6 mt-4 mt-sm-0" style="display: flex; justify-content: space-evenly;">
                      <div>
                        <label for="">Male</label>
                        <input  type="radio" placeholder="Gender" name="gender" id="gender" value="male"/>
                      </div>
                      <div>
                        <label for="">Female</label>
                        <input type="radio" placeholder="Gender" name="gender" id="gender" value="female"/>
                      </div>

                    </div>
                  </div>
                  
                  <div class="button-row d-flex mt-4">
                    <button class="btn btn-primary ml-auto js-btn-next" type="button" title="Next">Next</button>
                  </div>
                  <center> <a href="login-patient.php"> <p>Already have an account? Click here to login</p></a></center>
                </div>
              </div>
              <!--single form panel-->
              <div class="multisteps-form__panel shadow p-4 rounded bg-white" data-animation="scaleIn">
                <h3 class="multisteps-form__title">Address Information</h3>
                <div class="multisteps-form__content">
                  <div class="form-row mt-4">
                    <div class="col">
                      <input class="multisteps-form__input form-control" type="text" placeholder="Contact Number" id="contactNo" name="contactNo"/>
                    </div>
                  </div>
                  <div class="form-row mt-4">
                    <div class="col">
                      <input class="multisteps-form__input form-control" type="text" placeholder="House Address" id="homeAddress" name="homeAddress"/>
                    </div>
                  </div>
                  <div class="form-row mt-4">
                    <div class="col-12 col-sm-6">
                      <input class="multisteps-form__input form-control" type="text" placeholder="City" id="city" name="city"/>
                    </div>
                    <div class="col-6 col-sm-3 mt-4 mt-sm-0">
                      <select class="multisteps-form__select form-control" id="barangay" name="barangay">
                        <option selected="selected">Barangay</option>
                        <option value="1">176</option>
                        <option value="2">177</option>
                        <option value="3">178</option>
                      </select>
                    </div>
                    <div class="col-6 col-sm-3 mt-4 mt-sm-0">
                      <input class="multisteps-form__input form-control" type="text" placeholder="Zip" id="zip" name="zip"/>
                    </div>
                  </div>
                  <div class="button-row d-flex mt-4">
                    <button class="btn btn-primary js-btn-prev" type="button" title="Prev">Prev</button>
                    <button class="btn btn-primary ml-auto js-btn-next" type="button" title="Next">Next</button>
                  </div>
                </div>
              </div>
              <!--single form panel-->
              <div class="multisteps-form__panel shadow p-4 rounded bg-white" data-animation="scaleIn">
                <h3 class="multisteps-form__title">Account Information</h3>
                <div class="multisteps-form__content">
                  <div class="form-row mt-4">
                    <div class="col">
                      <input class="multisteps-form__input form-control" type="text" placeholder="Username" id="username" nam="username"/>
                    </div>
                  </div>
                  <div class="form-row mt-4">
                    <div class="col">
                      <input class="multisteps-form__input form-control" type="text" placeholder="Email " id="email" nam="email"/>
                    </div>
                  </div>
                  <div class="form-row mt-4">
                    <div class="col">
                      <input class="multisteps-form__input form-control" type="password" placeholder="Password " id="password" nam="password"/>
                    </div>
                  </div>
              <center> 
                <!-- <p>Please check your email to verify your account.</p></center> -->
                <div class="button-row d-flex mt-4">
                  <button class="btn btn-primary js-btn-prev" type="button" title="Prev">Prev</button>
                 <a href=""></a> <button class="btn btn-primary ml-auto js-btn-next" id="registerBtn" type="button" title="Next">Done</button>
                    
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
<script  src="./user reg.js"></script>
<script  src="./user/reverseAuth.js"></script>
<script>
  const registerBtn = document.querySelector('#registerBtn');

  registerBtn.addEventListener('click',async () => {
    const first_name = document.querySelector('#first_name').value
    const middle_name = document.querySelector('#middle_name').value
    const last_name = document.querySelector('#last_name').value
    const suffix = document.querySelector('#suffix').value
    const birthdate = document.querySelector('#birthdate').value
    const contactNo = document.querySelector('#contactNo').value
    const homeAddress = document.querySelector('#homeAddress').value
    const city = document.querySelector('#city').value
    const barangay = document.querySelector('#barangay').value
    const zip = document.querySelector('#zip').value
    const username = document.querySelector('#username').value
    const email = document.querySelector('#email').value
    const password = document.querySelector('#password').value
    const gender = document.querySelector('#gender').value

    const values = {
      first_name,
      middle_name,
      last_name,
      suffix,
      birthdate,
      contactNo,
      homeAddress,
      city,
      barangay,
      zip,
      username,
      email,
      password,
      gender
    }

     const result = await fetch('http://localhost:3001/register', { // sending data to the server
        method: 'POST',
        body: JSON.stringify({ ...values }),
        headers: { 'Content-type': 'application/json' }
    }) // getting the data from server

      const data = await result.json();
      console.log(data)
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