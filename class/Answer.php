<?php

class Answer
{
    private string $content;
    private bool $isCorrect;

    public function __construct(array $data)
    {
        $this->content = $data['content_answer'];
        $this->isCorrect = $data['is_correct'];
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function isCorrect(): bool
    {
        return $this->isCorrect;
    }
}