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

        if ($request->photo_2) {
            $photo = $request->file('photo_2');
            $filename_2 = $photo->getClientOriginalName();
            $image_resize = Image::make($photo->getRealPath());
            $image_resize->fit(600, 600)
                ->save(public_path('photos/' . $filename_2));
            $image_resize->fit(230, 230)
                ->save(public_path('thumbnails/' . $filename_2));
        }

        $block = new Block();
        $block->product_id = $request->product_id;

        if($request->icons == "on") {
            $block->content = $this->getIcons();
        } elseif($request->video == "on") {
            $block->content = $this->getContent('video');
        } else {
            $block->content = $request->content;
            if ($request->photo) {
                $block->photo = '/photos/' . $filename;
            }

            if($request->photo_2) {
                $block->photo_2 = '/photos/' . $filename_2;
            }
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

    public function remove(Request $request) {
        if($request->ajax()) {
            if(isset($request->block_id)) {
                $block = Block::find($request->block_id);
                if($block->delete()) {
                    return true;
                }
                return false;
            }
        }
        return false;
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

        if ($request->photo_2) {
            $photo = $request->file('photo_2');
            $filename_2 = $photo->getClientOriginalName();
            $image_resize = Image::make($photo->getRealPath());
            $image_resize->fit(600, 600)
                ->save(public_path('photos/' . $filename_2));
            $image_resize->fit(230, 230)
                ->save(public_path('thumbnails/' . $filename_2));
        }

        $block = Block::with('product')->find($block->id);

        if($request->icons == "on") {
            $block->content = $this->getIcons();
        } elseif($request->video == "on") {
            $block->content = $this->getContent("video");
        } else {
            if($request->photo) {
                $block->photo = '/photos/' . $filename;
            }

            if($request->photo_2) {
                $block->photo_2 = '/photos/' . $filename_2;
            }
            $product_slug = $block->product->slug;
            $block->content = $request->content;
            $block->display = $request->display;
        }

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
										<h2>Pristaja??e svakoj torbici, svakom d??epu i svakom  modernom mu??karcu!</h2>
									</div>
									<div class="col-12">
										<p>Mu??karci sa stilom i svi vi koji volite stvari koje istovremeno odlikuje lijep dizajn i multifunkcionalnost, Edward nov??anik morate imati u svojoj torbici.</p>
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
											<h2>Pristaja??e svakoj torbici, svakom d??epu i svakom  modernom mu??karcu!</h2>
										</div>
										<div class="col-12">
											<p>Mu??karci sa stilom i svi vi koji volite stvari koje istovremeno odlikuje lijep dizajn i multifunkcionalnost, Edward nov??anik morate imati u svojoj torbici.</p>
										</div>
									<div class="col-12">
										<div class="tofu-box">
											<div class="tofu-card">
												<div class="img-box">
													<img src="' . $image1 . '" alt="tofu-pic">
												</div>
												<div class="title-box">
													<h3>SUPERIORNA IZDR??LJIVOST</h3>
												</div>
											<div class="text-box">
												<p>Edward nov??anik je visokokvalitetan i koristan modni dodatak. Zahvaljuju??i materijalu od kojeg je izra??en, odlikuje se meko??om i superiornom izdr??ljivo????u!</p>
											</div>
										</div>
										<div class="tofu-card">
											<div class="img-box">
												<img src="' . $image2 . '" alt="tofu-pic">
											</div>
											<div class="title-box">
												<h3>KLASI??NO ZNA??I NAJBOLJE</h3>
											</div>
											<div class="text-box">
												<p>Edward nov??anik je visokokvalitetan i koristan modni dodatak. Zahvaljuju??i materijalu od kojeg je izra??en, odlikuje se meko??om i superiornom izdr??ljivo????u!</p>
											</div>
										</div>
										<div class="tofu-card">
											<div class="img-box">
												<img src="' . $image3 . '" alt="tofu-pic">
											</div>
											<div class="title-box">
												<h3>MNO??TVO ISKORISTIVIH PREGRADA</h3>
											</div>
											<div class="text-box">
												<p>Edward nov??anik je visokokvalitetan i koristan modni dodatak. Zahvaljuju??i materijalu od kojeg je izra??en, odlikuje se meko??om i superiornom izdr??ljivo????u!</p>
											</div>
										</div>
										<div class="tofu-card">
											<div class="img-box">
												<img src="' . $image4 . '" alt="tofu-pic">
											</div>
											<div class="title-box">
												<h3>ISPUNI??E ??ELJE SVAKOG MU??KARCA</h3>
											</div>
											<div class="text-box">
												<p>Edward nov??anik je visokokvalitetan i koristan modni dodatak. Zahvaljuju??i materijalu od kojeg je izra??en, odlikuje se meko??om i superiornom izdr??ljivo????u!</p>
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
										<p>Mu??ke torbice su uglavnom predvi??ene za no??enje preko ramena</p>
										<img src="' . $image . '" alt="mofu-img">
									</div>
									<div class="mofu-left mofu-sides col-12">
										<h3>Mijenja svaku torbicu</h3>
										<p>Mu??ke torbice su uglavnom predvi??ene za no??enje preko ramena</p>
										<img src="' . $image . '" alt="mofu-img">
									</div>
									<div class="mofu-left mofu-sides col-12">
										<h3>Mijenja svaku torbicu</h3>
										<p>Mu??ke torbice su uglavnom predvi??ene za no??enje preko ramena</p>
										<img src="' . $image . '" alt="mofu-img">
									</div>
									<div class="mofu-left mofu-sides col-12">
										<h3>Mijenja svaku torbicu</h3>
										<p>Mu??ke torbice su uglavnom predvi??ene za no??enje preko ramena</p>
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
											<p>Mu??ke torbice su uglavnom predvi??ene za no??enje preko ramena, oko struka ili u ruci. Ako niste ljubitelj i pristalica nijednog na??ina no??enja    torbice, napravi??ete pravi izbor s Edward nov??anikom. Ne??e se naduvati pa ga mo??ete staviti u svaki d??ep.
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
										<p>Mu??ke torbice su uglavnom predvi??ene za no??enje preko ramena, oko struka ili u ruci. Ako niste ljubitelj i pristalica nijednog na??ina no??enja    torbice, napravi??ete pravi izbor s Edward nov??anikom. Ne??e se naduvati pa ga mo??ete staviti u svaki d??ep.
										</p>
									</div>
								</div>
								<div class="mofu-box row align-items-center">
									<div class="mofu-left mofu-sides col-lg-6 col-md-12">
										<h3>Mijenja svaku torbicu</h3>
										<p>Mu??ke torbice su uglavnom predvi??ene za no??enje preko ramena, oko struka ili u ruci. Ako niste ljubitelj i pristalica nijednog na??ina no??enja    torbice, napravi??ete pravi izbor s Edward nov??anikom. Ne??e se naduvati pa ga mo??ete staviti u svaki d??ep. </p>
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
										<h3>Tehni??ke specifikacije:</h3>
									</div>
									<div class="col-lg-6 col-md-12">
										<div class="dec-left">
											<h5>OPIS:</h5>
											<p>Luksuzni mu??ki nov??anik ??? nepogre??iv izbor svakog mu??karca! Vrhunska kvaliteta, multifunkcionalnost, klasi??an i moderan dizajn re??i ??e drugima puno o vama i va??em ukusu.</p>
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
											<h5>TE??INA:</h5>
											<p>0.08kg</p>
											</div>
											</div>
										</div>
									</div>
									<div class="col-lg-6 col-md-12">
										<div class="dec-right">
											<h5>DIMENZIJE:</h5>
											<p>12 cm (du??ina) x 1,5 cm (??irina) x 9 cm (visina)t</p>
											<h5>PAKET:</h5>
											<p>U pakovanju dolazi 1 x Edward luksuzni mu??ki nov??anik.</p>
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

    protected function getIcons() {
        return '<div class="tofu-box-home mt-4 mb-4">
            <div class="tofu-card">
                <img src="/images/safe-pic.png" alt="safe-pic">
                <p>SIGURNA <br>DOSTAVA</p>
            </div>
            <div class="tofu-card">
                <img src="/images/delivery-pic.png" alt="delivery-pic">
                <p>BRZA <br>DOSTAVA 24H</p>
            </div>

            <div class="tofu-card">
                <img src="/images/quality-pic.png" alt="quality-pic">
                <p>KONTROLA <br>KVALITETA</p>
            </div>
            <div class="tofu-card">
                <img src="/images/pay-pic.png" alt="pay-pic">
                <p>PLA??ANJE <br>POUZE??EM</p>
            </div>
            <div class="tofu-card">
                <img src="/images/garancy-pic.png" alt="garancy-pic">
                <p>GARANTOVAN <br>POVRAT NOVCA</p>
            </div>
        </div>';
    }
}
