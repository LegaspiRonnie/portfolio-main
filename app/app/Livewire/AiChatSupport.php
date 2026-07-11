<?php

namespace App\Livewire;

use Livewire\Component;

class AiChatSupport extends Component
{
    public bool $open = false;

    public string $draft = '';

    public array $messages = [];

    private function topics(): array
    {
        return [
            'services' => [
                'question' => 'What services do you offer?',
                'keywords' => ['service', 'services', 'offer', 'website', 'websites', 'portfolio', 'pos', 'point of sale', 'point-of-sale', 'custom system', 'custom systems', 'build', 'create', 'develop'],
                'answer' => "I build custom websites, portfolio sites, POS (point-of-sale) systems, and custom web applications — mainly with Laravel, React.js, and Vue.js.",
            ],
            'technologies' => [
                'question' => 'What technologies do you use?',
                'keywords' => ['tech', 'technology', 'technologies', 'stack', 'laravel', 'react', 'vue', 'mysql', 'php', 'tailwind', 'unity', 'c#', 'javascript'],
                'answer' => "Laravel and PHP on the backend, React.js and Vue.js on the frontend, MySQL for data, and Tailwind CSS for styling — plus Unity and C# from my capstone project.",
            ],
            'availability' => [
                'question' => 'Are you available for freelance projects?',
                'keywords' => ['available', 'availability', 'freelance', 'hire', 'hiring', 'open to work', 'contract', 'job'],
                'answer' => "Yes — I'm currently accepting new freelance and contract projects. Head to the Pricing page or use the contact form below to reach out.",
            ],
            'pricing' => [
                'question' => 'How much do your projects cost?',
                'keywords' => ['price', 'pricing', 'cost', 'rate', 'rates', 'budget', 'quote', 'how much', 'fee'],
                'answer' => "Pricing depends on scope. I offer Starter, Professional, and Custom/Retainer packages — see the Pricing page for estimated starting prices.",
            ],
            'contact' => [
                'question' => 'How can I contact you?',
                'keywords' => ['contact', 'email', 'reach', 'message', 'get in touch', 'call', 'phone'],
                'answer' => "The fastest way is the contact form on the homepage, or email me directly at ronnielegaspi98@gmail.com.",
            ],
            'portfolio' => [
                'question' => 'Can I see more of your work?',
                'keywords' => ['work', 'projects', 'gallery', 'portfolio', 'samples', 'examples', 'case study', 'case studies', 'screenshot'],
                'answer' => "Definitely — check out the full Project Gallery for detailed write-ups, screenshots, and live demo links.",
            ],
        ];
    }

    public function ask(string $topicKey): void
    {
        $topics = $this->topics();

        if (! isset($topics[$topicKey])) {
            return;
        }

        $topic = $topics[$topicKey];
        $this->messages[] = ['from' => 'user', 'text' => $topic['question']];
        $this->simulateThinking();
        $this->messages[] = ['from' => 'bot', 'text' => $topic['answer']];
    }

    public function send(): void
    {
        $text = trim($this->draft);

        if ($text === '') {
            return;
        }

        $this->messages[] = ['from' => 'user', 'text' => $text];
        $this->draft = '';

        $lower = strtolower($text);
        $bestAnswer = null;
        $bestScore = 0;

        foreach ($this->topics() as $topic) {
            $score = 0;

            foreach ($topic['keywords'] as $keyword) {
                if (str_contains($lower, $keyword)) {
                    $score++;
                }
            }

            if ($score > $bestScore) {
                $bestScore = $score;
                $bestAnswer = $topic['answer'];
            }
        }

        $this->simulateThinking();

        $this->messages[] = [
            'from' => 'bot',
            'text' => $bestAnswer ?? "That's a bit outside what I can help with in this quick chat — please reach out through the contact form below and I'll get back to you personally!",
        ];
    }

    public function restart(): void
    {
        $this->messages = [];
        $this->draft = '';
    }

    private function simulateThinking(): void
    {
        usleep(500000);
    }

    public function render()
    {
        return view('livewire.ai-chat-support', [
            'suggestions' => $this->topics(),
        ]);
    }
}
