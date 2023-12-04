<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Prescription</title>
  <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'><link rel="stylesheet" href="Prescription.css">

</head>
<body>
<!-- partial:index.partial.html -->
<!-- MultiStep Form -->

<form id="msform">

  <!-- progressbar -->
  <ul id="progressbar">
    <li class="active">Step 1: Upload Prescription</li>
    <li>Step 2: Suggested Medicines </li>
    <li>Step 3: Consult To Doctor</li>
  </ul>
  <!-- fieldsets -->
  <fieldset>
    <h2 class="fs-title">Upload Prescription</h2>
    <h3 class="fs-subtitle">Please upload the prescription</h3>
    <input id="file" name="files" type="file" /><br/>
   
      
    </a>
    
    <input type="button" name="next" class="next action-button" value="Next" />
  </fieldset>
  <fieldset>
    <h2 class="fs-title">Suggestion Medicines Here</h2>
    <div>
      <ul class="prescription-field">
       
      <div class="prescription-field">
        <label>
                    
                    <label for="labtest"></label>
        </label>
      </div>

    </div>
    <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
    <input type="button" name="next" class="next action-button" value="Next" />
  </fieldset>
  <fieldset>
    <h2 class="fs-title">Do you want to get in touch with a doctor?</h2>
    <a href="#"><h3 class="fs-subtitle">Click Here</h3></a>
    <div class="prescription-field"></div>
    <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
    <input type="submit" name="submit" class="submit action-button" value="Submit" />
  </fieldset>
</form>


<!-- /.MultiStep Form -->
<!-- partial -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js'></script><script  src="Prescription.js"></script>

</body>
</html>
