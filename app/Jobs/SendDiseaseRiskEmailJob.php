<?php

namespace App\Jobs;

use App\Mail\DiseaseRiskAlert;
use App\Models\DiseaseRisk;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendDiseaseRiskEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $diseaseRisk;

    public function __construct(DiseaseRisk $diseaseRisk)
    {
        $this->diseaseRisk = $diseaseRisk;
    }

    public function handle()
    {
        $farmers = User::where('role', 'FARMER')->get();

        foreach ($farmers as $farmer) {
            Mail::to($farmer->email)->send(new DiseaseRiskAlert($this->diseaseRisk, $farmer));
        }
    }
}
