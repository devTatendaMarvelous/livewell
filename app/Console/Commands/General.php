<?php

namespace App\Console\Commands;


use App\Models\Policy;
use App\Models\Receipt;
use App\Models\SSB;
use App\Services\PayNowService;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class General extends Command
{


    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'general';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */

    protected PayNowService $payNowService;

    public function __construct(PayNowService $payNowService)
    {
        $this->payNowService = $payNowService;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $reference = 'INV-' . time();
        $payment = $this->payNowService->initiateMobilePayment( 1, $reference, '0784657168');

dd ($payment);        return 0;
    }


}
