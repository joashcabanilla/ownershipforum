<?php include('connection.php');
    include('dbcon.php');
    include('session.php');
    $result=mysqli_query($con, "select * from users where user_id='$session_id'")or die('Error In Session');
    $row=mysqli_fetch_array($result);
    $forumDateOptions = "<option value='2024-02-03'>02/03/2024</option>
    <option value='2024-02-04'>02/04/2024</option>
    <option value='2024-02-05'>02/05/2024</option>";

    $branch = "<option value='BSILANG OFFICE'>BSILANG OFFICE</option>
    <option value='BULACAN OFFICE'>BULACAN OFFICE</option>
    <option value='CAMARIN OFFICE'>CAMARIN OFFICE</option>
    <option value='FAIRVIEW OFFICE'>FAIRVIEW OFFICE</option>
    <option value='KIKO OFFICE'>KIKO OFFICE</option>
    <option value='LAGRO OFFICE'>LAGRO OFFICE</option>
    <option value='MAIN OFFICE'>MAIN OFFICE</option>
    <option value='MUNOZ OFFICE'>MUNOZ OFFICE</option>
    <option value='NUEVA ECIJA OFFICE'>NUEVA ECIJA OFFICE</option>
    <option value='TSORA OFFICE'>TSORA OFFICE</option>";
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="assets/dataTables.bootstrap4.min.css"/>
        <link rel="stylesheet" type="text/css" href="assets/bootstrap.min.css"/>
        <link rel="shortcut icon" href="imgs/logo.gif">
        <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
        <script src="assets/jquery-3.5.1.min.js"></script>
        <script src="assets/bootstrap.min.js"></script>
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
            
            div.dataTables_wrapper div.dataTables_filter input {
                width: 450px;
                height: 30px;
            }
            #frmMember_filter input{
                width: 570px !important;
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
        <label style="color:white;float:right;">COUNTER = <span id="kawnt"></span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>  <i>Welcome:</i> &nbsp;&nbsp;<input id='staff_name' type="text" style="border-top-style: hidden;
            border-right-style: hidden;
            border-left-style: hidden;
            border-bottom-style: hidden;
            background-color: green; color:white;height:15px; width:120px;" readonly></b></label>
    </header>
    <body onload="showInput();">
        <div class="container">
            <h4 class="text-center">NOVALICHES <a href="https://ownershipforum.novadeci.com/dashboard/" style="text-decoration: none;color:black;"> DEVELOPMENT</a> COOPERATIVE</h4>
            <p class="datatable design text-center">OWNERSHIP FORUM REGISTRATION</p>
            <div class="row">
                <div class="col-md-12">
                    <?php
                        if($session_id == 1){
                            echo 
                                '<div class="pull-right">
                                    <button data-id="" data-bs-toggle="modal" data-bs-target="#addMemberModal"   class="btn btn-success btn-sm fa fa-plus" ></button>
                                </div>';
                        }
                    ?>
                    <div class="pull-left">
                        <button data-id="" data-bs-toggle="modal" data-bs-target="#reportModal"   class="btn btn-success btn-sm fw-bolder" >Generate Report</button>
                    </div>
                    <br><br>    
                    <div class="table-responsive">
                        <table id="frmMember" class="table table-condensed table-hover" style="margin-right:20px;">
                            <thead>
                                <!--<th width="2%">MemID</th>-->
                                <!--<th width="3%">PB#</th>-->
                                
                                <th width="3%">PB#/MemID</th>
                                <th width="15%">Full Name</th>
                                <th width="3%">Birth Date</th>
                                <th width="3%">Status</th>
                                <th width="3%">Membership Date</th>
                                <th width="10%">Branch</th>
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
            
             const Kawnter = () => {
                var userS =  localStorage.getItem('val')

                $.ajax({
                    url:"getCounter.php",
                    type:"post",
                    data:{userS:userS},
                    success:function(data)
                    {
                        var json = JSON.parse(data);

                        $('#kawnt').text(json.kawnt)
                    }
                })
            }

            Kawnter();
            
            $(document).on('submit','#addMember',function(e){
              e.preventDefault();
              var mem_id= $('#addmem_idField').val();
              var pbno= $('#addpbnoField').val();
              var fullname= $('#addfullnameField').val();
              var bday= $('#addbdayField').val();
              var stat= $('#addstatField').val();
              var membership_date= $('#addmembership_dateField').val();
              var branch= $('#chooseBranch').find(":selected").val();

              var isregistered= $('#addisregisteredField').val();
              var count= $('#addcountField').val();
              if(mem_id != '' && pbno != ''  && fullname != '' && bday != '' && stat != '' && membership_date != '' && branch != '' && count != '')
              {
               $.ajax({
                 url:"add_member.php",
                 type:"post",
                 data:{mem_id:mem_id,pbno:pbno,fullname:fullname,bday:bday,stat:stat,membership_date:membership_date,branch:branch,isregistered:isregistered,count:count},
                 success:function(data)
                 {
                   var json = JSON.parse(data);
                   var status = json.status;
                   if(status=='true')
                   {
                    alert('Successfully Saved.');
                    mytable =$('#frmMember').DataTable();
                    mytable.draw();
                    $('#addMemberModal').modal('hide');
                    Kawnter();
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
                       var button =   '<td><a href="javascript:void();" data-id="' +id + '" class="btn btn-info btn-sm editbtn">Edit</a>  <a href="#!"  data-id="' +id + '"  class="btn btn-danger btn-sm deleteBtn">Delete</a></td>';
                      var button =   '<td><a href="javascript:void();" data-id="' +id + '" class="btn btn-success btn-sm editbtn">Update</a></td>';
                      var row = table.row("[id='"+trid+"']");
                    //   row.row("[id='" + trid + "']").data([id,mem_id,fullname,bday,stat,membership_date,branch,incentive,isregistered,forum_date,forum_attended,button]);
                    row.row("[id='" + trid + "']").data([mem_id,fullname,bday,stat,membership_date,branch,incentive,isregistered,forum_date,forum_attended,button]);
                      $('#updateModal').modal('hide');
                      Kawnter();
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
            
            $(document.body).on('click', '.openChange', function(){
                $('.memName4Change').text($('#fullnameField').val())
                $('.memStat4Change').val($('#statField').val())
                $('.memId4Change').val($('#id').val())
            })

            $(document.body).on('click', '#btnUpdateStats', function(e){
                var updated_count = $('.updated_count').val()
                var memStat4Change = $('.memStat4Change').val()
                var memId4Change = $('.memId4Change').val()

                $.ajax({
                    url:"update_status.php",
                    type:"post",
                    data:{ updated_count:updated_count, status:memStat4Change, id:memId4Change},
                    success:function(data)
                    {
                        var json = JSON.parse(data);
                        var status = json.status;
                        if(status=='true')
                        {
                            $('#frmMember').DataTable().ajax.reload();
                            $('#statField').val(memStat4Change)
                            $('#changeStatusModal').modal('hide');
                            Kawnter();
                        }
                        else
                        {
                            alert('failed');
                        }
                    }
                })
            });
            
            const defaultForumDate = () => {
                var today = new Date();
                var dd = String(today.getDate()).padStart(2, '0');
                var mm = String(today.getMonth() + 1).padStart(2, '0')
                var yyyy = today.getFullYear();

                today = yyyy + '-' + mm + '-' + dd

                // return today
                return yyyy + '-' + '02' + '-' + '24'
            }
            
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
            //   $('#forum_attendedField').val(json.forum_attended ? json.forum_attended : 'Face to Face');
                $('#forum_attendedField').val('Online');
            //    $('#forum_dateField').val(defaultForumDate());
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
                     Kawnter();
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
                                  <div class="col-md-9 d-flex">
                                    <input type="text" class="form-control" id="statField" name="stat" style="font-weight: bold;" readonly>
                                    <?php
                                        if($session_id == 1){
                                            echo '<a href="#!" data-id="" data-bs-toggle="modal" data-bs-target="#changeStatusModal" class="btn btn-success btn-sm openChange" style="margin-left:5px">Change</a>';
                                        }
                                    ?>
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
                                    <input type="text" class="form-control" id="branchField" name="branch" Placeholder="BRANCH OFFICE">
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
                            </div>
                            <hr />
                            <div class="mb-3 row">
                                <label for="" class="col-md-3 form-label"><b>Forum Attended</b></label>
                                <div class="col-md-9">
                                    <select class="form-control" id="forum_attendedField" name="forum_attended" style="font-size:1.5rem" required>
                                        <option value="Online">Online</option>
                                        <option value="Face to Face">Face to Face</option>
                                    </select>
                                </div>
                            </div>
                            <hr />
                            <div class="mb-3 row">
                                <label for="forum_dateField" class="col-md-3 form-label"><b>Forum Date</b></label>
                                <div class="col-md-9">
                                    <!-- <input type="date"  id="forum_dateField" name="forum_date" style="font-size:1.5rem" required> -->
                                    <select name="forum_date" class="form-control" id="forum_dateField" required>
                                        <?php echo $forumDateOptions;?>
                                    </select>
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
        <div class="modal fade" id="addMemberModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateModalLabel">Add Member</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="addMember" action="">
                            <div class="mb-3 row">
                                <label for="addmem_idField" class="col-md-3 form-label">MemID</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="addmem_idField" name="mem_id">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="addpbnoField" class="col-md-3 form-label">PBNO</label>
                                <div class="col-md-9">
                                    <input type="pbno" class="form-control" id="addpbnoField" name="pbno" value=".">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="addfullnameField" class="col-md-3 form-label">Fullname</label>
                                <div class="col-md-9">
                                    <input type="fullname" class="form-control" id="addfullnameField" name="fullname">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="addbdayField" class="col-md-3 form-label">Birthday</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="addbdayField" name="bday" >
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="addstatField" class="col-md-3 form-label">Status</label>
                                <div class="col-md-9">
                                    <!-- <input type="text" class="form-control" id="addstatField" name="stat" > -->
                                    <select class="form-control" name="stat" id="addstatField">
                                        <option value="MIGS">MIGS</option>
                                        <option value="NONMIGS">NONMIGS</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="addmembership_dateField" class="col-md-3 form-label">Membership Date</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="addmembership_dateField" name="membership_date" >
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="addbranchField" class="col-md-3 form-label">Branch</label>
                                <div class="col-md-9">
                                    <!--  <input type="text" class="form-control" id="addbranchField" name="branch" >-->
                                    <select class="form-control" name="branch" id="chooseBranch" required>
                                        <option value=""></option>
                                        <?php echo $branch;?>
                                        <!-- <option value="BSILANG OFFICE">Bagong Silang</option>
                                        <option value="BULACAN OFFICE">Bulacan</option>
                                        <option value="CAMARIN OFFICE">Camarin</option>
                                        <option value="FAIRVIEW OFFICE">Fairview</option>
                                        <option value="KIKO OFFICE">Kiko</option>
                                        <option value="LAGRO OFFICE">Lagro</option>
                                        <option value="MUNOZ OFFICE">Muñoz</option>
                                        <option value="MAIN OFFICE" selected>Main Office</option>
                                        <option value="TSORA OFFICE">Tandang Sora</option> -->
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="addisregisteredField" class="col-md-3 form-label">isRegistered</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="addisregisteredField" name="isregistered" value="NO" readonly>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="addcountField" class="col-md-3 form-label">Count</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="addcountField" name="count" value="1" readonly>
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
        </div>
        
        <!-- UPDATE MEMBER STATUS -->
        <div class="modal fade" id="changeStatusModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">UPDATE MEMBER STATUS</h5>
                        <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                    </div>
                    <div class="modal-body">
                        <div class="col-md-12 text-center">
                            <span class="memName4Change h3" style="color:green;text-align:center"></span>
                            <div class="form-group my-3">
                                <input type="hidden" name="id" class="memId4Change"/>
                                <input type="hidden" name="memName" class="memName4Change"/>
                                <input type="hidden" name="updated_count" value="1" class="updated_count"/>
                                <select class="form-control memStat4Change" name="status">
                                    <option value="MIGS" style="font-size:18px;text-align:center">MIGS</option>
                                    <option value="NONMIGS" style="font-size:18px;text-align:center">NONMIGS</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button name="update" class="btn btn-warning text-white" id="btnUpdateStats"><span class="fa fa-pencil"></span> Update</button>
                        <button class="btn btn-danger" type="button" data-bs-dismiss="modal"><span class="fa fa-close"></span> Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- REPORT MODAL -->
        <div class="modal fade" id="reportModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">GENERATE REPORT</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="reportForm" method="POST" target="_blank">
                            <input type="text" name="reportTitle" id="reportTitle" hidden/>
                            <input type="text" name="reportUser" id="reportUser" hidden/>
                            <div class="row">
                                <div class="col-12">
                                    <label for="reportName" class="form-label fw-bolder">Select Report</label>
                                    <select class="form-control" id="reportName" name="reportType" required autocomplete="false">
                                        <option value="1">List of registered members encoded by the current user</option>
                                        <option value="2">List of all registered members</option>
                                        <option value="3">Tally of registration</option>
                                    </select>
                                </div>
                                <div class="col-12 mt-3">
                                    <label for="reportBranch" class="form-label fw-bolder">Branch</label>
                                    <select class="form-control" id="reportBranch" name="branch">
                                        <option value="">-- ALL --</option>
                                        <?php echo $branch;?>
                                    </select>
                                </div>
                                <div class="col-12 mt-3">
                                    <label for="reportForumDate" class="form-label fw-bolder">Forum Date</label>
                                    <select class="form-control" id="reportForumDate" name="forumDate">
                                        <option value="">-- ALL --</option>
                                        <?php echo $forumDateOptions;?>
                                    </select>
                                </div>
                                <div class="col-12 mt-3">
                                    <label for="reportSchedule" class="form-label fw-bolder">Schedule</label>
                                    <select class="form-control" id="reportSchedule" name="schedule">
                                        <option value="">AM & PM</option>
                                        <option value="AM">AM</option>
                                        <option value="PM">PM</option>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-success text-white fw-bolder" id="generatePDF">PDF</button>
                        <!-- <button class="btn btn-success text-white fw-bolder" id="generateExcel">EXCEL</button> -->
                    </div>
                </div>
            </div>
        </div>
        <!--<footer class="main-footer">-->
        <!--  <div style="float:right;margin-right:135px;font-size:12px;"><strong>© 2022 <a href="https://ownershipforum.novadeci.com/forum-utility/">JV</a></strong> All rights reserved.-->
        <!--  <a href="add_member.php" data-id="" data-bs-toggle="modal" data-bs-target="#addMemberModal"><i class="fa fa-plus" aria-hidden="true"></i></a>-->
        <!--  </div>-->
        <!--</footer>-->
    </body>
</html>
<script type="text/javascript">
    function getReportTitle(reportId){
        switch(parseInt(reportId)){
            case 1:
            case 2:
                title = "List of registered members";
            break;

            case 3:
                title = "Tally of registration";
            break;
        }
        $("#reportUser").val($("#staff_name").val());
        $("#reportTitle").val(title);
    }

    $("#reportModal").on('shown.bs.modal',function(event){
        $("#reportBranch").val("");
        $("#reportName").val("1");
        $("#reportForumDate").val("");
    });

    $("#generatePDF").click((e) => {
        e.preventDefault();
        $("#reportForm").attr("action","generatePDF.php");
        getReportTitle($("#reportName").val());
        $("#reportForm").submit();
    });

    $("#generateExcel").click((e) => {
        e.preventDefault();
        $("#reportForm").attr("action","generateExcel.php");
        getReportTitle($("#reportName").val());
        $("#reportForm").submit();
    });

    $("#addMemberModal").on('show.bs.modal',function(event){
        $("#addmem_idField").val("");
        $("#addpbnoField").val(".");
        $("#addfullnameField").val("");
        $("#addbdayField").val("");
        $("#addstatField").val("");
        $("#addmembership_dateField").val("");
        $("#chooseBranch").val("");
    });

    const searchFocus = () => {
        setTimeout(() => {
            $("#frmMember_filter input").focus();
        },100);
    }
    $(document).ready((e) => {
        searchFocus();
    });

    $("#addMemberModal").on('hidden.bs.modal',function(event){
        searchFocus();
    });

    $("#reportModal").on('hidden.bs.modal',function(event){
        searchFocus();
    });

    $("#updateModal").on('hidden.bs.modal',function(event){
        searchFocus();
    });
</script>