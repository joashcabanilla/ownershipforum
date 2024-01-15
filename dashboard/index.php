<?php
    include('dbcon.php');
    include('session.php');
    $result=mysqli_query($con, "select * from users where user_id='$session_id'")or die('Error In Session');
    $row=mysqli_fetch_array($result);
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
        <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic"> -->
        <link rel="stylesheet" type="text/css" href="dist/css/dashboard_style.css">
        <!-- <link rel="stylesheet" type="text/css" href="../dist/css/font-awesome.min.css"> -->
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
            /* {
            overflow-y: hidden;
            overflow-x: hidden;
            } */
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
                                        foreach($con->query('SELECT SUM(count)
                                        FROM members') as $row) {
                                        echo "<h1 style='color:white;'>".number_format($row['SUM(count)'])."</h1>";
                                        }
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
                                        foreach($con->query('SELECT SUM(updated_count)
                                        FROM members where isregistered="YES"') as $row) {
                                        echo "<h1 style='color:white;'>".number_format($row['SUM(updated_count)'])."</h1>";
                                        }
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
                                        foreach($con->query('SELECT SUM(updated_count)
                                        FROM members where forum_date="2023-02-19"') as $row) {
                                        echo "<h1 style='color:white;'>".number_format($row['SUM(updated_count)'])."</h1>";
                                        }
                                        ?>
                                    </a>
                                </div>
                                <div style="clear:both;"></div>
                            </div>
                            <div class="detail-section dontPrint" style="padding: 5px !important">
                                
                                <table style='width:100% !important; font-size: 15px;'>
                                    <tr style="text-align:center;">
                                        <td>AM: <?php
                                                    foreach($con->query('SELECT SUM(updated_count)
                                                        FROM members where forum_date="2023-02-19" and forum_day <= "2023-02-19 03:59:59"') as $row) {
                                                            echo number_format($row['SUM(updated_count)']);
                                                    }
                                                ?>
                                        </td>
                                        <td>PM: <?php
                                                    foreach($con->query('SELECT SUM(updated_count)
                                                        FROM members where forum_date="2023-02-19" and forum_day >= "2023-02-19 04:00:00" and forum_day <= "2023-02-19 09:00:00"') as $row) {
                                                            echo number_format($row['SUM(updated_count)']);
                                                    }
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
                                        foreach($con->query('SELECT SUM(updated_count)
                                        FROM members where forum_date="2023-02-20"') as $row) {
                                        echo "<h1 style='color:white;'>".number_format($row['SUM(updated_count)'])."</h1>";
                                        }
                                        ?>
                                    </a>
                                </div>
                                <div style="clear:both;"></div>
                            </div>
                            <div class="detail-section dontPrint" style="padding: 5px !important">
                                <table style='width:100% !important; font-size: 15px;'>
                                    <tr style="text-align:center;">
                                        <td>AM: <?php
                                                    foreach($con->query('SELECT SUM(updated_count)
                                                        FROM members where forum_date="2023-02-20" and forum_day >= "2023-02-19 16:00:00" and forum_day <= "2023-02-20 03:59:59"') as $row) {
                                                            echo number_format($row['SUM(updated_count)']);
                                                    }
                                                ?>
                                        </td>
                                        <td>PM: <?php
                                                    foreach($con->query('SELECT SUM(updated_count)
                                                        FROM members where forum_date="2023-02-20" and forum_day >= "2023-02-20 04:00:00" and forum_day <= "2023-02-20 09:00:00"') as $row) {
                                                            echo number_format($row['SUM(updated_count)']);
                                                    }
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
                                        foreach($con->query('SELECT SUM(updated_count)
                                        FROM members where forum_date="2023-02-21"') as $row) {
                                        echo "<h1 style='color:white;'>".number_format($row['SUM(updated_count)'])."</h1>";
                                        }
                                        ?>
                                    </a>
                                </div>
                                <div style="clear:both;"></div>
                            </div>
                            <div class="detail-section dontPrint" style="padding: 5px !important">
                                <table style='width:100% !important; font-size: 15px;'>
                                    <tr style="text-align:center;">
                                        <td>AM: <?php
                                                    foreach($con->query('SELECT SUM(updated_count)
                                                        FROM members where forum_date="2023-02-21" and forum_day >= "2023-02-20 16:00:00" and forum_day <= "2023-02-21 03:59:59"') as $row) {
                                                            echo number_format($row['SUM(updated_count)']);
                                                    }
                                                ?>
                                        </td>
                                        <td>PM: <?php
                                                    foreach($con->query('SELECT SUM(updated_count)
                                                        FROM members where forum_date="2023-02-21" and forum_day >= "2023-02-21 04:00:00" and forum_day <= "2023-02-21 09:00:00"') as $row) {
                                                            echo number_format($row['SUM(updated_count)']);
                                                    }
                                                ?>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <!-- <div class="dashbord bsilang-content col-md-2" id="inner-div" >
                                <div class="title-section">
                                    <p><b>DAY 4</b></p>
                                </div>
                                <div class="icon-text-section">
                                    <div class="icon-section">
                                        <i class="fa fa-spinner" aria-hidden="true"></i>
                                    </div>
                                    <div class="text-section">
                                        <a href="#">
                                        <?php
                                    // foreach($con->query('SELECT SUM(updated_count)
                                    // FROM members where forum_date="2022-02-26"') as $row) {
                                    // echo "<h1 style='color:white;'>".number_format($row['SUM(updated_count)'])."</h1>";
                                    // }
                                    ?>
                                            </a>
                                    </div>
                                    <div style="clear:both;"></div>
                                </div>
                                <div class="detail-section">
                                    <a href="#">
                                        <p><b>02/26/2022</b></p>
                                        <i class="fa fa-arrow-right" aria-hidden="true"></i>
                                    </a>
                                </div>
                                </div> -->
                    </div>

                    <div class="row">
                        <br>
                      
                        <div class="divTable greenTable" style="width:100%;text-align:center;" id="printarea">
                            <div class="divTableHeading">
                                <div class="divTableRow">
                                    <div class="divTableHead" style="width:200px;text-align:center;"></div>
                                    <div class="divTableHead" style="width:100px;text-align:center;"><u>DAY 1</u> - <i>FEB 19</i></div>
                                    <div class="divTableHead" style="width:100px;text-align:center;"><u>DAY 2</u> - <i>FEB 20</i></div>
                                    <div class="divTableHead" style="width:100px;text-align:center;"><u>DAY 3</u> - <i>FEB 21</i></div>
                                    <!-- <div class="divTableHead" style="width:100px;text-align:center;">DAY 4 02/26/2022</div> -->
                                    <div class="divTableHead" style="width:100px;text-align:center;">TOTAL</div>
                                </div>
                                <div class="divTableRow">
                                    <div class="divTableHead" style="width:200px;text-align:center;"></div>
                                    <div class="divTableHead" style="width:100px;text-align:center;">AM &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; PM</div>
                                    <div class="divTableHead" style="width:100px;text-align:center;">AM &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; PM</div>
                                    <div class="divTableHead" style="width:100px;text-align:center;">AM &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; PM</div>
                                    <!-- <div class="divTableHead" style="width:100px;text-align:center;">DAY 4 02/26/2022</div> -->
                                    <div class="divTableHead" style="width:100px;text-align:center;"></div>
                                </div>
                            </div>
                            <div class="divTableBody">
                                
                                <div class="divTableRow">
                                    <div class="divTableHeading2" style="font-size:19px;color:white;padding:10px;">BSILANG</div>
                                    <div class="divTableCell">
                                         <table style='width:100% !important; font-size: 19px'>
                                            <tr>
                                                <!--<td>-->
                                                    <?php
                                                        // foreach($con->query('SELECT SUM(updated_count)
                                                        // FROM members where forum_date="2023-02-19" AND Branch="BSILANG OFFICE"') as $row) {
                                                        //     echo number_format($row['SUM(updated_count)']);
                                                        // }
                                                    ?>
                                                <!--</td>-->
                                                <td style="width: 50% !important;">
                                                    <?php
                                                    // 03:59:59 = 11:59 AM in PH
                                                        foreach($con->query('select SUM(updated_count) from members where forum_day <= "2023-02-19 03:59:59"
                                                        and forum_date="2023-02-19" AND Branch="BSILANG OFFICE"') as $row) {
                                                            echo number_format($row['SUM(updated_count)']);
                                                        }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    // 09:00:00 = 5pm in PH
                                                        foreach($con->query('select SUM(updated_count) from members where forum_day >= "2023-02-19 04:00:00" and forum_day <= "2023-02-19 09:00:00"
                                                         and forum_date="2023-02-19" AND Branch="BSILANG OFFICE"') as $row) {
                                                            echo number_format($row['SUM(updated_count)']);
                                                        }
                                                    ?>
                                                </td>
                                            </tr>
                                        </table> 
                                    </div>
                                    <div class="divTableCell">
                                        <table style='width:100% !important; font-size: 19px'>
                                            <tr>
                                                <!--<td>-->
                                                    <?php
                                                        // foreach($con->query('SELECT SUM(updated_count)
                                                        // FROM members where forum_date="2023-02-20" AND Branch="BSILANG OFFICE"') as $row) {
                                                        //     echo number_format($row['SUM(updated_count)']);
                                                        // }
                                                    ?>
                                                <!--</td>-->
                                                <td style="width: 50% !important;">
                                                    <?php
                                                    // 03:59:59 = 11:59 AM in PH
                                                        foreach($con->query('select SUM(updated_count) from members where forum_day >= "2023-02-19 16:00:00" and forum_day <= "2023-02-20 03:59:59" 
                                                        and forum_date="2023-02-20" AND Branch="BSILANG OFFICE"') as $row) {
                                                            echo number_format($row['SUM(updated_count)']);
                                                        }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    // 09:00:00 = 5pm in PH
                                                        foreach($con->query('select SUM(updated_count) from members where forum_day >= "2023-02-20 04:00:00" and forum_day <= "2023-02-20 09:00:00"
                                                         and forum_date="2023-02-20" AND Branch="BSILANG OFFICE"') as $row) {
                                                            echo number_format($row['SUM(updated_count)']);
                                                        }
                                                    ?>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="divTableCell">
                                        <table style='width:100% !important; font-size: 19px'>
                                            <tr>
                                                <!--<td>-->
                                                    <?php
                                                        // foreach($con->query('SELECT SUM(updated_count)
                                                        // FROM members where forum_date="2023-02-21" AND Branch="BSILANG OFFICE"') as $row) {
                                                        //     echo number_format($row['SUM(updated_count)']);
                                                        // }
                                                    ?>
                                                <!--</td>-->
                                                <td style="width: 50% !important;">
                                                    <?php
                                                    // 04:00:00 = 12pm in PH
                                                        foreach($con->query('select SUM(updated_count) from members where forum_day >= "2023-02-20 16:00:00" and forum_day <= "2023-02-21 03:59:59"
                                                        and forum_date="2023-02-21" AND Branch="BSILANG OFFICE"') as $row) {
                                                            echo number_format($row['SUM(updated_count)']);
                                                        }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    // 09:00:00 = 5pm in PH
                                                        foreach($con->query('select SUM(updated_count) from members where forum_day >= "2023-02-21 04:00:00" and forum_day <= "2023-02-21 09:00:00"
                                                         and forum_date="2023-02-21" AND Branch="BSILANG OFFICE"') as $row) {
                                                            echo number_format($row['SUM(updated_count)']);
                                                        }
                                                    ?>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <!-- <div class="divTableCell">
                                        <?php
                                            // foreach($con->query('SELECT SUM(updated_count)
                                            // FROM members where forum_date="2022-02-26" AND Branch="BSILANG OFFICE"') as $row) {
                                            // echo "<h4>".number_format($row['SUM(updated_count)'])."</h4>";
                                            // }
                                            ?>
                                        </div> -->
                                    <div class="divTableCell">
                                        <?php
                                            foreach($con->query('SELECT SUM(updated_count)
                                            FROM members where isregistered="YES" AND Branch="BSILANG OFFICE"') as $row) {
                                            echo "<h4><b>".number_format($row['SUM(updated_count)'])."</b></h4>";
                                            }
                                            ?>
                                    </div>
                                </div>
                                
                                
                                <div class="divTableRow">
                                    <div class="divTableHeading2" style="font-size:19px;color:white;padding:10px;">BULACAN</div>
                                    <div class="divTableCell">
                                        <table style='width:100% !important; font-size: 19px'>
                                           <tr>
                                               <!--<td>-->
                                                   <?php
                                                       // foreach($con->query('SELECT SUM(updated_count)
                                                       // FROM members where forum_date="2023-02-19" AND Branch="BULACAN OFFICE"') as $row) {
                                                       //     echo number_format($row['SUM(updated_count)']);
                                                       // }
                                                   ?>
                                               <!--</td>-->
                                               <td style="width: 50% !important;">
                                                   <?php
                                                   // 04:00:00 = 12pm in PH
                                                       foreach($con->query('select SUM(updated_count) from members where forum_day <= "2023-02-19 03:59:59" 
                                                       and forum_date="2023-02-19" AND Branch="BULACAN OFFICE"') as $row) {
                                                           echo number_format($row['SUM(updated_count)']);
                                                       }
                                                   ?>
                                               </td>
                                               <td>
                                                   <?php
                                                   // 09:00:00 = 5pm in PH
                                                       foreach($con->query('select SUM(updated_count) from members where forum_day >= "2023-02-19 04:00:00" and forum_day <= "2023-02-19 09:00:00"
                                                        and forum_date="2023-02-19" AND Branch="BULACAN OFFICE"') as $row) {
                                                           echo number_format($row['SUM(updated_count)']);
                                                       }
                                                   ?>
                                               </td>
                                           </tr>
                                       </table> 
                                    </div>
                                    <div class="divTableCell">
                                       <table style='width:100% !important; font-size: 19px'>
                                           <tr>
                                               <!--<td>-->
                                                   <?php
                                                       // foreach($con->query('SELECT SUM(updated_count)
                                                       // FROM members where forum_date="2023-02-20" AND Branch="BULACAN OFFICE"') as $row) {
                                                       //     echo number_format($row['SUM(updated_count)']);
                                                       // }
                                                   ?>
                                               <!--</td>-->
                                               <td style="width: 50% !important;">
                                                   <?php
                                                   // 04:00:00 = 12pm in PH
                                                       foreach($con->query('select SUM(updated_count) from members where forum_day >= "2023-02-19 16:00:00" and forum_day <= "2023-02-20 03:59:59"
                                                       and forum_date="2023-02-20" AND Branch="BULACAN OFFICE"') as $row) {
                                                           echo number_format($row['SUM(updated_count)']);
                                                       }
                                                   ?>
                                               </td>
                                               <td>
                                                   <?php
                                                   // 09:00:00 = 5pm in PH
                                                       foreach($con->query('select SUM(updated_count) from members where forum_day >= "2023-02-20 04:00:00" and forum_day <= "2023-02-20 09:00:00"
                                                        and forum_date="2023-02-20" AND Branch="BULACAN OFFICE"') as $row) {
                                                           echo number_format($row['SUM(updated_count)']);
                                                       }
                                                   ?>
                                               </td>
                                           </tr>
                                       </table>
                                    </div>
                                    <div class="divTableCell">
                                       <table style='width:100% !important; font-size: 19px'>
                                           <tr>
                                               <!--<td>-->
                                                   <?php
                                                       // foreach($con->query('SELECT SUM(updated_count)
                                                       // FROM members where forum_date="2023-02-21" AND Branch="BULACAN OFFICE"') as $row) {
                                                       //     echo number_format($row['SUM(updated_count)']);
                                                       // }
                                                   ?>
                                               <!--</td>-->
                                               <td style="width: 50% !important;">
                                                   <?php
                                                   // 04:00:00 = 12pm in PH
                                                       foreach($con->query('select SUM(updated_count) from members where forum_day >= "2023-02-20 16:00:00" and forum_day <= "2023-02-21 03:59:59" 
                                                       and forum_date="2023-02-21" AND Branch="BULACAN OFFICE"') as $row) {
                                                           echo number_format($row['SUM(updated_count)']);
                                                       }
                                                   ?>
                                               </td>
                                               <td>
                                                   <?php
                                                   // 09:00:00 = 5pm in PH
                                                       foreach($con->query('select SUM(updated_count) from members where forum_day >= "2023-02-21 04:00:00" and forum_day <= "2023-02-21 09:00:00"
                                                        and forum_date="2023-02-21" AND Branch="BULACAN OFFICE"') as $row) {
                                                           echo number_format($row['SUM(updated_count)']);
                                                       }
                                                   ?>
                                               </td>
                                           </tr>
                                       </table>
                                    </div>
                                    <!-- <div class="divTableCell">
                                        <?php
                                            // foreach($con->query('SELECT SUM(updated_count)
                                            // FROM members where forum_date="2022-02-26" AND Branch="BULACAN OFFICE"') as $row) {
                                            // echo "<h4>".number_format($row['SUM(updated_count)'])."</h4>";
                                            // }
                                            ?>
                                        </div> -->
                                    <div class="divTableCell">
                                        <?php
                                            foreach($con->query('SELECT SUM(updated_count)
                                            FROM members where isregistered="YES" AND Branch="BULACAN OFFICE"') as $row) {
                                            echo "<h4><b>".number_format($row['SUM(updated_count)'])."</b></h4>";
                                            }
                                            ?>
                                    </div>
                                </div>
                                
                                
                                <div class="divTableRow">
                                    <div class="divTableHeading2" style="font-size:19px;color:white;padding:10px;">CAMARIN</div>
                                    <div class="divTableCell">
                                        <table style='width:100% !important; font-size: 19px'>
                                           <tr>
                                               <!--<td>-->
                                                   <?php
                                                       // foreach($con->query('SELECT SUM(updated_count)
                                                       // FROM members where forum_date="2023-02-19" AND Branch="CAMARIN OFFICE"') as $row) {
                                                       //     echo number_format($row['SUM(updated_count)']);
                                                       // }
                                                   ?>
                                               <!--</td>-->
                                               <td style="width: 50% !important;">
                                                   <?php
                                                   // 04:00:00 = 12pm in PH
                                                       foreach($con->query('select SUM(updated_count) from members where forum_day <= "2023-02-19 03:59:59" 
                                                       and forum_date="2023-02-19" AND Branch="CAMARIN OFFICE"') as $row) {
                                                           echo number_format($row['SUM(updated_count)']);
                                                       }
                                                   ?>
                                               </td>
                                               <td>
                                                   <?php
                                                   // 09:00:00 = 5pm in PH
                                                       foreach($con->query('select SUM(updated_count) from members where forum_day >= "2023-02-19 04:00:00" and forum_day <= "2023-02-19 09:00:00"
                                                        and forum_date="2023-02-19" AND Branch="CAMARIN OFFICE"') as $row) {
                                                           echo number_format($row['SUM(updated_count)']);
                                                       }
                                                   ?>
                                               </td>
                                           </tr>
                                       </table> 
                                    </div>
                                    <div class="divTableCell">
                                       <table style='width:100% !important; font-size: 19px'>
                                           <tr>
                                               <!--<td>-->
                                                   <?php
                                                       // foreach($con->query('SELECT SUM(updated_count)
                                                       // FROM members where forum_date="2023-02-20" AND Branch="CAMARIN OFFICE"') as $row) {
                                                       //     echo number_format($row['SUM(updated_count)']);
                                                       // }
                                                   ?>
                                               <!--</td>-->
                                               <td style="width: 50% !important;">
                                                   <?php
                                                   // 04:00:00 = 12pm in PH
                                                       foreach($con->query('select SUM(updated_count) from members where forum_day >= "2023-02-19 16:00:00" and forum_day <= "2023-02-20 03:59:59"  
                                                       and forum_date="2023-02-20" AND Branch="CAMARIN OFFICE"') as $row) {
                                                           echo number_format($row['SUM(updated_count)']);
                                                       }
                                                   ?>
                                               </td>
                                               <td>
                                                   <?php
                                                   // 09:00:00 = 5pm in PH
                                                       foreach($con->query('select SUM(updated_count) from members where forum_day >= "2023-02-20 04:00:00" and forum_day <= "2023-02-20 09:00:00"
                                                        and forum_date="2023-02-20" AND Branch="CAMARIN OFFICE"') as $row) {
                                                           echo number_format($row['SUM(updated_count)']);
                                                       }
                                                   ?>
                                               </td>
                                           </tr>
                                       </table>
                                    </div>
                                    <div class="divTableCell">
                                       <table style='width:100% !important; font-size: 19px'>
                                           <tr>
                                               <!--<td>-->
                                                   <?php
                                                       // foreach($con->query('SELECT SUM(updated_count)
                                                       // FROM members where forum_date="2023-02-21" AND Branch="CAMARIN OFFICE"') as $row) {
                                                       //     echo number_format($row['SUM(updated_count)']);
                                                       // }
                                                   ?>
                                               <!--</td>-->
                                               <td style="width: 50% !important;">
                                                   <?php
                                                   // 04:00:00 = 12pm in PH
                                                       foreach($con->query('select SUM(updated_count) from members where  forum_day >= "2023-02-20 16:00:00" and forum_day <= "2023-02-21 03:59:59"  
                                                       and forum_date="2023-02-21" AND Branch="CAMARIN OFFICE"') as $row) {
                                                           echo number_format($row['SUM(updated_count)']);
                                                       }
                                                   ?>
                                               </td>
                                               <td>
                                                   <?php
                                                   // 09:00:00 = 5pm in PH
                                                       foreach($con->query('select SUM(updated_count) from members where forum_day >= "2023-02-21 04:00:00" and forum_day <= "2023-02-21 09:00:00"
                                                        and forum_date="2023-02-21" AND Branch="CAMARIN OFFICE"') as $row) {
                                                           echo number_format($row['SUM(updated_count)']);
                                                       }
                                                   ?>
                                               </td>
                                           </tr>
                                       </table>
                                    </div>
                                    <!-- <div class="divTableCell">
                                        <?php
                                            // foreach($con->query('SELECT SUM(updated_count)
                                            // FROM members where forum_date="2022-02-26" AND Branch="CAMARIN OFFICE"') as $row) {
                                            // echo "<h4>".number_format($row['SUM(updated_count)'])."</h4>";
                                            // }
                                            ?>
                                        </div> -->
                                    <div class="divTableCell">
                                        <?php
                                            foreach($con->query('SELECT SUM(updated_count)
                                            FROM members where isregistered="YES" AND Branch="CAMARIN OFFICE"') as $row) {
                                            echo "<h4><b>".number_format($row['SUM(updated_count)'])."</b></h4>";
                                            }
                                            ?>
                                    </div>
                                </div>
                                
                                
                                <div class="divTableRow">
                                    <div class="divTableHeading2" style="font-size:19px;color:white;padding:10px;">FAIRVIEW</div>
                                    <div class="divTableCell">
                                        <table style='width:100% !important; font-size: 19px'>
                                           <tr>
                                               <!--<td>-->
                                                   <?php
                                                       // foreach($con->query('SELECT SUM(updated_count)
                                                       // FROM members where forum_date="2023-02-19" AND Branch="FAIRVIEW OFFICE"') as $row) {
                                                       //     echo number_format($row['SUM(updated_count)']);
                                                       // }
                                                   ?>
                                               <!--</td>-->
                                               <td style="width: 50% !important;">
                                                   <?php
                                                   // 04:00:00 = 12pm in PH
                                                       foreach($con->query('select SUM(updated_count) from members where forum_day <= "2023-02-19 03:59:59" 
                                                       and forum_date="2023-02-19" AND Branch="FAIRVIEW OFFICE"') as $row) {
                                                           echo number_format($row['SUM(updated_count)']);
                                                       }
                                                   ?>
                                               </td>
                                               <td>
                                                   <?php
                                                   // 09:00:00 = 5pm in PH
                                                       foreach($con->query('select SUM(updated_count) from members where forum_day >= "2023-02-19 04:00:00" and forum_day <= "2023-02-19 09:00:00"
                                                        and forum_date="2023-02-19" AND Branch="FAIRVIEW OFFICE"') as $row) {
                                                           echo number_format($row['SUM(updated_count)']);
                                                       }
                                                   ?>
                                               </td>
                                           </tr>
                                       </table> 
                                    </div>
                                    <div class="divTableCell">
                                       <table style='width:100% !important; font-size: 19px'>
                                           <tr>
                                               <!--<td>-->
                                                   <?php
                                                       // foreach($con->query('SELECT SUM(updated_count)
                                                       // FROM members where forum_date="2023-02-20" AND Branch="FAIRVIEW OFFICE"') as $row) {
                                                       //     echo number_format($row['SUM(updated_count)']);
                                                       // }
                                                   ?>
                                               <!--</td>-->
                                               <td style="width: 50% !important;">
                                                   <?php
                                                   // 04:00:00 = 12pm in PH
                                                       foreach($con->query('select SUM(updated_count) from members where forum_day >= "2023-02-19 16:00:00" and forum_day <= "2023-02-20 03:59:59" 
                                                       and forum_date="2023-02-20" AND Branch="FAIRVIEW OFFICE"') as $row) {
                                                           echo number_format($row['SUM(updated_count)']);
                                                       }
                                                   ?>
                                               </td>
                                               <td>
                                                   <?php
                                                   // 09:00:00 = 5pm in PH
                                                       foreach($con->query('select SUM(updated_count) from members where forum_day >= "2023-02-20 04:00:00" and forum_day <= "2023-02-20 09:00:00"
                                                        and forum_date="2023-02-20" AND Branch="FAIRVIEW OFFICE"') as $row) {
                                                           echo number_format($row['SUM(updated_count)']);
                                                       }
                                                   ?>
                                               </td>
                                           </tr>
                                       </table>
                                    </div>
                                    <div class="divTableCell">
                                       <table style='width:100% !important; font-size: 19px'>
                                           <tr>
                                               <!--<td>-->
                                                   <?php
                                                       // foreach($con->query('SELECT SUM(updated_count)
                                                       // FROM members where forum_date="2023-02-21" AND Branch="FAIRVIEW OFFICE"') as $row) {
                                                       //     echo number_format($row['SUM(updated_count)']);
                                                       // }
                                                   ?>
                                               <!--</td>-->
                                               <td style="width: 50% !important;">
                                                   <?php
                                                   // 04:00:00 = 12pm in PH
                                                       foreach($con->query('select SUM(updated_count) from members where forum_day >= "2023-02-20 16:00:00" and forum_day <= "2023-02-21 03:59:59"
                                                       and forum_date="2023-02-21" AND Branch="FAIRVIEW OFFICE"') as $row) {
                                                           echo number_format($row['SUM(updated_count)']);
                                                       }
                                                   ?>
                                               </td>
                                               <td>
                                                   <?php
                                                   // 09:00:00 = 5pm in PH
                                                       foreach($con->query('select SUM(updated_count) from members where forum_day >= "2023-02-21 04:00:00" and forum_day <= "2023-02-21 09:00:00"
                                                        and forum_date="2023-02-21" AND Branch="FAIRVIEW OFFICE"') as $row) {
                                                           echo number_format($row['SUM(updated_count)']);
                                                       }
                                                   ?>
                                               </td>
                                           </tr>
                                       </table>
                                    </div>
                                    <!-- <div class="divTableCell">
                                        <?php
                                            // foreach($con->query('SELECT SUM(updated_count)
                                            // FROM members where forum_date="2022-02-26" AND Branch="FAIRVIEW OFFICE"') as $row) {
                                            // echo "<h4>".number_format($row['SUM(updated_count)'])."</h4>";
                                            // }
                                            ?>
                                        </div> -->
                                    <div class="divTableCell">
                                        <?php
                                            foreach($con->query('SELECT SUM(updated_count)
                                            FROM members where isregistered="YES" AND Branch="FAIRVIEW OFFICE"') as $row) {
                                            echo "<h4><b>".number_format($row['SUM(updated_count)'])."</b></h4>";
                                            }
                                            ?>
                                    </div>
                                </div>
                                
                                
                                
                                <div class="divTableRow">
                                    <div class="divTableHeading2" style="font-size:19px;color:white;padding:10px;">KIKO</div>
                                    <div class="divTableCell">
                                        <table style='width:100% !important; font-size: 19px'>
                                           <tr>
                                               <!--<td>-->
                                                   <?php
                                                       // foreach($con->query('SELECT SUM(updated_count)
                                                       // FROM members where forum_date="2023-02-19" AND Branch="KIKO OFFICE"') as $row) {
                                                       //     echo number_format($row['SUM(updated_count)']);
                                                       // }
                                                   ?>
                                               <!--</td>-->
                                               <td style="width: 50% !important;">
                                                   <?php
                                                   // 04:00:00 = 12pm in PH
                                                       foreach($con->query('select SUM(updated_count) from members where forum_day <= "2023-02-19 03:59:59" 
                                                       and forum_date="2023-02-19" AND Branch="KIKO OFFICE"') as $row) {
                                                           echo number_format($row['SUM(updated_count)']);
                                                       }
                                                   ?>
                                               </td>
                                               <td>
                                                   <?php
                                                   // 09:00:00 = 5pm in PH
                                                       foreach($con->query('select SUM(updated_count) from members where forum_day >= "2023-02-19 04:00:00" and forum_day <= "2023-02-19 09:00:00"
                                                        and forum_date="2023-02-19" AND Branch="KIKO OFFICE"') as $row) {
                                                           echo number_format($row['SUM(updated_count)']);
                                                       }
                                                   ?>
                                               </td>
                                           </tr>
                                       </table> 
                                    </div>
                                    <div class="divTableCell">
                                       <table style='width:100% !important; font-size: 19px'>
                                           <tr>
                                               <!--<td>-->
                                                   <?php
                                                       // foreach($con->query('SELECT SUM(updated_count)
                                                       // FROM members where forum_date="2023-02-20" AND Branch="KIKO OFFICE"') as $row) {
                                                       //     echo number_format($row['SUM(updated_count)']);
                                                       // }
                                                   ?>
                                               <!--</td>-->
                                               <td style="width: 50% !important;">
                                                   <?php
                                                   // 04:00:00 = 12pm in PH
                                                       foreach($con->query('select SUM(updated_count) from members where forum_day >= "2023-02-19 16:00:00" and forum_day <= "2023-02-20 03:59:59"
                                                       and forum_date="2023-02-20" AND Branch="KIKO OFFICE"') as $row) {
                                                           echo number_format($row['SUM(updated_count)']);
                                                       }
                                                   ?>
                                               </td>
                                               <td>
                                                   <?php
                                                   // 09:00:00 = 5pm in PH
                                                       foreach($con->query('select SUM(updated_count) from members where forum_day >= "2023-02-20 04:00:00" and forum_day <= "2023-02-20 09:00:00"
                                                        and forum_date="2023-02-20" AND Branch="KIKO OFFICE"') as $row) {
                                                           echo number_format($row['SUM(updated_count)']);
                                                       }
                                                   ?>
                                               </td>
                                           </tr>
                                       </table>
                                    </div>
                                    <div class="divTableCell">
                                       <table style='width:100% !important; font-size: 19px'>
                                           <tr>
                                               <!--<td>-->
                                                   <?php
                                                       // foreach($con->query('SELECT SUM(updated_count)
                                                       // FROM members where forum_date="2023-02-21" AND Branch="KIKO OFFICE"') as $row) {
                                                       //     echo number_format($row['SUM(updated_count)']);
                                                       // }
                                                   ?>
                                               <!--</td>-->
                                               <td style="width: 50% !important;">
                                                   <?php
                                                   // 04:00:00 = 12pm in PH
                                                       foreach($con->query('select SUM(updated_count) from members where forum_day >= "2023-02-20 16:00:00" and forum_day <= "2023-02-21 03:59:59"
                                                       and forum_date="2023-02-21" AND Branch="KIKO OFFICE"') as $row) {
                                                           echo number_format($row['SUM(updated_count)']);
                                                       }
                                                   ?>
                                               </td>
                                               <td>
                                                   <?php
                                                   // 09:00:00 = 5pm in PH
                                                       foreach($con->query('select SUM(updated_count) from members where forum_day >= "2023-02-21 04:00:00" and forum_day <= "2023-02-21 09:00:00"
                                                        and forum_date="2023-02-21" AND Branch="KIKO OFFICE"') as $row) {
                                                           echo number_format($row['SUM(updated_count)']);
                                                       }
                                                   ?>
                                               </td>
                                           </tr>
                                       </table>
                                    </div>
                                    <!-- <div class="divTableCell">
                                        <?php
                                            // foreach($con->query('SELECT SUM(updated_count)
                                            // FROM members where forum_date="2022-02-26" AND Branch="KIKO OFFICE"') as $row) {
                                            // echo "<h4>".number_format($row['SUM(updated_count)'])."</h4>";
                                            // }
                                            ?>
                                        </div> -->
                                    <div class="divTableCell">
                                        <?php
                                            foreach($con->query('SELECT SUM(updated_count)
                                            FROM members where isregistered="YES" AND Branch="KIKO OFFICE"') as $row) {
                                            echo "<h4><b>".number_format($row['SUM(updated_count)'])."</b></h4>";
                                            }
                                            ?>
                                    </div>
                                </div>
                                
                                
                                
                                <div class="divTableRow">
                                    <div class="divTableHeading2" style="font-size:19px;color:white;padding:10px;">LAGRO</div>
                                    <div class="divTableCell">
                                        <table style='width:100% !important; font-size: 19px'>
                                           <tr>
                                               <!--<td>-->
                                                   <?php
                                                       // foreach($con->query('SELECT SUM(updated_count)
                                                       // FROM members where forum_date="2023-02-19" AND Branch="LAGRO OFFICE"') as $row) {
                                                       //     echo number_format($row['SUM(updated_count)']);
                                                       // }
                                                   ?>
                                               <!--</td>-->
                                               <td style="width: 50% !important;">
                                                   <?php
                                                   // 04:00:00 = 12pm in PH
                                                       foreach($con->query('select SUM(updated_count) from members where forum_day <= "2023-02-19 03:59:59" 
                                                       and forum_date="2023-02-19" AND Branch="LAGRO OFFICE"') as $row) {
                                                           echo number_format($row['SUM(updated_count)']);
                                                       }
                                                   ?>
                                               </td>
                                               <td>
                                                   <?php
                                                   // 09:00:00 = 5pm in PH
                                                       foreach($con->query('select SUM(updated_count) from members where forum_day >= "2023-02-19 04:00:00" and forum_day <= "2023-02-19 09:00:00"
                                                        and forum_date="2023-02-19" AND Branch="LAGRO OFFICE"') as $row) {
                                                           echo number_format($row['SUM(updated_count)']);
                                                       }
                                                   ?>
                                               </td>
                                           </tr>
                                       </table> 
                                    </div>
                                    <div class="divTableCell">
                                       <table style='width:100% !important; font-size: 19px'>
                                           <tr>
                                               <!--<td>-->
                                                   <?php
                                                       // foreach($con->query('SELECT SUM(updated_count)
                                                       // FROM members where forum_date="2023-02-20" AND Branch="LAGRO OFFICE"') as $row) {
                                                       //     echo number_format($row['SUM(updated_count)']);
                                                       // }
                                                   ?>
                                               <!--</td>-->
                                               <td style="width: 50% !important;">
                                                   <?php
                                                   // 04:00:00 = 12pm in PH
                                                       foreach($con->query('select SUM(updated_count) from members where forum_day >= "2023-02-19 16:00:00" and forum_day <= "2023-02-20 03:59:59"
                                                       and forum_date="2023-02-20" AND Branch="LAGRO OFFICE"') as $row) {
                                                           echo number_format($row['SUM(updated_count)']);
                                                       }
                                                   ?>
                                               </td>
                                               <td>
                                                   <?php
                                                   // 09:00:00 = 5pm in PH
                                                       foreach($con->query('select SUM(updated_count) from members where forum_day >= "2023-02-20 04:00:00" and forum_day <= "2023-02-20 09:00:00"
                                                        and forum_date="2023-02-20" AND Branch="LAGRO OFFICE"') as $row) {
                                                           echo number_format($row['SUM(updated_count)']);
                                                       }
                                                   ?>
                                               </td>
                                           </tr>
                                       </table>
                                    </div>
                                    <div class="divTableCell">
                                       <table style='width:100% !important; font-size: 19px'>
                                           <tr>
                                               <!--<td>-->
                                                   <?php
                                                       // foreach($con->query('SELECT SUM(updated_count)
                                                       // FROM members where forum_date="2023-02-21" AND Branch="LAGRO OFFICE"') as $row) {
                                                       //     echo number_format($row['SUM(updated_count)']);
                                                       // }
                                                   ?>
                                               <!--</td>-->
                                               <td style="width: 50% !important;">
                                                   <?php
                                                   // 04:00:00 = 12pm in PH
                                                       foreach($con->query('select SUM(updated_count) from members where forum_day >= "2023-02-20 16:00:00" and forum_day <= "2023-02-21 03:59:59" 
                                                       and forum_date="2023-02-21" AND Branch="LAGRO OFFICE"') as $row) {
                                                           echo number_format($row['SUM(updated_count)']);
                                                       }
                                                   ?>
                                               </td>
                                               <td>
                                                   <?php
                                                   // 09:00:00 = 5pm in PH
                                                       foreach($con->query('select SUM(updated_count) from members where forum_day >= "2023-02-21 04:00:00" and forum_day <= "2023-02-21 09:00:00"
                                                        and forum_date="2023-02-21" AND Branch="LAGRO OFFICE"') as $row) {
                                                           echo number_format($row['SUM(updated_count)']);
                                                       }
                                                   ?>
                                               </td>
                                           </tr>
                                       </table>
                                    </div>
                                    <!-- <div class="divTableCell">
                                        <?php
                                            // foreach($con->query('SELECT SUM(updated_count)
                                            // FROM members where forum_date="2022-02-26" AND Branch="LAGRO OFFICE"') as $row) {
                                            // echo "<h4>".number_format($row['SUM(updated_count)'])."</h4>";
                                            // }
                                            ?>
                                        </div> -->
                                    <div class="divTableCell">
                                        <?php
                                            foreach($con->query('SELECT SUM(updated_count)
                                            FROM members where isregistered="YES" AND Branch="LAGRO OFFICE"') as $row) {
                                            echo "<h4><b>".number_format($row['SUM(updated_count)'])."</b></h4>";
                                            }
                                            ?>
                                    </div>
                                </div>
                                
                                
                                <div class="divTableRow">
                                    <div class="divTableHeading2" style="font-size:19px;color:white;padding:10px;">MAIN OFFICE</div>
                                    <div class="divTableCell">
                                        <table style='width:100% !important; font-size: 19px'>
                                           <tr>
                                               <!--<td>-->
                                                   <?php
                                                       // foreach($con->query('SELECT SUM(updated_count)
                                                       // FROM members where forum_date="2023-02-19" AND Branch="MAIN OFFICE"') as $row) {
                                                       //     echo number_format($row['SUM(updated_count)']);
                                                       // }
                                                   ?>
                                               <!--</td>-->
                                               <td style="width: 50% !important;">
                                                   <?php
                                                   // 04:00:00 = 12pm in PH
                                                       foreach($con->query('select SUM(updated_count) from members where forum_day <= "2023-02-19 03:59:59" 
                                                       and forum_date="2023-02-19" AND Branch="MAIN OFFICE"') as $row) {
                                                           echo number_format($row['SUM(updated_count)']);
                                                       }
                                                   ?>
                                               </td>
                                               <td>
                                                   <?php
                                                   // 09:00:00 = 5pm in PH
                                                       foreach($con->query('select SUM(updated_count) from members where forum_day >= "2023-02-19 04:00:00" and forum_day <= "2023-02-19 09:00:00"
                                                        and forum_date="2023-02-19" AND Branch="MAIN OFFICE"') as $row) {
                                                           echo number_format($row['SUM(updated_count)']);
                                                       }
                                                   ?>
                                               </td>
                                           </tr>
                                       </table> 
                                    </div>
                                    <div class="divTableCell">
                                       <table style='width:100% !important; font-size: 19px'>
                                           <tr>
                                               <!--<td>-->
                                                   <?php
                                                       // foreach($con->query('SELECT SUM(updated_count)
                                                       // FROM members where forum_date="2023-02-20" AND Branch="MAIN OFFICE"') as $row) {
                                                       //     echo number_format($row['SUM(updated_count)']);
                                                       // }
                                                   ?>
                                               <!--</td>-->
                                               <td style="width: 50% !important;">
                                                   <?php
                                                   // 04:00:00 = 12pm in PH
                                                       foreach($con->query('select SUM(updated_count) from members where forum_day >= "2023-02-19 16:00:00" and forum_day <= "2023-02-20 03:59:59"
                                                       and forum_date="2023-02-20" AND Branch="MAIN OFFICE"') as $row) {
                                                           echo number_format($row['SUM(updated_count)']);
                                                       }
                                                   ?>
                                               </td>
                                               <td>
                                                   <?php
                                                   // 09:00:00 = 5pm in PH
                                                       foreach($con->query('select SUM(updated_count) from members where forum_day >= "2023-02-20 04:00:00" and forum_day <= "2023-02-20 09:00:00"
                                                        and forum_date="2023-02-20" AND Branch="MAIN OFFICE"') as $row) {
                                                           echo number_format($row['SUM(updated_count)']);
                                                       }
                                                   ?>
                                               </td>
                                           </tr>
                                       </table>
                                    </div>
                                    <div class="divTableCell">
                                       <table style='width:100% !important; font-size: 19px'>
                                           <tr>
                                               <!--<td>-->
                                                   <?php
                                                       // foreach($con->query('SELECT SUM(updated_count)
                                                       // FROM members where forum_date="2023-02-21" AND Branch="MAIN OFFICE"') as $row) {
                                                       //     echo number_format($row['SUM(updated_count)']);
                                                       // }
                                                   ?>
                                               <!--</td>-->
                                               <td style="width: 50% !important;">
                                                   <?php
                                                   // 04:00:00 = 12pm in PH
                                                       foreach($con->query('select SUM(updated_count) from members where forum_day >= "2023-02-20 16:00:00" and forum_day <= "2023-02-21 03:59:59"
                                                       and forum_date="2023-02-21" AND Branch="MAIN OFFICE"') as $row) {
                                                           echo number_format($row['SUM(updated_count)']);
                                                       }
                                                   ?>
                                               </td>
                                               <td>
                                                   <?php
                                                   // 09:00:00 = 5pm in PH
                                                       foreach($con->query('select SUM(updated_count) from members where forum_day >= "2023-02-21 04:00:00" and forum_day <= "2023-02-21 09:00:00"
                                                        and forum_date="2023-02-21" AND Branch="MAIN OFFICE"') as $row) {
                                                           echo number_format($row['SUM(updated_count)']);
                                                       }
                                                   ?>
                                               </td>
                                           </tr>
                                       </table>
                                    </div>
                                    <!-- <div class="divTableCell">
                                        <?php
                                            // foreach($con->query('SELECT SUM(updated_count)
                                            // FROM members where forum_date="2022-02-26" AND Branch="MAIN OFFICE"') as $row) {
                                            // echo "<h4>".number_format($row['SUM(updated_count)'])."</h4>";
                                            // }
                                            ?>
                                        </div> -->
                                    <div class="divTableCell">
                                        <?php
                                            foreach($con->query('SELECT SUM(updated_count)
                                            FROM members where isregistered="YES" AND Branch="MAIN OFFICE"') as $row) {
                                            echo "<h4><b>".number_format($row['SUM(updated_count)'])."</b></h4>";
                                            }
                                            ?>
                                    </div>
                                </div>
                                
                                
                                <div class="divTableRow">
                                    <div class="divTableHeading2" style="font-size:19px;color:white;padding:10px;">MUÑOZ</div>
                                    <div class="divTableCell">
                                        <table style='width:100% !important; font-size: 19px'>
                                           <tr>
                                               <!--<td>-->
                                                   <?php
                                                       // foreach($con->query('SELECT SUM(updated_count)
                                                       // FROM members where forum_date="2023-02-19" AND Branch="MUNOZ OFFICE"') as $row) {
                                                       //     echo number_format($row['SUM(updated_count)']);
                                                       // }
                                                   ?>
                                               <!--</td>-->
                                               <td style="width: 50% !important;">
                                                   <?php
                                                   // 04:00:00 = 12pm in PH
                                                       foreach($con->query('select SUM(updated_count) from members where forum_day <= "2023-02-19 03:59:59" 
                                                       and forum_date="2023-02-19" AND Branch="MUNOZ OFFICE"') as $row) {
                                                           echo number_format($row['SUM(updated_count)']);
                                                       }
                                                   ?>
                                               </td>
                                               <td>
                                                   <?php
                                                   // 09:00:00 = 5pm in PH
                                                       foreach($con->query('select SUM(updated_count) from members where forum_day >= "2023-02-19 04:00:00" and forum_day <= "2023-02-19 09:00:00"
                                                        and forum_date="2023-02-19" AND Branch="MUNOZ OFFICE"') as $row) {
                                                           echo number_format($row['SUM(updated_count)']);
                                                       }
                                                   ?>
                                               </td>
                                           </tr>
                                       </table> 
                                    </div>
                                    <div class="divTableCell">
                                       <table style='width:100% !important; font-size: 19px'>
                                           <tr>
                                               <!--<td>-->
                                                   <?php
                                                       // foreach($con->query('SELECT SUM(updated_count)
                                                       // FROM members where forum_date="2023-02-20" AND Branch="MUNOZ OFFICE"') as $row) {
                                                       //     echo number_format($row['SUM(updated_count)']);
                                                       // }
                                                   ?>
                                               <!--</td>-->
                                               <td style="width: 50% !important;">
                                                   <?php
                                                   // 04:00:00 = 12pm in PH
                                                       foreach($con->query('select SUM(updated_count) from members where forum_day >= "2023-02-19 16:00:00" and forum_day <= "2023-02-20 03:59:59"
                                                       and forum_date="2023-02-20" AND Branch="MUNOZ OFFICE"') as $row) {
                                                           echo number_format($row['SUM(updated_count)']);
                                                       }
                                                   ?>
                                               </td>
                                               <td>
                                                   <?php
                                                   // 09:00:00 = 5pm in PH
                                                       foreach($con->query('select SUM(updated_count) from members where forum_day >= "2023-02-20 04:00:00" and forum_day <= "2023-02-20 09:00:00"
                                                        and forum_date="2023-02-20" AND Branch="MUNOZ OFFICE"') as $row) {
                                                           echo number_format($row['SUM(updated_count)']);
                                                       }
                                                   ?>
                                               </td>
                                           </tr>
                                       </table>
                                    </div>
                                    <div class="divTableCell">
                                       <table style='width:100% !important; font-size: 19px'>
                                           <tr>
                                               <!--<td>-->
                                                   <?php
                                                       // foreach($con->query('SELECT SUM(updated_count)
                                                       // FROM members where forum_date="2023-02-21" AND Branch="MUNOZ OFFICE"') as $row) {
                                                       //     echo number_format($row['SUM(updated_count)']);
                                                       // }
                                                   ?>
                                               <!--</td>-->
                                               <td style="width: 50% !important;">
                                                   <?php
                                                   // 04:00:00 = 12pm in PH
                                                       foreach($con->query('select SUM(updated_count) from members where forum_day >= "2023-02-20 16:00:00" and forum_day <= "2023-02-21 03:59:59"
                                                       and forum_date="2023-02-21" AND Branch="MUNOZ OFFICE"') as $row) {
                                                           echo number_format($row['SUM(updated_count)']);
                                                       }
                                                   ?>
                                               </td>
                                               <td>
                                                   <?php
                                                   // 09:00:00 = 5pm in PH
                                                       foreach($con->query('select SUM(updated_count) from members where forum_day >= "2023-02-21 04:00:00" and forum_day <= "2023-02-21 09:00:00"
                                                        and forum_date="2023-02-21" AND Branch="MUNOZ OFFICE"') as $row) {
                                                           echo number_format($row['SUM(updated_count)']);
                                                       }
                                                   ?>
                                               </td>
                                           </tr>
                                       </table>
                                    </div>
                                    <!-- <div class="divTableCell">
                                        <?php
                                            // foreach($con->query('SELECT SUM(updated_count)
                                            // FROM members where forum_date="2022-02-26" AND Branch="MUNOZ OFFICE"') as $row) {
                                            // echo "<h4>".number_format($row['SUM(updated_count)'])."</h4>";
                                            // }
                                            ?>
                                        </div> -->
                                    <div class="divTableCell">
                                        <?php
                                            foreach($con->query('SELECT SUM(updated_count)
                                            FROM members where isregistered="YES" AND Branch="MUNOZ OFFICE"') as $row) {
                                            echo "<h4><b>".number_format($row['SUM(updated_count)'])."</b></h4>";
                                            }
                                            ?>
                                    </div>
                                </div>
                                
                                
                                
                                <div class="divTableRow">
                                    <div class="divTableHeading2" style="font-size:19px;color:white;padding:10px;">TSORA</div>
                                    <div class="divTableCell">
                                        <table style='width:100% !important; font-size: 19px'>
                                           <tr>
                                               <!--<td>-->
                                                   <?php
                                                       // foreach($con->query('SELECT SUM(updated_count)
                                                       // FROM members where forum_date="2023-02-19" AND Branch="TSORA OFFICE"') as $row) {
                                                       //     echo number_format($row['SUM(updated_count)']);
                                                       // }
                                                   ?>
                                               <!--</td>-->
                                               <td style="width: 50% !important;">
                                                   <?php
                                                   // 04:00:00 = 12pm in PH
                                                       foreach($con->query('select SUM(updated_count) from members where forum_day <= "2023-02-19 03:59:59" 
                                                       and forum_date="2023-02-19" AND Branch="TSORA OFFICE"') as $row) {
                                                           echo number_format($row['SUM(updated_count)']);
                                                       }
                                                   ?>
                                               </td>
                                               <td>
                                                   <?php
                                                   // 09:00:00 = 5pm in PH
                                                       foreach($con->query('select SUM(updated_count) from members where forum_day >= "2023-02-19 04:00:00" and forum_day <= "2023-02-19 09:00:00"
                                                        and forum_date="2023-02-19" AND Branch="TSORA OFFICE"') as $row) {
                                                           echo number_format($row['SUM(updated_count)']);
                                                       }
                                                   ?>
                                               </td>
                                           </tr>
                                       </table> 
                                    </div>
                                    <div class="divTableCell">
                                       <table style='width:100% !important; font-size: 19px'>
                                           <tr>
                                               <!--<td>-->
                                                   <?php
                                                       // foreach($con->query('SELECT SUM(updated_count)
                                                       // FROM members where forum_date="2023-02-20" AND Branch="TSORA OFFICE"') as $row) {
                                                       //     echo number_format($row['SUM(updated_count)']);
                                                       // }
                                                   ?>
                                               <!--</td>-->
                                               <td style="width: 50% !important;">
                                                   <?php
                                                   // 04:00:00 = 12pm in PH
                                                       foreach($con->query('select SUM(updated_count) from members where forum_day >= "2023-02-19 16:00:00" and forum_day <= "2023-02-20 03:59:59"
                                                       and forum_date="2023-02-20" AND Branch="TSORA OFFICE"') as $row) {
                                                           echo number_format($row['SUM(updated_count)']);
                                                       }
                                                   ?>
                                               </td>
                                               <td>
                                                   <?php
                                                   // 09:00:00 = 5pm in PH
                                                       foreach($con->query('select SUM(updated_count) from members where forum_day >= "2023-02-20 04:00:00" and forum_day <= "2023-02-20 09:00:00"
                                                        and forum_date="2023-02-20" AND Branch="TSORA OFFICE"') as $row) {
                                                           echo number_format($row['SUM(updated_count)']);
                                                       }
                                                   ?>
                                               </td>
                                           </tr>
                                       </table>
                                    </div>
                                    <div class="divTableCell">
                                       <table style='width:100% !important; font-size: 19px'>
                                           <tr>
                                               <!--<td>-->
                                                   <?php
                                                       // foreach($con->query('SELECT SUM(updated_count)
                                                       // FROM members where forum_date="2023-02-21" AND Branch="TSORA OFFICE"') as $row) {
                                                       //     echo number_format($row['SUM(updated_count)']);
                                                       // }
                                                   ?>
                                               <!--</td>-->
                                               <td style="width: 50% !important;">
                                                   <?php
                                                   // 04:00:00 = 12pm in PH
                                                       foreach($con->query('select SUM(updated_count) from members where forum_day >= "2023-02-20 16:00:00" and forum_day <= "2023-02-21 03:59:59"
                                                       and forum_date="2023-02-21" AND Branch="TSORA OFFICE"') as $row) {
                                                           echo number_format($row['SUM(updated_count)']);
                                                       }
                                                   ?>
                                               </td>
                                               <td>
                                                   <?php
                                                   // 09:00:00 = 5pm in PH
                                                       foreach($con->query('select SUM(updated_count) from members where forum_day >= "2023-02-21 04:00:00" and forum_day <= "2023-02-21 09:00:00"
                                                        and forum_date="2023-02-21" AND Branch="TSORA OFFICE"') as $row) {
                                                           echo number_format($row['SUM(updated_count)']);
                                                       }
                                                   ?>
                                               </td>
                                           </tr>
                                       </table>
                                    </div>
                                    <!-- <div class="divTableCell">
                                        <?php
                                            // foreach($con->query('SELECT SUM(updated_count)
                                            // FROM members where forum_date="2022-02-26" AND Branch="TSORA OFFICE"') as $row) {
                                            // echo "<h4>".number_format($row['SUM(updated_count)'])."</h4>";
                                            // }
                                            ?>
                                        </div> -->
                                    <div class="divTableCell">
                                        <?php
                                            foreach($con->query('SELECT SUM(updated_count)
                                            FROM members where isregistered="YES" AND Branch="TSORA OFFICE"') as $row) {
                                            echo "<h4><b>".number_format($row['SUM(updated_count)'])."</b></h4>";
                                            }
                                            ?>
                                    </div>
                                </div>
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