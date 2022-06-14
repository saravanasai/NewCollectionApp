<?php

namespace App\Http\Controller\Transaction;

use App\Lib\Controller;
use App\Lib\Request;
use App\Lib\Response;
use App\Model\Collection\Collection;
use App\Model\Transaction\Transaction;
use App\Model\User\User;
use App\Rule\User\UserRule;

class TransactionController extends Controller
{

    public function index(Request $request, Response $response)
    {

        $transactions = Transaction::make()->all();

        return $response->toJSON(["data" => $transactions]);
    }


    public function todayTransaction(Request $request, Response $response)
    {
        $today_transactions = Transaction::make()->TodayTransaction();

        return $response->toJSON(["data" => $today_transactions]);
    }




    public function show(Request $request, Response $response)
    {

        $transaction_info = Transaction::make()->find($request->id);

        return $response
            ->status(200)
            ->toJSON(["data" => $transaction_info]);
    }

    public function transactionReport(Request $request,Response $response)
    {   

        $report_data = Transaction::make()->transactionBetween($request->fromDate,$request->Todate);
        
        return $response->toJSON(["data"=>$report_data]);
    }
}
