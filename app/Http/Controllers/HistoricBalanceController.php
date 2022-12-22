<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Client;
use App\Models\HistoricBalance;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\{CreateHistoricBalanceRequest, UpdateHistoricBalanceRequest};
use App\Repositories\HistoricBalanceRepository;
use Illuminate\Support\Facades\Storage;
use App\Services\FinanceServices;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

class HistoricBalanceController extends BaseController
{
    /** @var  HistoricBalanceRepository */
    private $HistoricBalanceRepository;
    private $profile;
    private $financeService;
    public function __construct(HistoricBalanceRepository $HistoricBal, FinanceServices $financeService)
    {
        $this->HistoricBalanceRepository = $HistoricBal;
        $this->financeService = $financeService;
    }
   public function index(Request $request)
   {
        $user = Auth::user();
        $this->profile = Client::where("user_id", $user->id)->first();
        $arrayFilter = [
            "client_id" => $this->profile->id,
        ];
        isset($request->type) ? $arrayFilter['type'] = $request->type : null;
        $historics = $this-> HistoricBalanceRepository->allQuery($arrayFilter)->orderBy("created_at", "desc")->paginate(10);
        return $this->sendResponse("HistoricBalance/index", ["historics" => $historics,"balance"=>$this->profile->balance]);

   }

   public function create(Request $request)
    {
        return $this->sendResponse("HistoricBalance/create",["type"=> $request->type]);
    }

   public function store(CreateHistoricBalanceRequest $request){
        $user = Auth::user();
        $this->profile = Client::where("user_id", $user->id)->first();
        $input = $request->all();
        $input['client_id'] = $this->profile->id;
        if($request->has('receipt') && $request->receipt ){
            $input['receipt'] = $request->file('receipt')->store('receipts', 'public');
        }
        try {
            DB::beginTransaction();
            $response = $this->financeService->transaction($request);
            if($response){
                $historics = $this-> HistoricBalanceRepository->create($input);
            }
            DB::commit();
        } catch (\PDOException $e) {
            DB::rollBack();
        }
        return Redirect::route('dashboard');
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
