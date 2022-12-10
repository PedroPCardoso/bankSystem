<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Client;
use App\Models\HistoricBalance;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;

class HistoricBalanceController extends Controller
{
   public function index(){
        $historics = HistoricBalance::paginate(8);

        return Inertia::render("HistoricBalance/index", ["historics" => $historics]);

   }

   public function create()
    {
        return Inertia::render('HistoricBalance/create');
    }

   public function store(Request $request){
 
        HistoricBalance::create(
            [
                'amount'=> $request->amount,
                'type'=>$request->type,
                'Description' =>$request->Description
            ]
            );
        return Redirect::route('posts.Index');
   }
   public function show($id,Request $request){

   }
}
