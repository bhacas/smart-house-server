<?php
$ip = '192.168.1.112';
$title = 'Sypialnia 1';
?>

<!DOCTYPE html>
<html>
    <?php include_once 'inc/head.php'; ?>
    <body class="skin-blue">
        <!-- header logo: style can be found in header.less -->
        <?php include_once 'inc/header.php'; ?>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <?php include_once 'inc/sitebar.php'; ?>
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1><?php echo $title ?></h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Panel główny</a></li>
                        <li class="active"><i class="fa fa-moon-o"></i> Sypialnie</li>
                        <li class="active"><?php echo $title ?></li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">

                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <a id="light1" class="small-box bg-red ajaxButton" href="#">
                                <div class="inner">
                                    <h3>Światło 1</h3>
                                    <p>Wyłączone</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-lightbulb-o"></i>
                                </div>
                            </a>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <a id="light2" class="small-box bg-red ajaxButton" href="#">
                                <div class="inner">
                                    <h3>Światło 2</h3>
                                    <p>Wyłączone</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-lightbulb-o"></i>
                                </div>
                            </a>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <a id="outlet1" class="small-box bg-aqua ajaxButton" href="#">
                                <div class="inner">
                                    <h3>Kontakt 1</h3>
                                    <p>Wyłączony</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-plug"></i>
                                </div>
                            </a>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <a id="outlet2" class="small-box bg-aqua ajaxButton" href="#">
                                <div class="inner">
                                    <h3>Kontakt 2</h3>
                                    <p>Wyłączony</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-plug"></i>
                                </div>
                            </a>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div id="window" class="small-box bg-green">
                                <div class="inner">
                                    <h3>Okno</h3>
                                    <p>Zamknięte</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-windows"></i>
                                </div>
                            </div>
                        </div><!-- ./col -->
                    </div><!-- /.row -->

                    <div class="row">
                        <section class="col-lg-7">
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs pull-right ui-sortable-handle">
                                    <li class="active"><a href="#revenue-chart" data-toggle="tab" aria-expanded="true">Dzienny</a></li>
                                    <li class=""><a href="#sales-chart" data-toggle="tab" aria-expanded="false">Tygodniowy</a></li>
                                    <li class="pull-left header"><i class="fa fa-line-chart"></i> Temperatura</li>
                                </ul>
                                <div class="tab-content no-padding">
                                    <!-- Morris chart - Sales -->
                                    <div class="chart tab-pane active" id="temp-daily-chart" style="position: relative; height: 300px;"></div>
                                    <div class="chart tab-pane" id="temp-weekly-chart" style="position: relative; height: 300px;"></div>
                                </div>
                            </div>
                        </section>

                        <section class="col-lg-5">
                            <div id="notifies" class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">10 ostatnich zdarzeń</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body no-padding">
                                    <table class="table table-condensed"></table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </section>
                    </div>

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="js/AdminLTE/app.js" type="text/javascript"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="js/AdminLTE/demo.js" type="text/javascript"></script>
        <!-- Morris.js charts -->
        <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
        <script src="js/plugins/morris/morris.min.js" type="text/javascript"></script>
        <script type="text/javascript">

            var tempDailyChart = new Morris.Line({
                // ID of the element in which to draw the chart.
                element: 'temp-daily-chart',
                // Chart data records -- each entry in this array corresponds to a point on
                // the chart.
                data: [],
                // The name of the data record attribute that contains x-values.
                xkey: 'time',
                // A list of names of data record attributes that contain y-values.
                ykeys: ['value'],
                // Labels for the ykeys -- will be displayed when you hover over the
                // chart.
                labels: ['Value']
            });

            function getStatus() {
                $.ajax({url: "/admin/getStatus.php?ip=<?php echo $ip ?>", success: function(result) {
                        $.each(result.outputs, function(type, value) {
                            if (value == 0) {
                                $('#' + type).removeClass('bg-yellow');
                            } else {
                                $('#' + type).addClass('bg-yellow');
                            }
                        });

                        var htmlTable = '<tr><th style="width: 10px">#</th><th>Data</th><th>Zdarzenie</th></tr>';
                        var i = 0;
                        $.each(result.notifies, function(res, obj) {
                            htmlTable += '<tr><td>' + (++i) + '</td><td>' + obj.time + '</td><td>' + obj.notify + '</td></tr>';
                        });
                        $('#notifies table').html(htmlTable);

                        tempDailyChart.setData(result.temp.daily);
                    }
                });
            }
            ;

            $(document).ready(function() {

                getStatus();

                setInterval(function() {
                    getStatus();
                }, 2500);

                $(".ajaxButton").click(function(e) {
                    e.preventDefault();
                    console.log($(this).attr('id'));
                    var value = $(this).hasClass('bg-yellow') ? 0 : 1;
                    var _this = $(this);
                    $.ajax({url: "http://<?php echo $ip ?>/?type=" + $(this).attr('id') + "&value=" + value, success: function(result) {
                            _this.toggleClass('bg-yellow');
                        }
                    });
                });
            });
        </script>
    </body>
</html>
