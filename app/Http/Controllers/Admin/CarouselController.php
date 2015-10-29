<?php

namespace App\Http\Controllers\Admin;

use App\Carousel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CarouselRequest;
use App\Http\Requests;
use App\Language;
use App\Services\ImageService;
use Laracasts\Flash\Flash;
use Kris\LaravelFormBuilder\FormBuilder;
use Datatable;
use Session;

class CarouselController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $table = $this->setDatatable();
        return view('admin.carousels.index', compact('table'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(FormBuilder $formBuilder)
    {
        $languages = Language::lists('title', 'id')->all();
        $form = $formBuilder->create('App\Forms\CarouselsForm', [
            'method' => 'POST',
            'url' => route('admin.carousel.store')
        ], $languages);
        return view('admin.carousels.create', compact('form'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(CarouselRequest $request)
    {
        $carousel = Carousel::create(ImageService::uploadImage($request, 'image'));
        $carousel->id ? Flash::success(trans('admin.create.success')) : Flash::error(trans('admin.create.fail'));
        return redirect(route('admin.carousel.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show(Carousel $carousel)
    {
        return view('admin.carousels.show', compact('carousel'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit(Carousel $carousel, FormBuilder $formBuilder)
    {
        $languages = Language::lists('title', 'id')->all();
        $form = $formBuilder->create('App\Forms\CarouselsForm', [
            'method' => 'PATCH',
            'url' => route('admin.carousel.update', ['id' => $carousel->id]),
            'model' => $carousel
        ], $languages);
        return view('admin.carousels.edit', compact('form', 'carousel'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Carousel $carousel, CarouselRequest $request)
    {
        $carousel->fill(ImageService::uploadImage($request, 'image'));
        $carousel->save() ? Flash::success(trans('admin.update.success')) : Flash::error(trans('admin.update.fail'));
        return redirect(route('admin.carousel.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Carousel $carousel)
    {
        $carousel->delete() ? Flash::success(trans('admin.delete.success')) : Flash::error(trans('admin.delete.fail'));
        return redirect(route('admin.carousel.index'));
    }

    /**
     * Change language
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postChange()
    {
        Session::put('image', Input::get('image'));
        return Redirect::back();
    }

    /**
     * Create DataTable HTML
     *
     * @return mixed
     * @throws \Exception
     */
    private function setDatatable()
    {
        return Datatable::table()
            ->addColumn(trans('admin.fields.carousel.title'), trans('admin.fields.updated_at'))
            ->addColumn(trans('admin.ops.name'))
            ->setUrl(route('api.table.carousel'))
            ->setOptions(array('sPaginationType' => 'bs_normal', 'oLanguage' => trans('admin.datatables')))
            ->render();
    }
}
