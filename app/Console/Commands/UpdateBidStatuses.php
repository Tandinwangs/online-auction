<?php

namespace App\Console\Commands;

use App\Mail\AuctionStatusUpdateMail;
use Carbon\Carbon;
use Illuminate\Console\Command;
use App\Models\Item;
use Illuminate\Support\Facades\Mail;

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
            $highestBid = $item->bids()->where('status', 'bidding stage')->orderBy('amount', 'desc')->first();

            if ($highestBid) {
                $highestBid->update(['status' => 'wins in Bidding']);
                $user = $highestBid->user;
                $item = $highestBid->item;
                Mail::to($user->email)->send(new AuctionStatusUpdateMail($user, $item));

                $item->bids()->where('id', '!=' , $highestBid->id)->update(['status' => 'loose in Bidding']);
            }
        }

        $this->info('UpdateBidStatus completed success');

    }   
}
