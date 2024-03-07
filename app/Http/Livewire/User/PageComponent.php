<?php

namespace App\Http\Livewire\User;

use App\Models\Page;
use Livewire\Component;

class PageComponent extends Component
{
    // Properties
    public $page;
    public $breadcrumb;

    /**
     * Mount the component with optional slug parameter.
     *
     * @param  string|null  $slug
     * @return void
     */
    public function mount($slug = null)
    {       
        // Extract slug details
        $slugs = $this->extractSlugDetails($slug);
    
        // Query the page based on slug
        $page = Page::where('slug', $slugs['currentSlug'])->filterSlug($slugs['otherSlugs'])->first();
        
        // Abort if query result is blank and slugs are not blank
        abort_if(blank($page) && !blank($slugs['otherSlugs']), 404);
     
        // Assign the page to $this->page
        $this->page = $page;
    }
    
    /**
     * Extract the slug details from the provided slug.
     *
     * @param  string  $slug
     * @return array
     */
    public function extractSlugDetails($slug)
    {   
        // Explode slug and retrieve details
        $slugs = explode('/', $slug);
        $this->breadcrumb = $slugs; 
        $slugs = array_reverse($slugs);
        $currentSlug = array_shift($slugs);

        return ['currentSlug' => $currentSlug, 'otherSlugs' => $slugs]; 
    }

    /**
     * Render the component.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function render()
    {
        // Render page view with guest layout
        return view('livewire.user.page-component')->layout('layouts.guest');
    }
}
