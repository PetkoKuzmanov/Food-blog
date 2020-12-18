<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CoronavirusController extends Controller
{
    //
    protected $dailyCases;

    protected $totalCases;

    protected $weeklyDeaths;


    public function __construct()
    {
        $result = Http::get('https://api.coronavirus.data.gov.uk/v1/data?filters=areaType=overview&structure={%22date%22:%22date%22,%22dateData%22:%22' . 'newCasesByPublishDate' . '%22}')['data'];
        $processedData = $result[0];
        $this->dailyCases = $processedData;

        // $result = Http::get('https://api.coronavirus.data.gov.uk/v1/data?filters=areaType=overview&structure={%22date%22:%22date%22,%22dateData%22:%22'.'cumCasesByPublishDate'.'%22}')['data'];
        // $processedData = $result[0];
        // $this->totalCases = $processedData['dateData'];

        $result = Http::get('https://api.coronavirus.data.gov.uk/v1/data?filters=areaType=overview&structure={%22date%22:%22date%22,%22dateData%22:%22' . 'newOnsDeathsByRegistrationDate' . '%22}')['data'];
        $processedData = $result[0];
        $this->weeklyDeaths = $processedData;
    }

    public function show()
    {
        return view('coronavirus.show', ['dailyCases' => $this->dailyCases], ['weeklyDeaths' => $this->weeklyDeaths]);
    }
}
