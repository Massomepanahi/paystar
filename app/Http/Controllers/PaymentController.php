<?php

namespace App\Http\Controllers;

use App\Http\Resources\Deposit;
use App\Models\Transaction;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function transferTo(Request $request)
    {

        $validatedData = $request->validate(
            [
                'clientId' => 'required|integer',
                'trackId' => 'required|string|max:40',
                'amount' => 'required|integer',
                'description' => 'required|string|max:30',
                'destinationFirstname' => 'required|string|max:33|min:2',
                'destinationLastname' => 'required|string|max:33|min:2',
                'destinationNumber' => 'required|string',
                'paymentNumber' => 'required|string|max:30',
                'deposit' => 'required|string',
                'sourceFirstName' => 'required|string',
                'sourceLastName' => 'required|string',
            ]);

        //---- after pay in bank ----

        if ($result->statusCode == 200) {
            $trans = Transaction::create(
                [
                    'trackId' => $result->trackId,
                    'amount' => $result->amount,
                    'description' => $result->description,
                    'destinationFirstname' => $result->destinationFirstname,
                    'destinationLastname' => $result->destinationLastname,
                    'destinationNumber' => $result->destinationNumber,
                    'paymentNumber' => $result->paymentNumber,
                    'type' => $result->type,
                    'sourceFirstName' => $result->sourceFirstName,
                    'sourceLastName' => $result->sourceLastName,
                    'inquiryTime' => $result->inquiryTime,
                    'inquiryDate' => $result->inquiryDate,
                    'inquirySequence' => $result->inquirySequence,
                    'refCode' => $result->refCode,


                ]
            );

            if ($trans) {
                return Response()->json(
                    ['message' => "انتقال وجه با موفقیت انجام شد."]
                )->setStatusCode(200);
            } else {
                return Response()->json(['message' => "حطا در دیتابیس"])->setStatusCode('other statuscode');
            }
        } else if ($result->statusCode == 400){
            return Response()->json(['message' => $result->error->message])->setStatusCode(400);

        }
        return Response()->json(['message' => "other error"])->setStatusCode('other statuscode');


    }

    public function deposit(Request $request)
    {


        $validatedData = $request->validate(
            [
                'clientId' => 'required',
                'deposit' => 'required|string|size:13',
                'trackId' => 'string|max:40',
                'fromDate' => 'required|date_format:YYYY/MM/DD',
                'toDate' => 'required|date_format:YYYY/MM/DD',
                'offset' => 'required|string|size:13',
                'length' => 'required|max:20',


            ]
        );

//---------- service response-----------
        $deposit = null;
        if ($deposit->status == 'Done') {
            return [
                'result' => (new Deposit($deposit)),
            ];
        } else {
            return Response()->json(['message' => "error"])->setStatusCode('errorcode');

        }

    }
}
