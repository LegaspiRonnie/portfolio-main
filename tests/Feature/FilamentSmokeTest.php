<?php

namespace Tests\Feature;

use App\Filament\Pages\SiteContent;
use App\Filament\Resources\ProjectResource\Pages\CreateProject;
use App\Filament\Resources\ProjectResource\Pages\ListProjects;
use App\Livewire\ContactForm;
use App\Models\ContactMessage;
use App\Models\Profile;
use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Livewire\Livewire;
use Tests\TestCase;

class FilamentSmokeTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Prevent any real network calls to the external APIs the homepage now uses
        // (geocoding, weather, GitHub) — this suite only cares about app behavior.
        Http::fake();

        $this->artisan('db:seed');
    }

    public function test_guest_is_redirected_from_admin(): void
    {
        $this->get('/admin')->assertRedirect('/admin/login');
    }

    public function test_admin_can_view_dashboard(): void
    {
        $user = User::first();

        $this->actingAs($user)->get('/admin')->assertOk();
    }

    public function test_admin_can_view_all_resource_pages(): void
    {
        $user = User::first();

        $this->actingAs($user)->get('/admin/projects')->assertOk();
        $this->actingAs($user)->get('/admin/projects/create')->assertOk();
        $this->actingAs($user)->get('/admin/experience-entries')->assertOk();
        $this->actingAs($user)->get('/admin/experience-entries/create')->assertOk();
        $this->actingAs($user)->get('/admin/skills')->assertOk();
        $this->actingAs($user)->get('/admin/skills/create')->assertOk();
        $this->actingAs($user)->get('/admin/contact-messages')->assertOk();
        $this->actingAs($user)->get('/admin/visits')->assertOk();
        $this->actingAs($user)->get('/admin/site-content')->assertOk();
    }

    public function test_viewing_a_message_marks_it_read(): void
    {
        $user = User::first();
        $message = ContactMessage::first();

        $this->assertNull($message->read_at);

        $this->actingAs($user)->get("/admin/contact-messages/{$message->id}")->assertOk();

        $this->assertNotNull($message->fresh()->read_at);
    }

    public function test_public_homepage_still_works(): void
    {
        $this->get('/')->assertOk();
    }

    public function test_contact_form_validates_and_stores_message(): void
    {
        $before = ContactMessage::count();

        Livewire::test(ContactForm::class)
            ->set('name', '')
            ->set('email', 'not-an-email')
            ->set('message', '')
            ->call('submit')
            ->assertHasErrors(['name', 'email', 'message']);

        $this->assertSame($before, ContactMessage::count());

        Livewire::test(ContactForm::class)
            ->set('name', 'Jane Recruiter')
            ->set('email', 'jane@example.com')
            ->set('message', 'Loved your portfolio, lets talk.')
            ->call('submit')
            ->assertHasNoErrors()
            ->assertSet('submitted', true);

        $this->assertSame($before + 1, ContactMessage::count());
        $this->assertDatabaseHas('contact_messages', [
            'name' => 'Jane Recruiter',
            'email' => 'jane@example.com',
        ]);
    }

    public function test_admin_can_create_a_project(): void
    {
        $this->actingAs(User::first());

        Livewire::test(CreateProject::class)
            ->fillForm([
                'title' => 'Test Project',
                'subtitle' => 'A subtitle',
                'description' => 'A description of the test project.',
                'tags' => ['Laravel', 'Testing'],
                'sort_order' => 5,
            ])
            ->call('create')
            ->assertHasNoFormErrors();

        $this->assertDatabaseHas('projects', ['title' => 'Test Project']);
        $this->assertSame(['Laravel', 'Testing'], Project::where('title', 'Test Project')->first()->tags);
    }

    public function test_admin_can_update_site_content(): void
    {
        $this->actingAs(User::first());

        Livewire::test(SiteContent::class)
            ->fillForm([
                'hero_heading' => 'Updated heading from test',
            ])
            ->call('save');

        $this->assertSame('Updated heading from test', Profile::first()->hero_heading);
    }

    public function test_archived_projects_are_hidden_from_the_public_site_but_visible_in_admin(): void
    {
        $project = Project::first();
        $this->assertNotNull($project);

        $this->get('/')->assertSee($project->title);

        $this->actingAs(User::first());
        Livewire::test(ListProjects::class)->callTableAction('archive', $project);

        $this->assertTrue($project->fresh()->is_archived);
        $this->get('/')->assertDontSee($project->title);

        Livewire::test(ListProjects::class, ['tableFilters' => ['is_archived' => ['value' => '1']]])
            ->assertCanSeeTableRecords([$project->fresh()]);
    }

    public function test_admin_can_restore_an_archived_project(): void
    {
        $project = Project::first();
        $project->update(['is_archived' => true]);

        $this->actingAs(User::first());
        Livewire::test(ListProjects::class, ['tableFilters' => ['is_archived' => ['value' => '1']]])
            ->callTableAction('restore', $project);

        $this->assertFalse($project->fresh()->is_archived);
        $this->get('/')->assertSee($project->title);
    }

    public function test_homepage_renders_the_quote_widget(): void
    {
        $response = $this->get('/');

        $response->assertOk();
        $response->assertSee('words to code by');
        $response->assertSee('Another one');
    }
}
