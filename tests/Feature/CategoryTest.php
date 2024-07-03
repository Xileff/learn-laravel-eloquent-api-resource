<?php

namespace Tests\Feature;

use App\Models\Category;
use Database\Seeders\CategorySeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    public function testResource()
    {
        $this->seed([CategorySeeder::class]);

        $category = Category::first();

        $this->get("/api/categories/$category->id")
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    'id' => $category->id,
                    'name' => $category->name,
                    'createdAt' => $category->created_at->toJSON(),
                    'updatedAt' => $category->updated_at->toJSON(),
                ]
            ]);
    }

    public function testResourceCollection()
    {
        $this->seed([CategorySeeder::class]);

        $categories = Category::all();

        $this->get('/api/categories')
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    [
                        'id' => $categories[0]->id,
                        'name' => $categories[0]->name,
                        'createdAt' => $categories[0]->created_at->toJSON(),
                        'updatedAt' => $categories[0]->updated_at->toJSON(),
                    ],
                    [
                        'id' => $categories[1]->id,
                        'name' => $categories[1]->name,
                        'createdAt' => $categories[1]->created_at->toJSON(),
                        'updatedAt' => $categories[1]->updated_at->toJSON(),
                    ],
                ]
            ]);
    }
}
