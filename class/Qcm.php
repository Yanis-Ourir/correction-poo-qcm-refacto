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
        $this->questions[] = $question; // je push ma question dans mon tableau de questions
    }

    public function generate() : void
    {
        foreach ($this->questions as $question) { // je parcours mon tableau de questions
            echo $question->getContent() . '<br>';
            foreach ($question->getAnswers() as $answer) {
                echo "<input type='radio'>" . $answer->getContent() . '</input><br>'; // je récupère le contenu de la réponse
            }
            echo $question->getExplanation() . '<br>'; // je récupère l'explication de la question
        }
        // Je récupère les questions grâce à mes méthodes getters public de ma classe Question
    }

    private function hydrate(array $data): void // hydrate = remplir un objet avec des données de la BDD
    {
        // donc le paramètre $data est le tableau que j'ai reçu après ma requête à la BDD
        foreach ($data as $question) {
            $newQuestion = new Question($question); // je crée une nouvelle instance de ma classe Question avec les données de la BDD
            $answers = $this->getAnswerByQuestionId($newQuestion); // je récupère les réponses de la question grâce à un objet question et sa méthode getId()
            foreach ($answers as $answer) {
                $newQuestion->addAnswer(new Answer($answer)); // je crée une nouvelle instance de ma classe Answer avec les données de la BDD
            }
            $this->addQuestion($newQuestion); // j'ajoute ma question dans mon tableau de questions du Qcm
        }
    }

    public function getQuestions(): array
    {
        $request = $this->db->query('SELECT * FROM question');
        $this->hydrate($request->fetchAll()); // je récupère toutes les questions de la BDD et je les envoie en argument de ma méthode hydrate
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