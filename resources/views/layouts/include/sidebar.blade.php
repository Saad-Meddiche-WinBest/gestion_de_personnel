<div class="container-sidebar" id="container-sidebar">
    @foreach (fill_sidebar() as $route)
        <div class="route">
            <a href="{{ $route['link'] }}">
                <div class="icon">
                    {!! $route['icon'] !!}
                </div>
                <div class="title">
                    {!! $route['title'] !!}
                </div>
            </a>
        </div>
    @endforeach
</div>
