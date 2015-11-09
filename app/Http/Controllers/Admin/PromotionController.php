<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Promotion;
use App\Language;
use App\Http\Requests\Admin\PromotionRequest;
use Datatable;
use Kris\LaravelFormBuilder\FormBuilder;
use Laracasts\Flash\Flash;
use Session;

class PromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $table = $this->setDatatable();
        return view('admin.promotions.index', compact('table'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(FormBuilder $formBuilder)
    {
        $languages = Language::lists('title', 'id')->all();
        $form = $formBuilder->create('App\Forms\PromotionsForm', [
            'method' => 'POST',
            'url' => route('admin.promotion.store')
        ], $languages);
        return view('admin.promotions.create', compact('form'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PromotionRequest $request)
    {
        //return $request->all();
        $promotion = Promotion::create($request->all());
        $promotion->id ? Flash::success(trans('admin.create.success')) : Flash::error(trans('admin.create.fail'));
        return redirect(route('admin.promotion.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Promotion $promotion)
    {
        return view('admin.promotions.show', compact('promotion'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Promotion $promotion, FormBuilder $formBuilder)
    {
        $languages = Language::lists('title', 'id')->all();
        $form = $formBuilder->create('App\Forms\PromotionsForm', [
            'method' => 'PATCH',
            'url' => route('admin.promotion.update', ['id' => $promotion->id]),
            'model' => $promotion
        ], $languages);
        return view('admin.promotions.edit', compact('form', 'promotion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Promotion $promotion, PromotionRequest $request)
    {
        $promotion->fill($request->all());
        $promotion->save() ? Flash::success(trans('admin.update.success')) : Flash::error(trans('admin.update.fail'));
        return redirect(route('admin.promotion.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Promotion $promotion)
    {
        $promotion->delete() ? Flash::success(trans('admin.delete.success')) : Flash::error(trans('admin.delete.fail'));
        return redirect(route('admin.promotion.index'));
    }

    private function setDatatable()
    {
        return Datatable::table()
            ->addColumn(trans('admin.fields.promotion.title'), trans('admin.fields.updated_at'))
            ->addColumn(trans('admin.ops.name'))
            ->setUrl(route('api.table.promotion'))
            ->setOptions(array('sPaginationType' => 'bs_normal', 'oLanguage' => trans('admin.datatables')))
            ->render();
    }
}
