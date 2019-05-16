//Details, ImageSrc, JobTitle, WhatWeDo, WhatWeNeedFromYou, WhyUs, submitLink
$(function () {

    $(document).ready(function(){
    
        const urlParams = new URLSearchParams(window.location.search);
        const postingId = urlParams.get('postingId');
        console.log(postingId)
    
      $.ajax({
        method: 'POST',
        url: 'postings_data.php',
        data: {postingId: postingId },
        dataType:"JSON",
        success:function(data) {
          console.log(data)
    
            document.getElementById("Details").innerHTML = data.Details
            document.getElementById("ImageSrc").src = data.ImageSrc
            document.getElementById("JobTitle").innerHTML = data.JobTitle
            document.getElementById("WhatWeDo").innerHTML = data.WhatWeDo
            document.getElementById("WhatWeNeedFromYou").innerHTML = data.WhatWeNeedFromYou
            document.getElementById("WhyUs").innerHTML = data.WhyUs
            document.getElementById("submitLink").href = `http://ec2-18-232-155-220.compute-1.amazonaws.com/appForm.html?JobTitle=${data.JobTitle}`
    
      
        }
      });
    
    });
    
    });
    