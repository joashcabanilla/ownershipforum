<?php
  // Courtesy: w3 Programmings
  // Article URL: https://w3programmings.com/apply-date-range-filters-in-server-side-jquery-datatables-using-php-and-ajax/

  include "config/db-config.php";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>OWNERSHIP FORUM UTILITY</title>
    <link rel="stylesheet" type="text/css" href="assets/bootstrap-3.3.7.min.css">
    <link rel="stylesheet" type="text/css" href="assets/dataTables.bootstrap-1.10.20.min.css">
    <link rel="stylesheet" type="text/css" href="assets/buttons.dataTables-1.6.4.min.css">
    <link rel="stylesheet" href="assets/bootstrap-datepicker-1.6.4.css" />
    <link rel="shortcut icon" href="imgs/logo.gif">
  </head>
  <body>

    <div class="container">
      <div class="row">
        <div class="col-sm-12">

          <div class="">
            <h4 class="text-center" style="margin-top:10px;"><b><a href="https://ownershipforum.novadeci.com/home.php">OWNERSHIP FORUM UTILITY</a></b></h4>
          </div>

          <div class="row well input-daterange">
            <div class="col-sm-4">
              <label class="control-label">Users' list</label>
        				<select class="form-control" name="user_s" id="user_s" style="height: 40px;">
        					<option>Select</option>
        				<?php
        					$sqli = "SELECT * FROM members GROUP BY user_s";
        					$result = mysqli_query($connection, $sqli);
        					 while ($row = mysqli_fetch_array($result)) {
        					 	echo '<option>'.$row['user_s'].'</option>';
        					 }
        					?>
        				</select>
            </div>

            <div class="col-sm-3">
              <label class="control-label">Start date</label>
              <input class="form-control datepicker" type="text" name="initial_date" id="initial_date" placeholder="yyyy-mm-dd" style="height: 40px;"/>
            </div>

            <div class="col-sm-3">
              <label class="control-label">End date</label>
              <input class="form-control datepicker" type="text" name="final_date" id="final_date" placeholder="yyyy-mm-dd" style="height: 40px;"/>
            </div>

            <div class="col-sm-2">
              <button class="btn btn-success btn-block" type="submit" name="filter" id="filter" style="margin-top: 30px">
                <i class="fa fa-filter"></i> Filter
              </button>
            </div>

            <div class="col-sm-12 text-danger" id="error_log"></div>
          </div>

          <br/><br/>

          <table id="fetch_generated_wills" class="table table-hover table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>#</th>
                <th style="width:200px;">Full Name</th>
                <th>Status</th>
                <th>Membership Date</th>
                <th>Branch</th>
                <th>isRegistered</th>
                <th>Incentive</th>
                <th style="width:130px;">Forum Date</th>
                <th>Users</th>
              </tr>
            </thead>
          </table>

        </div>
      </div>
      <footer class="">
         <div style="float:right;margin-right:5px;font-size:12px;"><strong>© 2022 <a href="#">JV</a></strong> All rights reserved.</div>
      </footer>
    </div>
    <script src="assets/jquery-3.5.1.min.js"></script>
    <script src="assets/jquery.dataTables-1.10.20.min.js"></script>
    <script src="assets/dataTables.buttons-1.6.4.min.js"></script>
    <script src="assets/jszip-3.1.3.min.js"></script>
    <script src="assets/pdfmake-0.1.53.min.js"></script>
    <script src="assets/vfs_fonts-0.1.53.js"></script>
    <script src="assets/buttons.html5-2.2.2.min.js"></script>
    <script src="assets/buttons.print-2.2.2.min.js"></script>
    <script src="assets/dataTables.bootstrap-1.10.20.min.js"></script>
    <script src="	assets/bootstrap-datepicker-1.9.0.min.js"></script>

    <script type="text/javascript">
      load_data();

      function load_data(initial_date, final_date, user_s){
        var ajax_url = "jquery-ajax.php";

        $('#fetch_generated_wills').DataTable({
          "order": [[ 0, "desc" ]],
          dom: 'Blfrtip',
          buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
          ],
          "processing": true,
          "serverSide": true,
          "stateSave": true,
          "lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ],
          "ajax" : {
            "url" : ajax_url,
            "dataType": "json",
            "type": "POST",
            "data" : {
              "action" : "fetch_members",
              "initial_date" : initial_date,
              "final_date" : final_date,
              "user_s" : user_s
            },
            "dataSrc": "records"
          },
          "columns": [
            { "data" : "counter" },
            { "data" : "fullname" },
            { "data" : "stat" },
            { "data" : "membership_date" },
            { "data" : "branch" },
            { "data" : "isregistered" },
            { "data" : "incentive" },
            { "data" : "forum_day" },
            { "data" : "user_s" }
          ]
        });
      }

      $("#filter").click(function(){
        var initial_date = $("#initial_date").val();
        var final_date = $("#final_date").val();
        var user_s = $("#user_s").val();

        if(initial_date == '' && final_date == ''){
          $('#fetch_generated_wills').DataTable().destroy();
          load_data("", "", user_s); // filter immortalize only
        }else{
          var date1 = new Date(initial_date);
          var date2 = new Date(final_date);
          var diffTime = Math.abs(date2 - date1);
          var diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

          if(initial_date == '' || final_date == ''){
              $("#error_log").html("Warning: You must select both (start and end) date.</span>");
          }else{
            if(date1 > date2){
                $("#error_log").html("Warning: End date should be greater then start date.");
            }else{
               $("#error_log").html("");
               $('#fetch_generated_wills').DataTable().destroy();
               load_data(initial_date, final_date, user_s);
            }
          }
        }
      });

      $('.input-daterange').datepicker({
        todayBtn:'linked',
        format: "yyyy-mm-dd",
        autoclose: true
      });

    </script>
  </body>
</html>
