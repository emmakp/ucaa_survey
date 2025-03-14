<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Survey</title>
    <!-- SurveyJS Libraries -->
    <script src="https://unpkg.com/survey-core@latest/survey.core.min.js"></script>
    <script src="https://unpkg.com/survey-knockout@latest/survey.ko.min.js"></script>
    <script src="https://unpkg.com/survey-js-ui/survey-js-ui.min.js"></script>
    <!-- Bootstrap and Custom CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('form/css/style2.css') }}">
    <link rel="stylesheet" href="{{ asset('form/css/slider.css') }}">
    <link rel="stylesheet" href="{{ asset('form/css/theme.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400" rel="stylesheet">
    <!-- Slider JS -->
    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="{{ asset('form/js/slider.js') }}"></script>
    <style>
    /* Full-screen loader */
    #loader {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        z-index: 999;
    }

    /* Full-screen GIF */
    #loaderGif {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover; /* Fills screen, may crop */
        z-index: 1;
    }

    /* Dark overlay */
    #loaderOverlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5); /* Semi-transparent black */
        z-index: 2; /* Above GIF, below content */
    }

    /* Welcome text with animation */
    #welcomeText {
        position: relative;
        z-index: 3; /* Above overlay */
        color: #ffffff;
        font-size: 46px;
        font-weight: 700;
        font-family: 'Roboto', sans-serif;
        text-align: center;
        margin-bottom: 20px;
        animation: panUp 0.5s ease-out forwards;
    }

    /* Centered button with animation */
    #startButton {
        position: relative;
        z-index: 3; /* Above overlay */
        padding: 9px 20px;
        font-size: 18px;
        border: 2px solid #ffffff;
        color: #000000;
        border-radius: 30px;
        cursor: pointer;
        animation: panUp 0.5s ease-out forwards;
    }

    /* #startButton:hover {
        background-color: rgba(255, 255, 255, 0.2); 
    } */

    /* Animation keyframes */
    @keyframes panUp {
        0% {
            transform: translateY(20px);
        }
        100% {
            transform: translateY(0);
        }
    }

    /* Jurisdiction overlay */
    /* #jurisdictionOverlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: url("{{ asset('form/img/welcome.gif') }}");
        background-size: cover;
        background-position: center;
        display: none;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        color: white;
        z-index: 1000;
    } */
    /* Jurisdiction overlay */
#jurisdictionOverlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-image: url("{{ asset('form/img/welcome.gif') }}");
    background-size: cover;
    background-position: center;
    display: none;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    color: white;
    z-index: 1000;
}

/* Dark overlay using ::before */
#jurisdictionOverlay::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5); /* Same opacity as loader */
    z-index: 1; /* Above background, below content */
}

/* Ensure content stays above overlay */
#jurisdictionOverlay h2,
#jurisdictionOverlay button {
    position: relative;
    z-index: 2; /* Above the overlay */
}

    #jurisdictionOverlay button {
        margin: 10px;
        padding: 10px 20px;
        font-size: 16px;
        background-color: white;
        color: black;
        border: none;
        border-radius: 5px;
        transition: background-color 0.3s;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    #jurisdictionOverlay h2 {
        text-align: center;
        width: 100%;
    }

    /* Other elements */
    #mainContent { display: none; }
    #secondOverlay {
        display: none;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 100vh;
        z-index: 1000;
    }
