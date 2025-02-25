
$(document).ready(function () {

    // let questionaire;

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: "/api/questionaires/fetch",
        type: "GET",
        dataType: "json",
        success: function (response) {

            console.log(response);
        },
        error: function (xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
});

const surveyJSON = {
    title: "Entebbe International Airport Survey",
    description: "Please take a few minutes to share your experience at the airport.",
    pages: [
        {
            name: "Facility Feedback",
            elements: [
                {
                    type: "rating",
                    name: "cleanliness_maintenance",
                    title: "How would you rate the overall cleanliness and maintenance of facilities available at the airport premises?",
                    isRequired: false,
                    rateMin: 1,
                    rateMax: 10
                },
                {
                    type: "boolean",
                    name: "facilities_lacking",
                    title: "Were there any specific facilities or amenities you felt were lacking or could be improved?",
                    isRequired: false
                },
                {
                    type: "text",
                    name: "describe_lacking_facilities",
                    title: "Kindly describe to us where exactly you felt something was lacking or could be improved.",
                    isRequired: false,
                    visibleIf: "{facilities_lacking} = true"
                },
                {
                    type: "rating",
                    name: "accessibility_disabilities",
                    title: "How satisfied were you with the accessibility of facilities for passengers with disabilities?",
                    isRequired: false,
                    rateValues: [
                        { value: 1, text: "😡" },
                        { value: 2, text: "🙁" },
                        { value: 3, text: "😐" },
                        { value: 4, text: "🙂" },
                        { value: 5, text: "😍" }
                    ]
                },
                {
                    type: "rating",
                    name: "parking_facilities",
                    title: "How convenient did you find the parking facilities and their proximity to the terminal?",
                    isRequired: false,
                    rateValues: [
                        { value: 1, text: "😡" },
                        { value: 2, text: "🙁" },
                        { value: 3, text: "😐" },
                        { value: 4, text: "🙂" },
                        { value: 5, text: "😍" }
                    ]
                },
                {
                    type: "radiogroup",
                    name: "accessibility_travelers",
                    title: "How would you rate the accessibility of the airport for pedestrians and travelers with luggage?",
                    isRequired: false,
                    choices: [
                        "Excellent",
                        "Good",
                        "Average",
                        "Poor",
                        "Very Poor"
                    ]
                }
            ]
        },
        {
            name: "Check-in Experience",
            elements: [
                {
                    type: "boolean",
                    name: "delays_queues",
                    title: "Did you experience any delays or long queues during the check-in process?",
                    isRequired: false
                },
                {
                    type: "dropdown",
                    name: "time_taken_delays",
                    title: "How long does it usually take?",
                    isRequired: false,
                    visibleIf: "{delays_queues} = true",
                    choices: [
                        "Less than 10 minutes",
                        "10-20 minutes",
                        "20-30 minutes",
                        "More than 30 minutes"
                    ]
                },
                {
                    type: "rating",
                    name: "assistance_staff",
                    title: "How satisfied were you with the availability of assistance from staff during check-in?",
                    isRequired: false,
                    rateValues: [
                        { value: 1, text: "😡" },
                        { value: 2, text: "🙁" },
                        { value: 3, text: "😐" },
                        { value: 4, text: "🙂" },
                        { value: 5, text: "😍" }
                    ]
                },
                {
                    type: "boolean",
                    name: "documents_received",
                    title: "Did you receive all necessary documents (boarding pass, baggage tags, etc.) promptly during check-in?",
                    isRequired: false
                },
                {
                    type: "dropdown",
                    name: "time_taken_documents",
                    title: "How long does it usually take?",
                    isRequired: false,
                    visibleIf: "{documents_received} = false",
                    choices: [
                        "Less than 10 minutes",
                        "10-20 minutes",
                        "20-30 minutes",
                        "More than 30 minutes"
                    ]
                },
                {
                    type: "boolean",
                    name: "informed_updates",
                    title: "Were you informed about any changes or updates regarding your flight during the check-in process?",
                    isRequired: false
                }
            ]
        },
        {
            name: "Baggage and Airport Rating",
            elements: [
                {
                    type: "rating",
                    name: "baggage_handling",
                    title: "How would you rate the overall baggage handling experience?",
                    isRequired: false,
                    rateMin: 1,
                    rateMax: 10
                },
                {
                    type: "rating",
                    name: "airport_rating",
                    title: "How would you rate the Ugandan Airport?",
                    isRequired: false,
                    rateMax: 5,
                    minRateDescription: "1 star",
                    maxRateDescription: "5 stars"
                },
                {
                    type: "text",
                    name: "email_address",
                    title: "Please fill in your email so that we can get back to you",
                    isRequired: false,
                    inputType: "email",
                    placeholder: "your.email@example.com"
                }
            ]
        }
    ]
};

Survey.StylesManager.applyTheme("defaultV2");

const survey = new Survey.Model(surveyJSON);


const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

survey.onComplete.add(function (result) {
    console.log(result.data);

    var surveyData = result.data;

    fetch('/survey/bufb8wpimY/fill/o0SsrY8RcW/ucaa', {
        method: 'POST',  // HTTP request method
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify(surveyData)  // Convert survey data to JSON string
    })
        .then(response => {
            if (response.ok) {
                // Show the second overlay
                document.getElementById('secondOverlay').style.display = 'flex';

                // hide the main content
                document.getElementById('mainContent').style.display = 'none';
                return response.json();
            }
            throw new Error('Network response was not ok.');
        })
        .then(data => {
            console.log("Survey results successfully sent:", data);
        })
        .catch(error => {
            console.error("Failed to send survey results:", error);
        });
});

document.addEventListener("DOMContentLoaded", function () {
    survey.render(document.getElementById("caa-form"));
});


// Landing page when the page starts
document.getElementById('startButton').addEventListener('click', function () {

    $('#loader').fadeOut(500, function () {
        // $('.selection-screen').fadeOut(500, function() {
        $('.options-screen').fadeIn(500);
        $('#returnee-btn').animate({ left: '0' }, 500);
        $('#departure-btn').delay(200).animate({ left: '0' }, 500);
        $('#security-btn').delay(400).animate({ left: '0' }, 500);
        $('#stakeholders-btn').delay(600).animate({ left: '0' }, 500);


        // });
        // $('.options-screen').fadeIn(500);
    });
    // Hide the loader
    // document.getElementById('loader').style.display = 'none';
    // $('.options-screen').fadeIn(500);
});

$('.form-btn').on('click', function () {
    $('.options-screen').fadeOut(500, function () {
        $('#mainContent').fadeIn(500);
    })
});

// Show the main content
// document.getElementById('mainContent').style.display = 'block';

document.addEventListener("DOMContentLoaded", function () {
    // Select all label elements that contain emojis
    const emojiLabels = document.querySelectorAll('.sd-rating__item');

    emojiLabels.forEach(label => {
        label.addEventListener('click', function () {
            // Add shake animation class when clicked
            label.classList.add('shake');  // Adding the shake effect

            // Display an alert with the emoji text
            // const emojiText = label.querySelector('.sv-string-viewer').textContent;
            // alert('You clicked on emoji: ' + emojiText);

            // Remove the shake class after the animation ends
            label.addEventListener('animationend', function () {
                label.classList.remove('shake');
            });
        });
    });
});