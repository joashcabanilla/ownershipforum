<?php
    include('dbcon.php');
    include('session.php');
    $result=mysqli_query($con, "select * from users where user_id='$session_id'")or die('Error In Session');
    $row=mysqli_fetch_array($result);

    $sql = "SELECT * FROM members";
    $totalRegistered = $totalRecords = 0;
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        $totalRecords = number_format(count($result->fetch_all(MYSQLI_ASSOC)));
    }

    $sql = "SELECT * FROM members WHERE isregistered ='YES' ORDER BY branch";
    $result = $con->query($sql);
    $memberData = array();
    if ($result->num_rows > 0) {
        $memberData = $result->fetch_all(MYSQLI_ASSOC);
    }
    $totalRegistered = number_format(count($memberData));
    $dayTally = [
        "2024-02-03" => [
            "total" => [],
            "AM" => [],
            "PM" => []
        ],
        "2024-02-04" => [
            "total" => [],
            "AM" => [],
            "PM" => []
        ],
        "2024-02-05" => [
            "total" => [],
            "AM" => [],
            "PM" => []
        ]
    ];

    $branchTally = $branchTotal = array();
    $branchLabelArray = [
        "BSILANG",
        "BULACAN",
        "CAMARIN",
        "FAIRVIEW",
        "KIKO",
        "LAGRO",
        "MAIN OFFICE",
        "MUNOZ",
        "TSORA",
        "NUEVA ECIJA"
    ];

    $dayArray = [
        "day1" => "2024-02-03",
        "day2" => "2024-02-04",
        "day3" => "2024-02-05"
    ];
    
    foreach($memberData as $data){
        $sched = date("A",strtotime($data['forum_day']));
        $dayTally[$data['forum_date']]["total"][] = $data['fullname'];
        $dayTally[$data['forum_date']][$sched][] = $data['fullname'];
        
        $branchData = strtoupper($data['branch'] != "MAIN OFFICE") ? strtoupper(trim(str_replace("OFFICE",'',$data['branch']))) : strtoupper($data['branch']);

        $branchTally[$branchData][$data['forum_date']][$sched][] = $data['fullname'];
        $branchTotal[$branchData][] = $data['fullname'];
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>NOVADECI</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="shortcut icon" href="img/logo.gif">
        <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
        <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
        <link rel="stylesheet" href="dist/css/skins/skin-green.min.css">
        <link rel="stylesheet" type="text/css" href="dist/css/dashboard_style.css">
        <style media="screen, print">
            div.greenTable {
            /* font-family: Georgia, serif; */
            border: 6px solid #24943A;
            background-color: #D4EED1;
            width: 100%;
            text-align: center;
            }
            .divTable.greenTable .divTableCell, .divTable.greenTable .divTableHead {
            border: 1px solid #24943A;
            padding: 3px 2px;
            }
            .divTable.greenTable .divTableBody .divTableCell {
            font-size: 13px;
            }
            .divTable.greenTable .divTableHeading {
            background: #24943A;
            background: -moz-linear-gradient(top, #5baf6b 0%, #3a9e4d 66%, #24943A 100%);
            background: -webkit-linear-gradient(top, #5baf6b 0%, #3a9e4d 66%, #24943A 100%);
            background: linear-gradient(to bottom, #5baf6b 0%, #3a9e4d 66%, #24943A 100%);
            border-bottom: 0px solid #444444;
            }
            .divTable.greenTable .divTableHeading .divTableHead {
            font-size: 19px;
            /* font-weight: bold; */
            color: #F0F0F0;
            text-align: left;
            border-left: 2px solid #24943A;
            }
            .divTable.greenTable .divTableHeading .divTableHead:first-child {
            border-left: none;
            }
            .greenTable .tableFootStyle {
            font-size: 13px;
            }
            .greenTable .tableFootStyle .links {
            text-align: right;
            }
            .greenTable .tableFootStyle .links a{
            display: inline-block;
            background: #FFFFFF;
            color: #24943A;
            padding: 2px 8px;
            border-radius: 5px;
            }
            .greenTable.outerTableFooter {
            border-top: none;
            }
            .greenTable.outerTableFooter .tableFootStyle {
            padding: 3px 5px;
            }
            /* DivTable.com */
            .divTable{ display: table; }
            .divTableRow { display: table-row; }
            .divTableHeading { display: table-header-group;}
            .divTableCell, .divTableHead { display: table-cell;}
            .divTableHeading { display: table-header-group;}
            .divTableFoot { display: table-footer-group;}
            .divTableBody { display: table-row-group;}
            .divTable.greenTable .divTableHeading2 {
            background: #24943A;
            background: -moz-linear-gradient(top, #5baf6b 0%, #3a9e4d 66%, #24943A 100%);
            background: -webkit-linear-gradient(top, #5baf6b 0%, #3a9e4d 66%, #24943A 100%);
            background: linear-gradient(to bottom, #5baf6b 0%, #3a9e4d 66%, #24943A 100%);
            border-bottom: 0px solid #444444;
            }
            .divTable.greenTable .divTableHeading2 .divTableHead {
            font-size: 19px;
            font-weight: bold;
            color: #F0F0F0;
            text-align: left;
            border-left: 2px solid #24943A;
            }
        </style>
        
        <style media="print">
            .dontPrint{
               display: none !important;
            }
            .dashbord{
                border: 1px solid #24943A;
                width: 24%;
            }
           
        </style>
    </head>
    <body class="hold-transition skin-green sidebar-mini">
        <br>
        <div class="container">
            <ol class="breadcrumb dontPrint">
                <li><a href="https://ownershipforum.novadeci.com/home.php"><i class="fa fa-dashboard"></i> Ownership Registration</a></li>
                <li class="active">Dashboard</li>
            </ol>
           
            <section id="main">
                <div class="container-fluid">
                    <div class="row" >
                        <div class="dashbord lagro-content col-md-3" id="inner-div">
                            <div class="title-section">
                                <p><b>TOTAL RECORDS</b></p>
                            </div>
                            <div class="icon-text-section">
                                <div class="icon-section dontPrint">
                                    <i class="fa fa-spinner" aria-hidden="true"></i>
                                </div>
                                <div class="text-section">
                                    <a href="#">
                                        <?php
                                            echo "<h1 style='color:white;'>".$totalRecords."</h1>";
                                        ?>
                                    </a>
                                </div>
                                <div style="clear:both;"></div>
                            </div>
                            <div class="detail-section dontPrint" style="padding: 5px !important">
                                 <br>
                            </div>
                        </div>
                        <div class="dashbord tsora-content col-md-3" id="inner-div">
                            <div class="title-section">
                                <p><b>TOTAL REGISTERED</b></p>
                            </div>
                            <div class="icon-text-section">
                                <div class="icon-section dontPrint">
                                    <i class="fa fa-spinner" aria-hidden="true"></i>
                                </div>
                                <div class="text-section">
                                    <a href="#">
                                    <?php
                                        echo "<h1 style='color:white;'>".$totalRegistered."</h1>";
                                    ?>
                                    </a>
                                </div>
                                <div style="clear:both;"></div>
                            </div>
                            <div class="detail-section dontPrint" style="padding: 5px !important">
                                 <br>
                            </div>
                        </div>
                        <div class="dashbord cubao-content col-md-2" id="inner-div" >
                            <div class="title-section">
                                <p><b>DAY 1</b></p>
                            </div>
                            <div class="icon-text-section">
                                <div class="icon-section dontPrint">
                                    <i class="fa fa-spinner" aria-hidden="true"></i>
                                </div>
                                <div class="text-section">
                                    <a href="#">
                                        <?php
                                            echo "<h1 style='color:white;'>".number_format(count($dayTally["2024-02-03"]["total"]))."</h1>";
                                        ?>
                                    </a>
                                </div>
                                <div style="clear:both;"></div>
                            </div>
                            <div class="detail-section dontPrint" style="padding: 5px !important">
                                
                                <table style='width:100% !important; font-size: 15px;'>
                                    <tr style="text-align:center;">
                                        <td>AM: <?php
                                                    echo number_format(count($dayTally["2024-02-03"]["AM"]));
                                                ?>
                                        </td>
                                        <td>PM: <?php
                                                    echo number_format(count($dayTally["2024-02-03"]["PM"]));
                                                ?>
                                        </td>
                                    </tr>
                                </table>
                               
                            </div>
                        </div>
                        <div class="dashbord main_ofc-content col-md-2" id="inner-div" >
                            <div class="title-section">
                                <p><b>DAY 2</b></p>
                            </div>
                            <div class="icon-text-section">
                                <div class="icon-section dontPrint">
                                    <i class="fa fa-spinner" aria-hidden="true"></i>
                                </div>
                                <div class="text-section">
                                    <a href="#">
                                        <?php
                                            echo "<h1 style='color:white;'>".number_format(count($dayTally["2024-02-04"]["total"]))."</h1>";
                                        ?>
                                    </a>
                                </div>
                                <div style="clear:both;"></div>
                            </div>
                            <div class="detail-section dontPrint" style="padding: 5px !important">
                                <table style='width:100% !important; font-size: 15px;'>
                                    <tr style="text-align:center;">
                                        <td>AM: <?php
                                                    echo number_format(count($dayTally["2024-02-04"]["AM"]));
                                                ?>
                                        </td>
                                        <td>PM: <?php
                                                    echo number_format(count($dayTally["2024-02-04"]["PM"]));
                                                ?>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="dashbord munoz-content col-md-2" id="inner-div" >
                            <div class="title-section">
                                <p><b>DAY 3</b></p>
                            </div>
                            <div class="icon-text-section">
                                <div class="icon-section dontPrint">
                                    <i class="fa fa-spinner" aria-hidden="true"></i>
                                </div>
                                <div class="text-section">
                                    <a href="#">
                                        <?php
                                            echo "<h1 style='color:white;'>".number_format(count($dayTally["2024-02-05"]["total"]))."</h1>";
                                        ?>
                                    </a>
                                </div>
                                <div style="clear:both;"></div>
                            </div>
                            <div class="detail-section dontPrint" style="padding: 5px !important">
                                <table style='width:100% !important; font-size: 15px;'>
                                    <tr style="text-align:center;">
                                        <td>AM: <?php
                                                    echo number_format(count($dayTally["2024-02-05"]["AM"]));
                                                ?>
                                        </td>
                                        <td>PM: <?php
                                                    echo number_format(count($dayTally["2024-02-05"]["PM"]));
                                                ?>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <br>
                      
                        <div class="divTable greenTable" style="width:100%;text-align:center;" id="printarea">
                            <div class="divTableHeading">
                                <div class="divTableRow">
                                    <div class="divTableHead" style="width:200px;text-align:center;"></div>
                                    <div class="divTableHead" style="width:100px;text-align:center;"><u>DAY 1</u> - <i>FEB 3</i></div>
                                    <div class="divTableHead" style="width:100px;text-align:center;"><u>DAY 2</u> - <i>FEB 4</i></div>
                                    <div class="divTableHead" style="width:100px;text-align:center;"><u>DAY 3</u> - <i>FEB 5</i></div>
                                    <div class="divTableHead" style="width:100px;text-align:center;">TOTAL</div>
                                </div>
                                <div class="divTableRow">
                                    <div class="divTableHead" style="width:200px;text-align:center;"></div>
                                    <div class="divTableHead" style="width:100px;text-align:center;">AM &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; PM</div>
                                    <div class="divTableHead" style="width:100px;text-align:center;">AM &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; PM</div>
                                    <div class="divTableHead" style="width:100px;text-align:center;">AM &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; PM</div>
                                    <div class="divTableHead" style="width:100px;text-align:center;"></div>
                                </div>
                            </div>
                            <div class="divTableBody">                                
                                <?php 
                                    foreach($branchLabelArray as $branch){

                                        $total = isset($branchTotal[$branch]) ? number_format(count($branchTotal[$branch])) : 0;

                                        $tally = [
                                            "day1" => [
                                                "AM" => isset($branchTally[$branch][$dayArray["day1"]]["AM"]) ? number_format(count($branchTally[$branch][$dayArray["day1"]]["AM"])) : 0,

                                                "PM" => isset($branchTally[$branch][$dayArray["day1"]]["PM"]) ? number_format(count($branchTally[$branch][$dayArray["day1"]]["PM"])) : 0
                                            ],
                                            "day2" => [
                                                "AM" => isset($branchTally[$branch][$dayArray["day2"]]["AM"]) ? number_format(count($branchTally[$branch][$dayArray["day2"]]["AM"])) : 0,

                                                "PM" => isset($branchTally[$branch][$dayArray["day2"]]["PM"]) ? number_format(count($branchTally[$branch][$dayArray["day2"]]["PM"])) : 0
                                            ],
                                            "day3" => [
                                                "AM" => isset($branchTally[$branch][$dayArray["day3"]]["AM"]) ? number_format(count($branchTally[$branch][$dayArray["day3"]]["AM"])) : 0,

                                                "PM" => isset($branchTally[$branch][$dayArray["day3"]]["PM"]) ? number_format(count($branchTally[$branch][$dayArray["day3"]]["PM"])) : 0
                                            ],
                                        ];

                                        echo '<div class="divTableRow">
                                        <div class="divTableHeading2" style="font-size:19px;color:white;padding:10px;">'.$branch.'</div>';
                                        echo '<div class="divTableCell">
                                             <table style="width:100% !important; font-size: 19px">
                                                <tr>
                                                    <td style="width: 50% !important;">
                                                        '.$tally['day1']["AM"].'
                                                    </td>
                                                    <td>
                                                        '.$tally['day1']["PM"].'
                                                    </td>
                                                </tr>
                                            </table> 
                                        </div>
                                        <div class="divTableCell">
                                            <table style="width:100% !important; font-size: 19px">
                                                <tr>
                                                    <td style="width: 50% !important;">
                                                        '.$tally['day2']["AM"].'
                                                    </td>
                                                    <td>
                                                        '.$tally['day2']["PM"].'
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="divTableCell">
                                            <table style="width:100% !important; font-size: 19px">
                                                <tr>
                                                    <td style="width: 50% !important;">
                                                        '.$tally['day3']["AM"].'
                                                    </td>
                                                    <td>
                                                        '.$tally['day3']["PM"].'
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="divTableCell">
                                        <h4><b>'.$total.'</b></h4>
                                        </div>
                                    </div>';
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                            
                    </div>
                    <br>
                    <div class="pull-right">
                        <button class="btn btn-success btn-md dontPrint" onclick={window.print()}>Print</button> <br><br>
                    </div>
                </div>
            </section>
        </div>
    </body>
    <footer class="container dontPrint">
        <div style="float:right;margin-right:5px;font-size:12px;"><strong>© 2023 <a href="#">JV</a></strong> All rights reserved.</div>
    </footer>
        <!-- <script src="../bower_components/jquery/dist/jquery.min.js"></script>
        <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="../bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="../bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
        <script src="../dist/js/adminlte.min.js"></script> -->
</html>