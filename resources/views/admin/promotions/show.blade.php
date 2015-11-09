@extends('layouts.admin')
@section('content')
    <div class="col-xs-12 no-padding">
        <div class="post-title pull-left">
            <h1> {{ $promotion->title }} </h1>
        </div>
    </div>
    <p>{!! $promotion->content !!}</p>
@endsection