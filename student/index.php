<?php 
require('./Config.php');
$config  = new Config();
$questions = $config->fetch_all('question');


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wapda E Exam Portal.</title>
    <!-- <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet"> -->
		<link rel="stylesheet" href="students.css">
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script> -->
  <script
      src="https://code.jquery.com/jquery-3.6.0.min.js"
      integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
      crossorigin="anonymous"
    ></script>  
  </head>
<body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <h3 class="mx-auto pt-2">Wapda Exam</h3>
        </nav>

        <!-- student questions -->
        <div class="container mt-sm-5 my-1">
    <div class="question ml-sm-5 pl-sm-5 pt-2" id="question">
        
    </div>
    <div class="d-flex align-items-center pt-3">
        <div id="prev_btn">
            <button class="btn btn-primary" onclick="prev_question()">Previous</button>
        </div>
        <div class="ml-auto mr-sm-5" id="next_btn">
            <button class="btn btn-success" onclick="next_question()">Next</button>
        </div>
        <div class="ml-auto mr-sm-5" id="result_btn" style="display:none">
            <button class="btn btn-success" onclick="result()" >Result</button>
        </div>
    </div>
</div>

</body>
<!-- Display the countdown timer in an element -->
<p id="demo"></p>

<script>
var i = 0;
var questions = <?php echo json_encode($questions); ?>;
var q_length = questions.length;

function next_question(){
  let q_id = document.getElementById("q_id").value;
  if(i < q_length -1 ){
    i++;
  }
  var ans = document.querySelector('input[name="radio"]:checked');
  if(ans){

    ans = ans.value;
  }
  make_result(ans,q_id);
}
function prev_question(){
  if( i > 0 ){
    i--;
  }
  get_question();
}

function make_result(ans, q_id){
  $.ajax({
        type: 'post',
        url: './api_functions/make_result.php',
        data: {ans:ans , q_id:q_id},
        success: function (data) {
          get_question();
        }
    })
}
function result(){
  let q_id = document.getElementById("q_id").value;
  var ans = document.querySelector('input[name="radio"]:checked');
  if(ans){

ans = ans.value;
}

  $.ajax({
        type: 'post',
        url: './api_functions/make_result.php',
        data: {ans:ans , q_id:q_id},
        success: function (data) {
            $.ajax({
              type: 'GET',
              url: './api_functions/result.php',
              data: {},
              success: function (data) {
                data = JSON.parse(data)
                alert(`your given number ${data['given_num']} outof  ${data['total']}`);
              }
          })    
        }
    })
}

function check_question(){
  if( i== 0){
    document.getElementById("prev_btn").style.display = 'none' 
  }
  else if(i >  0){
    document.getElementById("prev_btn").style.display = 'block' 
  }
  if( i == q_length -1){
    document.getElementById("next_btn").style.display = 'none' 
    document.getElementById("result_btn").style.display = 'block' 
  }
  else if( i < q_length -1){
    document.getElementById("next_btn").style.display = 'block' 
    document.getElementById("result_btn").style.display = 'none' 
  }
}

get_question();
function get_question(){
        
        check_question();
        var html = `
        <input hidden id="q_id" value="${questions[i]['q_id']}" />
        <div class="py-2 h5"><b>Q. ${questions[i]['question']}</b></div>
        <div class="ml-md-3 ml-sm-3 pl-md-5 pt-sm-0 pt-3" id="options">
            <label class="options">${questions[i]['option1']}
                <input type="radio" value="${questions[i]['option1']}" name="radio">
                <span class="checkmark"></span>
            </label>
            <label class="options">${questions[i]['option2']}
                <input type="radio" value="${questions[i]['option2']}" name="radio">
                <span class="checkmark"></span>
            </label>
            <label class="options">${questions[i]['option3']}
                <input type="radio" value="${questions[i]['option3']}" name="radio">
                <span class="checkmark"></span>
            </label>
            <label class="options">${questions[i]['option4']}
                <input type="radio" value="${questions[i]['option4']}" name="radio">
                <span class="checkmark"></span>
            </label>
        </div>
        `;

        document.getElementById("question").innerHTML = html;
}

// .............COUNTER
// Set the date we're counting down to
let date = new Date()
var countDownDate = date.setTime(date.getTime() + 2 * 60 * 60 * 1000);
// var countDownDate = new Date("Dec 20, 2022 15:37:25").getTime();

// Update the count down every 1 second
var x = setInterval(function() {

  // Get today's date and time
  var now = new Date().getTime();

  // Find the distance between now and the count down date
  var distance = countDownDate - now;

  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

  // Display the result in the element with id="demo"
  document.getElementById("demo").innerHTML =  hours + "h "
  + minutes + "m " + seconds + "s ";

  // If the count down is finished, write some text
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("demo").innerHTML = "EXPIRED";
  }
}, 1000);
</script>

</html>