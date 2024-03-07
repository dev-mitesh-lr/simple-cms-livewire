<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Page;

class PageListComponent extends Component
{
    public $deleteId = false;
    /**
     * Get all pages ordered by ID in descending order.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getPagesProperty()
    {
        return Page::orderBy('id', 'desc')->get();
    }

    /**
     * Delete a page by ID.
     *
     * @param  int  $id
     * @return void
     */
    public function deletePage($id)
    {
        $page = Page::find($id);
        $page->delete();
        session()->flash('message', 'Page Delete Successfully');
        $this->hideModal();
    }

    /**
     * Set the ID of the item to be deleted and display confirmation modal.
     *
     * @param int $id The ID of the item to be deleted.
     * @return void
     */
    public function confirmDelete($id)
    {
        $this->deleteId = $id;
    }

    /**
     * Hide the confirmation modal.
     *
     * @return void
     */
    public function  hideModal()
    {
        $this->deleteId = false;
    }

    /**
     * Render the Livewire component.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('livewire.page-list-component');
    }
}
