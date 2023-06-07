<style>
.container-sidebar {
    background-color: rgb(38, 11, 136);
    width: 10vw;
    height: 100%;

}

.route {
    display: flex;
    align-items: center;
    margin-bottom: 10px;
    display: flex;
    justify-content: center;
    flex-direction: column;
}

.icon {
    width: 20px;
    height: 20px;
    margin-right: 5px;
    display: flex;
    justify-content: center;
    flex-direction: row;
}

.title {
    color: white;
    text-align: center;
    
}
</style>

<div class="container-sidebar" id="container-sidebar"></div>

<script>
function fill_sidebar() {
    let sidebar = document.getElementById("container-sidebar");
    let routes = [
        {'title': 'route1', 'icon': `<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-door" viewBox="0 0 16 16">
  <path d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146ZM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4H2.5Z"/>
</svg>`},
        {'title': 'route3', 'icon': ''},
        {'title': 'route2', 'icon': ''}
    ];
    routes.forEach(route => {
        sidebar.innerHTML += `<div class="route">
                                    <div class="icon">
                                         ${route.icon}
                                        </div>
                                    <div class="title">
                                        ${route.title}
                                    </div>
                            </div>`;
    });
}

fill_sidebar();
</script>
