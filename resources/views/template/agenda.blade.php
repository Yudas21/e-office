        @extends('template.layout')
        @section('content')
        <!-- Page wrapper  -->
        <div class="page-wrapper">
            <!-- Bread crumb -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary">Agenda</h3> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                        <li class="breadcrumb-item">Agenda</li>
                    </ol>
                </div>
            </div>
            <!-- End Bread crumb -->
            <!-- Container fluid  -->
            <div class="container-fluid">
                <!-- Start Page Content -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <link rel="stylesheet" href="../dhtmlxScheduler/codebase/dhtmlxscheduler.css" type="text/css" media="screen" title="no title" charset="utf-8">
                                <script src="../dhtmlxScheduler/codebase/dhtmlxscheduler.js"   type="text/javascript" charset="utf-8"></script>
                                <div class="dhx_cal_container" style='width:100%; height:50%;'>
                                    <div class="dhx_cal_navline">
                                        <div class="dhx_cal_prev_button">&nbsp;</div>
                                        <div class="dhx_cal_next_button">&nbsp;</div>
                                        <div class="dhx_cal_today_button"></div>
                                        <div class="dhx_cal_date"></div>
                                        <div class="dhx_cal_tab" name="day_tab"></div>
                                        <div class="dhx_cal_tab" name="week_tab"></div>
                                        <div class="dhx_cal_tab" name="month_tab"></div>
                                    </div>
                                    <div class="dhx_cal_header">
                                    </div>
                                    <div class="dhx_cal_data">
                                    </div>
                                </div>

                                <script type="text/javascript" charset="utf-8">
                                    document.body.onload = function() {
                                        scheduler.config.xml_date="%Y-%m-%d %H:%i";
                                //        scheduler.config.prevent_cache = true;

                                        scheduler.config.lightbox.sections=[
                                            {name:"description", height:130, map_to:"text", type:"textarea" , focus:true},
                                            {name:"location", height:43, type:"textarea", map_to:"details" },
                                            {name:"time", height:72, type:"time", map_to:"auto"}
                                        ];
                                        scheduler.config.first_hour = 4;
                                        scheduler.config.limit_time_select = true;
                                        scheduler.locale.labels.section_location="Location";



                                        scheduler.init('scheduler_here',new Date(),"month");
                                        scheduler.setLoadMode("month");
                                        scheduler.load("../admin/data");

                                        var dp = new dataProcessor("../admin/data");
                                        dp.init(scheduler);
                                    };
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End PAge Content -->
            </div>
            <!-- End Container fluid  -->
            @stop