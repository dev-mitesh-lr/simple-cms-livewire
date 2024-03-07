<?php

namespace Database\Seeders;

use App\Models\Page;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class PagesTableSeeder extends Seeder
{
    protected $faker;

    public function __construct()
    {
        $this->faker = Faker::create();
    }

    public function run()
    {
        // Clear existing records to start fresh
        Page::truncate();

        // Seed pages
        $this->seedPages();
    }

    /**
     * Seed the database with sample pages and their hierarchical structure.
     *
     * @return void
     */
    private function seedPages()
    {
        $this->createPage('Page1', 'page1', $this->faker->paragraph);
        $this->createPage('Page1.1', 'page1-1', $this->faker->paragraph, 'page1');
        $this->createPage('Page1.1.1', 'page1-1-1', $this->faker->paragraph, 'page1-1');
        $this->createPage('Page1.2', 'page1-2', $this->faker->paragraph, 'page1');
        $this->createPage('Page2', 'page2', $this->faker->paragraph);
        $this->createPage('Page2.1', 'page2-1', $this->faker->paragraph, 'page2');
        $this->createPage('Page2.2', 'page2-2', $this->faker->paragraph, 'page2');
        $this->createPage('Page2.2.1', 'page2-2-1', $this->faker->paragraph, 'page2-2');

    }

    /**
     * Create a new page with the given title, slug, content, and parent slug.
     *
     * @param string $title The title of the page.
     * @param string $slug The slug of the page.
     * @param string $content The content of the page.
     * @param string|null $parentSlug The slug of the parent page (optional).
     * @return void
     */
    private function createPage($title, $slug, $content, $parentSlug = null)
    {
        $parent = null;
        if ($parentSlug) {
            $parent = Page::where('slug', $parentSlug)->first();
        }

        Page::create([
            'title' => $title,
            'slug' => $slug,
            'content' => $content,
            'parent_id' => $parent ? $parent->id : null,
        ]);
    }
}
