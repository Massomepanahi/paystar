<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Carbon;

class TransactionCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return
            $this->collection->map(function ($item) {

                return [
                    'transactionId' => $item->transactionId,
                    'traceId' => $item->traceId,
                    'amount' => (int)$item->Upvote,
                    'transactionDate' => Carbon::createFromDate($item->transactionDate)->format('Y/m/d'),
                    'senderName' => $item->senderName,
                    'senderIban' => $item->senderIban,
                    'senderBank' => $item->senderBank,
                    'receiverIban' => $item->receiverIban,
                    'receiverName' => $item->receiverName,
                    'comment' => $item->comment,
                    'payaCycle' => $item->payaCycle,
                    'payId' => $item->payId,
                    'returnCausality' => $item->returnCausality,
                    'returnId' => $item->returnId,
                    'rejected' => $item->rejected,
                    'adDate' => $item->adDate,


                ];


            });
    }
}
