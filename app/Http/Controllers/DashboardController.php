<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\HistoricBalance;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\{CreateHistoricBalanceRequest, UpdateHistoricBalanceRequest};
use App\Repositories\HistoricBalanceRepository;


class DashboardController extends BaseController
{
    private $HistoricBalanceRepository;

    public function __construct(HistoricBalanceRepository $HistoricBal)
    {
        $this->HistoricBalanceRepository = $HistoricBal;
    }

    public function index(){
        $user = Auth::user();
        $this->profile = Client::where("user_id", $user->id)->first();

        $historics = $this->HistoricBalanceRepository->allQuery([
            "client_id" => $this->profile->id,
        ])->orderBy("created_at", "desc")->paginate(8);
        return $this->sendResponse("Dashboard", ["historics" => $historics, "balance" => $this->profile->balance]);

   }
}
