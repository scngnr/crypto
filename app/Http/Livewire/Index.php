<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Cryptoorder;

class Index extends Component
{
    public function render()
    {
        $openOrders = Cryptoorder::where('clientOrderId', NULL)->get();
        $closedOrders = Cryptoorder::where('clientOrderId', "closed")->paginate(25);

        return view('livewire.index', ['openOrders' => $openOrders, "closedOrders" => $closedOrders])->layout('layouts.mainLayout');
    }
}
