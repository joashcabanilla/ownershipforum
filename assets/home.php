<?php include('connection.php');
  include('dbcon.php');
  include('session.php');
  $result=mysqli_query($con, "select * from users where user_id='$session_id'")or die('Error In Session');
  $row=mysqli_fetch_array($result);
 ?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.10.25/af-2.3.7/date-1.1.0/r-2.2.9/rg-1.1.3/sc-2.0.4/sp-1.3.0/datatables.min.css"/> -->
  <link rel="stylesheet" type="text/css" href="assets/dataTables.bootstrap4.min.css"/>
  <link rel="stylesheet" type="text/css" href="assets/bootstrap.min.css"/>
  <link rel="shortcut icon" href="imgs/logo.gif">
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <title>NOVADECI OwnershipForum</title>
  <style type="text/css">
    .btnAdd {
      text-align: right;
      width: 83%;
      margin-bottom: 20px;
    }
    .hover-item {
    background-color: red;
    }
    .hover-item:hover {
    background-color: orange;
    }

    #my_input[type="date"]
    {
        font-size:14px;
    }

  </style>

  <script language="JavaScript">
    function showInput() {
        var value = localStorage.getItem('val'); // get value of message from localstorage
        document.getElementById('staff_name').value = value; // set it value to display input
    }
  </script>

  <script>
      $(document).ready(function () {
          $('#page-button').click(function () {
              $('#modal-text').val($('#staff_name').val());
              $('#staff_name').val($('#staff_name').val());
          });
      });
  </script>
  <script>
      function sync()
      {
        var staff_name = document.getElementById('staff_name');
        var user_s = document.getElementById('user_s');
        user_s.value = staff_name.value;
      }
  </script>
</head>
<header style="background-color:green;">


  <a href="logout.php" style="color:white;margin-right:10px;"><label class="hover-item" style="float:right;margin-right:3px;padding:5px;height:28px;margin-top:-5px;"><i class="fa fa-sign-out" style="font-size:22px;"></i>&nbsp;<i >Log out</i></label></a>

  <label style="color:white;float:right;"><b>  <i>Welcome:</i> &nbsp;&nbsp;<input id='staff_name' type="text" style="border-top-style: hidden;
        border-right-style: hidden;
        border-left-style: hidden;
        border-bottom-style: hidden;
        background-color: green; color:white;height:15px; width:120px;" readonly></b></label>

</header>

<body onload="showInput();">
  <div class="container-fluid"><p> </p>


    <h4 class="text-center">NOVALICHES <a href="http://localhost/ownershipforum/dashboard" style="text-decoration: none;color:black;"> DEVELOPMENT</a> COOPERATIVE</h4>
    <p class="datatable design text-center">OWNERSHIP FORUM REGISTRATION</p>
    <div class="row">
      <div class="container">
        <!-- <div class="btnAdd">
         <a href="#!" data-id="" data-bs-toggle="modal" data-bs-target="#addMemberModal"   class="btn btn-success btn-sm" >Add User</a>
       </div> -->
       <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-9">
         <table id="frmMember" class="table">
          <thead>
            <th width="2%">ID</th>
            <th width="3%">MemID</th>
            <th width="20%">Full Name</th>
            <th width="3%">Birth Date</th>
            <th width="3%">Status</th>
            <th width="3%">Membership Date</th>
            <th width="15%">Branch</th>
            <th width="5%">Incentive</th>
            <th width="2%">Registered</th>
            <th width="7%">Forum Date</th>
            <th width="5%">Forum Attended</th>
            <th width="2%">Options</th>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
      <div class="col-md-2"></div>
    </div>
  </div>
</div>
</div>

