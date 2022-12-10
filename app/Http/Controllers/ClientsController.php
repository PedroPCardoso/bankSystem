<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;

class ClientController extends Controller
{

public function getHistoricBalance(Request $request)
    {
        $client = Client::find(1);
        $historicBalance = $client->historic_balance;
        return $historicBalance;
    }
}