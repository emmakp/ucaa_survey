<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Progress</title>
    <link rel="stylesheet" href="{{ asset('form/css/style2.css') }}">
    <link rel="stylesheet" href="{{ asset('form/css/slider.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('form/css/theme.css') }}">
    <script src="https://unpkg.com/survey-core/survey.core.min.js"></script>
    <script type="text/javascript" src="https://unpkg.com/survey-js-ui/survey-js-ui.min.js"></script>
    <script type="text/javascript" src="{{ asset('form/js/slider.js') }}"></script>
    <style>
        #jurisdictionOverlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            color: white;
            z-index: 1000;
        }
        #jurisdictionOverlay button {
            margin: 10px;
            padding: 10px 20px;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <!-- Loader Section -->
    <div id="loader" @if(isset($jurisdiction)) style="display: none;" @endif>
        <img src="{{ asset('form/img/welcome_1.gif') }}" alt="Loading..." id="loaderGif">
        <button id="startButton">Start</button>
    </div>

    <!-- Jurisdiction Selection Overlay -->
    <div id="jurisdictionOverlay" @if(isset($jurisdiction)) style="display: none;" @else style="display: flex;" @endif>
        <h2>Are you a Passenger or Staff?</h2>
        <button id="passengerButton">Passenger</button>
        <button id="staffButton">Staff</button>
    </div>

    <!-- Secondary Overlay Section -->
    <div id="secondOverlay" style="display: none;">
        <img src="{{ asset('form/img/thank you.gif') }}" alt="Loading..." id="loaderGif2">
        <button id="endButton">Connect to Wifi</button>
    </div>

    <!-- Main Survey Content -->
    <div id="mainContent" @if(isset($jurisdiction)) style="display: block;" @else style="display: none;" @endif>
        <div class="row">
            <div class="col-8">
                <div class="container">
                    <img src="{{ asset('form/img/caa-uganda-logo.png') }}" alt="">
                    <div id="caa-form"></div>
                </div>
            </div>
            <div class="col-4">
                <div id="slider">
                    <ul>
                        <li class="slide1"><img src="{{ asset('form/img/Civil-Aviation-Authority-offices.jpg') }}" alt=""></li>
                        <li class="slide2"><img src="{{ asset('form/img/slider_1.jpeg') }}" alt=""></li>
                        <li class="slide3"><img src="{{ asset('form/img/slider_2.jpeg') }}" alt=""></li>
                        <li class="slide4"><img src="{{ asset('form/img/slider_3.jpg') }}" alt=""></li>
                        <li class="slide5"><img src="{{ asset('form/img/slider_4.jpeg') }}" alt=""></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('form/js/questions.js') }}"></script>
    <script>
        const surveyId = "{{ $questionaire->survey_id ?? 1 }}";
        const questionaireId = "{{ $questionaire->obfuscator ?? 'default-id' }}";
        const jurisdiction = "{{ $jurisdiction ?? '' }}";

        document.getElementById('startButton')?.addEventListener('click', function() {
            document.getElementById('loader').style.display = 'none';
            document.getElementById('jurisdictionOverlay').style.display = 'flex';
        });

        document.getElementById('passengerButton')?.addEventListener('click', function() {
            window.location.href = `/survey/${surveyId}/${questionaireId}/passenger`;
        });

        document.getElementById('staffButton')?.addEventListener('click', function() {
            window.location.href = `/survey/${surveyId}/${questionaireId}/staff`;
        });

        if (jurisdiction) {
            const survey = new Survey.Model(jurisdiction === 'passenger' ? passengerSurveyJSON : staffSurveyJSON);
            survey.onComplete.add(function (result) {
                fetch(`/survey/${surveyId}/fill/${questionaireId}/ucaa`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify(result.data)
                }).then(() => {
                    document.getElementById('secondOverlay').style.display = 'flex';
                    document.getElementById('mainContent').style.display = 'none';
                });
            });
            survey.render(document.getElementById("caa-form"));
        }
    </script>
</body>
</html>