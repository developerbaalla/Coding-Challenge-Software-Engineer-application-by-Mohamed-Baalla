<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class createCategory extends Command
{
    /**
     *
     * @var App\Services\CategoryService
     */
    protected $categoryService;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:category';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create New Category';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $categories = $this->categoryService->getList();
        $categoriesId = array_keys(reset($categories));
        $categoriesId[] = 'keep_Empty';

        do { $name = $this->ask('What is the category name?'); } while ( !$name or strlen($name) > 250 );

        // print_r(reset($categories));
        $parentCategory = $this->choice('What is the parent_category?', $categoriesId);
        $parentCategory = (!empty($parentCategory)? $parentCategory: '');

        $category = $this->categoryService->saveCategory([
            "name"=> $name, 
            "parent_category"=> (($parentCategory!='keep_Empty')? $parentCategory: null)
        ]);

        $this->info("category created!");
    }
}