</style>
</head>
<body>

    <!-- Loader Section -->
    <div id="loader" @if(isset($jurisdiction)) style="display: none;" @endif>
        <img src="{{ asset('form/img/welcome.gif') }}" alt="Loading..." id="loaderGif">
        <div id="loaderOverlay"></div> <!-- Dark overlay -->
        <div id="welcomeText">Safety, Security & Service</div>
        <button id="startButton">Take Survey</button>
    </div>

    <!-- Jurisdiction Selection Overlay -->
    <div id="jurisdictionOverlay">
        <h2>Which category of stakeholder do you belong to?</h2>
        @foreach ($audiences as $audience)
            <button class="jurisdictionButton btn btn-md" data-jurisdiction="{{ $audience }}">{{ ucwords(str_replace('_', ' ', $audience)) }}</button>
        @endforeach
    </div>

    <!-- Thank You Overlay -->
    <div id="secondOverlay">
        <img src="{{ asset('form/img/thank you.gif') }}" alt="Thank You" id="loaderGif2">
        <button id="endButton">Connect to Wifi</button>
    </div>

    <!-- Main Survey Content -->
    <div id="mainContent" @if(isset($jurisdiction)) style="display: block;" @endif>
        <div class="container">
            <div class="row flex-column flex-md-row">
                <div class="col-12 col-md-8 order-1 order-md-0">
                    <div class="container">
                        <img src="{{ asset('form/img/caa-uganda-logo.png') }}" alt="CAA Logo" class="mb-4">
                        <div id="caa-form"></div>
                    </div>
                </div>
                <div class="col-12 col-md-4 order-2 d-none d-md-block">
                    <div id="slider">
                        <ul>
                            <li class="slide1"><img src="{{ asset('form/img/Civil-Aviation-Authority-offices.jpg') }}" alt=""></li>
                            <li class="slide2"><img src="{{ asset('form/img/slider_1.jpeg') }}" alt=""></li>
                            <!-- <li class="slide3"><img src="{{ asset('form/img/slider_2.jpeg') }}" alt=""></li>
                            <li class="slide4"><img src="{{ asset('form/img/slider_3.jpg') }}" alt=""></li>
                            <li class="slide5"><img src="{{ asset('form/img/slider_4.jpeg') }}" alt=""></li> -->
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    // Survey.StylesManager.applyTheme("defaultV2");
    document.addEventListener("DOMContentLoaded", function () {
    Survey.StylesManager.applyTheme("defaultV2");

    let surveyId = "{{ $survey_id ?? 1 }}";
    const questionaireId = "{{ $questionaire->obfuscator ?? 'default-id' }}";
    const jurisdiction = "{{ $jurisdiction ?? '' }}";

    // Rest of your existing code...

    if (jurisdiction) {
        const surveyJson = {!! $surveyJson ?? 'null' !!};
        if (surveyJson) {
            console.log("Initializing survey with defaultV2 theme...");
            const survey = new Survey.Model(surveyJson);
            survey.render(document.getElementById("caa-form"));
        }
    } else {
        document.getElementById('loader').style.display = 'flex';
    }
});

    // Default to survey_id = 1 (seeded survey)
    let surveyId = "{{ $survey_id ?? 1 }}";
    const questionaireId = "{{ $questionaire->obfuscator ?? 'default-id' }}";
    const jurisdiction = "{{ $jurisdiction ?? '' }}";

    document.getElementById('startButton')?.addEventListener('click', function() {
            document.getElementById('loader').style.display = 'none';
            document.getElementById('jurisdictionOverlay').style.display = 'flex';
        });
    
    // Check if a published survey is requested (e.g., via URL parameter)
    const urlParams = new URLSearchParams(window.location.search);
    const requestedSurveyId = urlParams.get('survey_id');
    if (requestedSurveyId) {
        fetch(`/survey/${requestedSurveyId}/check-published`, {
            method: 'GET',
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
        }).then(response => response.json()).then(data => {
            if (data.published) {
                surveyId = requestedSurveyId; // Use requested survey if published
            }
        }).catch(() => {
            console.log('Defaulting to survey_id = 1');
        });
    }

    console.log('Survey ID:', surveyId, 'Questionnaire ID:', questionaireId, 'Jurisdiction:', jurisdiction);

// Handle dynamic jurisdiction buttons
document.querySelectorAll('.jurisdictionButton').forEach(button => {
            button.addEventListener('click', function() {
                const selectedJurisdiction = this.getAttribute('data-jurisdiction');
                window.location.href = `/survey/${surveyId}/departments/${selectedJurisdiction.toLowerCase()}`;
            });
        });

        // Handle custom jurisdiction
        document.getElementById('customSubmitButton')?.addEventListener('click', function() {
            const customJurisdiction = document.getElementById('customJurisdiction').value.trim();
            if (customJurisdiction) {
                // Optionally save to DB via AJAX (see Step 4)
                fetch('/jurisdictions/store', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ name: customJurisdiction })
                }).then(response => response.json()).then(data => {
                    if (data.success) {
                        window.location.href = `/survey/${surveyId}/departments/${customJurisdiction.toLowerCase()}`;
                    }
                }).catch(error => console.error('Error saving jurisdiction:', error));
            } else {
                alert('Please enter a custom jurisdiction.');
            }
        });

        if (jurisdiction) {
            const surveyJson = {!! $surveyJson ?? 'null' !!};
            if (surveyJson) {
                const survey = new Survey.Model(surveyJson);
                survey.onComplete.add(function (result) {
                    console.log('Submitting data:', result.data);
                    fetch(`/survey/${surveyId}/fill/${questionaireId}/ucaa`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify(result.data)
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok: ' + response.status);
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            document.getElementById('secondOverlay').style.display = 'flex';
                            document.getElementById('mainContent').style.display = 'none';
                        } else {
                            console.error('Submission failed:', data.error);
                        }
                    })
                    .catch(error => console.error('Fetch error:', error));
                });
                survey.render(document.getElementById("caa-form"));
            }
        } else {
            document.getElementById('loader').style.display = 'flex';
        }
</script>
</body>
</html>