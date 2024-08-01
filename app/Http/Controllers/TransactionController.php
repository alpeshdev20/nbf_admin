<?php

namespace App\Http\Controllers;
use App\DataTables\transactionDataTable;
use App\Models\transaction;
use DB;
use Flash;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index(transactionDataTable $transactionPlanDataTable)
    {
        // return 'hello';
        return $transactionPlanDataTable->render('transaction.index');
    }

    public function update($id)
    {
        $transaction = transaction::find($id);
        

        if (empty($transaction)) {
            Flash::error('Transaction not found');

            return redirect(route('transaction.index'));
        }
        if($transaction->refund_amount != null)
        {
            transaction::where('id',$id)->update(['refund_status' =>'Done']);
            Flash::success('Transaction updated successfully.');
        }
        return redirect(route('transaction.index'));
    }
}
