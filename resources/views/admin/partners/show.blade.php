@extends('layouts.admin')

@section('content')
    <h1>{{ $partner->title  }}</h1>
    <div class="jumbotron">
        <img class="img-responsive" alt="" src="{!! $partner->logo  !!}" />
    </div>
    <p>{{ trans('admin.fields.partner.logo') . ': ' . $partner->logo  }}</p>


@endsection