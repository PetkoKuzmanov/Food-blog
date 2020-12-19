<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use App\Http\Controllers\CoronavirusController;

class PublicApiController extends Controller
{
    public function fetchCoronavirusData()
    {
        $dailyCasesResult = Http::get('https://api.coronavirus.data.gov.uk/v1/data?filters=areaType=overview&structure={%22date%22:%22date%22,%22dateData%22:%22' . 'newCasesByPublishDate' . '%22}')['data'];
        $dailyCases = $dailyCasesResult[0];

        $weeklyCasesResult = Http::get('https://api.coronavirus.data.gov.uk/v1/data?filters=areaType=overview&structure={%22date%22:%22date%22,%22dateData%22:%22' . 'newOnsDeathsByRegistrationDate' . '%22}')['data'];
        $weeklyDeaths = $weeklyCasesResult[0];

        $coronavirusController = new CoronavirusController($dailyCases, $weeklyDeaths);

        return $coronavirusController->show();
    }
}
