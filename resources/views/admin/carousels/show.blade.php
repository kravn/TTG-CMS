@extends('layouts.admin')

@section('content')
    <h1>{{ trans('admin.fields.carousel.title') . ': ' . $carousel->title  }}</h1>
    <h3>{{ trans('admin.fields.carousel.image') . ': ' . $carousel->image  }}</h3>
    <img class="img-responsive" alt="" src="{!! $carousel->image  !!}" />
    <h3> {{ trans('admin.fields.carousel.description') . ': ' . $carousel->description  }}</h3>
@endsection