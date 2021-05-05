<?php

namespace App\Http\Controllers;

use App\Models\Block;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class BlockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request Request fields
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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

        $block = new Block();
        $block->product_id = $request->product_id;
        $block->content = $request->content;
        if ($request->photo) {
            $block->photo = '/photos/' . $filename;
        }
        $block->save();

        return redirect(route('products.edit', $request->product_slug));
    }

    /**
     * Display the specified resource.
     *
     * @param Block $block Block model
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Block $block)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Block $block Block model
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Block $block)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request Request
     * @param Block   $block   Block model
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Block $block)
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

        $block = Block::with('product')->find($block->id);
        if($request->photo) {
            $block->photo = '/photos/' . $filename;
        }
        $product_slug = $block->product->slug;
        $block->content = $request->content;
        $block->display = $request->display;
        $block->save();

        return redirect(route('products.edit', $product_slug));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Block $block Block to delete
     *
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Block $block)
    {
        $block = Block::with('product')->find($block->id);
        $product_slug = $block->product->slug;
        $block->delete();

        return redirect(route('products.edit', $product_slug));
    }

    /**
     * Method getContent.
     *
     * @param $type $type [explicite description]
     *
     * @return void
     */
    protected function getContent($type)
    {
        switch ($type) {
            case 'intro':
                $content = '<div class="container">
								<div class="d-flex justify-content-center row">
									<div class="col-12">
										<h2>Pristajaće svakoj torbici, svakom džepu i svakom  modernom muškarcu!</h2>
									</div>
									<div class="col-12">
										<p>Muškarci sa stilom i svi vi koji volite stvari koje istovremeno odlikuje lijep dizajn i multifunkcionalnost, Edward novčanik morate imati u svojoj torbici.</p>
									</div>
								</div>
							</div>';
                break;
            case 'tofu':
                $image1 = asset('images/tofu-1.png');
                $image2 = asset('images/tofu-2.png');
                $image3 = asset('images/tofu-3.png');
                $image4 = asset('images/tofu-4.png');
                $content = '<div class="bg-silver">
								<div class="container">
									<div class="row d-flex justify-content-center">
										<div class="col-12">
											<h2>Pristajaće svakoj torbici, svakom džepu i svakom  modernom muškarcu!</h2>
										</div>
										<div class="col-12">
											<p>Muškarci sa stilom i svi vi koji volite stvari koje istovremeno odlikuje lijep dizajn i multifunkcionalnost, Edward novčanik morate imati u svojoj torbici.</p>
										</div>
									<div class="col-12">
										<div class="tofu-box">
											<div class="tofu-card">
												<div class="img-box">
													<img src="' . $image1 . '" alt="tofu-pic">
												</div>
												<div class="title-box">
													<h3>SUPERIORNA IZDRŽLJIVOST</h3>
												</div>
											<div class="text-box">
												<p>Edward novčanik je visokokvalitetan i koristan modni dodatak. Zahvaljujući materijalu od kojeg je izrađen, odlikuje se mekoćom i superiornom izdržljivošću!</p>
											</div>
										</div>
										<div class="tofu-card">
											<div class="img-box">
												<img src="' . $image2 . '" alt="tofu-pic">
											</div>
											<div class="title-box">
												<h3>KLASIČNO ZNAČI NAJBOLJE</h3>
											</div>
											<div class="text-box">
												<p>Edward novčanik je visokokvalitetan i koristan modni dodatak. Zahvaljujući materijalu od kojeg je izrađen, odlikuje se mekoćom i superiornom izdržljivošću!</p>
											</div>
										</div>
										<div class="tofu-card">
											<div class="img-box">
												<img src="' . $image3 . '" alt="tofu-pic">
											</div>
											<div class="title-box">
												<h3>MNOŠTVO ISKORISTIVIH PREGRADA</h3>
											</div>
											<div class="text-box">
												<p>Edward novčanik je visokokvalitetan i koristan modni dodatak. Zahvaljujući materijalu od kojeg je izrađen, odlikuje se mekoćom i superiornom izdržljivošću!</p>
											</div>
										</div>
										<div class="tofu-card">
											<div class="img-box">
												<img src="' . $image4 . '" alt="tofu-pic">
											</div>
											<div class="title-box">
												<h3>ISPUNIĆE ŽELJE SVAKOG MUŠKARCA</h3>
											</div>
											<div class="text-box">
												<p>Edward novčanik je visokokvalitetan i koristan modni dodatak. Zahvaljujući materijalu od kojeg je izrađen, odlikuje se mekoćom i superiornom izdržljivošću!</p>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>';
                break;
            case 'intro2':
                $image = asset('images/mofu-1.png');
                $content = '<div class="container">
								<div class="mofu-box-two row align-items-center">
									<div class="mofu-left mofu-sides col-12">
										<h3>Mijenja svaku torbicu</h3>
										<p>Muške torbice su uglavnom predviđene za nošenje preko ramena</p>
										<img src="' . $image . '" alt="mofu-img">
									</div>
									<div class="mofu-left mofu-sides col-12">
										<h3>Mijenja svaku torbicu</h3>
										<p>Muške torbice su uglavnom predviđene za nošenje preko ramena</p>
										<img src="' . $image . '" alt="mofu-img">
									</div>
									<div class="mofu-left mofu-sides col-12">
										<h3>Mijenja svaku torbicu</h3>
										<p>Muške torbice su uglavnom predviđene za nošenje preko ramena</p>
										<img src="' . $image . '" alt="mofu-img">
									</div>
									<div class="mofu-left mofu-sides col-12">
										<h3>Mijenja svaku torbicu</h3>
										<p>Muške torbice su uglavnom predviđene za nošenje preko ramena</p>
										<img src="' . $image . '" alt="mofu-img">
									</div>
								</div>
							</div>';
                break;
            case 'mofu':
                $image = asset('images/mofu-1.png');
                $content = '<div class="bg-silver">
								<div class="container">
									<div class="mofu-box row align-items-center">
										<div class="mofu-left mofu-sides col-lg-6 col-md-12">
											<h3>Mijenja svaku torbicu</h3>
											<p>Muške torbice su uglavnom predviđene za nošenje preko ramena, oko struka ili u ruci. Ako niste ljubitelj i pristalica nijednog načina nošenja    torbice, napravićete pravi izbor s Edward novčanikom. Neće se naduvati pa ga možete staviti u svaki džep.
											</p>
										</div>
									<div class="mofu-right mofu-sides col-lg-6 col-md-12">
										<img src="' . $image . '" alt="mofu-img">
									</div>
								</div>
								<div class="mofu-box row align-items-center">
									<div class="mofu-left mofu-sides col-lg-6 col-md-12 order-2 order-lg-1">
										<img src="' . $image . '" alt="mofu-img">
									</div>
									<div class="mofu-right mofu-sides col-lg-6 col-md-12 order-1 order-lg-2">
										<h3>Mijenja svaku torbicu</h3>
										<p>Muške torbice su uglavnom predviđene za nošenje preko ramena, oko struka ili u ruci. Ako niste ljubitelj i pristalica nijednog načina nošenja    torbice, napravićete pravi izbor s Edward novčanikom. Neće se naduvati pa ga možete staviti u svaki džep.
										</p>
									</div>
								</div>
								<div class="mofu-box row align-items-center">
									<div class="mofu-left mofu-sides col-lg-6 col-md-12">
										<h3>Mijenja svaku torbicu</h3>
										<p>Muške torbice su uglavnom predviđene za nošenje preko ramena, oko struka ili u ruci. Ako niste ljubitelj i pristalica nijednog načina nošenja    torbice, napravićete pravi izbor s Edward novčanikom. Neće se naduvati pa ga možete staviti u svaki džep. </p>
									</div>
									<div class="mofu-right mofu-sides col-lg-6 col-md-12">
										<img src="' . $image . '" alt="mofu-img">
									</div>
								</div>
							</div>
						</div>';
                break;
            case 'images':
                $image = asset('images/mofu-1.png');
                $content = '<div class="container">
								<div class="row">
									<div class="col-lg-6 col-md-12">
										<img src="' . $image . '" alt="mofu-img">
									</div>
									<div class="col-lg-6 col-md-12">
										<img src="' . $image . '" alt="mofu-img">
									</div>
								</div>
							</div>';
                break;
            case 'video':
                $video = asset('images/video-1.mp4');
                $content = '<div class="container">
								<div class="row">
									<div class="col-12">
										<video controls>
											<source src="' . $video . '" type="video/mp4">
										</video>
									</div>
								</div>
							</div>';
                break;
            case 'dec':
                $content = '<div class="container">
								<div class="dec-box row">
									<div class="col-12">
										<h3>Tehničke specifikacije:</h3>
									</div>
									<div class="col-lg-6 col-md-12">
										<div class="dec-left">
											<h5>OPIS:</h5>
											<p>Luksuzni muški novčanik – nepogrešiv izbor svakog muškarca! Vrhunska kvaliteta, multifunkcionalnost, klasičan i moderan dizajn reći će drugima puno o vama i vašem ukusu.</p>
											<div class="doc-info">
											<div class="doc-col">
											<h5>MATERIJAL:</h5>
											<p>Poliuretan</p>
											</div>
											<div class="doc-col">
											<h5>BOJA:</h5>
											<p>plava</p>
											</div>
											<div class="doc-col">
											<h5>TEŽINA:</h5>
											<p>0.08kg</p>
											</div>
											</div>
										</div>
									</div>
									<div class="col-lg-6 col-md-12">
										<div class="dec-right">
											<h5>DIMENZIJE:</h5>
											<p>12 cm (dužina) x 1,5 cm (širina) x 9 cm (visina)t</p>
											<h5>PAKET:</h5>
											<p>U pakovanju dolazi 1 x Edward luksuzni muški novčanik.</p>
										</div>
									</div>
								</div>
							</div>';
                break;
            default:
                $content = '';
                break;
        }

        return $content;
    }
}
