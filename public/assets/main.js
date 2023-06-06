function fill_sidebar() {

    let sidebar = document.getElementById("sidebar");
    let routes = [{
            'title': 'Services',
            'icon': ''
        },
        {
            'title': 'route3',
            'icon': ''
        },
        {
            'title': 'route2',
            'icon': ''
        },
    ];
    routes.forEach(route => {
        sidebar.innerHTML += `<div class="route">
                                        <div class="icon">

                                        </div>
                                        <div class="title">
                                            ${route.title}
                                        </div>
                                    </div>`
    });
}


// Functions that will work in start up
fill_sidebar();
