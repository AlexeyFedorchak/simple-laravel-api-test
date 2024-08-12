<?php

namespace App\Dto;

class SubmissionDto
{
    protected string $name;
    protected string $email;
    protected string $message;

    public function setName(string $name): static
    {
        $this->name = $name;
        return $this;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;
        return $this;
    }

    public function setMessage(string $message): static
    {
        $this->message = $message;
        return $this;
    }

    public function toObject(): object
    {
        return (object) [
            'name' => $this->name,
            'email' => $this->email,
            'message' => $this->message,
        ];
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'message' => $this->message,
        ];
    }
}
