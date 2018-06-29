<?php $user = $this->session->userdata('email'); ?>
<!DOCTYPE html>
<html>
<head>
<title>List of all contacts</title>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <style>
body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
}

.topnav {
  overflow: hidden;
  background-color: #333;
}

.topnav a {
  float: left;
  display: block;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.topnav a:hover {
  background-color: #ddd;
  color: black;
}

.active {
  background-color: #4CAF50;
  color: white;
}

.topnav .icon {
  display: none;
}

@media screen and (max-width: 600px) {
  .topnav a:not(:first-child) {display: none;}
  .topnav a.icon {
    float: right;
    display: block;
  }
}

@media screen and (max-width: 600px) {
  .topnav.responsive {position: relative;}
  .topnav.responsive .icon {
    position: absolute;
    right: 0;
    top: 0;
  }
  .topnav.responsive a {
    float: none;
    display: block;
    text-align: left;
  }
}
</style>
</head>
<body>

<div class="topnav" id="myTopnav">
  <a href="#home" class="active">Dashboard</a>
  <a href="#news">News</a>
  <div style="float: right;"> <span style="color: #4caf50;"><?php echo $user; ?></span></div>
  <div style="float: right;margin-right: -85px;margin-top: 8px;">
      <a href="<?= site_url('Login/logout') ?>" >Logout</a>
  </div>
  
</div>

<h1>List of all contacts</h1>
<div style="float: right;margin-top: -35px;margin-right: 12px;"><a href="<?= site_url('Dashboard/add_new_contact') ?>" class="btn btn-primary">ADD NEW CONTACT</a> </div>
<?php if ($this->session->flashdata('message')) { ?>
<div class="text-center" style="margin-bottom: 10px;">
<span style="background:#759675;padding: 6px;color:#fff;width:297px;border-radius: 5px;"><?php echo $this->session->flashdata('message'); ?></span>
</div>
<?php } ?>
<br><br>
<table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Sr No</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Mobile Number</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        	<?php if(!empty($table_data)){  $i = 1; foreach ($table_data as $value) { ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $value['first_name']; ?></td>
                <td><?php echo $value['last_name']; ?></td>
                <td><?php echo $value['mobile_no']; ?></td>
                <td><a href="<?= site_url('Dashboard/edit_contact/'.$value['id'].'') ?>" style="cursor: pointer;">Edit</a> &nbsp; <a onclick="del_stud(this.id,'<?php echo $value['id']; ?>')" id="del_stud<?php echo $i; ?>" style="cursor: pointer;">Delete</a> </td>
            </tr>
        <?php $i++; } } ?>

    </table>
</body>
<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('#example').DataTable();
});

function del_stud(e,contact_id){
   swal({
     title: "Are you sure?",
     text: "Once deleted, you will not be able to recover this Contact!",
     icon: "warning",
     buttons: true,
     dangerMode: true,
   })
   .then((willDelete) => {
     if (willDelete) {
       $.ajax({
       type: "POST",
            url: "<?= site_url('Dashboard/del_contact') ?>",
            async : false,
            data:{'contact_id':contact_id,'reqtype_del':'delete'},
            success : function(data){
             console.log(data);
           }
       });
       swal("Poof! Your Contact has been deleted!", {
         icon: "success", 
       });
       myVar = setTimeout(alertFunc, 2000);
       
     } else {
       swal("Your Contact is safe!"); 
     }
   });
}
function alertFunc() {
   window.location.reload(true);
}
</script>
</html>