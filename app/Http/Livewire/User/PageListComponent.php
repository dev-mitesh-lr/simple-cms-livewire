<?php

namespace App\Http\Livewire\User;

use App\Models\Page;
use Livewire\Component;

class PageListComponent extends Component
{       
    /**
     * Retrieve pages without parent_id.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getPagesProperty()
    {
        return Page::whereNull('parent_id')->get();
    }

    /**
     * Render the component.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function render()
    {
        // Renders page list view with guest layout
        return view('livewire.user.page-list-component')->layout('layouts.guest');
    }
}
