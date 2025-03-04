<?php

// namespace Database\Seeders; // Keep commented out or remove

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Seed Titles first (for users.title)
        DB::table('titles')->insert([
            ['TitleName' => 'Mr.', 'Acrynom' => 'MR', 'created_at' => now(), 'updated_at' => now()],
            ['TitleName' => 'Mrs.', 'Acrynom' => 'MRS', 'created_at' => now(), 'updated_at' => now()],
            ['TitleName' => 'Ms.', 'Acrynom' => 'MS', 'created_at' => now(), 'updated_at' => now()],
            ['TitleName' => 'Dr.', 'Acrynom' => 'DR', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Seed User Roles (for users.UserRole)
        DB::table('userroles')->insert([
            ['RoleName' => 'User', 'created_at' => now(), 'updated_at' => now()],
            ['RoleName' => 'Administrator', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Seed User (only if it doesn’t exist)
        if (!DB::table('users')->where('email', 'admin@example.com')->exists()) {
            DB::table('users')->insert([
                [
                    'FirstName' => 'Admin',
                    'SecondName' => 'Sudo',
                    'username' => 'admin',
                    'title' => 2,
                    'gender' => 'Female',
                    'email' => 'admin@example.com',
                    'email_verified_at' => now(),
                    'password' => bcrypt('admin@2024'),
                    'UserRole' => 2,
                    'Obfuscator' => Str::random(10),
                    'validity' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);
        }

        // Seed Audiences (depends on users)
        DB::table('audiences')->insert([
            ['title' => 'Passenger', 'name' => 'Passenger', 'created_by' => 1, 'obfuscator' => Str::random(10), 'validity' => true, 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Staff', 'name' => 'Staff', 'created_by' => 1, 'obfuscator' => Str::random(10), 'validity' => true, 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Seed Surveys (depends on users)
        DB::table('surveys')->insert([
            ['title' => 'Passenger Survey', 'obfuscator' => Str::random(10), 'created_by' => 1, 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Seed Questionaires (only if it doesn’t exist)
        if (!DB::table('questionaires')->where('obfuscator', 'initial-survey')->exists()) {
            DB::table('questionaires')->insert([
                [
                    'obfuscator' => 'initial-survey',
                    'survey_id' => 1,
                    'validity' => true,
                    'target_audience' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);
        }

        // Seed Question Types
        DB::table('question_types')->insert([
            ['type' => 'Rating', 'obfuscator' => Str::random(10), 'created_at' => now(), 'updated_at' => now()],
            ['type' => 'Boolean', 'obfuscator' => Str::random(10), 'created_at' => now(), 'updated_at' => now()],
            ['type' => 'Text', 'obfuscator' => Str::random(10), 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Seed Initial Questions (12 without departments)
        DB::table('questions')->insert([
            // Passenger questions
            ['survey_id' => 1, 'audience_type' => 'passenger', 'question' => 'Rate check-in', 'questionaire_id' => 1, 'is_required' => true, 'question_type' => 1, 'obfuscator' => Str::random(10), 'created_at' => now(), 'updated_at' => now(), 'validity' => true],
            ['survey_id' => 1, 'audience_type' => 'passenger', 'question' => 'Was it clear?', 'questionaire_id' => 1, 'is_required' => true, 'question_type' => 2, 'obfuscator' => Str::random(10), 'created_at' => now(), 'updated_at' => now(), 'validity' => true],
            ['survey_id' => 1, 'audience_type' => 'passenger', 'question' => 'Any issues?', 'questionaire_id' => 1, 'is_required' => true, 'question_type' => 3, 'obfuscator' => Str::random(10), 'created_at' => now(), 'updated_at' => now(), 'validity' => true],
            ['survey_id' => 1, 'audience_type' => 'passenger', 'question' => 'Rate your experience', 'questionaire_id' => 1, 'is_required' => true, 'question_type' => 1, 'obfuscator' => Str::random(10), 'created_at' => now(), 'updated_at' => now(), 'validity' => true],
            ['survey_id' => 1, 'audience_type' => 'passenger', 'question' => 'Was it easy to find?', 'questionaire_id' => 1, 'is_required' => true, 'question_type' => 2, 'obfuscator' => Str::random(10), 'created_at' => now(), 'updated_at' => now(), 'validity' => true],
            ['survey_id' => 1, 'audience_type' => 'passenger', 'question' => 'Any feedback?', 'questionaire_id' => 1, 'is_required' => true, 'question_type' => 3, 'obfuscator' => Str::random(10), 'created_at' => now(), 'updated_at' => now(), 'validity' => true],
            // Staff questions
            ['survey_id' => 1, 'audience_type' => 'staff', 'question' => 'Do you have tools?', 'questionaire_id' => 1, 'is_required' => true, 'question_type' => 2, 'obfuscator' => Str::random(10), 'created_at' => now(), 'updated_at' => now(), 'validity' => true],
            ['survey_id' => 1, 'audience_type' => 'staff', 'question' => 'Rate your shift', 'questionaire_id' => 1, 'is_required' => true, 'question_type' => 1, 'obfuscator' => Str::random(10), 'created_at' => now(), 'updated_at' => now(), 'validity' => true],
            ['survey_id' => 1, 'audience_type' => 'staff', 'question' => 'Any challenges?', 'questionaire_id' => 1, 'is_required' => true, 'question_type' => 3, 'obfuscator' => Str::random(10), 'created_at' => now(), 'updated_at' => now(), 'validity' => true],
            ['survey_id' => 1, 'audience_type' => 'staff', 'question' => 'Rate your experience', 'questionaire_id' => 1, 'is_required' => true, 'question_type' => 1, 'obfuscator' => Str::random(10), 'created_at' => now(), 'updated_at' => now(), 'validity' => true],
            ['survey_id' => 1, 'audience_type' => 'staff', 'question' => 'Do you have tools 2?', 'questionaire_id' => 1, 'is_required' => true, 'question_type' => 2, 'obfuscator' => Str::random(10), 'created_at' => now(), 'updated_at' => now(), 'validity' => true],
            ['survey_id' => 1, 'audience_type' => 'staff', 'question' => 'Any feedback?', 'questionaire_id' => 1, 'is_required' => true, 'question_type' => 3, 'obfuscator' => Str::random(10), 'created_at' => now(), 'updated_at' => now(), 'validity' => true],
        ]);
    }
}