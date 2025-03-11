<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Survey</title>
    <!-- SurveyJS Libraries -->
    <script src="https://unpkg.com/survey-core/survey.core.min.js"></script>
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
               #jurisdictionOverlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            /* background: rgba(0, 0, 0, 0.8); */
            background:  #007bff;
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
            background-color: white;
            color: black;
            border: none;
            border-radius: 5px;
            transition: background-color 0.3s;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        #jurisdictionOverlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    /* background: rgba(0, 0, 0, 0.8); */
    background:  #007bff;
    display: flex;
    justify-content: center; /* Centers children horizontally */
    align-items: center; /* Centers children vertically */
    flex-direction: column;
    color: white;
    z-index: 1000;
}
#jurisdictionOverlay h2 {
    text-align: center; /* Explicitly center text inside h2 */
    width: 100%; /* Ensure it spans the container */
}
        #mainContent { display: none; }
        #secondOverlay { display: none; flex-direction: column; align-items: center; justify-content: center; height: 100vh; }
    </style>
</head>
<body>

   <!-- Loader Section -->
   <div id="loader" @if(isset($jurisdiction)) style="display: none;" @endif>
        <img src="{{ asset('form/img/welcome_1.gif') }}" alt="Loading..." id="loaderGif">
        <button id="startButton">Start</button>
    </div>
    <!-- Jurisdiction Selection Overlay -->
<div id="jurisdictionOverlay" @if(isset($jurisdiction)) style="display: none;" @endif>
    <!-- <h2>Which stakeholder department do you belong to?</h2> -->
    <h2>Which Category  of stakeholder do you belong to?</h2>
    <!-- @foreach (\App\Jurisdiction::active()->get() as $jurisdictionOption)
        <button class="jurisdictionButton" data-jurisdiction="{{ $jurisdictionOption->name }}">{{ $jurisdictionOption->name }}</button>
    @endforeach -->
    @foreach ($audiences as $audience)
    <button class="jurisdictionButton" data-jurisdiction="{{ $audience }}">{{ $audience }}</button>
@endforeach
</div>

    <!-- Thank You Overlay -->
    <div id="secondOverlay">
        <img src="{{ asset('form/img/thank you.gif') }}" alt="Thank You" id="loaderGif2">
        <button id="endButton">Connect to Wifi</button>
    </div>

    <!-- Main Survey Content -->
    <!-- <div id="mainContent" @if(isset($jurisdiction)) style="display: block;" @endif>
        <div class="row">
            <div class="col-8">
                <div class="container">
                    <img src="{{ asset('form/img/caa-uganda-logo.png') }}" alt="CAA Logo" class="mb-4">
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
    </div> -->
    <div id="mainContent" @if(isset($jurisdiction)) style="display: block;" @endif>
    <div class="container">
        <div class="row flex-column flex-md-row">
            <div class="col-12 col-md-8 order-1 order-md-0">
                <div class="container">
                    <img src="{{ asset('form/img/caa-uganda-logo.png') }}" alt="CAA Logo" class="mb-4">
                    <div id="caa-form"></div>
                </div>
            </div>
            <div class="col-12 col-md-4 order-2">
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
</div>
    <script>
        // console.log(Survey.Version);
        // Survey.applyTheme?.("defaultV2");
    // Survey.StylesManager.applyTheme("defaultV2");

    // Default to survey_id = 1 (seeded survey)
//     let surveyId = "{{ $survey_id ?? 1 }}";
//     const questionaireId = "{{ $questionaire->obfuscator ?? 'default-id' }}";
//     const jurisdiction = "{{ $jurisdiction ?? '' }}";

//     document.getElementById('startButton')?.addEventListener('click', function() {
//             document.getElementById('loader').style.display = 'none';
//             document.getElementById('jurisdictionOverlay').style.display = 'flex';
//         });
    
