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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class QuestionSeeder extends Seeder
{
    public function run()
    {
        // Disable foreign key checks to allow truncation
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Clear existing records
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
            ['Name' => 'Stakeholder Meeting', 'Description' => 'Handles stakeholder-specific engagements'],
        ];

        foreach ($departments as $dept) {
            Departments::firstOrCreate(
                ['Name' => $dept['Name']],
                ['Description' => $dept['Description'], 'is_active' => true]
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

        // Seed Admin User
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

        // Seed Audiences
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

        // Map question types
        $questionTypeMap = [
            1 => $ratingType->id,
            2 => $booleanType->id,
            3 => $textType->id,
        ];

        // Define base questions for each audience and department
        $baseQuestions = [
            'Security' => [
                'travelers' => [
                    ['question' => 'How would you rate the efficiency of the security screening process?', 'question_type' => 1, 'is_required' => true],
                    ['question' => 'Did you feel safe during the security checks?', 'question_type' => 2, 'is_required' => true],
                    ['question' => 'What could be improved in the security screening process?', 'question_type' => 3, 'is_required' => false],
                    ['question' => 'How courteous were the security staff?', 'question_type' => 1, 'is_required' => true],
                    ['question' => 'Were the security instructions clear?', 'question_type' => 2, 'is_required' => true],
                    ['question' => 'Did you encounter any issues during security checks?', 'question_type' => 3, 'is_required' => false],
                ],
                'airline_flight_crew' => [
                    ['question' => 'How would you rate the efficiency of crew security checks?', 'question_type' => 1, 'is_required' => true],
                    ['question' => 'Are there dedicated security lanes for crew members?', 'question_type' => 2, 'is_required' => true],
                    ['question' => 'What challenges do you face during security checks as a crew member?', 'question_type' => 3, 'is_required' => false],
                    ['question' => 'How cooperative are the security staff with crew?', 'question_type' => 1, 'is_required' => true],
                    ['question' => 'Are the security protocols for crew clear?', 'question_type' => 2, 'is_required' => true],
                    ['question' => 'What improvements would you suggest for crew security procedures?', 'question_type' => 3, 'is_required' => false],
                ],
                'security_immigration' => [
                    ['question' => 'How would you rate the effectiveness of security measures?', 'question_type' => 1, 'is_required' => true],
                    ['question' => 'Are there sufficient resources for security operations?', 'question_type' => 2, 'is_required' => true],
                    ['question' => 'What operational challenges do you face in security?', 'question_type' => 3, 'is_required' => false],
                    ['question' => 'How would you rate the quality of security training?', 'question_type' => 1, 'is_required' => true],
                    ['question' => 'Are the security procedures clear and manageable?', 'question_type' => 2, 'is_required' => true],
                    ['question' => 'What suggestions do you have for enhancing security operations?', 'question_type' => 3, 'is_required' => false],
                ],
                'airport_operations' => [
                    ['question' => 'How would you rate the coordination between security and operations?', 'question_type' => 1, 'is_required' => true],
                    ['question' => 'Is there adequate security support for operational needs?', 'question_type' => 2, 'is_required' => true],
                    ['question' => 'What security-related operational issues do you encounter?', 'question_type' => 3, 'is_required' => false],
                    ['question' => 'How efficient are security processes from an operational perspective?', 'question_type' => 1, 'is_required' => true],
                    ['question' => 'Is security communication effective with operations?', 'question_type' => 2, 'is_required' => true],
                    ['question' => 'What improvements would you suggest for security-operations integration?', 'question_type' => 3, 'is_required' => false],
                ],
                'retail_hospitality' => [
                    ['question' => 'How would you rate the security presence in retail areas?', 'question_type' => 1, 'is_required' => true],
                    ['question' => 'Do you feel safe working in retail zones?', 'question_type' => 2, 'is_required' => true],
                    ['question' => 'What security incidents or concerns have you noticed in retail?', 'question_type' => 3, 'is_required' => false],
                    ['question' => 'How responsive is security to retail issues?', 'question_type' => 1, 'is_required' => true],
                    ['question' => 'Are security protocols clear for retail staff?', 'question_type' => 2, 'is_required' => true],
                    ['question' => 'What suggestions do you have for improving security in retail areas?', 'question_type' => 3, 'is_required' => false],
                ],
                'medical_emergency' => [
                    ['question' => 'How would you rate security support during medical emergencies?', 'question_type' => 1, 'is_required' => true],
                    ['question' => 'Are security procedures clear in medical areas?', 'question_type' => 2, 'is_required' => true],
                    ['question' => 'What challenges do you face coordinating security during emergencies?', 'question_type' => 3, 'is_required' => false],
                    ['question' => 'How adequate are security resources for medical zones?', 'question_type' => 1, 'is_required' => true],
                    ['question' => 'Is security communication effective during emergencies?', 'question_type' => 2, 'is_required' => true],
                    ['question' => 'What improvements would you suggest for security in medical contexts?', 'question_type' => 3, 'is_required' => false],
                ],
                'vip_special' => [
                    ['question' => 'How would you rate the efficiency of VIP security checks?', 'question_type' => 1, 'is_required' => true],
                    ['question' => 'Is the VIP security discreet and professional?', 'question_type' => 2, 'is_required' => true],
                    ['question' => 'What issues have you encountered with VIP security?', 'question_type' => 3, 'is_required' => false],
                    ['question' => 'How adequate are security resources for VIP services?', 'question_type' => 1, 'is_required' => true],
                    ['question' => 'Are VIP security protocols clear?', 'question_type' => 2, 'is_required' => true],
                    ['question' => 'What suggestions do you have for enhancing VIP security?', 'question_type' => 3, 'is_required' => false],
                ],
                'media_communication' => [
                    ['question' => 'How would you rate security cooperation with media activities?', 'question_type' => 1, 'is_required' => true],
                    ['question' => 'Are security guidelines clear for media staff?', 'question_type' => 2, 'is_required' => true],
                    ['question' => 'What security-related challenges do you face as media?', 'question_type' => 3, 'is_required' => false],
                    ['question' => 'How adequate is security support for media events?', 'question_type' => 1, 'is_required' => true],
                    ['question' => 'Is security communication effective with media?', 'question_type' => 2, 'is_required' => true],
                    ['question' => 'What suggestions do you have for improving security-media interactions?', 'question_type' => 3, 'is_required' => false],
                ],
            ],
            'Operations' => [
                'travelers' => [
                    ['question' => 'How would you rate the efficiency of the check-in process?', 'question_type' => 1, 'is_required' => true],
                    ['question' => 'Was the boarding process well-organized?', 'question_type' => 2, 'is_required' => true],
                    ['question' => 'What issues did you encounter during check-in or boarding?', 'question_type' => 3, 'is_required' => false],
                    ['question' => 'How would you rate the cleanliness of the terminal?', 'question_type' => 1, 'is_required' => true],
                    ['question' => 'Were there adequate facilities (seating, restrooms, etc.)?', 'question_type' => 2, 'is_required' => true],
                    ['question' => 'What suggestions do you have for improving operational processes?', 'question_type' => 3, 'is_required' => false],
                ],
                'airline_flight_crew' => [
                    ['question' => 'How would you rate the efficiency of crew operational procedures?', 'question_type' => 1, 'is_required' => true],
                    ['question' => 'Are there clear guidelines for crew operations?', 'question_type' => 2, 'is_required' => true],
                    ['question' => 'What operational challenges do you face as a crew member?', 'question_type' => 3, 'is_required' => false],
                    ['question' => 'How would you rate the support from operational staff?', 'question_type' => 1, 'is_required' => true],
                    ['question' => 'Is the equipment and technology adequate for crew tasks?', 'question_type' => 2, 'is_required' => true],
                    ['question' => 'What improvements would you suggest for crew operations?', 'question_type' => 3, 'is_required' => false],
                ],
                'security_immigration' => [
                    ['question' => 'How would you rate the integration of security with operational processes?', 'question_type' => 1, 'is_required' => true],
                    ['question' => 'Are operational resources sufficient for security needs?', 'question_type' => 2, 'is_required' => true],
                    ['question' => 'What operational issues impact security effectiveness?', 'question_type' => 3, 'is_required' => false],
                    ['question' => 'How would you rate the efficiency of operational support?', 'question_type' => 1, 'is_required' => true],
                    ['question' => 'Is there effective communication between security and operations?', 'question_type' => 2, 'is_required' => true],
                    ['question' => 'What suggestions do you have for improving security-operations coordination?', 'question_type' => 3, 'is_required' => false],
                ],
                'airport_operations' => [
                    ['question' => 'How would you rate the overall operational efficiency?', 'question_type' => 1, 'is_required' => true],
                    ['question' => 'Are there sufficient resources for operational tasks?', 'question_type' => 2, 'is_required' => true],
                    ['question' => 'What are the main operational challenges you face?', 'question_type' => 3, 'is_required' => false],
                    ['question' => 'How would you rate the coordination between operational teams?', 'question_type' => 1, 'is_required' => true],
                    ['question' => 'Is the technology and equipment up to date?', 'question_type' => 2, 'is_required' => true],
                    ['question' => 'What improvements would you suggest for operational processes?', 'question_type' => 3, 'is_required' => false],
                ],
                'retail_hospitality' => [
                    ['question' => 'How would you rate the operational support for retail areas?', 'question_type' => 1, 'is_required' => true],
                    ['question' => 'Are there adequate facilities for retail staff?', 'question_type' => 2, 'is_required' => true],
                    ['question' => 'What operational issues affect retail operations?', 'question_type' => 3, 'is_required' => false],
                    ['question' => 'How would you rate the cleanliness of retail zones?', 'question_type' => 1, 'is_required' => true],
                    ['question' => 'Is there effective communication with operational teams?', 'question_type' => 2, 'is_required' => true],
                    ['question' => 'What suggestions do you have for improving retail operations?', 'question_type' => 3, 'is_required' => false],
                ],
                'medical_emergency' => [
                    ['question' => 'How would you rate the operational readiness for medical emergencies?', 'question_type' => 1, 'is_required' => true],
                    ['question' => 'Are there clear procedures for medical staff during operations?', 'question_type' => 2, 'is_required' => true],
                    ['question' => 'What operational challenges do you face in medical services?', 'question_type' => 3, 'is_required' => false],
                    ['question' => 'How would you rate the support from operational teams?', 'question_type' => 1, 'is_required' => true],
                    ['question' => 'Is the equipment adequate for medical operations?', 'question_type' => 2, 'is_required' => true],
                    ['question' => 'What improvements would you suggest for medical operations?', 'question_type' => 3, 'is_required' => false],
                ],
                'vip_special' => [
                    ['question' => 'How would you rate the efficiency of VIP operational services?', 'question_type' => 1, 'is_required' => true],
                    ['question' => 'Are VIP facilities well-maintained?', 'question_type' => 2, 'is_required' => true],
                    ['question' => 'What operational issues affect VIP services?', 'question_type' => 3, 'is_required' => false],
                    ['question' => 'How would you rate the quality of VIP operations?', 'question_type' => 1, 'is_required' => true],
                    ['question' => 'Is there effective coordination for VIP movements?', 'question_type' => 2, 'is_required' => true],
                    ['question' => 'What suggestions do you have for enhancing VIP operations?', 'question_type' => 3, 'is_required' => false],
                ],
                'media_communication' => [
                    ['question' => 'How would you rate the operational support for media activities?', 'question_type' => 1, 'is_required' => true],
                    ['question' => 'Are there adequate facilities for media staff?', 'question_type' => 2, 'is_required' => true],
                    ['question' => 'What operational challenges do you face as media?', 'question_type' => 3, 'is_required' => false],
                    ['question' => 'How would you rate the accessibility of operational areas?', 'question_type' => 1, 'is_required' => true],
                    ['question' => 'Is there effective communication with operational teams?', 'question_type' => 2, 'is_required' => true],
                    ['question' => 'What improvements would you suggest for media operations?', 'question_type' => 3, 'is_required' => false],
                ],
            ],
            'Customs and Immigrations' => [
                'travelers' => [
                    ['question' => 'How would you rate the speed of the immigration process?', 'question_type' => 1, 'is_required' => true],
                    ['question' => 'Were the customs procedures clear?', 'question_type' => 2, 'is_required' => true],
                    ['question' => 'What difficulties did you face with immigration or customs?', 'question_type' => 3, 'is_required' => false],
                    ['question' => 'How courteous were the immigration officers?', 'question_type' => 1, 'is_required' => true],
                    ['question' => 'Did you feel the customs checks were fair?', 'question_type' => 2, 'is_required' => true],
                    ['question' => 'What suggestions do you have for improving immigration and customs?', 'question_type' => 3, 'is_required' => false],
                ],
                'airline_flight_crew' => [
                    ['question' => 'How would you rate the efficiency of crew customs processing?', 'question_type' => 1, 'is_required' => true],
                    ['question' => 'Are there dedicated customs lanes for crew?', 'question_type' => 2, 'is_required' => true],
                    ['question' => 'What issues do you encounter with customs as a crew member?', 'question_type' => 3, 'is_required' => false],
                    ['question' => 'How would you rate the support from customs staff?', 'question_type' => 1, 'is_required' => true],
                    ['question' => 'Are the customs procedures for crew clear?', 'question_type' => 2, 'is_required' => true],
                    ['question' => 'What suggestions do you have for improving crew customs processes?', 'question_type' => 3, 'is_required' => false],
                ],
                'security_immigration' => [
                    ['question' => 'How would you rate the efficiency of customs and immigration operations?', 'question_type' => 1, 'is_required' => true],
                    ['question' => 'Are there sufficient resources for handling passenger volumes?', 'question_type' => 2, 'is_required' => true],
                    ['question' => 'What challenges do you face in processing passengers?', 'question_type' => 3, 'is_required' => false],
                    ['question' => 'How would you rate the training for customs and immigration duties?', 'question_type' => 1, 'is_required' => true],
                    ['question' => 'Are the procedures and guidelines clear?', 'question_type' => 2, 'is_required' => true],
                    ['question' => 'What improvements would you suggest for customs and immigration?', 'question_type' => 3, 'is_required' => false],
                ],
                'airport_operations' => [
                    ['question' => 'How would you rate the coordination with customs and immigration?', 'question_type' => 1, 'is_required' => true],
                    ['question' => 'Is there effective communication with customs/immigration teams?', 'question_type' => 2, 'is_required' => true],
                    ['question' => 'What operational issues arise from customs/immigration processes?', 'question_type' => 3, 'is_required' => false],
                    ['question' => 'How would you rate the impact of customs/immigration on operations?', 'question_type' => 1, 'is_required' => true],
                    ['question' => 'Are resources adequate to support customs/immigration?', 'question_type' => 2, 'is_required' => true],
                    ['question' => 'What suggestions do you have for improving related operations?', 'question_type' => 3, 'is_required' => false],
                ],
                'retail_hospitality' => [
                    ['question' => 'How would you rate the impact of customs/immigration on retail?', 'question_type' => 1, 'is_required' => true],
                    ['question' => 'Do customs/immigration affect passenger flow in retail areas?', 'question_type' => 2, 'is_required' => true],
                    ['question' => 'What issues do you notice related to customs/immigration?', 'question_type' => 3, 'is_required' => false],
                    ['question' => 'How would you rate cooperation with customs/immigration?', 'question_type' => 1, 'is_required' => true],
                    ['question' => 'Are guidelines clear for retail staff?', 'question_type' => 2, 'is_required' => true],
                    ['question' => 'What improvements would you suggest for retail operations?', 'question_type' => 3, 'is_required' => false],
                ],
                'medical_emergency' => [
                    ['question' => 'How would you rate the integration with customs/immigration?', 'question_type' => 1, 'is_required' => true],
                    ['question' => 'Are procedures clear for medical staff in these areas?', 'question_type' => 2, 'is_required' => true],
                    ['question' => 'What challenges do you face related to customs/immigration?', 'question_type' => 3, 'is_required' => false],
                    ['question' => 'How would you rate support during medical emergencies?', 'question_type' => 1, 'is_required' => true],
                    ['question' => 'Is communication effective with customs/immigration?', 'question_type' => 2, 'is_required' => true],
                    ['question' => 'What suggestions do you have for improving medical operations?', 'question_type' => 3, 'is_required' => false],
                ],
                'vip_special' => [
                    ['question' => 'How would you rate the efficiency of VIP customs/immigration?', 'question_type' => 1, 'is_required' => true],
                    ['question' => 'Are VIP customs/immigration services discreet?', 'question_type' => 2, 'is_required' => true],
                    ['question' => 'What issues have you encountered with VIP processing?', 'question_type' => 3, 'is_required' => false],
                    ['question' => 'How would you rate resources for VIP customs/immigration?', 'question_type' => 1, 'is_required' => true],
                    ['question' => 'Are VIP protocols clear?', 'question_type' => 2, 'is_required' => true],
                    ['question' => 'What suggestions do you have for enhancing VIP services?', 'question_type' => 3, 'is_required' => false],
                ],
                'media_communication' => [
                    ['question' => 'How would you rate cooperation with customs/immigration?', 'question_type' => 1, 'is_required' => true],
                    ['question' => 'Are customs/immigration guidelines clear for media?', 'question_type' => 2, 'is_required' => true],
                    ['question' => 'What challenges do you face with customs/immigration?', 'question_type' => 3, 'is_required' => false],
                    ['question' => 'How would you rate support for media events?', 'question_type' => 1, 'is_required' => true],
                    ['question' => 'Is communication effective with customs/immigration?', 'question_type' => 2, 'is_required' => true],
                    ['question' => 'What improvements would you suggest for media interactions?', 'question_type' => 3, 'is_required' => false],
                ],
            ],
            'Strategic Planning' => [
                'travelers' => [
                    ['question' => 'How would you rate the airport’s infrastructure?', 'question_type' => 1, 'is_required' => true],
                    ['question' => 'Is the airport well-planned for future growth?', 'question_type' => 2, 'is_required' => true],
                    ['question' => 'What infrastructure improvements would you like to see?', 'question_type' => 3, 'is_required' => false],
                    ['question' => 'How would you rate the airport’s accessibility?', 'question_type' => 1, 'is_required' => true],
                    ['question' => 'Are there adequate transportation options?', 'question_type' => 2, 'is_required' => true],
                    ['question' => 'What strategic initiatives would enhance your experience?', 'question_type' => 3, 'is_required' => false],
                ],
                'airline_flight_crew' => [
                    ['question' => 'How would you rate strategic planning for crew operations?', 'question_type' => 1, 'is_required' => true],
                    ['question' => 'Are there plans to improve crew facilities?', 'question_type' => 2, 'is_required' => true],
                    ['question' => 'What strategic changes would benefit crew members?', 'question_type' => 3, 'is_required' => false],
                    ['question' => 'How would you rate adaptability to operational changes?', 'question_type' => 1, 'is_required' => true],
                    ['question' => 'Is there investment in crew infrastructure?', 'question_type' => 2, 'is_required' => true],
                    ['question' => 'What suggestions do you have for crew planning?', 'question_type' => 3, 'is_required' => false],
                ],
                'security_immigration' => [
                    ['question' => 'How would you rate planning for security and immigration?', 'question_type' => 1, 'is_required' => true],
                    ['question' => 'Are future security needs addressed in plans?', 'question_type' => 2, 'is_required' => true],
                    ['question' => 'What strategic challenges do you foresee?', 'question_type' => 3, 'is_required' => false],
                    ['question' => 'How would you rate resource allocation for security projects?', 'question_type' => 1, 'is_required' => true],
                    ['question' => 'Is there effective long-term planning?', 'question_type' => 2, 'is_required' => true],
                    ['question' => 'What improvements would you suggest for your area?', 'question_type' => 3, 'is_required' => false],
                ],
                'airport_operations' => [
                    ['question' => 'How would you rate the effectiveness of strategic planning?', 'question_type' => 1, 'is_required' => true],
                    ['question' => 'Are staff involved in strategic decision-making?', 'question_type' => 2, 'is_required' => true],
                    ['question' => 'What initiatives would improve operational efficiency?', 'question_type' => 3, 'is_required' => false],
                    ['question' => 'How would you rate communication of strategic plans?', 'question_type' => 1, 'is_required' => true],
                    ['question' => 'Is there sufficient funding for strategic projects?', 'question_type' => 2, 'is_required' => true],
                    ['question' => 'What suggestions do you have for enhancing planning?', 'question_type' => 3, 'is_required' => false],
                ],
                'retail_hospitality' => [
                    ['question' => 'How would you rate planning for retail and hospitality?', 'question_type' => 1, 'is_required' => true],
                    ['question' => 'Are there plans to improve retail facilities?', 'question_type' => 2, 'is_required' => true],
                    ['question' => 'What strategic changes would benefit retail?', 'question_type' => 3, 'is_required' => false],
                    ['question' => 'How would you rate integration of retail in planning?', 'question_type' => 1, 'is_required' => true],
                    ['question' => 'Is retail considered in strategic decisions?', 'question_type' => 2, 'is_required' => true],
                    ['question' => 'What improvements would you suggest for retail planning?', 'question_type' => 3, 'is_required' => false],
                ],
                'medical_emergency' => [
                    ['question' => 'How would you rate planning for medical services?', 'question_type' => 1, 'is_required' => true],
                    ['question' => 'Are there plans to enhance medical facilities?', 'question_type' => 2, 'is_required' => true],
                    ['question' => 'What initiatives would improve emergency response?', 'question_type' => 3, 'is_required' => false],
                    ['question' => 'How would you rate prioritization of medical needs?', 'question_type' => 1, 'is_required' => true],
                    ['question' => 'Is there effective long-term planning for medical?', 'question_type' => 2, 'is_required' => true],
                    ['question' => 'What suggestions do you have for medical planning?', 'question_type' => 3, 'is_required' => false],
                ],
                'vip_special' => [
                    ['question' => 'How would you rate planning for VIP services?', 'question_type' => 1, 'is_required' => true],
                    ['question' => 'Are there plans to upgrade VIP facilities?', 'question_type' => 2, 'is_required' => true],
                    ['question' => 'What strategic changes would enhance VIP experiences?', 'question_type' => 3, 'is_required' => false],
                    ['question' => 'How would you rate investment in VIP infrastructure?', 'question_type' => 1, 'is_required' => true],
                    ['question' => 'Is VIP service prioritized in decisions?', 'question_type' => 2, 'is_required' => true],
                    ['question' => 'What suggestions do you have for VIP planning?', 'question_type' => 3, 'is_required' => false],
                ],
                'media_communication' => [
                    ['question' => 'How would you rate planning for media and communication?', 'question_type' => 1, 'is_required' => true],
                    ['question' => 'Are there plans to improve media facilities?', 'question_type' => 2, 'is_required' => true],
                    ['question' => 'What initiatives would support media activities?', 'question_type' => 3, 'is_required' => false],
                    ['question' => 'How would you rate integration of media needs?', 'question_type' => 1, 'is_required' => true],
                    ['question' => 'Is media considered in strategic decisions?', 'question_type' => 2, 'is_required' => true],
                    ['question' => 'What suggestions do you have for media planning?', 'question_type' => 3, 'is_required' => false],
                ],
            ],
            'Information Desk' => [
                'travelers' => [
                    ['question' => 'How would you rate the helpfulness of information desk staff?', 'question_type' => 1, 'is_required' => true],
                    ['question' => 'Was the information provided accurate and timely?', 'question_type' => 2, 'is_required' => true],
                    ['question' => 'What issues did you have obtaining information?', 'question_type' => 3, 'is_required' => false],
                    ['question' => 'How would you rate the accessibility of information services?', 'question_type' => 1, 'is_required' => true],
                    ['question' => 'Were digital information screens clear?', 'question_type' => 2, 'is_required' => true],
                    ['question' => 'What suggestions do you have for improving information?', 'question_type' => 3, 'is_required' => false],
                ],
                'airline_flight_crew' => [
                    ['question' => 'How would you rate the quality of information for crew?', 'question_type' => 1, 'is_required' => true],
                    ['question' => 'Is there a dedicated information channel for crew?', 'question_type' => 2, 'is_required' => true],
                    ['question' => 'What information-related issues do you encounter?', 'question_type' => 3, 'is_required' => false],
                    ['question' => 'How would you rate the timeliness of updates?', 'question_type' => 1, 'is_required' => true],
                    ['question' => 'Are information systems user-friendly for crew?', 'question_type' => 2, 'is_required' => true],
                    ['question' => 'What suggestions do you have for crew information?', 'question_type' => 3, 'is_required' => false],
                ],
                'security_immigration' => [
                    ['question' => 'How would you rate information support for security?', 'question_type' => 1, 'is_required' => true],
                    ['question' => 'Is information readily available for security staff?', 'question_type' => 2, 'is_required' => true],
                    ['question' => 'What challenges do you face accessing information?', 'question_type' => 3, 'is_required' => false],
                    ['question' => 'How would you rate the clarity of information provided?', 'question_type' => 1, 'is_required' => true],
                    ['question' => 'Are updates communicated effectively?', 'question_type' => 2, 'is_required' => true],
                    ['question' => 'What improvements would you suggest for information?', 'question_type' => 3, 'is_required' => false],
                ],
                'airport_operations' => [
                    ['question' => 'How would you rate the effectiveness of information services?', 'question_type' => 1, 'is_required' => true],
                    ['question' => 'Are there sufficient resources for information desks?', 'question_type' => 2, 'is_required' => true],
                    ['question' => 'What challenges do you face providing information?', 'question_type' => 3, 'is_required' => false],
                    ['question' => 'How would you rate training for information staff?', 'question_type' => 1, 'is_required' => true],
                    ['question' => 'Is the technology adequate for information services?', 'question_type' => 2, 'is_required' => true],
                    ['question' => 'What improvements would you suggest for info desks?', 'question_type' => 3, 'is_required' => false],
                ],
                'retail_hospitality' => [
                    ['question' => 'How would you rate information support for retail?', 'question_type' => 1, 'is_required' => true],
                    ['question' => 'Is information about passenger flow clear?', 'question_type' => 2, 'is_required' => true],
                    ['question' => 'What information challenges do you face in retail?', 'question_type' => 3, 'is_required' => false],
                    ['question' => 'How would you rate the timeliness of updates?', 'question_type' => 1, 'is_required' => true],
                    ['question' => 'Are digital tools effective for retail staff?', 'question_type' => 2, 'is_required' => true],
                    ['question' => 'What suggestions do you have for retail information?', 'question_type' => 3, 'is_required' => false],
                ],
                'medical_emergency' => [
                    ['question' => 'How would you rate information support for medical?', 'question_type' => 1, 'is_required' => true],
                    ['question' => 'Is critical information accessible during emergencies?', 'question_type' => 2, 'is_required' => true],
                    ['question' => 'What information challenges do you face?', 'question_type' => 3, 'is_required' => false],
                    ['question' => 'How would you rate communication during emergencies?', 'question_type' => 1, 'is_required' => true],
                    ['question' => 'Are information systems reliable for medical?', 'question_type' => 2, 'is_required' => true],
                    ['question' => 'What improvements would you suggest?', 'question_type' => 3, 'is_required' => false],
                ],
                'vip_special' => [
                    ['question' => 'How would you rate information quality for VIPs?', 'question_type' => 1, 'is_required' => true],
                    ['question' => 'Is VIP-specific information readily available?', 'question_type' => 2, 'is_required' => true],
                    ['question' => 'What information issues have you encountered?', 'question_type' => 3, 'is_required' => false],
                    ['question' => 'How would you rate the discretion of information?', 'question_type' => 1, 'is_required' => true],
                    ['question' => 'Are updates timely for VIP services?', 'question_type' => 2, 'is_required' => true],
                    ['question' => 'What suggestions do you have for VIP information?', 'question_type' => 3, 'is_required' => false],
                ],
                'media_communication' => [
                    ['question' => 'How would you rate information support for media?', 'question_type' => 1, 'is_required' => true],
                    ['question' => 'Is event information clear and accessible?', 'question_type' => 2, 'is_required' => true],
                    ['question' => 'What challenges do you face obtaining information?', 'question_type' => 3, 'is_required' => false],
                    ['question' => 'How would you rate the responsiveness of info desks?', 'question_type' => 1, 'is_required' => true],
                    ['question' => 'Are communication channels effective for media?', 'question_type' => 2, 'is_required' => true],
                    ['question' => 'What improvements would you suggest?', 'question_type' => 3, 'is_required' => false],
                ],
            ],
            'General' => [
                'travelers' => [
                    ['question' => 'How would you rate your overall airport experience?', 'question_type' => 1, 'is_required' => true],
                    ['question' => 'Would you recommend this airport to others?', 'question_type' => 2, 'is_required' => true],
                    ['question' => 'What were the highlights of your experience?', 'question_type' => 3, 'is_required' => false],
                    ['question' => 'How would you rate the efficiency of airport operations?', 'question_type' => 1, 'is_required' => true],
                    ['question' => 'Did you feel safe and secure at the airport?', 'question_type' => 2, 'is_required' => true],
                    ['question' => 'What areas need improvement?', 'question_type' => 3, 'is_required' => false],
                ],
                'airline_flight_crew' => [
                    ['question' => 'How would you rate your overall working experience?', 'question_type' => 1, 'is_required' => true],
                    ['question' => 'Do you feel valued as a crew member?', 'question_type' => 2, 'is_required' => true],
                    ['question' => 'What are the biggest challenges in your role?', 'question_type' => 3, 'is_required' => false],
                    ['question' => 'How would you rate support from management?', 'question_type' => 1, 'is_required' => true],
                    ['question' => 'Are resources adequate for your tasks?', 'question_type' => 2, 'is_required' => true],
                    ['question' => 'What suggestions do you have for improvement?', 'question_type' => 3, 'is_required' => false],
                ],
                'security_immigration' => [
                    ['question' => 'How would you rate your overall working experience?', 'question_type' => 1, 'is_required' => true],
                    ['question' => 'Do you feel supported in your security role?', 'question_type' => 2, 'is_required' => true],
                    ['question' => 'What challenges do you face in your duties?', 'question_type' => 3, 'is_required' => false],
                    ['question' => 'How would you rate resource availability?', 'question_type' => 1, 'is_required' => true],
                    ['question' => 'Is communication effective with other departments?', 'question_type' => 2, 'is_required' => true],
                    ['question' => 'What improvements would you suggest?', 'question_type' => 3, 'is_required' => false],
                ],
                'airport_operations' => [
                    ['question' => 'How would you rate your overall working experience?', 'question_type' => 1, 'is_required' => true],
                    ['question' => 'Do you feel valued as an operations staff member?', 'question_type' => 2, 'is_required' => true],
                    ['question' => 'What are the biggest operational challenges?', 'question_type' => 3, 'is_required' => false],
                    ['question' => 'How would you rate support from management?', 'question_type' => 1, 'is_required' => true],
                    ['question' => 'Are resources sufficient for operations?', 'question_type' => 2, 'is_required' => true],
                    ['question' => 'What suggestions do you have for improvement?', 'question_type' => 3, 'is_required' => false],
                ],
                'retail_hospitality' => [
                    ['question' => 'How would you rate your overall working experience?', 'question_type' => 1, 'is_required' => true],
                    ['question' => 'Do you feel supported in your retail role?', 'question_type' => 2, 'is_required' => true],
                    ['question' => 'What challenges do you face in retail?', 'question_type' => 3, 'is_required' => false],
                    ['question' => 'How would you rate the facilities for retail staff?', 'question_type' => 1, 'is_required' => true],
                    ['question' => 'Is communication effective with management?', 'question_type' => 2, 'is_required' => true],
                    ['question' => 'What improvements would you suggest?', 'question_type' => 3, 'is_required' => false],
                ],
                'medical_emergency' => [
                    ['question' => 'How would you rate your overall working experience?', 'question_type' => 1, 'is_required' => true],
                    ['question' => 'Do you feel equipped to handle emergencies?', 'question_type' => 2, 'is_required' => true],
                    ['question' => 'What challenges do you face in medical services?', 'question_type' => 3, 'is_required' => false],
                    ['question' => 'How would you rate resource availability?', 'question_type' => 1, 'is_required' => true],
                    ['question' => 'Is support from other departments effective?', 'question_type' => 2, 'is_required' => true],
                    ['question' => 'What improvements would you suggest?', 'question_type' => 3, 'is_required' => false],
                ],
                'vip_special' => [
                    ['question' => 'How would you rate the overall VIP experience?', 'question_type' => 1, 'is_required' => true],
                    ['question' => 'Were VIP services exclusive and professional?', 'question_type' => 2, 'is_required' => true],
                    ['question' => 'What issues did you encounter with VIP services?', 'question_type' => 3, 'is_required' => false],
                    ['question' => 'How would you rate the quality of VIP facilities?', 'question_type' => 1, 'is_required' => true],
                    ['question' => 'Is VIP treatment consistent?', 'question_type' => 2, 'is_required' => true],
                    ['question' => 'What suggestions do you have for VIP services?', 'question_type' => 3, 'is_required' => false],
                ],
                'media_communication' => [
                    ['question' => 'How would you rate your overall experience?', 'question_type' => 1, 'is_required' => true],
                    ['question' => 'Is the airport supportive of media needs?', 'question_type' => 2, 'is_required' => true],
                    ['question' => 'What challenges do you face as media?', 'question_type' => 3, 'is_required' => false],
                    ['question' => 'How would you rate access to information?', 'question_type' => 1, 'is_required' => true],
                    ['question' => 'Is communication effective with airport staff?', 'question_type' => 2, 'is_required' => true],
                    ['question' => 'What improvements would you suggest?', 'question_type' => 3, 'is_required' => false],
                ],
            ],
            'Stakeholder Meeting' => [
                'travelers' => [
                    ['question' => 'How would you rate the effectiveness of stakeholder engagement?', 'question_type' => 1, 'is_required' => true],
                    ['question' => 'Do you feel your feedback is valued?', 'question_type' => 2, 'is_required' => true],
                    ['question' => 'What challenges do you face in giving feedback?', 'question_type' => 3, 'is_required' => false],
                    ['question' => 'How would you rate communication with stakeholders?', 'question_type' => 1, 'is_required' => true],
                    ['question' => 'Are there clear channels for input?', 'question_type' => 2, 'is_required' => true],
                    ['question' => 'What improvements would you suggest?', 'question_type' => 3, 'is_required' => false],
                ],
                'airline_flight_crew' => [
                    ['question' => 'How would you rate stakeholder engagement for crew?', 'question_type' => 1, 'is_required' => true],
                    ['question' => 'Is crew input considered in decisions?', 'question_type' => 2, 'is_required' => true],
                    ['question' => 'What challenges do you face in stakeholder meetings?', 'question_type' => 3, 'is_required' => false],
                    ['question' => 'How would you rate communication with stakeholders?', 'question_type' => 1, 'is_required' => true],
                    ['question' => 'Are there effective feedback channels?', 'question_type' => 2, 'is_required' => true],
                    ['question' => 'What suggestions do you have for engagement?', 'question_type' => 3, 'is_required' => false],
                ],
                'security_immigration' => [
                    ['question' => 'How would you rate stakeholder engagement?', 'question_type' => 1, 'is_required' => true],
                    ['question' => 'Do you feel your input influences decisions?', 'question_type' => 2, 'is_required' => true],
                    ['question' => 'What challenges do you face in meetings?', 'question_type' => 3, 'is_required' => false],
                    ['question' => 'How would you rate communication effectiveness?', 'question_type' => 1, 'is_required' => true],
                    ['question' => 'Are feedback mechanisms clear?', 'question_type' => 2, 'is_required' => true],
                    ['question' => 'What improvements would you suggest?', 'question_type' => 3, 'is_required' => false],
                ],
                'airport_operations' => [
                    ['question' => 'How would you rate stakeholder engagement?', 'question_type' => 1, 'is_required' => true],
                    ['question' => 'Is operational input valued in decisions?', 'question_type' => 2, 'is_required' => true],
                    ['question' => 'What challenges do you face in meetings?', 'question_type' => 3, 'is_required' => false],
                    ['question' => 'How would you rate communication with stakeholders?', 'question_type' => 1, 'is_required' => true],
                    ['question' => 'Are there clear channels for feedback?', 'question_type' => 2, 'is_required' => true],
                    ['question' => 'What suggestions do you have for improvement?', 'question_type' => 3, 'is_required' => false],
                ],
                'retail_hospitality' => [
                    ['question' => 'How would you rate stakeholder engagement for retail?', 'question_type' => 1, 'is_required' => true],
                    ['question' => 'Do you feel retail needs are considered?', 'question_type' => 2, 'is_required' => true],
                    ['question' => 'What challenges do you face in meetings?', 'question_type' => 3, 'is_required' => false],
                    ['question' => 'How would you rate communication with stakeholders?', 'question_type' => 1, 'is_required' => true],
                    ['question' => 'Are feedback channels effective?', 'question_type' => 2, 'is_required' => true],
                    ['question' => 'What improvements would you suggest?', 'question_type' => 3, 'is_required' => false],
                ],
                'medical_emergency' => [
                    ['question' => 'How would you rate stakeholder engagement?', 'question_type' => 1, 'is_required' => true],
                    ['question' => 'Is medical input valued in decisions?', 'question_type' => 2, 'is_required' => true],
                    ['question' => 'What challenges do you face in meetings?', 'question_type' => 3, 'is_required' => false],
                    ['question' => 'How would you rate communication effectiveness?', 'question_type' => 1, 'is_required' => true],
                    ['question' => 'Are there clear feedback mechanisms?', 'question_type' => 2, 'is_required' => true],
                    ['question' => 'What suggestions do you have for engagement?', 'question_type' => 3, 'is_required' => false],
                ],
                'vip_special' => [
                    ['question' => 'How would you rate stakeholder engagement for VIPs?', 'question_type' => 1, 'is_required' => true],
                    ['question' => 'Is VIP feedback considered in decisions?', 'question_type' => 2, 'is_required' => true],
                    ['question' => 'What challenges do you face with engagement?', 'question_type' => 3, 'is_required' => false],
                    ['question' => 'How would you rate communication with stakeholders?', 'question_type' => 1, 'is_required' => true],
                    ['question' => 'Are feedback channels clear for VIPs?', 'question_type' => 2, 'is_required' => true],
                    ['question' => 'What improvements would you suggest?', 'question_type' => 3, 'is_required' => false],
                ],
                'media_communication' => [
                    ['question' => 'How would you rate engagement with media stakeholders?', 'question_type' => 1, 'is_required' => true],
                    ['question' => 'Is the airport responsive to media inquiries?', 'question_type' => 2, 'is_required' => true],
                    ['question' => 'What issues have you encountered in relations?', 'question_type' => 3, 'is_required' => false],
                    ['question' => 'How would you rate transparency of information?', 'question_type' => 1, 'is_required' => true],
                    ['question' => 'Are protocols effective for media access?', 'question_type' => 2, 'is_required' => true],
                    ['question' => 'What suggestions do you have for media relations?', 'question_type' => 3, 'is_required' => false],
                ],
            ],
        ];

        // Seed Questions
        foreach ($audiences as $audienceKey => $audience) {
            foreach ($baseQuestions as $department => $deptQuestions) {
                foreach ($deptQuestions[$audienceKey] as $question) {
                    Question::create([
                        'survey_id' => $survey->id,
                        'audience_type' => $audienceKey,
                        'department' => $department,
                        'question' => $question['question'],
                        'questionaire_id' => $questionnaires[$audienceKey]->id,
                        'question_type' => $questionTypeMap[$question['question_type']],
                        'is_required' => $question['is_required'],
                        'obfuscator' => Str::random(10),
                        'validity' => true,
                    ]);
                }
            }
        }
    }
}