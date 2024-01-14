<?php

class Qcm
{
    private array $questions = [];
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function addQuestion(Question $question) : void
    {
        $this->questions[] = $question;
    }

    public function generate() : void
    {
        foreach ($this->questions as $question) {
            echo $question->getContent() . '<br>';
            foreach ($question->getAnswers() as $answer) {
                echo "<input type='radio'>" . $answer->getContent() . '</input><br>';
            }
            echo $question->getExplanation() . '<br>';
        }
    }

    private function hydrate(array $data): void
    {
        foreach ($data as $question) {
            $newQuestion = new Question($question);
            $answers = $this->getAnswerByQuestionId($newQuestion);
            foreach ($answers as $answer) {
                $newQuestion->addAnswer(new Answer($answer));
            }
            $this->addQuestion($newQuestion);
        }
    }

    public function getQuestions(): array
    {
        $request = $this->db->query('SELECT * FROM question');
        $this->hydrate($request->fetchAll());
        return $this->questions;
    }

    public function getAnswerByQuestionId(Question $question): array
    {
        $request = $this->db->prepare('SELECT * FROM answer WHERE question_id = :id');
        $request->execute([
            ':id' => $question->getId()
        ]);
        return $request->fetchAll();
    }


}