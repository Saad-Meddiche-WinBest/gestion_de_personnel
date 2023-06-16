<div class="container-sidebar" id="container-sidebar">
    @foreach (fill_sidebar() as $route)
        <form action="{{ $route['link'] }}" method="GET" id="myForm{{$route['title']}}">
            <input type="hidden" name="name_of_model" value="{{ $route['name_of_model'] }}">
            
            <div class="route" data-route-id="{{$route['title']}}">
                <div class="icon">
                    {!! $route['icon'] !!}
                </div>
                <div class="title">
                    {!! $route['title'] !!}
                </div>
            </div>
        </form>
    @endforeach
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var routes = document.querySelectorAll('.route');
        routes.forEach(function(route) {
            route.addEventListener('click', function() {
                var routeId = this.getAttribute('data-route-id');
                var form = document.getElementById('myForm' + routeId);
                form.submit();
            });
        });
    });
</script>
