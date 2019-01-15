@extends('BE.layouts.BE')
@section('title')
    {{@$title}}
@stop

@section('content')

    <div class="row">
        <div class="col-lg-8">

            <div class="row">

                <div class="col-sm-4">
                    <div class="card-box widget-box-four">
                        <div id="dashboard-1" class="widget-box-four-chart"></div>
                        <div class="wigdet-four-content pull-left">
                            <h4 class="m-t-0 font-16 m-b-5 font-600 text-overflow" title="Total Revenue">Total
                                Revenue</h4>
                            <p class="font-secondary text-muted">Jan - Apr 2017</p>
                            <h3 class="m-b-0 m-t-20 font-600"><span>$</span> <span data-plugin="counterup">5,2548</span>
                            </h3>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div><!-- end col -->

                <div class="col-sm-4">
                    <div class="card-box widget-box-four">
                        <div id="dashboard-2" class="widget-box-four-chart"></div>
                        <div class="wigdet-four-content pull-left">
                            <h4 class="m-t-0 font-16 font-600 m-b-5 text-overflow" title="Total Unique Visitors">Total
                                Unique Visitors</h4>
                            <p class="font-secondary text-muted">Jan - Apr 2017</p>
                            <h3 class="m-b-0 m-t-20 font-600"><span>$</span> <span data-plugin="counterup">65,241</span>
                            </h3>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div><!-- end col -->

                <div class="col-sm-4">
                    <div class="card-box widget-box-four">
                        <div id="dashboard-3" class="widget-box-four-chart"></div>
                        <div class="wigdet-four-content pull-left">
                            <h4 class="m-t-0 font-16 font-600 m-b-5 text-overflow" title="Number of Transactions">Number
                                of Transactions</h4>
                            <p class="font-secondary text-muted">Jan - Apr 2017</p>
                            <h3 class="m-b-0 m-t-20 font-600"><span>$</span> <span
                                    data-plugin="counterup">28,5960</span></h3>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div><!-- end col -->

            </div>
            <!-- end row -->


            <div class="row">
                <div class="col-12">
                    <div class="card-box">
                        <h4 class="header-title m-t-0">Stacked Bar Chart</h4>
                        <div class="text-center">
                            <div class="row">
                                <div class="col-4">
                                    <div class="m-t-20 m-b-20">
                                        <h4 class="m-b-10">2563</h4>
                                        <p class="text-uppercase m-b-5 font-13 font-600">Lifetime total sales</p>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="m-t-20 m-b-20">
                                        <h4 class="m-b-10">6952</h4>
                                        <p class="text-uppercase m-b-5 font-13 font-600">Income amounts</p>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="m-t-20 m-b-20">
                                        <h4 class="m-b-10">1125</h4>
                                        <p class="text-uppercase m-b-5 font-13 font-600">Total visits</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="morris-bar-stacked" style="height: 310px;"></div>

                    </div>

                </div><!-- end col -->

            </div>
            <!-- end row -->

        </div><!-- end col -->


        <div class="col-lg-4">
            <div class="card-box text-center">
                <div class="text-center">
                    <h5 class="font-normal text-muted">Lifetime Sales</h5>
                    <h3 class="m-b-30"><i class="mdi mdi-arrow-up-bold-hexagon-outline text-success"></i> 48948
                        <small>USD</small>
                    </h3>
                </div>

                <div id="morris-line-example" style="height: 180px;"></div>

            </div>


            <div class="card-box">
                <h4 class="header-title m-t-0 m-b-15">Recent Notifications</h4>

                <div class="m-b-15">
                    <p><span class="pull-right text-dark">Mark Loyerdn</span> <span
                            class="label label-primary">Visitor</span></p>
                    <p class="font-13 m-b-5">Praesent libero. Nunc nec dui vitae urna cursus lacinia. In venenatis eget
                        justo in dictum. Vestibulum auctor raesent quisnm.</p>
                    <p class="font-13"><i>2 Min ago</i></p>
                </div>

                <div class="">
                    <p><span class="pull-right text-dark">Mark Loyerdn</span> <span
                            class="label label-success">Seller</span></p>
                    <p class="font-13 m-b-5">Praesent libero. Nunc nec dui vitae urna cursus lacinia. In venenatis eget
                        justo in dictum. Vestibulum auctor raesent quisnm.</p>
                    <p class="font-13 m-b-0"><i>5 Hours ago</i></p>
                </div>
            </div>
        </div> <!-- end col -->

    </div>
    <!-- end row -->


    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <h4 class="m-t-0 header-title"><b>Recent Candidates</b></h4>
                <p class="text-muted font-14 m-b-20">
                    Your awesome text goes here.
                </p>

                <div class="table-responsive">
                    <table class="table m-0 table-colored table-primary table-hover">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Position</th>
                            <th>Office</th>
                            <th>Age</th>
                            <th>Start date</th>
                            <th>Salary</th>
                        </tr>
                        </thead>


                        <tbody>
                        <tr>
                            <td>Tiger Nixon</td>
                            <td>System Architect</td>
                            <td>Edinburgh</td>
                            <td>61</td>
                            <td>2011/04/25</td>
                            <td>$320,800</td>
                        </tr>
                        <tr>
                            <td>Garrett Winters</td>
                            <td>Accountant</td>
                            <td>Tokyo</td>
                            <td>63</td>
                            <td>2011/07/25</td>
                            <td>$170,750</td>
                        </tr>
                        <tr>
                            <td>Ashton Cox</td>
                            <td>Junior Technical Author</td>
                            <td>San Francisco</td>
                            <td>66</td>
                            <td>2009/01/12</td>
                            <td>$86,000</td>
                        </tr>
                        <tr>
                            <td>Cedric Kelly</td>
                            <td>Senior Javascript Developer</td>
                            <td>Edinburgh</td>
                            <td>22</td>
                            <td>2012/03/29</td>
                            <td>$433,060</td>
                        </tr>
                        <tr>
                            <td>Airi Satou</td>
                            <td>Accountant</td>
                            <td>Tokyo</td>
                            <td>33</td>
                            <td>2008/11/28</td>
                            <td>$162,700</td>
                        </tr>
                        <tr>
                            <td>Brielle Williamson</td>
                            <td>Integration Specialist</td>
                            <td>New York</td>
                            <td>61</td>
                            <td>2012/12/02</td>
                            <td>$372,000</td>
                        </tr>
                        <tr>
                            <td>Herrod Chandler</td>
                            <td>Sales Assistant</td>
                            <td>San Francisco</td>
                            <td>59</td>
                            <td>2012/08/06</td>
                            <td>$137,500</td>
                        </tr>
                        <tr>
                            <td>Rhona Davidson</td>
                            <td>Integration Specialist</td>
                            <td>Tokyo</td>
                            <td>55</td>
                            <td>2010/10/14</td>
                            <td>$327,900</td>
                        </tr>
                        <tr>
                            <td>Colleen Hurst</td>
                            <td>Javascript Developer</td>
                            <td>San Francisco</td>
                            <td>39</td>
                            <td>2009/09/15</td>
                            <td>$205,500</td>
                        </tr>
                        <tr>
                            <td>Sonya Frost</td>
                            <td>Software Engineer</td>
                            <td>Edinburgh</td>
                            <td>23</td>
                            <td>2008/12/13</td>
                            <td>$103,600</td>
                        </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div> <!-- end row -->