//     // Check if a published survey is requested (e.g., via URL parameter)
//     const urlParams = new URLSearchParams(window.location.search);
//     const requestedSurveyId = urlParams.get('survey_id');
//     if (requestedSurveyId) {
//         fetch(`/survey/${requestedSurveyId}/check-published`, {
//             method: 'GET',
//             headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
//         }).then(response => response.json()).then(data => {
//             if (data.published) {
//                 surveyId = requestedSurveyId; // Use requested survey if published
//             }
//         }).catch(() => {
//             console.log('Defaulting to survey_id = 1');
//         });
//     }

//     console.log('Survey ID:', surveyId, 'Questionnaire ID:', questionaireId, 'Jurisdiction:', jurisdiction);

//     document.addEventListener("DOMContentLoaded", function () {
//     // Survey.StylesManager.applyTheme("defaultV2");
//     // Survey.applyTheme?.("defaultV2");

//     let surveyId = "{{ $survey_id ?? 1 }}";
//     const questionaireId = "{{ $questionaire->obfuscator ?? 'default-id' }}";
//     const jurisdiction = "{{ $jurisdiction ?? '' }}";

//     // Rest of your existing code...

//     if (jurisdiction) {
//         const surveyJson = {!! $surveyJson ?? 'null' !!};
//         if (surveyJson) {
//             console.log("Initializing survey with defaultV2 theme...");
//             const survey = new Survey.Model(surveyJson);
//             survey.render(document.getElementById("caa-form"));
//         }
//     } else {
//         document.getElementById('loader').style.display = 'flex';
//     }
// });

// // Handle dynamic jurisdiction buttons
// document.querySelectorAll('.jurisdictionButton').forEach(button => {
//             button.addEventListener('click', function() {
//                 const selectedJurisdiction = this.getAttribute('data-jurisdiction');
//                 window.location.href = `/survey/${surveyId}/departments/${selectedJurisdiction.toLowerCase()}`;
//             });
//         });

//         // Handle custom jurisdiction
//         document.getElementById('customSubmitButton')?.addEventListener('click', function() {
//             const customJurisdiction = document.getElementById('customJurisdiction').value.trim();
//             if (customJurisdiction) {
//                 // Optionally save to DB via AJAX (see Step 4)
//                 fetch('/jurisdictions/store', {
//                     method: 'POST',
//                     headers: {
//                         'Content-Type': 'application/json',
//                         'X-CSRF-TOKEN': '{{ csrf_token() }}'
//                     },
//                     body: JSON.stringify({ name: customJurisdiction })
//                 }).then(response => response.json()).then(data => {
//                     if (data.success) {
//                         window.location.href = `/survey/${surveyId}/departments/${customJurisdiction.toLowerCase()}`;
//                     }
//                 }).catch(error => console.error('Error saving jurisdiction:', error));
//             } else {
//                 alert('Please enter a custom jurisdiction.');
//             }
//         });

//         if (jurisdiction) {
//             const surveyJson = {!! $surveyJson ?? 'null' !!};
//             if (surveyJson) {
//                 const survey = new Survey.Model(surveyJson);
//                 survey.onComplete.add(function (result) {
//                     console.log('Submitting data:', result.data);
//                     fetch(`/survey/${surveyId}/fill/${questionaireId}/ucaa`, {
//                         method: 'POST',
//                         headers: {
//                             'Content-Type': 'application/json',
//                             'X-CSRF-TOKEN': '{{ csrf_token() }}'
//                         },
//                         body: JSON.stringify(result.data)
//                     })
//                     .then(response => {
//                         if (!response.ok) {
//                             throw new Error('Network response was not ok: ' + response.status);
//                         }
//                         return response.json();
//                     })
//                     .then(data => {
//                         if (data.success) {
//                             document.getElementById('secondOverlay').style.display = 'flex';
//                             document.getElementById('mainContent').style.display = 'none';
//                         } else {
//                             console.error('Submission failed:', data.error);
//                         }
//                     })
//                     .catch(error => console.error('Fetch error:', error));
//                 });
//                 survey.render(document.getElementById("caa-form"));
//             }
//         } else {
//             document.getElementById('loader').style.display = 'flex';
//         }


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