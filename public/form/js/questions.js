 
 let data = null;
async function get_question() {
      await $.ajax({
        url: '/api/questions', 
        type: 'GET',
        success: function(response) {
              data = response.data;  
            console.log(data); 
        },
        error: function(xhr, status, error) {
            console.log('Error: ' + error);
        }
    });
}

// async function setupSurvey() {
get_question();
 console.log(data)
// setTimeout(() => {
    const surveyJSON = {
    title: "Civil Aviation Authority Survey",
    description: "Please take a few minutes to share your experience at the airport.",
    pages: [
        {
            name: "Accessibility and Convenience",
            elements: [
                {
                    type: "rating",
                    name: "accessibility_travelers",
                    title: 
                    "data[0].question",
                    isRequired: true,
                    rateMin: 1,
                    rateMax: 10
                },
                {
                    type: "rating",
                    name: "checkin_options_convenience",
                    title: "data[1].question",
                    isRequired: true,
                    rateValues: [
                        { value: 1, text: "Poor" },
                        { value: 2, text: "Fair" },
                        { value: 3, text: "Good" },
                        { value: 4, text: "Very Good" },
                        { value: 5, text: "Excellent" }
                    ]
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
                    type: "boolean",
                    name: "facilities_lacking",
                    // title: "Were there any specific facilities or amenities you felt were lacking or could be improved?",
                    title: "data[2].question",
                    isRequired: true
                },
                {
                    type: "text",
                    name: "email_address",
                    title: "Please fill in your email so that we can get back to you (Optional)",
                    // title: "data[3].question",
                    isRequired: false,
                    inputType: "email",
                    placeholder: "your.email@example.com"
                },
                {
                    type: "radiogroup",
                    name: "gender",
                    title: "data[5].question",
                    // title: "What is your gender?",
                    isRequired: true,
                    choices: [
                        "Male",
                        "Female",
                        "Non-binary",
                        "Prefer not to say"
                    ]
                },
                {
                    type: "rating",
                    name: "airport_rating",
                    title: "data[6].question",
                    // title: "How would you rate the Ugandan Airport?",
                    isRequired: true,
                    rateMax: 5,
                    minRateDescription: "1 ⭐",
                    maxRateDescription: "5 ⭐",
                    rateValues: [
                        { value: 1, text: "⭐" },
                        { value: 2, text: "⭐⭐" },
                        { value: 3, text: "⭐⭐⭐" },
                        { value: 4, text: "⭐⭐⭐⭐" },
                        { value: 5, text: "⭐⭐⭐⭐⭐" }
                    ]
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
    
    
    // }
    // setupSurvey();
// }, 1000);