@stop

@section('scriptstop')
    <script src="{{asset('BE/plugins/waypoints/jquery.waypoints.min.js')}}"></script>
    <script src="{{asset('BE/plugins/counterup/jquery.counterup.min.js')}}"></script>

    <!--Morris Chart-->
    <script src="{{asset('BE/plugins/morris/morris.min.js')}}"></script>
    <script src="{{asset('BE/plugins/raphael/raphael-min.js')}}"></script>
    <script src="{{asset('BE/plugins/jquery-sparkline/jquery.sparkline.min.js')}}"></script>
@stop
@section('scripts')
    <script>
        $(document).ready(function () {

            var DrawSparkline = function () {
                $('#dashboard-1').sparkline([20, 40, 30, 10], {
                    type: 'pie',
                    width: '80',
                    height: '80',
                    sliceColors: ['#60befc', '#6248ff', '#e3b0db', '#dbdbdb']
                });
                $('#dashboard-2').sparkline([25, 35, 21], {
                    type: 'pie',
                    width: '80',
                    height: '80',
                    sliceColors: ['#6ad9c3', '#9aa1f2', '#ebeff2']
                });
                $('#dashboard-3').sparkline([20, 40, 30], {
                    type: 'pie',
                    width: '80',
                    height: '80',
                    sliceColors: ['#c086f3', '#65acff', '#7ed321']
                });
            }

            DrawSparkline();

            var resizeChart;

            $(window).resize(function (e) {
                clearTimeout(resizeChart);
                resizeChart = setTimeout(function () {
                    DrawSparkline();
                }, 300);
            });
        });


        !function ($) {
            "use strict";

            var MorrisCharts = function () {
            };

            //creates Stacked chart
            MorrisCharts.prototype.createStackedChart = function (element, data, xkey, ykeys, labels, lineColors) {
                Morris.Bar({
                    element: element,
                    data: data,
                    xkey: xkey,
                    ykeys: ykeys,
                    stacked: true,
                    labels: labels,
                    hideHover: 'auto',
                    resize: true, //defaulted to true
                    gridLineColor: '#eeeeee',
                    barColors: lineColors,
                    barSizeRatio: 0.5
                });
            },

                //creates line chart
                MorrisCharts.prototype.createLineChart = function (element, data, xkey, ykeys, labels, opacity, Pfillcolor, Pstockcolor, lineColors) {
                    Morris.Line({
                        element: element,
                        data: data,
                        xkey: xkey,
                        ykeys: ykeys,
                        labels: labels,
                        fillOpacity: opacity,
                        pointFillColors: Pfillcolor,
                        pointStrokeColors: Pstockcolor,
                        behaveLikeLine: true,
                        gridLineColor: '#eef0f2',
                        hideHover: 'auto',
                        lineWidth: '3px',
                        pointSize: 0,
                        preUnits: '$',
                        resize: true, //defaulted to true
                        lineColors: lineColors
                    });
                },

                MorrisCharts.prototype.init = function () {

                    //creating Stacked chart
                    var $stckedData = [
                        {y: '2005', a: 45, b: 180, c: 100},
                        {y: '2006', a: 75, b: 65, c: 80},
                        {y: '2007', a: 100, b: 90, c: 56},
                        {y: '2008', a: 75, b: 65, c: 89},
                        {y: '2009', a: 100, b: 90, c: 120},
                        {y: '2010', a: 75, b: 65, c: 110},
                        {y: '2011', a: 50, b: 40, c: 85},
                        {y: '2012', a: 75, b: 65, c: 52},
                        {y: '2013', a: 50, b: 40, c: 77},
                        {y: '2014', a: 75, b: 65, c: 90},
                        {y: '2015', a: 100, b: 90, c: 130},
                        {y: '2016', a: 80, b: 65, c: 95}
                    ];
                    this.createStackedChart('morris-bar-stacked', $stckedData, 'y', ['a', 'b', 'c'], ['Series A', 'Series B', 'Series C'], ['#6ad9c3', '#9aa1f2', '#ebeff2']);

                    //create line chart
                    var $data = [
                        {y: '2008', a: 50, b: 0},
                        {y: '2009', a: 75, b: 50},
                        {y: '2010', a: 30, b: 80},
                        {y: '2011', a: 50, b: 50},
                        {y: '2012', a: 75, b: 10},
                        {y: '2013', a: 50, b: 40},
                        {y: '2014', a: 75, b: 50},
                        {y: '2015', a: 100, b: 70}
                    ];
                    this.createLineChart('morris-line-example', $data, 'y', ['a', 'b'], ['Series A', 'Series B'], ['0.1'], ['#ffffff'], ['#999999'], ['#5553ce ', '#f06292']);
                },
                //init
                $.MorrisCharts = new MorrisCharts, $.MorrisCharts.Constructor = MorrisCharts
        }(window.jQuery),

//initializing
            function ($) {
                "use strict";
                $.MorrisCharts.init();
            }(window.jQuery);
    </script>
@endsection
