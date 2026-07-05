<?php

namespace App\Livewire;

use App\Models\PricingLead;
use Livewire\Attributes\Validate;
use Livewire\Component;

class PurchaseInterest extends Component
{
    public bool $open = false;

    #[Validate('required|string|max:255')]
    public string $name = '';

    #[Validate('required|email|max:255')]
    public string $email = '';

    #[Validate('required|string|max:255')]
    public string $plan = '';

    #[Validate('nullable|string|max:2000')]
    public string $message = '';

    public bool $submitted = false;

    protected $listeners = ['open-purchase-modal' => 'openFor'];

    public function openFor(string $plan): void
    {
        $this->plan = $plan;
        $this->open = true;
        $this->submitted = false;
    }

    public function submit(): void
    {
        $this->validate();

        PricingLead::create([
            'name' => $this->name,
            'email' => $this->email,
            'plan' => $this->plan,
            'message' => $this->message ?: null,
        ]);

        $this->reset(['name', 'email', 'message']);
        $this->submitted = true;
    }

    public function close(): void
    {
        $this->open = false;
        $this->submitted = false;
    }

    public function render()
    {
        return view('livewire.purchase-interest');
    }
}
