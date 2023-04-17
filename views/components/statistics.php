<?php
$homeController = new HomeController();

$usersCount = $homeController->getUsersCount();
$groupsCount = $homeController->getGroupsCount();
$articlesCount = $homeController->getArticlesCount();

$groups = $homeController->getGroupsName();
$groupUsersCount = $homeController->getGroupUsersCount();

?>
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-header p-3 pt-2">
                    <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                        <i class="material-icons opacity-10">weekend</i>
                    </div>
                    <div class="text-end pt-1">
                        <p class="text-sm mb-0 text-capitalize">Total Articals</p>
                        <h4 class="mb-0"><?= $articlesCount['count'] ?></h4>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-header p-3 pt-2">
                    <div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                        <i class="material-icons opacity-10">person</i>
                    </div>
                    <div class="text-end pt-1">
                        <p class="text-sm mb-0 text-capitalize">Total Users</p>
                        <h4 class="mb-0"><?= $usersCount['count'] ?></h4>
                    </div>
                </div>

            </div>
        </div>

        <div class="col-xl-4 col-sm-6">
            <div class="card">
                <div class="card-header p-3 pt-2">
                    <div class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                        <i class="material-icons opacity-10">weekend</i>
                    </div>
                    <div class="text-end pt-1">
                        <p class="text-sm mb-0 text-capitalize">Total Groups</p>
                        <h4 class="mb-0"><?= $groupsCount['count'] ?></h4>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Chart -->
    <div class="row mt-4">
        <div class="col-lg-12 col-md-6 mt-4 mb-4">
            <div class="card z-index-2 ">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                    <div class="bg-gradient-dark shadow-dark border-radius-lg py-3 pe-1">
                        <div class="chart">
                            <canvas id="chart-bars" class="chart-canvas" height="170"></canvas>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <h6 class="mb-0 ">Groups - Users</h6>
                    <p class="text-sm ">A Relation between Group and its users </p>

                </div>
            </div>
        </div>

    </div>

</div>

<script src="../assets/js/plugins/chartjs.min.js"></script>

<script>
    const groupsText = "<?= $groups ?>";
    groupsName = groupsText.split(",")
    const countText = "<?= $groupUsersCount ?>";
    groupUsersCount = countText.split(",")
    // alert(groupsName);
    var ctx = document.getElementById("chart-bars").getContext("2d");
    new Chart(ctx, {
        type: "bar",
        data: {
            labels: groupsName,
            datasets: [{
                label: "Users",
                tension: 0.4,
                borderWidth: 0,
                borderRadius: 4,
                borderSkipped: false,
                backgroundColor: "rgba(255, 255, 255, .8)",
                data: groupUsersCount,
                maxBarThickness: 6
            }, ],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false,
                }
            },
            interaction: {
                intersect: false,
                mode: 'index',
            },
            scales: {
                y: {
                    grid: {
                        drawBorder: false,
                        display: true,
                        drawOnChartArea: true,
                        drawTicks: false,
                        borderDash: [5, 5],
                        color: 'rgba(255, 255, 255, .2)'
                    },
                    ticks: {
                        suggestedMin: 0,
                        suggestedMax: 500,
                        beginAtZero: true,
                        padding: 10,
                        font: {
                            size: 14,
                            weight: 300,
                            family: "Roboto",
                            style: 'normal',
                            lineHeight: 2
                        },
                        color: "#fff"
                    },
                },
                x: {
                    grid: {
                        drawBorder: false,
                        display: true,
                        drawOnChartArea: true,
                        drawTicks: false,
                        borderDash: [5, 5],
                        color: 'rgba(255, 255, 255, .2)'
                    },
                    ticks: {
                        display: true,
                        color: '#f8f9fa',
                        padding: 10,
                        font: {
                            size: 14,
                            weight: 300,
                            family: "Roboto",
                            style: 'normal',
                            lineHeight: 2
                        },
                    }
                },
            },
        },
    });
</script>