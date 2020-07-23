<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Repositories\ProductRepositoryInterface;
use Illuminate\Http\Request;

class deleteProduct extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:product {product_id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete Product';

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
    public function handle(Request $request, ProductRepositoryInterface $product)
    {
        $product = $product->delete($this->argument('product_id'));
        $this->info("Product deleted!");
    }
}
