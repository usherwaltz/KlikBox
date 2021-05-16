<?php

namespace App\Http\Controllers;


use App\Models\Block;
use App\Models\Product;
use App\Models\Category;
use App\Models\Attribute;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\ProductUpdateRequest;
use Itstructure\GridView\DataProviders\EloquentDataProvider;
use Psy\Util\Json;

class ProductController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {

        $dataProvider = new EloquentDataProvider(Product::query());
//        $products = Product::paginate(20);
        return view('products.index', [
//            'products' => $products,
            'dataProvider' => $dataProvider
        ]);
    }


    /**
     * Method create
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('products.create');
    }

//    /**
//     * Method show
//     *
//     * @param $slug $slug [explicite description]
//     *
//     * @return Factory|View
//     */
//    public function show($slug)
//    {
//        $product = Product::where('slug', $slug)->first();
//
//        return view('product.show', compact('product'));
//    }

    /**
     * Method edit
     *
     * @param $slug $slug [explicite description]
     *
     * @return Factory|View
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

    public function uploadImage($photo) {
        $photo_filename = $photo->getClientOriginalName();
        $image_resize = Image::make($photo->getRealPath());
        $image_resize->fit(600, 600)
            ->save(public_path('photos/' . $photo_filename));
        $image_resize->fit(230, 230)
            ->save(public_path('thumbnails/' . $photo_filename));
        return '/photos/' . $photo_filename;
    }

    /**
     * Method update
     *
     * @param ProductUpdateRequest $request
     * @param $id $id
     *
     * @return Application
     */
    public function update(ProductUpdateRequest $request, $id)
    {
        $product = Product::find($id);

        if(isset($request->blocks)) {
            foreach ($request->blocks as $block) {
                $blockToSave = null;
                if(isset($block['id'])) {
                    $blockToSave = Block::find($block['id']);
                } else {
                    $blockToSave = new Block();
                    $blockToSave->product_id = $product->id;
                }

                if(isset($block['type'])) {
                    $blockToSave->type = $block['type'];
                }

                switch ($blockToSave->type) {
                    case "STANDARD":
                        $blockToSave->content = $block['content'];

                        if(isset($block['photo'])) {
                            $blockToSave->photo = $this->uploadImage($block['photo']);
                        }

                        if(isset($block['photo_2'])) {
                            $blockToSave->photo_2 = $this->uploadImage($block['photo_2']);
                        }


                        $blockToSave->save();
                        break;

                    case "VIDEO":
                        if(isset($block['video'])) {
                            $blockToSave->video = $block['video'];
                            $blockToSave->save();
                        }

                        break;

                    case "ICONS":
                        if(isset($block['icon_1'])) {
                            $blockToSave->icon_1 = $this->uploadImage($block['icon_1']);
                        }

                        if(isset($block['icon_2'])) {
                            $blockToSave->icon_2 = $this->uploadImage($block['icon_2']);
                        }

                        if(isset($block['icon_3'])) {
                            $blockToSave->icon_3 = $this->uploadImage($block['icon_3']);
                        }

                        if(isset($block['icon_4'])) {
                            $blockToSave->icon_4 = $this->uploadImage($block['icon_4']);
                        }

                        if(isset($block['icon_1_text'])) {
                            $blockToSave->icon_1_text = $block['icon_1_text'];
                        }

                        if(isset($block['icon_2_text'])) {
                            $blockToSave->icon_2_text = $block['icon_2_text'];
                        }

                        if(isset($block['icon_3_text'])){
                            $blockToSave->icon_3_text = $block['icon_3_text'];
                        }

                        if(isset($block['icon_4_text'])) {
                            $blockToSave->icon_4_text = $block['icon_4_text'];
                        }
                        $blockToSave->save();
                        break;
                    case "TABLE":
                        if(isset($block['content'])) {
                            $blockToSave->content = $block['content'];
                        }
                        $blockToSave->save();
                        break;
                    case "PHOTOS":
                        if(isset($block['photos'])) {
                            $helperArray = [];
                            foreach ($block['photos'] as $photo) {
                                $helperArray[] = $this->uploadImage($photo);
                            }
                            $blockToSave->photos = Json::encode($helperArray);
                            $blockToSave->save();
                        }
                }
            }
        }

        if ($request->photo) {
            $photo = $request->file('photo');
            $filename = $photo->getClientOriginalName();
            $image_resize = Image::make($photo->getRealPath());
            $image_resize->fit(600, 600)
                ->save(public_path('photos/' . $filename));
            $image_resize->fit(230, 230)
                ->save(public_path('thumbnails/' . $filename));
        }
        $product->name = $request->name;
        $product->slug = $request->slug;
        $product->top_choice = isset($request->top_choice) && $request->top_choice == "on" ? 1 : 0;
        $product->description = $request->description;
        if ($request->photo) {
            $product->photo = '/photos/' . $filename;
        }
        $product->oldprice = $request->oldprice;
        $product->price = $request->price;

        //check if product was saved
        if($product->save()) {
            if ($request->categories) {
                $product->categories()->sync($request->categories);
            }
            if ($request->options) {
                $product->options()->sync($request->options);
            }
            Session::flash('message', 'Detalji proizvoda "' . $product->name . '" su uspješno sačuvani!');
            Session::flash('alert-class', 'alert-success');
        } else {
            Session::flash('message', 'Došlo je do greške prilikom izmjene proizvoda "' . $product->name . '"!');
            Session::flash('alert-class', 'alert-danger');
        }

        return redirect(route('products.edit', $product->slug));
    }

    /**
     * Method store
     *
     * @param CreateProductRequest $request Request with validation
     *
     * @return RedirectResponse|Redirector
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

    public function delete() {
        $id = $_GET['id'];
        $product = Product::find($id);
        if($product->delete()) {
            Session::flash('message', 'Uspješno ste obrisali proizvod ' . $product->name . '"');
            Session::flash('alert-class', 'alert-success');
        } else {
            Session::flash('message', 'Doslo je do greške prilikom brisanja proizvoda "' . $product->name . '"');
            Session::flash('alert-class', 'alert-danger');
        }
        return redirect(route('products.index'));
    }
}
