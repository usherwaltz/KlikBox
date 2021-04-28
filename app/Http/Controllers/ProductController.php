<?php

namespace App\Http\Controllers;


use App\Models\Product;
use App\Models\Category;
use App\Models\Attribute;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\ProductUpdateRequest;

class ProductController extends Controller
{
    /**
     * Method index
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $products = Product::paginate(20);
        return view('products.index', compact('products'));
    }


    /**
     * Method create
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Method show
     *
     * @param $slug $slug [explicite description]
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($slug)
    {
        $product = Product::where('slug', $slug)->first();

        return view('product.show', compact('product'));
    }

    /**
     * Method edit
     *
     * @param $slug $slug [explicite description]
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($slug)
    {
        $categories = Category::all();
        $attributes = Attribute::all();
        $attributes->load('options');
        $product = Product::where('slug', $slug)->first();
        $product->load('categories', 'attributes');
        return view('products.edit', compact('product', 'categories', 'attributes'));
    }

    /**
     * Method update
     *
     * @param ProductUpdateRequest $request
     * @param $id $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(ProductUpdateRequest $request, $id)
    {
        if ($request->photo) {
            $photo = $request->file('photo');
            $filename = $photo->getClientOriginalName();
            $image_resize = Image::make($photo->getRealPath());
            $image_resize->fit(600, 600)
                ->save(public_path('photos/' . $filename));
            $image_resize->fit(230, 230)
                ->save(public_path('thumbnails/' . $filename));
        }
        $product = Product::find($id);
        $product->name = $request->name;
        $product->slug = $request->slug;
        $product->description = $request->description;
        if ($request->photo) {
            $product->photo = '/photos/' . $filename;
        }
        $product->oldprice = $request->oldprice;
        $product->price = $request->price;
        $product->save();
        if ($request->categories) {
            $product->categories()->sync($request->categories);
        }
        if ($request->options) {
            $product->options()->sync($request->options);
        }

        return redirect(route('products.edit', $product->slug));
    }

    /**
     * Method store
     *
     * @param CreateProductRequest $request Request with validation
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(CreateProductRequest $request)
    {
        $product = new Product();
        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->save();

        return redirect(route('products.edit', $product->slug));
    }
    /**
     * Method upload
     *
     * @param Request $request [explicite description]
     *
     * @return void
     */
    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;
            $request->file('upload')->move(public_path('photos'), $fileName);
            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('photos/' . $fileName);
            $msg = 'Image uploaded successfully';
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
            @header('Content-type: text/html; charset=utf-8');
            echo $response;
        }
    }

    public function destroy(Product $product){
        $product->delete();
        return redirect(route('products.index'));
    }
}
