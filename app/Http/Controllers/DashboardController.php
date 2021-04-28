<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Method index
     *
     * @return void
     */
    public function index()
    {
        $ordersCount = Order::count();
        return view('home', ['ordersCount' => $ordersCount]);
    }
}
