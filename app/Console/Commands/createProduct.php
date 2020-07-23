<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Repositories\ProductRepositoryInterface;
use App\Repositories\CategoryRepositoryInterface;
use Illuminate\Http\Request;

class createProduct extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:product';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create New Product';

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
    public function handle(Request $request, CategoryRepositoryInterface $categories, ProductRepositoryInterface $product)
    {
        $categories = $categories->list();

        do { $name = $this->ask('What is the product name?'); } while ( !$name or strlen($name) > 250 );
        do { $description = $this->ask('What is the product description?'); } while ( !$description or strlen($description) > 250 );
        do { $price = $this->ask('What is the product price?'); } while ( !is_numeric($price) or $price <= 0 );
        do { $image = $this->ask('Move image to '.public_path('images').' And put Image Name?'); } while ( !is_file(public_path('images').'/'.$image) );
        
        print_r(reset($categories));
        $category_id = $this->choice('What is the product category_id?', array_keys(reset($categories)));

        $request->merge(["name"=>$name, "description"=>$description, "price"=>$price, "image"=>$image, "category_id"=>$category_id]);

        $product = $product->create($image);

        $this->info("Product created!");
    }
}
