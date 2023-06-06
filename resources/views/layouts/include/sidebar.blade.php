<style>
.container-sidebar {
    background-color: rgb(38, 11, 136);
    width: 10vw;
    height: 100%;
    text-align: center;
}

.route {
    display: flex;
    align-items: center;
    margin-bottom: 10px;
}

.icon {
    width: 20px;
    height: 20px;
    margin-right: 5px;
}

.title {
    color: white;
}
</style>

<div class="container-sidebar" id="container-sidebar"></div>

<script>
function fill_sidebar() {
    let sidebar = document.getElementById("container-sidebar");
    let routes = [
        {'title': 'route1', 'icon': ''},
        {'title': 'route3', 'icon': ''},
        {'title': 'route2', 'icon': ''}
    ];
    
    routes.forEach(route => {
        sidebar.innerHTML += `<div class="route">
                                    <div class="icon"></div>
                                    <div class="title">
                                        ${route.title}
                                    </div>
                                </div>`;
    });
}

fill_sidebar();
</script>