<script type="text/javascript" src="assets/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="assets/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="assets/datatables.min.js"></script>

  <script type="text/javascript">
    $(document).ready(function() {
      $('#frmMember').DataTable({
        "fnCreatedRow": function( nRow, aData, iDataIndex ) {
          $(nRow).attr('id', aData[0]);
        },
        'serverSide':'true',
        'processing':'true',
        'paging':'true',
        'order':[],
        'ajax': {
          'url':'fetch_data.php',
          'type':'post',
        },
        "columnDefs": [{
          'target':[10],
          'orderable' :false,
        }]
      });
    } );
    $(document).on('submit','#addUser',function(e){
      e.preventDefault();
      var mem_id= $('#addmem_idField').val();
      var fullname= $('#addfullnameField').val();
      // var fname= $('#addfnameField').val();
      // var mname= $('#addmnameField').val();
      var branch= $('#addbranchField').val();
      var stat= $('#addstatField').val();
      var forum_date= $('#addforum_dateField').val();

      if(mem_id != '' && fullname != '' && branch != '' && stat != '' && forum_date != '')
      {
       $.ajax({
         url:"add_member.php",
         type:"post",
         data:{mem_id:mem_id,fullname:fullname,branch:branch,stat:stat,forum_date:forum_date},
         success:function(data)
         {
           var json = JSON.parse(data);
           var status = json.status;
           if(status=='true')
           {
            mytable =$('#frmMember').DataTable();
            mytable.draw();
            $('#addMemberModal').modal('hide');
          }
          else
          {
            alert('failed');
          }
        }
      });
     }
     else {
      alert('Fill all the required fields');
    }
  });
    $(document).on('submit','#updateMember',function(e){
      e.preventDefault();
       //var tr = $(this).closest('tr');
       var mem_id= $('#mem_idField').val();
       var fullname= $('#fullnameField').val();
       var bday= $('#bdayField').val();
       var stat= $('#statField').val();
       var membership_date= $('#membership_dateField').val();
       var branch= $('#branchField').val();
       var isregistered= $('#isregisteredField').val();
       var forum_date= $('#forum_dateField').val();
       var updated_count= $('#updated_count').val();
       var user_s= $('#user_s').val();
       var incentive= $('#incentiveField').val();
       var forum_attended= $('#forum_attendedField').val();
       var trid= $('#trid').val();
       var id= $('#id').val();
       if(mem_id != '' && fullname != '' && bday != '' && stat != '' && membership_date != '' && branch != '' && isregistered != '' && forum_date != '' && updated_count != '' && user_s != ''  && incentive != '' && forum_attended != '')
       {
         $.ajax({
           url:"update_member.php",
           type:"post",
           data:{mem_id:mem_id,fullname:fullname,bday:bday,stat:stat,membership_date:membership_date,branch:branch,isregistered:isregistered,forum_date:forum_date,updated_count:updated_count,user_s:user_s,incentive:incentive,forum_attended:forum_attended,id:id},
           success:function(data)
           {
             var json = JSON.parse(data);
             var status = json.status;
             if(status=='true')
             {
              table =$('#frmMember').DataTable();
              // var button =   '<td><a href="javascript:void();" data-id="' +id + '" class="btn btn-info btn-sm editbtn">Edit</a>  <a href="#!"  data-id="' +id + '"  class="btn btn-danger btn-sm deleteBtn">Delete</a></td>';
              var button =   '<td><a href="javascript:void();" data-id="' +id + '" class="btn btn-success btn-sm editbtn">Update</a></td>';
              var row = table.row("[id='"+trid+"']");
              row.row("[id='" + trid + "']").data([id,mem_id,fullname,bday,stat,membership_date,branch,incentive,isregistered,forum_date,forum_attended,button]);
              $('#updateModal').modal('hide');
            }
            else
            {
              alert('failed');
            }
          }
        });
       }
       else {
        alert('Fill all the required fields');
      }
    });
    $('#frmMember').on('click','.editbtn ',function(event){
      var table = $('#frmMember').DataTable();
      var trid = $(this).closest('tr').attr('id');
     // console.log(selectedRow);
     var id = $(this).data('id');
     $('#updateModal').modal('show');

     $.ajax({
      url:"get_single_data.php",
      data:{id:id},
      type:'post',
      success:function(data)
      {
       var json = JSON.parse(data);
       $('#mem_idField').val(json.mem_id);
       $('#fullnameField').val(json.fullname);
       $('#bdayField').val(json.bday);
       $('#statField').val(json.stat);
       $('#membership_dateField').val(json.membership_date);
       $('#branchField').val(json.branch);
       $('#isregisteredField').val('YES');
       $('#forum_dateField').val(json.forum_date);
       $('#user_sField').val(json.user_s);
       $('#incentiveField').val(json.incentive);
       $('#forum_attendedField').val(json.forum_attended);
       $('#id').val(id);
       $('#trid').val(trid);
     }
   })
   });

    $(document).on('click','.deleteBtn',function(event){
       var table = $('#frmMember').DataTable();
      event.preventDefault();
      var id = $(this).data('id');
      if(confirm("Are you sure want to delete this record ? "))
      {
      $.ajax({
        url:"delete_member.php",
        data:{id:id},
        type:"post",
        success:function(data)
        {
          var json = JSON.parse(data);
          status = json.status;
          if(status=='success')
          {

             $("#"+id).closest('tr').remove();
          }
          else
          {
            alert('Failed');
            return;
          }
        }
      });
      }
      else
      {
        return null;
      }



    })
 </script>
 <!-- update Modal -->
 <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true" >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="updateModalLabel">Member's Information</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <form id="updateMember" >

        <input type="text" name="user_s" id="user_s" hidden/>
          <!-- <label for="staff_name">Name</label>
          <input class="form-control" id="modal-text" type="text" value=""> -->

          <input type="hidden" name="id" id="id" value="">
          <input type="hidden" name="trid" id="trid" value="">

          <div class="mb-3 row">
            <label for="mem_idField" class="col-md-3 form-label">MemID/PBno</label>
            <div class="col-md-9">
              <input type="text" class="form-control" id="mem_idField" name="mem_id">
            </div>
          </div>
          <div class="mb-3 row">
            <label for="fullnameField" class="col-md-3 form-label">Full Name</label>
            <div class="col-md-9">
              <input type="text" class="form-control" id="fullnameField" name="fullname" style="font-weight: bold;">
            </div>
          </div>
          <div class="mb-3 row">
            <label for="bdayField" class="col-md-3 form-label">Birth Date</label>
            <div class="col-md-9">
              <input type="text" class="form-control" id="bdayField" name="bday">
            </div>
          </div>
          <div class="mb-3 row">
            <label for="statField" class="col-md-3 form-label">Status</label>
            <div class="col-md-9">
              <input type="text" class="form-control" id="statField" name="stat" style="font-weight: bold;">
            </div>
          </div>
          <div class="mb-3 row">
            <label for="membership_dateField" class="col-md-3 form-label">Membership Date</label>
            <div class="col-md-9">
              <input type="text" class="form-control" id="membership_dateField" name="membership_date">
            </div>
          </div>
          <div class="mb-3 row">
            <label for="branchField" class="col-md-3 form-label">Branch</label>
            <div class="col-md-9">
              <input type="text" class="form-control" id="branchField" name="branch">
            </div>
          </div>
          <hr />
          <div class="mb-3 row">
              <input type="hidden" id="isregisteredField" name="isregistered" class="form-control">
          </div>

          <div class="mb-3 row">
            <label for="" class="col-md-3 form-label"><b>With incentive?</b></label>
            <div class="col-md-9">
              <select class="form-control" id="incentiveField" name="incentive" style="font-size:1.5rem" required>
                <option value="YES">YES</option>
                <option value="NONE">NONE</option>
              </select>
              <!-- <input type="radio" class="" id="incentiveField" name="incentive" value="YES" style="width:20px;height:20px;"><label for="" style="margin-right:20px;font-size:18px;">&nbsp;Yes </label>
              <input type="radio" class="" id="incentiveField" name="incentive" value="NONE" style="width:20px;height:20px;"><label for="" style="font-size:18px;">&nbsp;None </label> -->
              <!-- <?php include_once('dbcon.php'); ?>
              <input name="sex" type="radio" id="incentiveField" value="YES" <?php echo ($incentive== 'YES') ?  "checked" : "" ;  ?>/> YES
              <input name="sex" type="radio" id="incentiveField" value="NONE" <?php echo ($incentive== 'NONE') ?  "checked" : "" ;  ?>/> NONE -->
            </div>
          </div><hr />
          <div class="mb-3 row">
            <label for="" class="col-md-3 form-label"><b>Forum Attended</b></label>
            <div class="col-md-9">
              <select class="form-control" id="forum_attendedField" name="forum_attended" style="font-size:1.5rem" required>
                <option value="Online">Online</option>
                <option value="Face to Face">Face to Face</option>
              </select>
            </div>
          </div><hr />
          <div class="mb-3 row">
            <label for="forum_dateField" class="col-md-3 form-label"><b>Forum Date</b></label>
            <div class="col-md-9">
              <input type="date" class="form-control" id="forum_dateField" name="forum_date" style="font-size:1.5rem" required>
              <input type="hidden" class="form-control" id="updated_count" name="updated_count" value="1" >
            </div>
          </div>
          <div class="text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button"  class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>



