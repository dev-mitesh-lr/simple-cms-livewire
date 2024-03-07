<?php

namespace App\Rules;

use App\Models\Page;
use Illuminate\Support\Str;
use Illuminate\Contracts\Validation\Rule;

class SlugValidateRule implements Rule
{
    protected $slug;
    protected $pageId;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($slug,$pageId)
    {
        $this->slug = Str::slug($slug);
        $this->pageId = Str::slug($pageId);
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {       
        $page = Page::where('slug',$this->slug)->where('parent_id',$value)->when(!blank($this->pageId),function($query){
            return $query->where('id','!=',$this->pageId);
        })->first();    
        return blank($page);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Please choose another slug.It matches the slug of an existing child item under this parent.';
    }
}
