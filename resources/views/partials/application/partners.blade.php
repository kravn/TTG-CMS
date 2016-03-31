<div class="container">
    <div class="section-divider" id="popular-games"></div>
    <h1 class="section-title">{{ trans('application.labels.headers.partners_and_affiliates') }}</h1>
    @foreach($partners as $partner)
        <img src="{{ $partner->logo }}" title="{{ $partner->title }}">
    @endforeach
</div>

