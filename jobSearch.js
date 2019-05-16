var jobList = [] //jobList is global

//Get php with results from table, create HTML cards for each row in the table
$(document).ready(function(){    
    $.ajax({
        url:"jobSearch_data.php",
        method:"GET",
        dataType:"JSON",
        success:function(data) {
            jobList = data //data refers to the data array from the PHP file
            console.log(data)
            for (var i = 0; i < data.length; i++) {
                console.log(data[i].JobTitle)

                //template literal for HTML card
                var cardHtml = `
                <div id=${i} class='w3-card w3-margin w3-margin-top'>
                    <div id='area' class='w3-container w3-white'>
                        <h4>${data[i].JobTitle}</h4>
                        <b>${data[i].Category}</b>
                        <b>  -  </b>
                        <b>${data[i].Location}</b>
                        <br>
                        <br>
                        <a href='http://ec2-18-232-155-220.compute-1.amazonaws.com/postings.html?postingId=${data[i].ID}'>
                            <button class='w3-button w3-green w3-padding-large w3-margin-bottom'>Apply Now</button>
                        </a>
                    </div>
                </div>
                `
                //create a new div and place the template in the div, add to the document
                var newDiv = document.createElement('div') 
                newDiv.innerHTML = cardHtml
                document.getElementById("output").appendChild(newDiv);
            }
        }
   })
});
//Compare the categorys in jobList array to searchTerm, if searchTerm is present then show those cards and hide everything else

function btnCheck() {
    filterList = []

    if (document.getElementById("filterInfoTech").checked) {
        filterList.push("Information Technology")
    } 

    if (document.getElementById("filterSales").checked) {
        filterList.push("Sales")
    } 

    if (document.getElementById("filterAdvertising").checked) {
        filterList.push("Advertising")
    } 

    if (document.getElementById("filterHR").checked) {
        filterList.push("Human Resources")
    }

    filter(filterList)

} 

//function for filter buttons, display postings from catagory and hide the rest
function filter(filterList) {

    for (var i = 0; i < jobList.length; i++) {
        if (filterList.includes(jobList[i].Category) || filterList.length == 0 ) {
            document.getElementById(i).style.display = "block"
        } else {    
            document.getElementById(i).style.display = "none"
        }
    }
}

//function for search box, display matching catagories, job names, and locations
function findSearch(searchTerm) {

for (var i = 0; i < jobList.length; i++) {
        if (jobList[i].JobTitle.toLowerCase().includes(searchTerm.toLowerCase()) || jobList[i].Category.toLowerCase().includes(searchTerm.toLowerCase() ) || jobList[i].Location.toLowerCase().includes(searchTerm.toLowerCase() )  ) {
            document.getElementById(i).style.display = "block"
        }
        else{
            document.getElementById(i).style.display = "none"
        }
    }  
}