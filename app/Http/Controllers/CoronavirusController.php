<?php

namespace App\Http\Controllers;

class CoronavirusController extends Controller
{
    protected $dailyCases;

    protected $weeklyDeaths;

    public function __construct(array $dailyCases, array $weeklyDeaths)
    {
        $this->dailyCases = $dailyCases;

        $this->weeklyDeaths = $weeklyDeaths;
    }

    public function show()
    {
        return view('coronavirus.show', ['dailyCases' => $this->dailyCases], ['weeklyDeaths' => $this->weeklyDeaths]);
    }
}