<!-- Add member Modal -->
<!-- <div class="modal fade" id="addMemberModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="updateModalLabel">Add User</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="addUser" action="">
          <div class="mb-3 row">
            <label for="addmem_idField" class="col-md-3 form-label">mem_id</label>
            <div class="col-md-9">
              <input type="text" class="form-control" id="addmem_idField" name="mem_id">
            </div>
          </div>
          <div class="mb-3 row">
            <label for="addlnameField" class="col-md-3 form-label">lname</label>
            <div class="col-md-9">
              <input type="lname" class="form-control" id="addlnameField" name="lname">
            </div>
          </div>
          <div class="mb-3 row">
            <label for="addfnameField" class="col-md-3 form-label">fname</label>
            <div class="col-md-9">
              <input type="text" class="form-control" id="addfnameField" name="name" >
            </div>
          </div>
          <div class="mb-3 row">
            <label for="addmnameField" class="col-md-3 form-label">mname</label>
            <div class="col-md-9">
              <input type="text" class="form-control" id="addmnameField" name="mname" >
            </div>
          </div>
          <div class="mb-3 row">
            <label for="addsexField" class="col-md-3 form-label">sex</label>
            <div class="col-md-9">
              <input type="text" class="form-control" id="addsexField" name="sex" >
            </div>
          </div>
          <div class="mb-3 row">
            <label for="addbranchField" class="col-md-3 form-label">branch</label>
            <div class="col-md-9">
              <input type="text" class="form-control" id="addbranchField" name="branch" >
            </div>
          </div>
          <div class="mb-3 row">
            <label for="addstatField" class="col-md-3 form-label">stat</label>
            <div class="col-md-9">
              <input type="text" class="form-control" id="addstatField" name="stat" >
            </div>
          </div>
          <div class="mb-3 row">
            <label for="addvaccine_typeField" class="col-md-3 form-label">vaccine_type</label>
            <div class="col-md-9">
              <input type="text" class="form-control" id="addvaccine_typeField" name="vaccine_type" >
            </div>
          </div>
          <div class="mb-3 row">
            <label for="adddate_vaccinatedField" class="col-md-3 form-label">date_vaccinated</label>
            <div class="col-md-9">
              <input type="text" class="form-control" id="adddate_vaccinatedField" name="date_vaccinated" >
            </div>
          </div>

          <div class="text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div> -->
<!-- <footer><p style="font-size:11px; float:right; margin-right:70px; font-style:italic">Developed by: JV</p></footer> -->
</body>
</html>
<script type="text/javascript">
  //var table = $('#frmMember').DataTable();
</script>
