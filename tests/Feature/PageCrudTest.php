<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Page;
use App\Models\User;
use Livewire\Livewire;
use App\Http\Livewire\PageListComponent;
use Illuminate\Foundation\Testing\WithFaker;
use App\Http\Livewire\PageCreateOrUpdateComponent;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PageCrudTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_render_page_list_component()
    {
        // Create a user
        $this->actingAs(User::factory()->create());

        // Render the Livewire component
        $component = Livewire::test(PageListComponent::class);

        // Assert that the component rendered successfully
        $component->assertStatus(200);
    }

    /** @test */
    public function it_shown_an_create_page_page()
    {
        $this->actingAs(User::factory()->create());
        $this->get('/page/update')
            ->assertStatus(200);
    }

    /** @test */
    public function can_create_page()
    {
        // $this->actingAs(User::factory()->create());
        Livewire::test(PageCreateOrUpdateComponent::class)
            ->set('title', 'New Page')
            ->set('slug', 'new-page')
            ->set('content', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.')
            ->call('submitForm', new Page())
            ->assertRedirect(route('pages'))
            ->assertSessionHas('message', 'Page created successfully.');

        $this->assertDatabaseHas('pages', [
            'title' => 'New Page',
            'slug' => 'new-page',
            'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
        ]);
    }

    /** @test */
    public function can_edit_page()
    {
        $page = Page::factory()->create();

       $data =  Livewire::test(PageCreateOrUpdateComponent::class, ['id' => $page->id])
            ->set('title', 'Updated Page Title')
            ->set('slug', 'updated-page-slug')
            ->set('content', 'Updated content for the page.')
            ->call('submitForm', $page)
            ->assertRedirect(route('pages'))
            ->assertSessionHas('message', 'Page updated successfully.');

        $this->assertDatabaseHas('pages', [
            'id' => $page->id,
            'title' => 'Updated Page Title',
            'slug' => 'updated-page-slug',
            'content' => 'Updated content for the page.',
        ]);
    }

    /** @test */
    public function can_delete_page()
    {
        // Create a page to be deleted
        $page = Page::factory()->create();

        // Ensure that the page exists in the database
        $this->assertDatabaseHas('pages', $page->toArray());

        // Run Livewire test to delete the page
        Livewire::test(PageListComponent::class, ['id' => $page->id])
            ->call('deletePage', $page->id);

        // Ensure that the page has been deleted from the database
        $this->assertDatabaseMissing('pages', $page->toArray());
    }


     /** @test */
    public function cannot_create_page_with_same_slug_and_parent()
    {
        // Create a parent page
        $parentPage = Page::factory()->create();

        // Create an existing page with the same parameters
        $existingPage = Page::factory()->create([
            'slug' => 'existing-page',
            'parent_id' => $parentPage->id,
        ]);

        Livewire::test(PageCreateOrUpdateComponent::class)
            ->set('title', 'New Page')
            ->set('slug', 'existing-page') 
            ->set('content', 'Content for the new page.')
            ->set('parentId', $parentPage->id) 
            ->call('submitForm', $existingPage) 
            ->assertHasErrors(['parentId']); 
    }


     /** @test */
     public function can_create_page_with_same_slug_and_parent()
     {
         // Create a parent page
         $parentPage = Page::factory()->create();
 
         // Create an existing page with the same parameters
         $existingPage = Page::factory()->create([
             'slug' => 'existing-page',
             'parent_id' => $parentPage->id,
         ]);
 
         Livewire::test(PageCreateOrUpdateComponent::class)
             ->set('title', 'New Page')
             ->set('slug', 'existing-page-update') 
             ->set('content', 'Content for the new page.')
             ->set('parentId', $parentPage->id) 
             ->call('submitForm', $existingPage) 
             ->assertHasNoErrors();
     }

      /** @test */
    public function is_render_first_page()
    {
        $this->actingAs(User::factory()->create());
        $this->get('/page')
            ->assertStatus(200);
    }

    /** @test */
    public function it_renders_page_list_with_pages()
    {
        $page = Page::factory()->create();
        Livewire::test(PageListComponent::class)->assertSee($page->title);
    }

    /** @test */
    public function it_renders_page_component()
    {
        // Create pages with and without parent_id
        $page = Page::factory()->create();
        $pageWithParent = Page::factory()->create(['parent_id' => $page->id]);

        $this->get('/page/' . $pageWithParent->slug)->assertSee($pageWithParent->title);
    }

    /** @test */
    public function it_renders_page_with_parents_component()
    {
        // Create pages with and without parent_id
        $page = Page::factory()->create();
        $pageWithParent = Page::factory()->create(['parent_id' => $page->id]);
        $pageWithParent1 = Page::factory()->create(['parent_id' => $pageWithParent->id]);
        $pageWithParent2 = Page::factory()->create(['parent_id' => $pageWithParent1->id]);

        $this->get('/page/' . $pageWithParent->slug . '/' . $pageWithParent1->slug . '/' . $pageWithParent2->slug)->assertSee($pageWithParent2->title);
    }
}
