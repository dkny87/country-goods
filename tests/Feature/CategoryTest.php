<?php

namespace Tests\Feature;

use App\Models\Category;
use Illuminate\Container\Container;
use App\Repositories\Categories\CategoryRepository;
use App\Services\Categories\CategoryService;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\DKBaseTestCase;

class CategoryTest extends DKBaseTestCase
{
    use DatabaseTransactions;

    /**
     * @test
     */
    public function it_creates_a_category()
    {
        $data = [
            'name' => 'Category Name Pow',
            'description' => 'Category Description'
        ];

        $categoryService = new CategoryService(new CategoryRepository(new Container()));
        $category = $categoryService->create($data);

        $this->assertInstanceOf(Category::class, $category);
        $this->assertEquals($data['name'], $category->name);
    }


    /**
     * @test
     */
    public function it_updates_a_category()
    {
        $data = [
            'name' => 'Category Name Po',
            'description' => 'Category Description'
        ];

        $category = factory(Category::class)->create();
        $category->update($data);

        $this->assertInstanceOf(Category::class, $category);
        $this->assertEquals($data['name'], $category->name);
    }
}
