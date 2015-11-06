<div class="container">
    @foreach($partners as $partner)
        <img src="{{ $partner->logo }}" title="{{ $partner->title }}">
    @endforeach
</div>

