const surveyJSON = {
    title: "Civil Aviation Authority Survey",
    description: "Please take a few minutes to share your experience at the airport.",
    pages: [
        {
        name: "Facility Feedback",
        elements: [
            {
            type: "rating",
            name: "cleanliness_maintenance",
            title: "How would you rate the overall cleanliness and maintenance of facilities available at the airport premises?",
            isRequired: true,
            rateMin: 1,
            rateMax: 10
            },
            {
            type: "boolean",
            name: "facilities_lacking",
            title: "Were there any specific facilities or amenities you felt were lacking or could be improved?",
            isRequired: true
            },
            {
            type: "text",
            name: "describe_lacking_facilities",
            title: "Kindly describe to us where exactly you felt something was lacking or could be improved.",
            isRequired: true,
            visibleIf: "{facilities_lacking} = true"
            },
            {
            type: "rating",
            name: "accessibility_disabilities",
            title: "How satisfied were you with the accessibility of facilities for passengers with disabilities?",
            isRequired: true,
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
            isRequired: true,
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
            isRequired: true,
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
            isRequired: true
            },
            {
            type: "dropdown",
            name: "time_taken_delays",
            title: "How long does it usually take?",
            isRequired: true,
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
            isRequired: true,
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
            isRequired: true
            },
            {
            type: "dropdown",
            name: "time_taken_documents",
            title: "How long does it usually take?",
            isRequired: true,
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
            isRequired: true
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
            isRequired: true,
            rateMin: 1,
            rateMax: 10
            },
            {
            type: "rating",
            name: "airport_rating",
            title: "How would you rate the Ugandan Airport?",
            isRequired: true,
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
survey.onComplete.add(function (result) {
    // Show the second overlay
    document.getElementById('secondOverlay').style.display = 'flex';
  
    // hide the main content
    document.getElementById('mainContent').style.display = 'none';
});

document.addEventListener("DOMContentLoaded", function() {
    survey.render(document.getElementById("caa-form"));
});