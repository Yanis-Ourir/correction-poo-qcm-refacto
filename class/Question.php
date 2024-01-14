<?php

class Question
{
    private int $id;
    private string $content;
    private array $answers = [];
    private string $explanation;

    public function __construct(array $data)
    {
        $this->content = $data['content'];
        $this->id = $data['id'];
        $this->explanation = $data['explanation'];
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function addAnswer(Answer $answer) : void
    {
        $this->answers[] = $answer;
    }

    public function getAnswers(): array
    {
        return $this->answers;
    }

    public function setExplanation(string $explanation) : void
    {
        $this->explanation = $explanation;
    }

    public function getExplanation(): string
    {
        return $this->explanation;
    }

    public function setId(int $id) : void
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }



}