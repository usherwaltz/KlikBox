<?php

namespace App\Http\Controllers;

use App\Exports\OrderExport;
use App\Models\Item;
use App\Models\Order;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\OrderRequest;
use App\Mail\OrderMail;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Excel;

class OrderController extends Controller
{
    /**
     * Method __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['store', 'show', 'create', 'confirm']);
    }
    /**
     * Method index
     *
     * @return void
     */
    public function index()
    {
        $orders = Order::paginate(20);
        $orders->load('items');
        return view('orders.index', ['orders' => $orders]);
    }
    /**
     * Method check
     *
     * @param OrderRequest $request
     *
     * @return void
     */
    public function store(OrderRequest $request)
    {

        $cart = Cart::content();
        $id = Str::uuid()->toString();
        $requestData = [
            "name" => $request->name,
            "lastname" => $request->lastname,
            "email" => $request->email,
            "city" => $request->city,
            "postcode" => $request->postcode,
            "street" => $request->street,
            "phone" => $request->phone
        ];
        $orderData = [
            $id => [
                'data' => $requestData,
                'cart' => $cart
            ],
        ];

        session()->put('order', $orderData);

        return redirect(route('order.show', $id));
    }

    /**
     * Method show
     *
     * @param mixed $id
     *
     * @return void
     */
    public function show($id)
    {
        $data = [];
        $cart = Cart::content();
        $productIds = $cart->pluck('id')->unique();
        $products = Product::whereIn('id', $productIds)->get();
        $orders = session()->get('order');
        if ($orders) {
            $data['order'] = $orders[$id];
            $data['id'] = $id;
            $data['products']  = $products;
            return view('order.show', $data);
        }
        return abort(404);
    }

    /**
     * Method create
     *
     * @return void
     */
    public function create()
    {
        session()->forget('order');
        Cart::destroy();
        return redirect(route('cart.index'));
    }

    /**
     * Method confirm
     *
     * @param $id $id [explicite description]
     *
     * @return void
     */
    public function confirm($id)
    {
        $orders = session()->get('order');
        if ($orders) {
            $orderToConfirm = $orders[$id];
            $order = new Order();
            $order->id = $id;
            $order->name = $orderToConfirm['data']['name'];
            $order->lastname = $orderToConfirm['data']['lastname'];
            $order->city = $orderToConfirm['data']['city'];
            $order->street = $orderToConfirm['data']['street'];
            $order->postcode = $orderToConfirm['data']['postcode'];
            $order->phone = $orderToConfirm['data']['phone'];
            if ($orderToConfirm['data']['email']) {
                $order->email = $orderToConfirm['data']['email'];
            }
            $order->save();
            foreach ($orderToConfirm['cart'] as $row) {
                $opts = $row->options;
                $optnames = '';
                foreach ($opts as $key => $val) {
                    $optnames .= " $val";
                }
                $item = new Item();
                $item->order_id = $id;
                $item->name = $row->name . $optnames;
                $item->qty = $row->qty;
                $item->price = $row->price;
                $item->save();
            }
            session()->forget('order');
            session()->forget('cart');

            Mail::to('narudzbe@klikbox.ba')
                ->send(new OrderMail($order, $id));
            return view('order.finish', ['id' => $id]);
        } else {
            return redirect(url('/'));
        }
    }

    /**
     * Method showOrder
     *
     * @param $id $id [explicite description]
     *
     * @return void
     */
    public function showOrder($id)
    {
        $order = Order::find($id);
        $order->load('items');
        return view('orders.view', ['order' => $order]);
    }

    public function export()
    {
        return \Maatwebsite\Excel\Facades\Excel::download(new OrderExport, 'orders.xlsx');
    }
}
