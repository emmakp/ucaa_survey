<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\QuestionType;

class QuestionTypeSeeder extends Seeder
{
    public function run()
    {
        QuestionType::create(['type' => 'Rating']);
        QuestionType::create(['type' => 'Boolean']);
        QuestionType::create(['type' => 'Text']);
    }
}