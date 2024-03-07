<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Page extends Model
{
    use HasFactory;

    protected $fillable = ['parent_id', 'slug', 'title', 'content'];

    /**
     * Get the parent page of the current page.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo(Page::class, 'parent_id');
    }

    /**
     * Get the children pages of the current page.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children()
    {
        return $this->hasMany(Page::class, 'parent_id')->with('children');
    }

    /**
     * Scope a query to filter pages by slug.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  array  $slug
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFilterslug($query, $slug)
    {
        if (empty($slug)) {
            return $query;
        }
        $slug_term = array_shift($slug);

        return $query->whereHas('parent', function ($subQuery) use ($slug_term, $slug) {
            $subQuery->where('slug', $slug_term)->filterslug($slug);
        });
    }


    /**
     * Set the slug attribute.
     *
     * @param  string  $value
     * @return void
     */
    public function setSlugAttribute($value)
    {   
        $this->attributes['slug'] = Str::slug($value);
    }

    /**
     * Get the full path of a child page.
     *
     * @param  \App\Models\Page  $childPage
     * @return string
     */
    public function getPath($childPage)
    {
        $path = [$this->slug];

        // Traverse up the hierarchy to get the path
        $parent = $this;
        while ($parent = $parent->parent) {
            array_unshift($path, $parent->slug);
        }

        // Add child page's slug
        $path[] = $childPage->slug;

        // Build the URL
        return implode('/', $path);
    }
}
