<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Repositories\CategoryRepositoryInterface;
use Illuminate\Http\Request;

class deleteCategory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:category {category_id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete Category';

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
        $category = $category->delete($this->argument('category_id'));
        $this->info("Category deleted!");
    }
}
