<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Attribute;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cart = Cart::content();
        $cartProductIds = $cart->pluck('id')->unique();
        $products = Product::whereIn('id', $cartProductIds)->get();

        return view('cart', ['cart' => $cart, 'products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $productCount = Product::all()->count();
        $product_id = $request->product_id;
        $product = Product::find($product_id);
        $attributeNames = Attribute::pluck('slug');
        $attribs = [];
        foreach ($attributeNames as $attributeName) {
            if ($request->has($attributeName)) {
                $attribs[$attributeName] = $request->$attributeName;
            }
        }
        $price = ($request->qty == 1) ? $product->price : $request->prc;

        Cart::add($product->id, $product->name, $request->qty, $price, $attribs);


        if (!$product) {
            abort(404);
        }
        Session::flash('message', 'Proizvod "' . $product->name . '" je uspješno dodan u korpu!');
        Session::flash('alert-class', 'alert-dark');

        // session()->put('cart', $cart);
        if($productCount<2){
            return redirect(url('cart'));
        }
        return redirect()
            ->back()->with('success', 'Product added to cart successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return void
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return void
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return void
     */
    public function update(Request $request)
    {

        if ($request->id and $request->quantity) {
            Cart::update($request->id, $request->quantity); // Will update the quantity
            session()->flash('success', 'Korpa uspješno osvježena');
        }
    }

    /**
     * Method remove
     *
     * @param Request $request
     *
     * @return void
     */
    public function remove(Request $request)
    {
        if ($request->id) {
            Cart::remove($request->id);
            $this->update($request);
            session()->flash('success', 'Korpa uspješno osvježena');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return void
     */
    public function destroy($id)
    {
    }
}
