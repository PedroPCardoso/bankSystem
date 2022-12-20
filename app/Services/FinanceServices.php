<?php
namespace App\Services;

use App\Models\HistoricBalance;
use App\Repositories\{HistoricBalanceRepository, ClientRepository};
use App\Models\Client;
use Illuminate\Support\Facades\Auth;


class FinanceServices {

    private $profile;
    /** @var  HistoricBalanceRepository */
    private $HistoricBalanceRepository;
    /** @var  ClientRepository */
    private $ClientRepository;

    public function __construct(HistoricBalanceRepository $HistoricBal, ClientRepository $ClientRepository)
    {
        $this->HistoricBalanceRepository = $HistoricBal;
        $this->ClientRepository = $ClientRepository;
    }
    public function validateBalance(){

        $user = Auth::user();
        $this->profile = Client::where("user_id", $user->id)->first();

        $historics = $this->HistoricBalanceRepository->allQuery([
            "client_id" => $this->profile->id,
        ]);
        $depositsSum = $historics->where("type", HistoricBalance::TYPE_DEPOSIT)->sum("amount");
        $purchaseSum = $historics->where("type", HistoricBalance::TYPE_PAYMENT)->sum("amount");
        $balance = $depositsSum - $purchaseSum;
        return $balance;
        
    }
    public function transaction($data){
        $balance = $this->validateBalance();

        if($data->type == HistoricBalance::TYPE_DEPOSIT){
            return $this->creditValue($data->amount, $balance);
        }
        else if ($data->type == HistoricBalance::TYPE_PAYMENT) {
            return $this->debitValue($data->amount, $balance);
        }

    }
    public function debitValue($value,$balance){
        if($balance>=$value){
            $newBalance = $balance - $value;
            $update = $this->ClientRepository->update([
                "balance" => $newBalance
            ], $this->profile->id);
            if($update){
                return true;
            }
            return false;
        }
        else {
            $update = $this->ClientRepository->update([
                "balance" => $balance
            ], $this->profile->id);
            return false;
        }
        
    }
    public function creditValue($value, $balance)
    { 
        $newBalance = $balance + $value;
        $update = $this->ClientRepository->update([
            "balance" => $newBalance
        ], $this->profile->id);
        if ($update) {
            return true;
        }
        return false;

    }
    
}