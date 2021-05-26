<?php

namespace App\Http\Controllers;

use App\Models\Option;
use App\Models\Product;
use App\Models\Category;
use App\Models\Attribute;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = Product::all();
        return view('products', compact('products'));
        //return view('home');
    }

    public function about()
    {
        return view('products.about');
    }

    /**
     * Method akcija
     *
     * @return void
     */
    public function akcija()
    {
        $category = Category::where('slug', 'akcija')->first();
        $category->load('products');
        $products = $category->products;
        return view('products', compact('products'));
    }
    /**
     * Method novo
     *
     * @return void
     */
    public function novo()
    {
        $category = Category::where('slug', 'novo')->first();
        $category->load('products');
        $products = $category->products;
        return view('products', compact('products'));
    }
    /**
     * Method trend
     *
     * @return void
     */
    public function trend()
    {
        $category = Category::where('slug', 'trend')->first();
        $category->load('products');
        $products = $category->products;
        return view('products', compact('products'));
    }
    /**
     * Method show
     *
     * @param $slug $slug [explicite description]
     *
     * @return void
     */
    public function show($slug)
    {
        $product = Product::where('slug', $slug)->first();
        $product->load('options');
        $product->load('blocks');
        $attributeIds = $product->options->pluck('attribute_id')->toArray();
        $attributeIds = array_unique($attributeIds);
        $attributes = Attribute::whereIn('id', $attributeIds)->get();
        return view('product.show', compact('product', 'attributes'));
    }

    /**
     * Method cart
     *
     * @return void
     */
    public function cart()
    {
        return view('cart');
    }
    /**
     * Method addToCart
     *
     * @param $id $id [explicite description]
     *
     * @return void
     */
    public function addToCart($id)
    {
        $product = Product::find($id);

        if (!$product) {
            abort(404);
        }

        $cart = session()->get('cart');

        // if cart is empty then this the first product
        if (!$cart) {
            $cart = [
                $id => [
                    "name" => $product->name,
                    "quantity" => 1,
                    "price" => $product->price,
                    "photo" => $product->photo
                ]
            ];

            session()->put('cart', $cart);

            return redirect()->back()
                ->with('success', 'Product added to cart successfully!');
        }

        // if cart not empty then check if this product exist then increment quantity
        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
            session()->put('cart', $cart);
            return redirect()->back()
                ->with('success', 'Product added to cart successfully!');
        }

        // if item not exist in cart then add to cart with quantity = 1
        $cart[$id] = [
            "name" => $product->name,
            "quantity" => 1,
            "price" => $product->price,
            "photo" => $product->photo
        ];

        session()->put('cart', $cart);

        return redirect()
            ->back()->with('success', 'Product added to cart successfully!');
    }

    /**
     * Method update
     *
     * @param Request $request [explicite description]
     *
     * @return void
     */
    public function update(Request $request)
    {
        if ($request->id and $request->quantity) {
            $cart = session()->get('cart');

            $cart[$request->id]["quantity"] = $request->quantity;

            session()->put('cart', $cart);

            session()->flash('success', 'Cart updated successfully');
        }
    }

    /**
     * Method remove
     *
     * @param Request $request [explicite description]
     *
     * @return void
     */
    public function remove(Request $request)
    {
        if ($request->id) {
            $cart = session()->get('cart');
            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }

            session()->flash('success', 'Product removed successfully');
        }
    }

    public function getSearchProducts(Request $request)
    {
        if($request->searchString != "" || $request->searchString != null) {
            $results = Product::where('name', 'like', "%$request->searchString%")
                ->orWhere('description', 'like', "%$request->searchString%")->get();
        } else {
            $results = Product::orderBy('id')->paginate(15);
        }

        if ($request->ajax()) {
            return $this->appendData($results);
        } else {
            return view('products', compact('results'));
        }
    }

    /**
     * @param Request $request
     * @return Application|Factory|View|string
     */
    public function getHomeProducts(Request $request)
    {
        $results = Product::orderBy('id')->paginate(15);

        if ($request->ajax()) {
            return $this->appendData($results);
        }
        return view('home');
    }

    /**
     * @param Request $request
     * @return Application|Factory|View|string
     */
    public function getAkcijaProducts(Request $request)
    {
        $category = Category::where('slug', 'akcija')->first();
        $category->load('products')->paginate(15);
        $results = $category->products;

        if ($request->ajax()) {
            return $this->appendData($results);
        }
        return view('akcija');
    }

    /**
     * @param Request $request
     * @return Application|Factory|View|string
     */
    public function getTrendProducts(Request $request)
    {
        $category = Category::where('slug', 'trend')->first();
        $category->load('products')->paginate(15);
        $results = $category->products;

        if ($request->ajax()) {
            return $this->appendData($results);
        }
        return view('trend');
    }

    /**
     * @param Request $request
     * @return Application|Factory|View|string
     */
    public function getNovoProducts(Request $request)
    {
        $category = Category::where('slug', 'novo')->first();
        $category->load('products')->paginate(15);
        $results = $category->products;

        if ($request->ajax()) {
            return $this->appendData($results);
        }
        return view('novo');
    }

    public function appendData($results) {
        $products = '';
        foreach ($results as $result) {
            $slug = $result->slug;
            $name = $result->name;
            $photo = $result->photo ?
                '<img class="start-img" src="' . $result->photo . '" alt="photo">' :
                '<img class="image-placeholder start-img" src="/images/placeholder.png" alt="fire">';
            $price = $result->oldprice ?
                '<span>' . round($result->oldprice) . ' KM</span> ' . round($result->price) . ' KM' :
                round($result->price) . ' KM' ;

            $hasPercent = $result->oldprice != null;
            $percent = '';
            if($hasPercent) {
                $discount = 100 - round($result->price/$result->oldprice * 100);
                $percent = '<div class="procent-box">
                                <div class="procent">
                                    <span>- ' . $discount . '%</span>
                                </div>
                            </div>';
            }
            $product = '
                <div class="col-lg-4 col-md-4 col-xl p-0">
                    <div class="card m-2">
                        <div class="card-body">
                            <a href="/admin/product/' . $slug . '">
                                <div class="card-box">
                                    '. $percent . '
                                    <div class="img-box image-placeholder">
                                        ' . $photo . '
                                    </div>
                                    <div class="title-box">
                                        <p>' . $name . '</p>
                                    </div>
                                    <div class="price-box">
                                        ' . $price . '
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>';

            $products .= $product;
        }
        return $products;
    }
}
