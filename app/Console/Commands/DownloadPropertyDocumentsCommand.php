<?php

namespace App\Console\Commands;

use App\Models\Document;
use App\Models\Property;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\IOFactory;

class DownloadPropertyDocumentsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'download-documents';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        for ($i = 1; $i <= 100; $i++) {
            $this->info("loop $i ...");
            $this->downloadDocs();
        }
    }

    private function downloadDocs()
    {
        $file = public_path('link2.csv');

        $spreadsheet = IOFactory::load($file);
        $dataArray = $spreadsheet->getActiveSheet()->toArray();
        $ids = [];
        foreach ($dataArray as $property) {
            $ids[] = $property[0];
        }

        $docIds = Document::all()->pluck('property_id')->toArray();

        $properties = Property::whereNotNull('beneficiary_id')->whereIn('stand_number', $ids)->whereNotIn('id',$docIds)->get();

        foreach ($properties->chunk(100) as $chunk) {
            $chunk->each(function ($property) {
                $filename = "EpworthOfferLetter_$property->id .pdf";
                $url = env('API_URL')."beneficiary/epworth-offer-letter/$property->beneficiary_id/$property->id/download/none";

                $response = Http::timeout(320)->get($url);

                if ($response->successful()) {
                    Storage::put($filename, $response->body());

                } else {
                    $this->info("$property->id  - $property->stand_number $property->township,   $response");
                }

            });

        }
    }
}
