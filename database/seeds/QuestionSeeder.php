<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Answer;
use App\Question;
use App\Questionaire;
use App\Survey;
use App\Audience;
use App\Title;
use App\UserRoles;
use App\QuestionType;
use App\Departments;
use App\Jurisdiction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class QuestionSeeder extends Seeder
{
    public function run()
    {
        // Disable foreign key checks to allow deletion (MySQL-specific)
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

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
        Departments::query()->delete();

        // Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Seed Departments
        $departments = [
            ['Name' => 'Security', 'Description' => 'Handles security screening and safety'],
            ['Name' => 'Operations', 'Description' => 'Manages check-in, boarding, and baggage'],
            ['Name' => 'Customs and Immigrations', 'Description' => 'Oversees immigration and customs processes'],
            ['Name' => 'Strategic Planning', 'Description' => 'Focuses on transportation and airport strategy'],
            ['Name' => 'Information Desk', 'Description' => 'Provides customer support and emergency response'],
            ['Name' => 'General', 'Description' => 'Covers overall airport experience'],
            ['Name' => 'Stakeholder meeting', 'Description' => 'Handles stakeholder-specific engagements'],
        ];

        foreach ($departments as $dept) {
            Departments::firstOrCreate(
                ['Name' => $dept['Name']],
                ['Description' => $dept['Description'], 'is_active' => true]
            );
        }

        // Seed Jurisdictions
        $jurisdictions = [
            ['name' => 'Travelers', 'is_active' => true],
            ['name' => 'Staff', 'is_active' => true],
        ];
        foreach ($jurisdictions as $j) {
            Jurisdiction::firstOrCreate(
                ['name' => $j['name']],
                ['is_active' => $j['is_active']]
            );
        }

        // Seed Titles
        Title::create(['TitleName' => 'Mr.', 'Acrynom' => 'MR']);
        Title::create(['TitleName' => 'Mrs.', 'Acrynom' => 'MRS']);
        Title::create(['TitleName' => 'Ms.', 'Acrynom' => 'MS']);
        Title::create(['TitleName' => 'Dr.', 'Acrynom' => 'DR']);

        // Seed User Roles
        UserRoles::create(['RoleName' => 'User']);
        UserRoles::create(['RoleName' => 'Administrator']);

        // Seed User (admin) - Ensure $admin is always defined
        $admin = \App\User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'FirstName' => 'Admin',
                'SecondName' => 'Sudo',
                'username' => 'admin',
                'title' => 2, // Mrs.
                'gender' => 'Female',
                'email_verified_at' => now(),
                'password' => bcrypt('admin@2024'),
                'UserRole' => 2, // Administrator
                'Obfuscator' => Str::random(10),
                'validity' => 1,
            ]
        );

        // Seed New Audiences
        $audiences = [
            'travelers' => Audience::create([
                'title' => 'Travelers',
                'name' => 'travelers',
                'created_by' => $admin->id,
                'obfuscator' => Str::random(10),
                'validity' => true,
            ]),
            'airline_flight_crew' => Audience::create([
                'title' => 'Airline & Flight Crew',
                'name' => 'airline_flight_crew',
                'created_by' => $admin->id,
                'obfuscator' => Str::random(10),
                'validity' => true,
            ]),
            'security_immigration' => Audience::create([
                'title' => 'Security & Immigration Officials',
                'name' => 'security_immigration',
                'created_by' => $admin->id,
                'obfuscator' => Str::random(10),
                'validity' => true,
            ]),
            'airport_operations' => Audience::create([
                'title' => 'Airport Operation & Ground Staff',
                'name' => 'airport_operations',
                'created_by' => $admin->id,
                'obfuscator' => Str::random(10),
                'validity' => true,
            ]),
            'retail_hospitality' => Audience::create([
                'title' => 'Retail & Hospitality Staff',
                'name' => 'retail_hospitality',
                'created_by' => $admin->id,
                'obfuscator' => Str::random(10),
                'validity' => true,
            ]),
            'medical_emergency' => Audience::create([
                'title' => 'Medical & Emergency Services',
                'name' => 'medical_emergency',
                'created_by' => $admin->id,
                'obfuscator' => Str::random(10),
                'validity' => true,
            ]),
            'vip_special' => Audience::create([
                'title' => 'VIP & Special Services',
                'name' => 'vip_special',
                'created_by' => $admin->id,
                'obfuscator' => Str::random(10),
                'validity' => true,
            ]),
            'media_communication' => Audience::create([
                'title' => 'Media & Communication',
                'name' => 'media_communication',
                'created_by' => $admin->id,
                'obfuscator' => Str::random(10),
                'validity' => true,
            ]),
        ];

        // Seed Survey
        $survey = Survey::create([
            'title' => 'Default Airport Stakeholder Survey',
            'obfuscator' => Str::random(10),
            'created_by' => $admin->id,
            'status' => 'active',
            'published' => true,
        ]);

        // Attach all audiences to the survey
        $survey->audiences()->attach(collect($audiences)->pluck('id')->toArray());

        // Seed Questionnaires for each audience
        $questionnaires = [];
        foreach ($audiences as $key => $audience) {
            $questionnaires[$key] = Questionaire::create([
                'obfuscator' => "initial-survey-{$key}",
                'survey_id' => $survey->id,
                'validity' => true,
                'target_audience' => $audience->id,
            ]);
        }

        // Seed Question Types
        $ratingType = QuestionType::create(['type' => 'Rating', 'obfuscator' => Str::random(10)]);
        $booleanType = QuestionType::create(['type' => 'Boolean', 'obfuscator' => Str::random(10)]);
        $textType = QuestionType::create(['type' => 'Text', 'obfuscator' => Str::random(10)]);

        // Seed Questions with updated audience types
        $questions = [
            // Travelers
            ['audience_type' => 'travelers', 'department' => 'Security', 'question' => 'How would you rate the efficiency and speed of the check-in process?', 'question_type' => $ratingType->id, 'is_required' => true],
            ['audience_type' => 'travelers', 'department' => 'Security', 'question' => 'Were airline and airport staff helpful and professional during check-in?', 'question_type' => $booleanType->id, 'is_required' => true],
            ['audience_type' => 'travelers', 'department' => 'Security', 'question' => 'Did you clearly understand security screening procedures before reaching the checkpoint?', 'question_type' => $booleanType->id, 'is_required' => true],
            ['audience_type' => 'travelers', 'department' => 'Operations', 'question' => 'Was the boarding process well-organized and clearly communicated?', 'question_type' => $booleanType->id, 'is_required' => true],
            ['audience_type' => 'travelers', 'department' => 'General', 'question' => 'How would you rate your overall experience at the airport?', 'question_type' => $ratingType->id, 'is_required' => true],

            // Airline & Flight Crew
            ['audience_type' => 'airline_flight_crew', 'department' => 'Operations', 'question' => 'Are there challenges in coordinating with airlines for smooth boarding?', 'question_type' => $textType->id, 'is_required' => false],
            ['audience_type' => 'airline_flight_crew', 'department' => 'Strategic Planning', 'question' => 'Is communication between airport and airline staff efficient?', 'question_type' => $booleanType->id, 'is_required' => true],
            ['audience_type' => 'airline_flight_crew', 'department' => 'General', 'question' => 'How would you rate your overall working experience at the airport?', 'question_type' => $ratingType->id, 'is_required' => true],

            // Security & Immigration Officials
            ['audience_type' => 'security_immigration', 'department' => 'Security', 'question' => 'Are security screening procedures clear, effective, and manageable?', 'question_type' => $booleanType->id, 'is_required' => true],
            ['audience_type' => 'security_immigration', 'department' => 'Customs and Immigrations', 'question' => 'Are there enough personnel at passport control and customs to prevent delays?', 'question_type' => $booleanType->id, 'is_required' => true],
            ['audience_type' => 'security_immigration', 'department' => 'General', 'question' => 'What security or fraud concerns need to be addressed?', 'question_type' => $textType->id, 'is_required' => false],

            // Airport Operation & Ground Staff
            ['audience_type' => 'airport_operations', 'department' => 'Operations', 'question' => 'Do you have the necessary equipment and manpower to handle baggage effectively?', 'question_type' => $booleanType->id, 'is_required' => true],
            ['audience_type' => 'airport_operations', 'department' => 'Operations', 'question' => 'What are the common causes of baggage delays or mishandling?', 'question_type' => $textType->id, 'is_required' => false],
            ['audience_type' => 'airport_operations', 'department' => 'General', 'question' => 'Are there enough staff to handle peak passenger volumes?', 'question_type' => $booleanType->id, 'is_required' => true],

            // Retail & Hospitality Staff
            ['audience_type' => 'retail_hospitality', 'department' => 'Operations', 'question' => 'Are there adequate facilities for staff rest areas and refreshment?', 'question_type' => $booleanType->id, 'is_required' => true],
            ['audience_type' => 'retail_hospitality', 'department' => 'General', 'question' => 'Do you feel valued and supported as an airport staff member?', 'question_type' => $booleanType->id, 'is_required' => true],
            ['audience_type' => 'retail_hospitality', 'department' => 'Operations', 'question' => 'What operational challenges do you face in managing passenger facilities?', 'question_type' => $textType->id, 'is_required' => false],

            // Medical & Emergency Services
            ['audience_type' => 'medical_emergency', 'department' => 'Information Desk', 'question' => 'Are emergency response plans and procedures clear and well-communicated?', 'question_type' => $booleanType->id, 'is_required' => true],
            ['audience_type' => 'medical_emergency', 'department' => 'Information Desk', 'question' => 'What challenges do you face in responding to emergency situations?', 'question_type' => $textType->id, 'is_required' => false],
            ['audience_type' => 'medical_emergency', 'department' => 'General', 'question' => 'How would you rate your overall working experience at the airport?', 'question_type' => $ratingType->id, 'is_required' => true],

            // VIP & Special Services
            ['audience_type' => 'vip_special', 'department' => 'Operations', 'question' => 'Were special assistance services (for disabled, elderly, or VIPs) easy to access?', 'question_type' => $booleanType->id, 'is_required' => true],
            ['audience_type' => 'vip_special', 'department' => 'Strategic Planning', 'question' => 'What improvements could be made to the airport’s accessibility and mobility options?', 'question_type' => $textType->id, 'is_required' => false],
            ['audience_type' => 'vip_special', 'department' => 'General', 'question' => 'Do you feel valued and supported as an airport staff member?', 'question_type' => $booleanType->id, 'is_required' => true],

            // Media & Communication
            ['audience_type' => 'media_communication', 'department' => 'Information Desk', 'question' => 'Are airport announcements and digital screens clear and informative?', 'question_type' => $ratingType->id, 'is_required' => true],
            ['audience_type' => 'media_communication', 'department' => 'Strategic Planning', 'question' => 'How effective is the coordination with external transport service providers?', 'question_type' => $ratingType->id, 'is_required' => true],
            ['audience_type' => 'media_communication', 'department' => 'General', 'question' => 'How can passenger communication and assistance be improved?', 'question_type' => $textType->id, 'is_required' => false],
        ];

        foreach ($questions as $question) {
            Question::create([
                'survey_id' => $survey->id,
                'audience_type' => $question['audience_type'],
                'department' => $question['department'],
                'question' => $question['question'],
                'questionaire_id' => $questionnaires[$question['audience_type']]->id,
                'question_type' => $question['question_type'],
                'is_required' => $question['is_required'],
                'obfuscator' => Str::random(10),
                'validity' => true,
            ]);
        }
    }
}