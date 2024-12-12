<?php
class Question
{
    public $question;
    public $choices;
    public $correctAnswer;

    public function __construct($question, $choices, $correctAnswer)
    {
        $this->question      = $question;
        $this->choices       = $choices;
        $this->correctAnswer = $correctAnswer;
    }

    public function getQuestion(){
        return $this->question;
    }

    public function getChoices(){
        return $this->choices;
    }

    public function getCorrectAnswer(){
        return $this->correctAnswer;
    }

    public function estCorrect($choice){
        return $this->getCorrectAnswer() == $choice;
    }

    public function displayQuestions(){
        echo $this->question . "<br>";
        foreach($this->choices as $choice){
            <input type="radio">
            echo $choice ."<br>";
        }
    }

}