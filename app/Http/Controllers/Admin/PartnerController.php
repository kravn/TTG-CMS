<?php

namespace App\Http\Controllers\Admin;

use App\Partner;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PartnerRequest;
use App\Http\Requests;
use App\Services\ImageService;
use Laracasts\Flash\Flash;
use Kris\LaravelFormBuilder\FormBuilder;
use Datatable;
use Session;

class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $partners = $this->setDatatable();
        //$partners = Partner::all();
        return view('admin.partners.index', compact('partners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(FormBuilder $formBuilder)
    {
        $form = $formBuilder->create('App\Forms\PartnersForm', [
            'method' => 'POST',
            'url' => route('admin.partner.store')
        ]);
        return view('admin.partners.create', compact('form'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PartnerRequest $request)
    {
        $partner = Partner::create(ImageService::uploadImage($request, 'logo'));
        $partner->id ? Flash::success(trans('admin.create.success')) : Flash::error(trans('admin.create.fail'));
        return redirect(route('admin.partner.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Partner $partner)
    {
        return view('admin.partners.show', compact('partner'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Partner $partner, FormBuilder $formBuilder)
    {
        $form = $formBuilder->create('App\Forms\PartnersForm', [
            'method' => 'PATCH',
            'url' => route('admin.partner.update', ['id' => $partner->id]),
            'model' => $partner
        ]);
        return view('admin.partners.edit', compact('form', 'partner'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Partner $partner, PartnerRequest $request)
    {
        $partner->fill(ImageService::uploadImage($request, 'logo'));
        $partner->save() ? Flash::success(trans('admin.update.success')) : Flash::error(trans('admin.update.fail'));
        return redirect(route('admin.partner.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Partner $partner)
    {
        $partner->delete() ? Flash::success(trans('admin.delete.success')) : Flash::error(trans('admin.delete.fail'));
        return redirect(route('admin.partner.index'));
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
            ->addColumn(trans('admin.fields.partner.title'), trans('admin.fields.partner.logo'), trans('admin.fields.updated_at'))
            ->addColumn(trans('admin.ops.name'))
            ->setUrl(route('api.table.partner'))
            ->setOptions(['sPaginationType' => 'bs_normal', 'oLanguage' => trans('admin.datatables')])
            ->render();
    }

}
