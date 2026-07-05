<?php

namespace App\Filament\Pages;

use App\Models\Profile;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class SiteContent extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationGroup = 'Portfolio Content';

    protected static ?int $navigationSort = 4;

    protected static ?string $title = 'Site Content';

    protected static string $view = 'filament.pages.site-content';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill(Profile::firstOrFail()->toArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Hero section')
                    ->schema([
                        Forms\Components\Textarea::make('hero_heading')
                            ->required()
                            ->rows(2)
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('hero_subheading')
                            ->required()
                            ->rows(3)
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('About section')
                    ->schema([
                        Forms\Components\Textarea::make('about_paragraph_1')
                            ->label('Paragraph 1')
                            ->required()
                            ->rows(3)
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('about_paragraph_2')
                            ->label('Paragraph 2')
                            ->required()
                            ->rows(3)
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('Contact info')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required(),
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->required(),
                        Forms\Components\TextInput::make('phone'),
                        Forms\Components\TextInput::make('location'),
                        Forms\Components\TextInput::make('website_url')
                            ->label('Website URL')
                            ->url()
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Integrations')
                    ->schema([
                        Forms\Components\TextInput::make('github_username')
                            ->label('GitHub username')
                            ->helperText('Enables the GitHub Activity section on the homepage. Leave blank to hide it.')
                            ->prefix('github.com/'),
                    ]),

                Forms\Components\Section::make('Stats bar')
                    ->description('"Projects shipped" is counted automatically from your Projects list.')
                    ->schema([
                        Forms\Components\TextInput::make('stats_months_internship')
                            ->label('Months of internship')
                            ->numeric()
                            ->required(),
                        Forms\Components\TextInput::make('stats_technologies')
                            ->label('Technologies used')
                            ->numeric()
                            ->required(),
                        Forms\Components\TextInput::make('stats_percent_learning')
                            ->label('% committed to learning')
                            ->numeric()
                            ->minValue(0)
                            ->maxValue(100)
                            ->required(),
                    ])
                    ->columns(3),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();
        $profile = Profile::firstOrFail();

        if ($data['location'] !== $profile->location) {
            $data['latitude'] = null;
            $data['longitude'] = null;
        }

        $profile->update($data);

        Notification::make()
            ->title('Site content updated')
            ->success()
            ->send();
    }
}
