<div class="sidebar">
    @if($advert1)
        @if($advert1->link)
            <a href="{{ $advert1->link }}" target="_blank" class="widget">
        @else
            <span class="widget">
        @endif
            @if($advert1->title)
                <h2 class="widget-title">{{ $advert1->title }}</h2>
            @endif
            @if($advert1->description)
                <p class="widget-description">{{ $advert1->description }}</p>
            @endif
            @if($advert1->image)
                <div class="banner-spot clearfix">
                    <div class="banner-img">
                        <img src="{{ asset("uploads/{$advert1->image}") }}" alt="advert1" class="img-fluid">
                    </div>
                </div>
            @endif
        @if(!$advert1->link)
            </span>
        @else
            </a>
        @endif
    @endif

    @if($advert2)
        @if($advert2->link)
            <a href="{{ $advert2->link }}" target="_blank" class="widget">
        @else
            <span class="widget">
        @endif
        @if($advert2->title)
            <h2 class="widget-title">{{ $advert2->title }}</h2>
        @endif
        @if($advert2->description)
            <p class="widget-description">{{ $advert2->description }}</p>
        @endif
        @if($advert2->image)
            <div class="banner-spot clearfix">
                <div class="banner-img">
                    <img src="{{ asset("uploads/{$advert2->image}") }}" alt="advert1" class="img-fluid">
                </div>
            </div>
        @endif
        @if(!$advert2->link)
            </span>
        @else
            </a>
        @endif
    @endif
</div>
