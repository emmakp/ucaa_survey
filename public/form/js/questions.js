// Passenger Survey
const passengerSurveyJSON = {
    title: "Civil Aviation Authority - Passenger Survey",
    description: "Please share your experience at the Ugandan Airport.",
    pages: [
        {
            name: "Check-in & Security Screening",
            elements: [
                { type: "rating", name: "checkin_efficiency", title: "How would you rate the efficiency and friendliness of the check-in process?", rateMax: 5, isRequired: true },
                { type: "boolean", name: "security_clear", title: "Were the security screening procedures clear and handled professionally?", isRequired: true },
                { type: "text", name: "delays_issues", title: "Did you experience any delays or inconveniences during check-in or security checks? If yes, please describe.", isRequired: false }
            ]
        },
        {
            name: "Terminal Facilities & Services",
            elements: [
                { type: "rating", name: "terminal_cleanliness", title: "How would you rate the cleanliness and comfort of the terminal?", rateMax: 5, isRequired: true },
                { type: "boolean", name: "facilities_adequate", title: "Were airport facilities (e.g., lounges, restrooms, seating, Wi-Fi) adequate and accessible?", isRequired: true },
                { type: "rating", name: "services_quality", title: "How satisfied are you with the availability and quality of food, retail, and other services?", rateMax: 5, isRequired: true }
            ]
        },
        {
            name: "Boarding & Baggage Handling",
            elements: [
                { type: "boolean", name: "boarding_organized", title: "Was the boarding process well-organized and timely?", isRequired: true },
                { type: "text", name: "baggage_issues", title: "Did you experience any issues with baggage claim (e.g., delays, lost luggage, damaged items)? If yes, please describe.", isRequired: false },
                { type: "rating", name: "communication_updates", title: "How would you rate the communication regarding boarding and baggage updates?", rateMax: 5, isRequired: true }
            ]
        },
        {
            name: "Immigration & Customs",
            elements: [
                { type: "boolean", name: "immigration_efficient", title: "Was the immigration process efficient and well-organized?", isRequired: true },
                { type: "boolean", name: "customs_clear", title: "Were customs procedures clearly communicated and easy to follow?", isRequired: true },
                { type: "rating", name: "officer_professionalism", title: "How would you rate the professionalism and courtesy of immigration/customs officers?", rateMax: 5, isRequired: true }
            ]
        },
        {
            name: "Transportation & Accessibility",
            elements: [
                { type: "boolean", name: "signage_clear", title: "Was airport signage and wayfinding clear and easy to follow?", isRequired: true },
                { type: "rating", name: "transport_convenience", title: "How convenient was access to transportation (taxis, shuttles, car rentals, public transport)?", rateMax: 5, isRequired: true },
                { type: "text", name: "transport_delays", title: "Were there any delays or difficulties in reaching or leaving the airport? If yes, please describe.", isRequired: false }
            ]
        },
        {
            name: "Customer Support & Emergency Response",
            elements: [
                { type: "boolean", name: "staff_available", title: "Were airport staff readily available to assist when needed?", isRequired: true },
                { type: "rating", name: "assistance_effectiveness", title: "How would you rate the response time and effectiveness of airport assistance (lost items, medical, or other inquiries)?", rateMax: 5, isRequired: true },
                { type: "rating", name: "emergency_handling", title: "How well did the airport handle any disruptions, delays, or emergencies?", rateMax: 5, isRequired: true }
            ]
        }
    ]
};

// Staff Survey
const staffSurveyJSON = {
    title: "Civil Aviation Authority - Staff Survey",
    description: "Please provide feedback to help improve airport operations.",
    pages: [
        {
            name: "Check-in & Security Screening",
            elements: [
                { type: "boolean", name: "tools_support", title: "Do you have the necessary tools and support to carry out check-in and security screening efficiently?", isRequired: true },
                { type: "boolean", name: "security_clear", title: "Are security procedures clear and easy to follow for both staff and passengers?", isRequired: true },
                { type: "text", name: "checkin_challenges", title: "What challenges do you face in ensuring a smooth check-in process?", isRequired: false }
            ]
        },
        {
            name: "Terminal Facilities & Services",
            elements: [
                { type: "boolean", name: "working_environment", title: "Do you feel the airport provides a comfortable and safe working environment?", isRequired: true },
                { type: "boolean", name: "resources_adequate", title: "Are there sufficient resources and facilities to handle passenger needs efficiently?", isRequired: true },
                { type: "text", name: "service_improvements", title: "What improvements would help enhance airport services and passenger experience?", isRequired: false }
            ]
        },
        {
            name: "Boarding & Baggage Handling",
            elements: [
                { type: "text", name: "boarding_bottlenecks", title: "Are there any bottlenecks or inefficiencies in the boarding process that need improvement?", isRequired: false },
                { type: "boolean", name: "baggage_resources", title: "Do you have sufficient manpower and equipment for smooth baggage handling?", isRequired: true },
                { type: "text", name: "baggage_measures", title: "What measures could be introduced to reduce lost or delayed baggage incidents?", isRequired: false }
            ]
        },
        {
            name: "Immigration & Customs",
            elements: [
                { type: "boolean", name: "resources_sufficient", title: "Do you have the necessary resources to process passengers efficiently?", isRequired: true },
                { type: "text", name: "processing_challenges", title: "What are the main challenges in handling passenger documentation and clearance?", isRequired: false },
                { type: "text", name: "process_improvements", title: "Are there any process improvements that could enhance the flow of passengers?", isRequired: false }
            ]
        },
        {
            name: "Transportation & Accessibility",
            elements: [
                { type: "boolean", name: "transport_options", title: "Are there enough transport options for passengers at peak hours?", isRequired: true },
                { type: "text", name: "accessibility_improvements", title: "What improvements could be made to airport accessibility?", isRequired: false },
                { type: "text", name: "transport_coordination", title: "Do you face challenges coordinating with external transport services?", isRequired: false }
            ]
        },
        {
            name: "Customer Support & Emergency Response",
            elements: [
                { type: "boolean", name: "complaint_procedures", title: "Do you have clear procedures for handling customer complaints and inquiries?", isRequired: true },
                { type: "boolean", name: "emergency_protocols", title: "Are emergency response protocols well-communicated and easy to implement?", isRequired: true },
                { type: "text", name: "support_training", title: "What support or training would help you respond better to passenger needs?", isRequired: false }
            ]
        }
    ]
};

Survey.StylesManager.applyTheme("defaultV2");