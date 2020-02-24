<?php

namespace Tests\Feature;

use App\Http\Controllers\API\Categories\CategoryController;
use App\Models\Category;
use Illuminate\Container\Container;
use App\Repositories\Categories\CategoryRepository;
use App\Services\Categories\CategoryService;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CategoryTest extends FCBaseTestCase
{
    use DatabaseTransactions;

    /**
     * @test
     */
    public function it_creates_a_category()
    {
        $data = [
            'name' => 'Category Name',
            'description' => 'Category Description'
        ];

        $categoryService = new CategoryService(new CategoryRepository(new Container()));
        $category = $categoryService->create($data);

        $this->assertInstanceOf(Category::class, $category);
        $this->assertEquals($data['name'], $category->name);
    }
}
