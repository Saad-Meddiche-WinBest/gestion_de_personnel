<style>
    .box-container {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 8px;
    }

    .box1 {
        display: flex;
        flex-direction: column;
    }

    .box1 p {
        color: black;
        text-decoration: none;
        font-size: 1.3vh;
        font-weight: bold;
    }

    .box {
        height: 130px;
        width: 150px;
        border-radius: 4px;
        box-shadow: 3px 3px 10px #c9cacaea;
        padding: 20px;
        display: flex;
        align-items: center;
        justify-content: space-around;
        cursor: pointer;
        transition: transform 0.3s ease-in-out;

    }


    .box:hover {
        transform: scale(1.08);
    }

    .box:nth-child(1) {
        background-color: var(--one-use-color);
    }

    .box:nth-child(2) {
        background-color: var(--two-use-color);
    }

    .box:nth-child(3) {
        background-color: var(--one-use-color);
    }

    .box:nth-child(4) {
        background-color: var(--two-use-color);
    }

    .box img {
        height: 50px;
    }

    .box .text {
        color: white;
    }

    .topic {
        font-size: 13px;
        font-weight: 400;
        letter-spacing: 1px;
    }

    .topic-heading {
        font-size: 30px;
        letter-spacing: 3px;
    }

    .report-container {
        min-height: 300px;
        max-width: 1200px;
        margin: 70px auto 0px auto;
        background-color: #ffffff;
        border-radius: 30px;
        box-shadow: 3px 3px 10px rgb(188, 188, 188);
        padding: 0px 20px 20px 20px;
    }

    .report-header {
        height: 80px;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 20px 20px 10px 20px;
        border-bottom: 2px solid rgba(0, 20, 151, 0.59);
    }

    .recent-Articles {
        font-size: 30px;
        font-weight: 600;
        color: #5500cb;
    }

    .view {
        height: 35px;
        width: 90px;
        border-radius: 8px;
        background-color: #5500cb;
        color: white;
        font-size: 15px;
        border: none;
        cursor: pointer;
    }

    .report-body {
        max-width: 1160px;
        overflow-x: auto;
        padding: 20px;
    }

    .report-topic-heading,
    .item1 {
        width: 1120px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .t-op {
        font-size: 18px;
        letter-spacing: 0px;
    }

    .items {
        width: 1120px;
        margin-top: 15px;
    }

    .item1 {
        margin-top: 20px;
    }

    .t-op-nextlvl {
        font-size: 14px;
        letter-spacing: 0px;
        font-weight: 600;
    }

    .label-tag {
        width: 100px;
        text-align: center;
        background-color: rgb(0, 177, 0);
        color: white;
        border-radius: 4px;
    }
</style>
<div class="main">
    <div class="box-container">
       

    </div>


</div>
<script>
    function fill_sidebar() {
        let sidebar = document.getElementById("box-container");
        let routes = [{
                'img': 'https://cdn-icons-png.flaticon.com/512/2693/2693560.png',
                'p': 'Employer'
            },

            {
                'img': 'https://cdn-icons-png.flaticon.com/512/2693/2693560.png',
                'p': 'Stagiaire'
            },

            {
                'img': 'https://cdn-icons-png.flaticon.com/512/2693/2693560.png',
                'p': 'Présence'
            },

            {
                'img': 'https://cdn-icons-png.flaticon.com/512/2693/2693560.png',
                'p': 'Utilisateur'
            }

        ];
        routes.forEach(route => {
            sidebar.innerHTML += ` <a href="">
                                      <div class="box box1">
                                        <img src="https://cdn-icons-png.flaticon.com/512/2693/2693560.png" class="créative">
                                        <p>Suivi de congé</p>
                                        </div>
                                  </a>`;
        });
    }

    fill_sidebar();
</script>