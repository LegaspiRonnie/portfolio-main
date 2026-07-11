<?php

namespace App\Livewire;

use App\Models\Feedback;
use Livewire\Attributes\Validate;
use Livewire\Component;

class FeedbackWidget extends Component
{
    public bool $open = false;

    #[Validate('required|integer|min:1|max:5')]
    public int $rating = 0;

    #[Validate('nullable|string|max:255')]
    public string $name = '';

    #[Validate('nullable|email|max:255')]
    public string $email = '';

    #[Validate('required|string|max:2000')]
    public string $message = '';

    public bool $submitted = false;

    public function setRating(int $rating): void
    {
        $this->rating = $rating;
    }

    public function submit(): void
    {
        $this->validate();

        Feedback::create([
            'name' => $this->name ?: null,
            'email' => $this->email ?: null,
            'rating' => $this->rating,
            'message' => $this->message,
            'page' => request()->headers->get('referer') ?? url()->previous(),
        ]);

        $this->reset(['name', 'email', 'message', 'rating']);
        $this->submitted = true;
    }

    public function reopen(): void
    {
        $this->submitted = false;
        $this->open = false;
    }

    public function render()
    {
        return view('livewire.feedback-widget');
    }
}
