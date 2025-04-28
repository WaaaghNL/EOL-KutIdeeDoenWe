<?php
$ideaList = DB::query("SELECT id,ideakey, name, idea, status, created_at FROM ideas ORDER BY id DESC");

$ideasADay = DB::query("SELECT DATE(created_at) AS date, COUNT(*) AS count_per_day FROM ideas GROUP BY DATE(created_at)");
$data = array();
$pie = array('false' => 0, 'true' => 0);
foreach ($ideasADay as $row) {
    $data[$row['date']]['total'] = $row['count_per_day'];
}

$ideasADayFalse = DB::query("SELECT DATE(created_at) AS date, COUNT(*) AS count_per_day FROM ideas WHERE status = 0 GROUP BY DATE(created_at)");
$dateIdeasADayFalse = array();
foreach ($ideasADayFalse as $row) {
    $data[$row['date']]['false'] = $row['count_per_day'];
    $pie['false'] = $pie['false'] + $row['count_per_day'];
}

$ideasADayTrue = DB::query("SELECT DATE(created_at) AS date, COUNT(*) AS count_per_day FROM ideas WHERE status = 1 GROUP BY DATE(created_at)");
$dateIdeasADayTrue = array();
foreach ($ideasADayTrue as $row) {
    $data[$row['date']]['true'] = $row['count_per_day'];
    $pie['true'] = $pie['true'] + $row['count_per_day'];
}
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>Overzicht | <?= $siteTitle; ?></title>

        <?php require_once 'meta.php'; ?>
        <!-- Bootgrid -->
        <link rel="stylesheet" href="/vendor/jquery-bootgrid/dist/jquery.bootgrid.min.css">
        <!-- Custom Stylesheet -->
        <link href="/css/style.css" rel="stylesheet">


        <!-- Google charts -->
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
            google.charts.load("current", {"packages": ["corechart"]});
            google.charts.setOnLoadCallback(drawChart);
            function drawChart() {
                var data = new google.visualization.DataTable();
                data.addColumn("date", "Date");
                data.addColumn("number", "Totaal");
                data.addColumn("number", "Slecht idee");
                data.addColumn("number", "Kut idee");
                var rows = [

<?php
foreach ($data as $date => $counts) {
    $false = (isset($counts['false'])) ? $counts['false'] : 0;
    $true = (isset($counts['true'])) ? $counts['true'] : 0;
    echo '[new Date("' . $date . '"), ' . $counts['total'] . ', ' . $false . ', ' . $true . '],';
}
?>

                ];
                data.addRows(rows);
                var options = {
                    title: "Records Count per Day",
                    curveType: "function",
                    legend: {position: "bottom"}
                };
                var chart = new google.visualization.LineChart(document.getElementById("chart_div"));
                chart.draw(data, options);
            }
        </script>



        <script type="text/javascript">
            google.charts.load('current', {'packages': ['corechart']});
            google.charts.setOnLoadCallback(drawChart);
            function drawChart() {

                var data = google.visualization.arrayToDataTable([
                    ['Task', 'Hours per Day'],
                    ['Kut idee', <?= $pie['true']; ?>],
                    ['Slecht idee', <?= $pie['false']; ?>]
                ]);
                var options = {
                    title: 'Idee resultaten'
                };
                var chart = new google.visualization.PieChart(document.getElementById('piechart'));
                chart.draw(data, options);
            }
        </script>



    </head>

    <body>
        <!--**********************************
            Main wrapper start
        ***********************************-->
        <div id="main-wrapper">
            <div class="content-body">

                <div class="container">
                    <div class="row">
                        <div class="col-6">
                            <div class="card stat-widget-one bg-eth">
                                <div class="card-body">
                                    <div class="row justify-content-between">
                                        <div class="col-auto">
                                            <h4 class="mb-3">Kut ideeën</h4>

                                            <h3 class="mb-3"><span class="counter"><?= count($ideaList); ?></span> Ideas</h3>
                                        </div>
                                        <div class="col-auto">
                                            <i class="cc cc ETH-alt" title="ETH"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card">
                                <div class="card-header pb-0">
                                    <h4 class="card-title">Pie Chart</h4>
                                </div>
                                <div class="card-body">
                                    <div id="piechart" style="width: 400px; height: 400px;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header pb-0">
                                    <h4 class="card-title">Line Chart</h4>
                                </div>
                                <div class="card-body">
                                    <div id="chart_div" style="width: 1050px; height: 400px;"></div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Ideeën</h4>
                                    <div class="table-responsive">
                                        <table class="table primary-table-bg-hover">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Naam</th>
                                                    <th>Idee</th>
                                                    <th>Datum</th>
                                                    <th>Resultaat</th>
                                                    <th>Link</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $idCount = count($ideaList);
                                                foreach ($ideaList AS $idea) {
                                                    ?>
                                                    <tr>
                                                        <td><?= $idCount; ?></td>
                                                        <td><?= $idea['name']; ?></td>
                                                        <td><?= $idea['idea']; ?></td>
                                                        <td><?= $idea['created_at']; ?></td>
                                                        <td>
                                                            <?php
                                                            if ($idea['status']) {
                                                                echo '<span class="badge badge-success">Kut</span>';
                                                            }
                                                            else {
                                                                echo '<span class="badge badge-danger">Nope</span>';
                                                            }
                                                            ?>
                                                        </td>
                                                        <td><a href="<?= $siteBase . $idea['ideakey']; ?>" target="_blank"><?= $idea['ideakey']; ?></a></td>
                                                    </tr>
                                                    <?php
                                                    $idCount--;
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="footer">
                <div class="copyright">
                    <p><?= $siteCopyright; ?></p>
                </div>
            </div>
        </div>
        <script src="/vendor/common/common.min.js"></script>
        <script src="/js/custom.min.js"></script>
        <script src="/js/settings.js"></script>
        <script src="/js/quixnav.js"></script>
        <script src="/js/styleSwitcher.js"></script>
    </body>
</html>