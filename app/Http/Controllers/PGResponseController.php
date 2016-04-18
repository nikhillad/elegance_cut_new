<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\MailController;
use Config;
use DB;
use App;

class PGResponseController extends Controller
{
	//Upon transaction success
    public function success(Request $request)
    {
    	$pg_id = $request->input('mihpayid','');
        $mode = $request->input('mode','');
        $status = $request->input('status','');
        $txn_id = $request->input('txnid','');
        $amount = $request->input('amount','');
        $cardCategory = $request->input('cardCategory','');
        $net_amount_debit = $request->input('net_amount_debit','');
        $firstname = $request->input('firstname','');
        $lastname = $request->input('lastname','');
        $PG_TYPE = $request->input('PG_TYPE','');
        $bank_ref_num = $request->input('bank_ref_num','');
        $bankcode = $request->input('bankcode','');
        $error = $request->input('error','');
        $error_Message = $request->input('error_Message','');
        $name_on_card = $request->input('name_on_card','');
        $cardnum = $request->input('cardnum','');
        $issuing_bank = $request->input('issuing_bank','');
        $card_type = $request->input('card_type','');

        //update txn master
        $objTxnMaster = App\TxnMaster::where('txn_id',$txn_id)->first();

        $objTxnMaster->pg_id = $pg_id;
        $objTxnMaster->status = $status;
        $objTxnMaster->mode = $mode;
        $objTxnMaster->error = $error_Message;
        $objTxnMaster->bank_code = $bankcode;
        $objTxnMaster->pg_type = $PG_TYPE;
        $objTxnMaster->bank_ref_no = $bank_ref_num;
        $objTxnMaster->name_on_card = $name_on_card;
        $objTxnMaster->card_no = $cardnum;
        $objTxnMaster->issuing_bank = $issuing_bank;
        $objTxnMaster->card_type = $card_type;

        $objTxnMaster->save();

        //update order master
        App\OrderMaster::where('txn_id',$txn_id)->update(array('status'=>'approved'));

        //decrease item qty from inventory
        $objOrders = App\OrderMaster::where('txn_id',$txn_id)->get();

        foreach ($objOrders as $key => $value) {
            removePurchasedItemFromInventory($value->item_id,$value->size,$value->qty);
        }

        //send notification to user
        MailController::send_txn_notification('success',$objTxnMaster);

        return view('pg_response.success',compact('objTxnMaster'));
    }

    //Upon transaction failure
    public function fail(Request $request)
    {
    	$pg_id = $request->input('mihpayid','');
        $mode = $request->input('mode','');
        $status = $request->input('status','');
        $txn_id = $request->input('txnid','');
        $amount = $request->input('amount','');
        $cardCategory = $request->input('cardCategory','');
        $net_amount_debit = $request->input('net_amount_debit','');
        $firstname = $request->input('firstname','');
        $lastname = $request->input('lastname','');
        $PG_TYPE = $request->input('PG_TYPE','');
        $bank_ref_num = $request->input('bank_ref_num','');
        $bankcode = $request->input('bankcode','');
        $error = $request->input('error','');
        $error_Message = $request->input('error_Message','');
        $name_on_card = $request->input('name_on_card','');
        $cardnum = $request->input('cardnum','');
        $issuing_bank = $request->input('issuing_bank','');
        $card_type = $request->input('card_type','');

        //update txn master
        $objTxnMaster = App\TxnMaster::where('txn_id',$txn_id)->first();

        $objTxnMaster->pg_id = $pg_id;
        $objTxnMaster->status = $status;
        $objTxnMaster->mode = $mode;
        $objTxnMaster->error = $error_Message;
        $objTxnMaster->bank_code = $bankcode;
        $objTxnMaster->pg_type = $PG_TYPE;
        $objTxnMaster->bank_ref_no = $bank_ref_no;
        $objTxnMaster->name_on_card = $name_on_card;
        $objTxnMaster->card_no = $cardnum;
        $objTxnMaster->issuing_bank = $issuing_bank;
        $objTxnMaster->card_type = $card_type;

        $objTxnMaster->save();


        //send notification to user
        MailController::send_txn_notification('failed',$objTxnMaster);

        return view('pg_response.failed',compact('objTxnMaster'));
    }

    //Upon cancellation from user at PG side
    public function cancel(Request $request)
    {
    	$pg_id = $request->input('mihpayid','');
        $mode = $request->input('mode','');
        $status = $request->input('status','');
        $txn_id = $request->input('txnid','');
        $amount = $request->input('amount','');
        $cardCategory = $request->input('cardCategory','');
        $net_amount_debit = $request->input('net_amount_debit','');
        $firstname = $request->input('firstname','');
        $lastname = $request->input('lastname','');
        $PG_TYPE = $request->input('PG_TYPE','');
        $bank_ref_num = $request->input('bank_ref_num','');
        $bankcode = $request->input('bankcode','');
        $error = $request->input('error','');
        $error_Message = $request->input('error_Message','');
        $name_on_card = $request->input('name_on_card','');
        $cardnum = $request->input('cardnum','');
        $issuing_bank = $request->input('issuing_bank','');
        $card_type = $request->input('card_type','');

        //update txn master
        $objTxnMaster = App\TxnMaster::where('txn_id',$txn_id)->first();

        $objTxnMaster->pg_id = $pg_id;
        $objTxnMaster->status = $status;
        $objTxnMaster->mode = $mode;
        $objTxnMaster->error = $error_Message;
        $objTxnMaster->bank_code = $bankcode;
        $objTxnMaster->pg_type = $PG_TYPE;
        $objTxnMaster->bank_ref_no = $bank_ref_no;
        $objTxnMaster->name_on_card = $name_on_card;
        $objTxnMaster->card_no = $cardnum;
        $objTxnMaster->issuing_bank = $issuing_bank;
        $objTxnMaster->card_type = $card_type;

        $objTxnMaster->save();

        //update order master
        App\OrderMaster::where('txn_id',$txn_id)->update('status','cancelled');

        //send notification to user
        MailController::send_txn_notification('cancelled',$objTxnMaster);

        return view('pg_response.cancelled',compact('objTxnMaster'));
    }
}
