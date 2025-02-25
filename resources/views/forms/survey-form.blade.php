<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Progess</title>
  <link rel="stylesheet" href="{{ asset('form/css/style2.css')}}">
  <link rel="stylesheet" href="{{ asset('form/css/slider.css')}}">
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  {{-- <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script> --}}
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- <link href="https://unpkg.com/survey-core/defaultV2.min.css" rel="stylesheet" /> -->
  <link rel="stylesheet" href="{{ asset('form/css/theme.css')}}">
  <link rel="stylesheet" href="{{ asset('css/sform.css')}}">
  <script src="https://unpkg.com/survey-core/survey.core.min.js"></script>
  <!-- <script src="https://unpkg.com/survey-vue/survey.vue.min.js"></script> -->
  <script type="text/javascript" src="https://unpkg.com/survey-js-ui/survey-js-ui.min.js"></script>
  <!-- <script src="script.js"></script> -->
  <script type="text/javascript" src="{{ asset('form/js/slider.js')}}"></script>
</head>
<body>
  <!-- Loader Section -->
  <div id="loader">
    <img src="{{ asset('form/img/welcome_1.gif')}}" alt="Loading..." id="loaderGif">
    <button id="startButton">Start</button>
  </div>

  <!-- Secondary Overlay Section -->
  <div id="secondOverlay" style="display: none;">
    <img src="{{ asset('form/img/thank you.gif')}}" alt="Loading..." id= "loaderGif2">
    <button id="endButton">Connect to Wifi</button>
  </div>
  <div class="options-screen hidden">
    <h2>Select a Survey</h2>
    {{-- <button class="form-btn" onclick="location.href='returnee_form.html'" value="return">Returnee Form</button>
    <button class="form-btn" onclick="location.href='departure_form.html'" value="depart">Departure Form</button> --}}
    <button class="form-btn" value="return" id="returnee-btn">Returnee Survey</button>
    <button class="form-btn" value="depart" id="departure-btn">Departure Survey</button>
    <button class="form-btn" value="return" id="security-btn">Security Survey</button>
    <button class="form-btn" value="depart" id="stakeholders-btn">Stakeholders Survey</button>
  </div>
  <div id="mainContent" style="display: none;">
    <div class="row">
      <div class="col-md-7">
        <div class="container">
            <img src="{{ asset('form/img/caa-uganda-logo.png')}}" alt="">
            <div id="caa-form">

            </div>
          </div>
      </div>
        <div class="col-md-5">
          <div id="slider">
            <ul>
              <li class="slide1">
                <img src="{{ asset('form/img/Civil-Aviation-Authority-offices.jpg')}}" alt="">
              </li>
              <li class="slide2">
                <img src="{{ asset('form/img/slider_1.jpeg')}}" alt="">
              </li>
              <li class="slide3">
                <img src="{{ asset('form/img/slider_2.jpeg')}}" alt="">
              </li>
              <li class="slide4">
                <img src="{{ asset('form/img/slider_3.jpg')}}" alt="">
              </li>
              <li class="slide4">
                <img src="{{ asset('form/img/slider_4.jpeg')}}" alt="">
              </li>
             </ul>
          </div>
        </div>
    </div>
  </div>
  <script src="{{ asset('form/js/questions.js')}}"></script>
</body>
</html>