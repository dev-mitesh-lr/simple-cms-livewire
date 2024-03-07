<?php

namespace App\Http\Livewire;

use App\Models\Page;
use Livewire\Component;
use App\Rules\SlugValidateRule;

class PageCreateOrUpdateComponent extends Component
{
    // Properties for form fields and data
    public $pageId = null;
    public $title;
    public $slug;
    public $content;
    public $parentId = null;
    
    /**
     * Define the validation rules for the Livewire component.
     *
     * @return array The validation rules.
     */
    protected function rules()
    {       
        $slug_terms = !blank($this->slug) ? $this->slug :  $this->title;
        
        return [
            'title' => ['required', 'string', 'max:255'],
            'content' => 'required|string',
            'parentId' => [new SlugValidateRule($slug_terms,$this->pageId)]
        ];
    }
    // Initialize component with optional page ID
    public function mount($id = null)
    {
        // Set page ID from request
        $this->pageId = request()->id;
        // Set page data
        $this->setPageData();
        $this->emit('initializeSummernote');
    }

    /**
     * Get the page object.
     *
     * @return \App\Models\Page|null
     */
    public function getPageProperty()
    {
        return Page::find($this->pageId);
    }

    /**
     * Get pages except the current page.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getPagesProperty()
    {
        return Page::select(['id', 'title'])->when(!blank($this->pageId), function ($query) {
            return $query->where('id', '!=', $this->pageId);
        })->whereNull('parent_id')->with('children')->get();
    }

    /**
     * Sets page data from the page object.
     * 
     * This method assigns values to various properties of the object 
     * based on the corresponding properties of the page object.
     * If the properties of the page object are not set, empty strings 
     * are assigned to the respective properties of this object.
     *
     * @return void
     */
    public function setPageData()
    {
        $this->title = $this->page->title ?? '';
        $this->slug = $this->page->slug ?? '';
        $this->content = $this->page->content ?? '';
        $this->parentId = $this->page->parent_id ?? '';
    }

    // Handle form submission
    public function submitForm(Page $page)
    {
        // Validate form data
        $validatedData = $this->validate();
        $validatedData['parent_id'] = !blank($this->parentId) ? $this->parentId : null;
        $validatedData['slug'] = !blank($this->slug) ? $this->slug : $this->title;

        // Create new page
        Page::updateOrCreate(['id' => $page->id ?? null], $validatedData);
        $message =  isset($page->id) ? 'Page updated successfully.' : 'Page created successfully.';

        return redirect()->route('pages')->with('message', $message);
    }

    // Render the Livewire component
    public function render()
    {
        return view('livewire.page-component');
    }
}
