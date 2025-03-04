<?php

namespace Database\Seeders; // Keep commented out or remove

use Illuminate\Database\Seeder;
use App\Answer;
use App\Question;
use App\Questionaire;
use App\Survey;
use App\Audience;
use App\Title;
use App\UserRoles;
use App\QuestionType;

class QuestionSeeder extends Seeder
{
    public function run()
    {
        // Clear dependent records first
        Answer::query()->delete();
        Question::query()->delete();
        Questionaire::query()->delete();
        Survey::query()->delete();
        Audience::query()->delete();
        \App\User::query()->delete();
        Title::query()->delete();
        UserRoles::query()->delete();
        QuestionType::query()->delete();

        // Seed Titles
        Title::create(['TitleName' => 'Mr.', 'Acrynom' => 'MR']);
        Title::create(['TitleName' => 'Mrs.', 'Acrynom' => 'MRS']);
        Title::create(['TitleName' => 'Ms.', 'Acrynom' => 'MS']);
        Title::create(['TitleName' => 'Dr.', 'Acrynom' => 'DR']);

        // Seed User Roles
        UserRoles::create(['RoleName' => 'User']);
        UserRoles::create(['RoleName' => 'Administrator']);

        // Seed User (only if it doesn’t exist)
        if (!\App\User::where('email', 'admin@example.com')->exists()) {
            \App\User::create([
                'FirstName' => 'Admin',
                'SecondName' => 'Sudo',
                'username' => 'admin',
                'title' => 2, // Mrs.
                'gender' => 'Female',
                'email' => 'admin@example.com',
                'email_verified_at' => now(),
                'password' => bcrypt('admin@2024'),
                'UserRole' => 2, // Administrator
                'Obfuscator' => \Illuminate\Support\Str::random(10),
                'validity' => 1,
            ]);
        }

        // Seed Audiences
        Audience::create([
            'title' => 'Passenger',
            'name' => 'Passenger',
            'created_by' => 1,
            'obfuscator' => \Illuminate\Support\Str::random(10),
            'validity' => true,
        ]);
        Audience::create([
            'title' => 'Staff',
            'name' => 'Staff',
            'created_by' => 1,
            'obfuscator' => \Illuminate\Support\Str::random(10),
            'validity' => true,
        ]);

        // Seed Surveys
        $survey = Survey::create([
            'title' => 'Passenger Survey',
            'obfuscator' => \Illuminate\Support\Str::random(10),
            'created_by' => 1,
            'status' => 'active',
            'published' => true,
        ]);

        // Seed Questionaires
        if (!Questionaire::where('obfuscator', 'initial-survey')->exists()) {
            $questionaire = Questionaire::create([
                'obfuscator' => 'initial-survey',
                'survey_id' => $survey->id,
                'validity' => true,
                'target_audience' => 1,
            ]);
        } else {
            $questionaire = Questionaire::where('obfuscator', 'initial-survey')->first();
        }

        // Seed Question Types
        QuestionType::create(['type' => 'Rating', 'obfuscator' => \Illuminate\Support\Str::random(10)]);
        QuestionType::create(['type' => 'Boolean', 'obfuscator' => \Illuminate\Support\Str::random(10)]);
        QuestionType::create(['type' => 'Text', 'obfuscator' => \Illuminate\Support\Str::random(10)]);

        // Seed Questions with Departments
        $questions = [
            // 1. Check-in & Security Screening (Security)
            ['audience_type' => 'passenger', 'department' => 'Security', 'question' => 'How would you rate the efficiency and speed of the check-in process?', 'question_type' => 1, 'is_required' => true], // Rating
            ['audience_type' => 'passenger', 'department' => 'Security', 'question' => 'Were airline and airport staff helpful and professional during check-in?', 'question_type' => 2, 'is_required' => true], // Boolean
            ['audience_type' => 'passenger', 'department' => 'Security', 'question' => 'Did you clearly understand security screening procedures before reaching the checkpoint?', 'question_type' => 2, 'is_required' => true], // Boolean
            ['audience_type' => 'passenger', 'department' => 'Security', 'question' => 'How would you rate the professionalism and courtesy of security personnel?', 'question_type' => 1, 'is_required' => true], // Rating
            ['audience_type' => 'passenger', 'department' => 'Security', 'question' => 'Did you experience any delays, confusion, or inconvenience during security screening?', 'question_type' => 3, 'is_required' => false], // Text
            ['audience_type' => 'passenger', 'department' => 'Security', 'question' => 'Was the baggage screening process well-organized and efficient?', 'question_type' => 2, 'is_required' => true], // Boolean
            ['audience_type' => 'staff', 'department' => 'Security', 'question' => 'Are there enough counters and personnel to handle peak hours efficiently?', 'question_type' => 2, 'is_required' => true], // Boolean
            ['audience_type' => 'staff', 'department' => 'Security', 'question' => 'Do you have the necessary tools and training to assist passengers smoothly?', 'question_type' => 2, 'is_required' => true], // Boolean
            ['audience_type' => 'staff', 'department' => 'Security', 'question' => 'What challenges do you face in ensuring a smooth check-in process?', 'question_type' => 3, 'is_required' => false], // Text
            ['audience_type' => 'staff', 'department' => 'Security', 'question' => 'Are security screening procedures clear, effective, and manageable?', 'question_type' => 2, 'is_required' => true], // Boolean
            ['audience_type' => 'staff', 'department' => 'Security', 'question' => 'What improvements could be made to reduce delays at security checkpoints?', 'question_type' => 3, 'is_required' => false], // Text
            ['audience_type' => 'staff', 'department' => 'Security', 'question' => 'Are there any security threats or operational challenges that need urgent attention?', 'question_type' => 3, 'is_required' => false], // Text

            // 2. Terminal Facilities & Services (Operations)
            ['audience_type' => 'passenger', 'department' => 'Operations', 'question' => 'How would you rate the cleanliness of the terminal, including restrooms?', 'question_type' => 1, 'is_required' => true], // Rating
            ['audience_type' => 'passenger', 'department' => 'Operations', 'question' => 'Were waiting areas comfortable, with adequate seating and facilities?', 'question_type' => 2, 'is_required' => true], // Boolean
            ['audience_type' => 'passenger', 'department' => 'Operations', 'question' => 'How satisfied are you with the availability of charging ports and Wi-Fi connectivity?', 'question_type' => 1, 'is_required' => true], // Rating
            ['audience_type' => 'passenger', 'department' => 'Operations', 'question' => 'Were food, beverage, and retail options adequate in terms of quality and variety?', 'question_type' => 1, 'is_required' => true], // Rating
            ['audience_type' => 'passenger', 'department' => 'Operations', 'question' => 'Was signage clear and easy to follow throughout the airport?', 'question_type' => 2, 'is_required' => true], // Boolean
            ['audience_type' => 'passenger', 'department' => 'Operations', 'question' => 'Were special assistance services (for disabled, elderly, or families with children) easy to access?', 'question_type' => 2, 'is_required' => true], // Boolean
            ['audience_type' => 'staff', 'department' => 'Operations', 'question' => 'Are there adequate facilities for staff rest areas and refreshment?', 'question_type' => 2, 'is_required' => true], // Boolean
            ['audience_type' => 'staff', 'department' => 'Operations', 'question' => 'What operational challenges do you face in managing passenger facilities?', 'question_type' => 3, 'is_required' => false], // Text
            ['audience_type' => 'staff', 'department' => 'Operations', 'question' => 'Are maintenance teams responding quickly to facility issues?', 'question_type' => 2, 'is_required' => true], // Boolean
            ['audience_type' => 'staff', 'department' => 'Operations', 'question' => 'Is signage effective in reducing passenger confusion and congestion?', 'question_type' => 2, 'is_required' => true], // Boolean
            ['audience_type' => 'staff', 'department' => 'Operations', 'question' => 'What improvements could be made to the overall passenger experience in the terminal?', 'question_type' => 3, 'is_required' => false], // Text
            ['audience_type' => 'staff', 'department' => 'Operations', 'question' => 'Do you receive frequent passenger complaints about specific terminal services?', 'question_type' => 3, 'is_required' => false], // Text

            // 3. Boarding & Baggage Handling (Operations)
            ['audience_type' => 'passenger', 'department' => 'Operations', 'question' => 'Was the boarding process well-organized and clearly communicated?', 'question_type' => 2, 'is_required' => true], // Boolean
            ['audience_type' => 'passenger', 'department' => 'Operations', 'question' => 'Did you experience any delays, confusion, or issues during boarding?', 'question_type' => 3, 'is_required' => false], // Text
            ['audience_type' => 'passenger', 'department' => 'Operations', 'question' => 'How would you rate the efficiency of baggage claim and delivery?', 'question_type' => 1, 'is_required' => true], // Rating
            ['audience_type' => 'passenger', 'department' => 'Operations', 'question' => 'Did your baggage arrive in good condition without damage or loss?', 'question_type' => 2, 'is_required' => true], // Boolean
            ['audience_type' => 'passenger', 'department' => 'Operations', 'question' => 'Were lost or delayed baggage issues handled professionally and efficiently?', 'question_type' => 2, 'is_required' => true], // Boolean
            ['audience_type' => 'passenger', 'department' => 'Operations', 'question' => 'Was there enough overhead bin space for your carry-on luggage?', 'question_type' => 2, 'is_required' => true], // Boolean
            ['audience_type' => 'staff', 'department' => 'Operations', 'question' => 'Are there challenges in coordinating with airlines for smooth boarding?', 'question_type' => 3, 'is_required' => false], // Text
            ['audience_type' => 'staff', 'department' => 'Operations', 'question' => 'Do you have the necessary equipment and manpower to handle baggage effectively?', 'question_type' => 2, 'is_required' => true], // Boolean
            ['audience_type' => 'staff', 'department' => 'Operations', 'question' => 'What are the common causes of baggage delays or mishandling?', 'question_type' => 3, 'is_required' => false], // Text
            ['audience_type' => 'staff', 'department' => 'Operations', 'question' => 'Are lost baggage reporting and resolution systems working efficiently?', 'question_type' => 2, 'is_required' => true], // Boolean
            ['audience_type' => 'staff', 'department' => 'Operations', 'question' => 'Do boarding gates have sufficient space and resources to handle peak traffic?', 'question_type' => 2, 'is_required' => true], // Boolean
            ['audience_type' => 'staff', 'department' => 'Operations', 'question' => 'How can the boarding process be improved for both staff and passengers?', 'question_type' => 3, 'is_required' => false], // Text

            // 4. Immigration & Customs (Customs and Immigrations)
            ['audience_type' => 'passenger', 'department' => 'Customs and Immigrations', 'question' => 'Was the immigration process quick and efficient?', 'question_type' => 2, 'is_required' => true], // Boolean
            ['audience_type' => 'passenger', 'department' => 'Customs and Immigrations', 'question' => 'Were immigration officers professional and courteous?', 'question_type' => 1, 'is_required' => true], // Rating
            ['audience_type' => 'passenger', 'department' => 'Customs and Immigrations', 'question' => 'Were customs procedures clear, with proper guidance for passengers?', 'question_type' => 2, 'is_required' => true], // Boolean
            ['audience_type' => 'passenger', 'department' => 'Customs and Immigrations', 'question' => 'Were there any unnecessary delays or difficulties in passport control?', 'question_type' => 3, 'is_required' => false], // Text
            ['audience_type' => 'passenger', 'department' => 'Customs and Immigrations', 'question' => 'Did you feel safe and well-treated during the entire immigration process?', 'question_type' => 2, 'is_required' => true], // Boolean
            ['audience_type' => 'passenger', 'department' => 'Customs and Immigrations', 'question' => 'Were customs checks fair, transparent, and conducted with minimal inconvenience?', 'question_type' => 2, 'is_required' => true], // Boolean
            ['audience_type' => 'staff', 'department' => 'Customs and Immigrations', 'question' => 'Are immigration and customs facilities sufficient to handle passenger volumes?', 'question_type' => 2, 'is_required' => true], // Boolean
            ['audience_type' => 'staff', 'department' => 'Customs and Immigrations', 'question' => 'Are there enough personnel at passport control and customs to prevent delays?', 'question_type' => 2, 'is_required' => true], // Boolean
            ['audience_type' => 'staff', 'department' => 'Customs and Immigrations', 'question' => 'What challenges do you face in processing passengers quickly and efficiently?', 'question_type' => 3, 'is_required' => false], // Text
            ['audience_type' => 'staff', 'department' => 'Customs and Immigrations', 'question' => 'Do passengers frequently face confusion over immigration/customs procedures?', 'question_type' => 2, 'is_required' => true], // Boolean
            ['audience_type' => 'staff', 'department' => 'Customs and Immigrations', 'question' => 'Are there any improvements needed in coordination with airlines and border control?', 'question_type' => 3, 'is_required' => false], // Text
            ['audience_type' => 'staff', 'department' => 'Customs and Immigrations', 'question' => 'What security or fraud concerns need to be addressed?', 'question_type' => 3, 'is_required' => false], // Text

            // 5. Transportation & Accessibility (Strategic Planning)
            ['audience_type' => 'passenger', 'department' => 'Strategic Planning', 'question' => 'Was it easy to find transportation options from the airport (taxis, buses, shuttles)?', 'question_type' => 2, 'is_required' => true], // Boolean
            ['audience_type' => 'passenger', 'department' => 'Strategic Planning', 'question' => 'How convenient and accessible were airport parking areas?', 'question_type' => 1, 'is_required' => true], // Rating
            ['audience_type' => 'passenger', 'department' => 'Strategic Planning', 'question' => 'Was the signage for transportation and parking clear and easy to follow?', 'question_type' => 2, 'is_required' => true], // Boolean
            ['audience_type' => 'passenger', 'department' => 'Strategic Planning', 'question' => 'Did you face any difficulties with accessibility (for disabled passengers, heavy luggage, etc.)?', 'question_type' => 3, 'is_required' => false], // Text
            ['audience_type' => 'passenger', 'department' => 'Strategic Planning', 'question' => 'Were taxi services, ride-sharing, and public transport reliable and fairly priced?', 'question_type' => 1, 'is_required' => true], // Rating
            ['audience_type' => 'passenger', 'department' => 'Strategic Planning', 'question' => 'Were there any delays or difficulties in reaching or leaving the airport?', 'question_type' => 3, 'is_required' => false], // Text
            ['audience_type' => 'staff', 'department' => 'Strategic Planning', 'question' => 'Are there challenges in managing transportation and passenger flow outside the terminal?', 'question_type' => 3, 'is_required' => false], // Text
            ['audience_type' => 'staff', 'department' => 'Strategic Planning', 'question' => 'Are there enough parking spaces and clear traffic control measures?', 'question_type' => 2, 'is_required' => true], // Boolean
            ['audience_type' => 'staff', 'department' => 'Strategic Planning', 'question' => 'What improvements could be made to the airport’s accessibility and mobility options?', 'question_type' => 3, 'is_required' => false], // Text
            ['audience_type' => 'staff', 'department' => 'Strategic Planning', 'question' => 'Do you receive frequent passenger complaints about transport services?', 'question_type' => 2, 'is_required' => true], // Boolean
            ['audience_type' => 'staff', 'department' => 'Strategic Planning', 'question' => 'How effective is the coordination with external transport service providers?', 'question_type' => 1, 'is_required' => true], // Rating
            ['audience_type' => 'staff', 'department' => 'Strategic Planning', 'question' => 'Are there any infrastructure gaps in airport accessibility?', 'question_type' => 3, 'is_required' => false], // Text

            // 6. Customer Support & Emergency Response (Information Desk)
            ['audience_type' => 'passenger', 'department' => 'Information Desk', 'question' => 'Were customer service counters easily accessible, with helpful and responsive staff?', 'question_type' => 2, 'is_required' => true], // Boolean
            ['audience_type' => 'passenger', 'department' => 'Information Desk', 'question' => 'How satisfied were you with the handling of lost items, flight inquiries, or special requests?', 'question_type' => 1, 'is_required' => true], // Rating
            ['audience_type' => 'passenger', 'department' => 'Information Desk', 'question' => 'Did the airport provide clear and timely updates on flight delays or changes?', 'question_type' => 2, 'is_required' => true], // Boolean
            ['audience_type' => 'passenger', 'department' => 'Information Desk', 'question' => 'Were medical assistance or emergency response teams readily available?', 'question_type' => 2, 'is_required' => true], // Boolean
            ['audience_type' => 'passenger', 'department' => 'Information Desk', 'question' => 'Did you feel safe in case of an emergency (fire, security threat, medical issue)?', 'question_type' => 2, 'is_required' => true], // Boolean
            ['audience_type' => 'passenger', 'department' => 'Information Desk', 'question' => 'Were airport announcements and digital screens clear and informative?', 'question_type' => 1, 'is_required' => true], // Rating
            ['audience_type' => 'staff', 'department' => 'Information Desk', 'question' => 'Do you receive adequate training in customer service and crisis management?', 'question_type' => 2, 'is_required' => true], // Boolean
            ['audience_type' => 'staff', 'department' => 'Information Desk', 'question' => 'Are emergency response plans and procedures clear and well-communicated?', 'question_type' => 2, 'is_required' => true], // Boolean
            ['audience_type' => 'staff', 'department' => 'Information Desk', 'question' => 'Are there enough personnel to handle passenger inquiries and complaints?', 'question_type' => 2, 'is_required' => true], // Boolean
            ['audience_type' => 'staff', 'department' => 'Information Desk', 'question' => 'What challenges do you face in responding to emergency situations?', 'question_type' => 3, 'is_required' => false], // Text
            ['audience_type' => 'staff', 'department' => 'Information Desk', 'question' => 'How can passenger communication and assistance be improved?', 'question_type' => 3, 'is_required' => false], // Text
            ['audience_type' => 'staff', 'department' => 'Information Desk', 'question' => 'Are there any recurring issues in lost-and-found or passenger support?', 'question_type' => 3, 'is_required' => false], // Text

            // 7. Flight Experience & Airline Coordination (Strategic Planning)
            ['audience_type' => 'passenger', 'department' => 'Strategic Planning', 'question' => 'Was the flight information (departure times, gate changes) clearly communicated?', 'question_type' => 2, 'is_required' => true], // Boolean
            ['audience_type' => 'passenger', 'department' => 'Strategic Planning', 'question' => 'Were airline staff and airport personnel helpful in resolving any issues?', 'question_type' => 2, 'is_required' => true], // Boolean
            ['audience_type' => 'passenger', 'department' => 'Strategic Planning', 'question' => 'How smoothly was the overall boarding and flight departure process?', 'question_type' => 1, 'is_required' => true], // Rating
            ['audience_type' => 'passenger', 'department' => 'Strategic Planning', 'question' => 'Did you experience any flight delays, and were they communicated effectively?', 'question_type' => 3, 'is_required' => false], // Text
            ['audience_type' => 'passenger', 'department' => 'Strategic Planning', 'question' => 'Was there a comfortable waiting experience before boarding?', 'question_type' => 2, 'is_required' => true], // Boolean
            ['audience_type' => 'passenger', 'department' => 'Strategic Planning', 'question' => 'Were there sufficient updates on baggage and flight status after arrival?', 'question_type' => 2, 'is_required' => true], // Boolean
            ['audience_type' => 'staff', 'department' => 'Strategic Planning', 'question' => 'Is communication between airport and airline staff efficient?', 'question_type' => 2, 'is_required' => true], // Boolean
            ['audience_type' => 'staff', 'department' => 'Strategic Planning', 'question' => 'Are there any bottlenecks in coordinating departures and arrivals?', 'question_type' => 3, 'is_required' => false], // Text
            ['audience_type' => 'staff', 'department' => 'Strategic Planning', 'question' => 'Do passengers frequently miss flights due to airport inefficiencies?', 'question_type' => 2, 'is_required' => true], // Boolean
            ['audience_type' => 'staff', 'department' => 'Strategic Planning', 'question' => 'Are there sufficient airline counters and personnel for check-ins?', 'question_type' => 2, 'is_required' => true], // Boolean
            ['audience_type' => 'staff', 'department' => 'Strategic Planning', 'question' => 'What are the biggest challenges in handling flight delays?', 'question_type' => 3, 'is_required' => false], // Text
            ['audience_type' => 'staff', 'department' => 'Strategic Planning', 'question' => 'How can coordination between airlines and airport operations be improved?', 'question_type' => 3, 'is_required' => false], // Text

            // 8. Overall Airport Experience & Suggestions (General)
            ['audience_type' => 'passenger', 'department' => 'General', 'question' => 'How would you rate your overall experience at the airport?', 'question_type' => 1, 'is_required' => true], // Rating
            ['audience_type' => 'passenger', 'department' => 'General', 'question' => 'What were the best aspects of your experience?', 'question_type' => 3, 'is_required' => false], // Text
            ['audience_type' => 'passenger', 'department' => 'General', 'question' => 'What areas do you think need improvement?', 'question_type' => 3, 'is_required' => false], // Text
            ['audience_type' => 'passenger', 'department' => 'General', 'question' => 'Would you recommend this airport to other travelers?', 'question_type' => 2, 'is_required' => true], // Boolean
            ['audience_type' => 'passenger', 'department' => 'General', 'question' => 'Were there any specific incidents or staff members that stood out positively or negatively?', 'question_type' => 3, 'is_required' => false], // Text
            ['audience_type' => 'passenger', 'department' => 'General', 'question' => 'Do you have any suggestions for making the airport experience better?', 'question_type' => 3, 'is_required' => false], // Text
            ['audience_type' => 'staff', 'department' => 'General', 'question' => 'How would you rate your overall working experience at the airport?', 'question_type' => 1, 'is_required' => true], // Rating
            ['audience_type' => 'staff', 'department' => 'General', 'question' => 'What are the biggest operational challenges you face?', 'question_type' => 3, 'is_required' => false], // Text
            ['audience_type' => 'staff', 'department' => 'General', 'question' => 'Do you feel valued and supported as an airport staff member?', 'question_type' => 2, 'is_required' => true], // Boolean
            ['audience_type' => 'staff', 'department' => 'General', 'question' => 'Are there enough staff to handle peak passenger volumes?', 'question_type' => 2, 'is_required' => true], // Boolean
            ['audience_type' => 'staff', 'department' => 'General', 'question' => 'What improvements would make your job easier and more efficient?', 'question_type' => 3, 'is_required' => false], // Text
            ['audience_type' => 'staff', 'department' => 'General', 'question' => 'Do you have any suggestions for improving airport operations?', 'question_type' => 3, 'is_required' => false], // Text
        ];

        foreach ($questions as $question) {
            Question::create([
                'survey_id' => $survey->id,
                'audience_type' => $question['audience_type'],
                'department' => $question['department'],
                'question' => $question['question'],
                'questionaire_id' => $questionaire->id,
                'question_type' => $question['question_type'],
                'is_required' => $question['is_required'],
                'obfuscator' => \Illuminate\Support\Str::random(10),
                'validity' => true,
            ]);
        }
    }
}