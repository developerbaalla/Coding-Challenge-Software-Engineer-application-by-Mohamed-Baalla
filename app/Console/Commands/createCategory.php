<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Repositories\CategoryRepositoryInterface;
use Illuminate\Http\Request;

class createCategory extends Command
{
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
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(Request $request, CategoryRepositoryInterface $category)
    {
        $categories = $category->list();
        $catsKeys = array_keys(reset($categories));
        $catsKeys[] = 'keep_Empty';

        do { $name = $this->ask('What is the category name?'); } while ( !$name or strlen($name) > 250 );

        print_r(reset($categories));
        $parent_category = $this->choice('What is the parent_category?', $catsKeys);
        $parent_category = (!empty($parent_category)? $parent_category: '');

        $request->merge(["name"=>$name, "parent_category"=>(($parent_category!='keep_Empty')? $parent_category: null)]);

        $category = $category->create();

        $this->info("category created!");
    }
}
