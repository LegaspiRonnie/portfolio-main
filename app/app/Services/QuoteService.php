<?php

namespace App\Services;

class QuoteService
{
    /**
     * A curated bank of real, correctly-attributed programming quotes.
     *
     * Live "programming quotes" APIs were evaluated and rejected: quotable.io
     * (the most common choice) is offline, and the community alternative
     * (programming-quotesapi.vercel.app) returned HTTP 429 on the first
     * request during testing. A local bank guarantees the widget always
     * has something real to show instead of failing silently.
     *
     * @return array<int, array{text: string, author: string}>
     */
    public function all(): array
    {
        return [
            ['text' => 'Talk is cheap. Show me the code.', 'author' => 'Linus Torvalds'],
            ['text' => 'Any fool can write code that a computer can understand. Good programmers write code that humans can understand.', 'author' => 'Martin Fowler'],
            ['text' => 'First, solve the problem. Then, write the code.', 'author' => 'John Johnson'],
            ['text' => 'Make it work, make it right, make it fast.', 'author' => 'Kent Beck'],
            ['text' => 'Programs must be written for people to read, and only incidentally for machines to execute.', 'author' => 'Harold Abelson'],
            ['text' => 'Premature optimization is the root of all evil.', 'author' => 'Donald Knuth'],
            ['text' => "It's not a bug – it's an undocumented feature.", 'author' => 'Anonymous'],
            ['text' => 'Debugging is twice as hard as writing the code in the first place.', 'author' => 'Brian Kernighan'],
            ['text' => 'Code is like humor. When you have to explain it, it\'s bad.', 'author' => 'Cory House'],
            ['text' => 'Simplicity is prerequisite for reliability.', 'author' => 'Edsger W. Dijkstra'],
            ['text' => 'Deleted code is debugged code.', 'author' => 'Jeff Sickel'],
            ['text' => 'There are only two hard things in Computer Science: cache invalidation and naming things.', 'author' => 'Phil Karlton'],
            ['text' => 'Walking on water and developing software from a specification are easy if both are frozen.', 'author' => 'Edward V. Berard'],
            ['text' => 'The most disastrous thing that you can ever learn is your first programming language.', 'author' => 'Alan Kay'],
            ['text' => 'Truth can only be found in one place: the code.', 'author' => 'Robert C. Martin'],
        ];
    }

    public function random(): array
    {
        $quotes = $this->all();

        return $quotes[array_rand($quotes)];
    }
}
