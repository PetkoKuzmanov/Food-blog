<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PublicApiController extends Controller
{
    
    // public function __construct()
    // {
    //     $this->$http = $http;
    // }

    public function fetchCoronavirusData()
    {
        $dailyCasesResult = $this->http::get('https://api.coronavirus.data.gov.uk/v1/data?filters=areaType=overview&structure={%22date%22:%22date%22,%22dateData%22:%22' . 'newCasesByPublishDate' . '%22}')['data'];
        $dailyCases = $dailyCasesResult[0];

        // $this->dailyCases = $processedData;

        $weeklyCasesResult = $this->http::get('https://api.coronavirus.data.gov.uk/v1/data?filters=areaType=overview&structure={%22date%22:%22date%22,%22dateData%22:%22' . 'newOnsDeathsByRegistrationDate' . '%22}')['data'];
        $weeklyDeaths = $weeklyCasesResult[0];

        // $this->weeklyDeaths = $processedData;

        return(['dailyCases' => $dailyCases, 'weeklyDeaths' => $weeklyDeaths]);
    }
}
