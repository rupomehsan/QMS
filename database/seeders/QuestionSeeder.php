<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Question::create([
            "subject_id" => 1,
            "question" => "What is HTML?",
            "options" => [
                "HTML describes the structure of a webpage",
                "HTML is the standard markup language mainly used to create web pages",
                "HTML consists of a set of elements that helps the browser how to view the content",
                "All of the mentioned"
            ],
            "answer" => ['0', '3'],
        ]);

        Question::create([
            "subject_id" => 1,
            "question" => "Who is the father of HTML?",
            "options" => [
                "Rasmus Lerdorf",
                "Tim Berners-Lee",
                "Brendan Eich",
                "Sergey Brin"
            ],
            "answer" => ['1', '2'],
        ]);

        Question::create([
            "subject_id" => 2,
            "question" => "What is CSS?",
            "options" => [
                "CSS is a style sheet language",
                "CSS is the language used to style the HTML documents",
                "CSS is designed to separate the presentation",
                "All of the mentioned"
            ],
            "answer" => ['3'],
        ]);

        Question::create([
            "subject_id" => 2,
            "question" => "CSS stands for -",
            "options" => [
                "Color and style sheets",
                "Cascading style sheets",
                "Cascade style sheets",
                "None of the above"
            ],
            "answer" => ['0', '1'],
        ]);

        Question::create([
            "subject_id" => 3,
            "question" => "What is JavaScript?",
            "options" => [
                "JavaScript is a scripting language used to make the website interactive",
                "JavaScript is an assembly language used to make the website interactive",
                "JavaScript is a compiled language used to make the website interactive",
                "None of the mentioned"
            ],
            "answer" => ['0', '3'],
        ]);

        Question::create([
            "subject_id" => 3,
            "question" => "Which of the following is correct about JavaScript?",
            "options" => [
                "JavaScript is Assembly-language",
                "JavaScript is an Object-Based language",
                "JavaScript is an Object-Oriented language",
                " JavaScript is a High-level language"
            ],
            "answer" => ['1', '2'],
        ]);

        Question::create([
            "subject_id" => 4,
            "question" => "What is PHP?",
            "options" => [
                "PHP is an open-source programming language",
                "PHP is used to develop dynamic and interactive websites",
                "PHP is a server-side scripting language",
                "All of the mentioned"
            ],
            "answer" => ['3'],
        ]);

        Question::create([
            "subject_id" => 4,
            "question" => "Who is the father of PHP?",
            "options" => [
                "Drek Kolkevi",
                "Rasmus Lerdorf",
                "Willam Makepiece",
                "List Barely"
            ],
            "answer" => ['1', '3'],
        ]);



        // Question::factory()->count(50)->create();
    }
}
