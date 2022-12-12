<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Client;
use App\Models\HistoricBalance;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\{CreateHistoricBalanceRequest, UpdateHistoricBalanceRequest};
use App\Repositories\HistoricBalanceRepository;


class HistoricBalanceController extends BaseController
{
    /** @var  HistoricBalanceRepository */
    private $HistoricBalanceRepository;

    public function __construct(HistoricBalanceRepository $HistoricBal)
    {
        $this->HistoricBalanceRepository = $HistoricBal;
    }
   public function index()
   {
        $user = Auth::user();
        $profile= Client::where("user_id", $user->id)->first();
        $historics = $this-> HistoricBalanceRepository->allQuery([
            "client_id" => $profile->id,
        ])->paginate(8);
        return $this->sendResponse("HistoricBalance/index", ["historics" => $historics]);

   }

   public function create()
    {
        return $this->sendResponse("HistoricBalance/create");
    }

   public function store(CreateHistoricBalanceRequest $request){
       
        $historics = $this-> HistoricBalanceRepository->create($request);
    
        return $this->sendResponse("HistoricBalance/index");
    }
   public function show($id,Request $request){

   }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HistoricBalance  $HistoricBalance
     * @return \Illuminate\Http\Response
     */
    public function edit(HistoricBalance $HistoricBalance)
    {
        return $this->sendResponse("HistoricBalance/edit",
            [
                'HistoricBalance' => [
                    'id' => $HistoricBalance->id,
                    'amount' => $HistoricBalance->amount,
                    'Description' => $HistoricBalance->Description
                ]
            ]
    
    );
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HistoricBalance  $HistoricBalance
     * @return \Illuminate\Http\Response
     */
    public function update($id, UpdateHistoricBalanceRequest $request)
    {
        $input = $request->all();

        $historic = $this->HistoricBalanceRepository->update($input, $id);

        return $this->sendResponse("HistoricBalance/index");
    }
}
