
//Retrieve Job interest from URL parameter
$(function () {

    $(document).ready(function(){
    
        const urlParams = new URLSearchParams(window.location.search);
        const JobTitle = urlParams.get('JobTitle');
        document.getElementById("JobInterest").value = JobTitle;
        console.log(JobTitle)
    
    
    });
    
    });
    
    //Reset the error field
    $(':file').on('click', function () {
        document.getElementById("errorField").innerHTML = "";
    });
    
    //Determine if the file type is acceptable, display error message if needed
    $(':file').on('change', function () {
      var file = this.files[0];
    
      if (file.size > 10000000) {
        document.getElementById("errorField").innerHTML = "File is more than 10MB";
      }
    
      var acceptedFileTypes = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'image/jpg', 'image/jpeg', 'image/png'];
      var allowedFile = 0;
    
      for(var i = 0; i < acceptedFileTypes.length; i++) {
        if(file.type === acceptedFileTypes[i]) {
            allowedFile = 1;
        }
      }
    
      if(allowedFile === 0) {
        document.getElementById("errorField").innerHTML = "File type is not supported!";
      }
    
    });
    
    //Upload form data
    $(function () {
    
    $('form').on('submit', function (e) {
    
      //Retrieve form data from page
      var form = $('form')[0];
      var formData = new FormData(form);
    
      e.preventDefault();
    
      //Send form data to php script and redirect to completion page
      $.ajax({
        type: 'post',
        url: 'appFormUpload.php',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function () {
          
          window.location.replace("http://ec2-18-232-155-220.compute-1.amazonaws.com/applicationComplete.html");
        }
      });
    
    });
    
    });
    
    