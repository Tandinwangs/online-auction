<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use App\Models\Item;

class UpdateBidStatuses extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-bid-statuses';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update bid statuses based on auction end time';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $items = Item::where('auction_end', '<', Carbon::now())->get();

        foreach ($items as $item){
            $highestBid = $item->bids()->orderBy('amount', 'desc')->first();

            if ($highestBid) {
                $highestBid->update(['status' => 'wins']);

                $item->bids()->where('id', '!=' , $highestBid->id)->update(['status' => 'loss']);
            }
        }

    }   
}
