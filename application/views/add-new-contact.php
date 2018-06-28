<!DOCTYPE html>
<html lang="en">
<head>
	<title>ADD NEW CONTACT</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="<?= site_url('html/images/icons/favicon.ico') ?>"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= site_url('html/vendor/bootstrap/css/bootstrap.min.css') ?>">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= site_url('html/fonts/font-awesome-4.7.0/css/font-awesome.min.css') ?>">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= site_url('html/fonts/Linearicons-Free-v1.0.0/icon-font.min.css') ?>">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= site_url('html/vendor/animate/animate.css') ?>">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="<?= site_url('html/vendor/css-hamburgers/hamburgers.min.css') ?>">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= site_url('html/vendor/animsition/css/animsition.min.css') ?>">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= site_url('html/vendor/select2/select2.min.css') ?>">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="<?= site_url('html/vendor/daterangepicker/daterangepicker.css') ?>">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= site_url('html/css/util.css') ?>">
	<link rel="stylesheet" type="text/css" href="<?= site_url('html/css/main.css') ?>">
<!--===============================================================================================-->
</head>
<body style="background-color: #666666;">
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form" id="add-contact-form" method="post" method="<?= site_url('Dashboard/add_new_contact') ?>">
					<span class="login100-form-title p-b-43">
						ADD NEW CONTACT
					</span>
					
					
					<div class="wrap-input100 validate-input" data-validate="First Name is required">
						<input class="input100" type="text" name="first_name" id="first_name">
						<span class="focus-input100"></span>
						<span class="label-input100">First Name</span>
					</div>
					
					
					<div class="wrap-input100">
						<input class="input100" type="text" name="middle_name" id="middle_name">
						<span class="focus-input100"></span>
						<span class="label-input100">Middle Name</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Last Name is required">
						<input class="input100" type="text" name="last_name" id="last_name">
						<span class="focus-input100"></span>
						<span class="label-input100">Last Name</span>
					</div>

					<div class="wrap-input100">
						<input class="input100" type="text" name="email" id="email">
						<span class="focus-input100"></span>
						<span class="label-input100">Email ID</span>
					</div>

					<div class="wrap-input100">
						<input class="input100" type="text" name="mobile_no" id="mobile_no">
						<span class="focus-input100"></span>
						<span class="label-input100">Mobile Number</span>
					</div>

					<div class="wrap-input100">
						<input class="input100" type="text" name="landline_no" id="landline_no">
						<span class="focus-input100"></span>
						<span class="label-input100">Landline Number</span>
					</div>

					<div class="wrap-input100">
						<textarea class="input100" name="notes"></textarea>
						<span class="focus-input100"></span>
						<span class="label-input100">Notes</span>
					</div>
			

					<div class="container-login100-form-btn">
						<button class="login100-form-btn" id="">
							Add
						</button>
					</div>
				
				</form>

				<div class="login100-more" style="background-image: url('<?= site_url('html/images/contact-form2.jpg') ?>');">
				</div>
			</div>
		</div>
	</div>

	
<!--===============================================================================================-->
	<script src="<?= site_url('html/vendor/jquery/jquery-3.2.1.min.js') ?>"></script>
<!--===============================================================================================-->
	<script src="<?= site_url('html/vendor/animsition/js/animsition.min.js') ?>"></script>
<!--===============================================================================================-->
	<script src="<?= site_url('html/vendor/bootstrap/js/popper.js') ?>"></script>
	<script src="<?= site_url('html/vendor/bootstrap/js/bootstrap.min.js') ?>"></script>
<!--===============================================================================================-->
	<script src="<?= site_url('html/vendor/select2/select2.min.js') ?>"></script>
<!--===============================================================================================-->
	<script src="<?= site_url('html/vendor/daterangepicker/moment.min.js') ?>"></script>
	<script src="<?= site_url('html/vendor/daterangepicker/daterangepicker.js') ?>"></script>
<!--===============================================================================================-->
	<script src="<?= site_url('html/vendor/countdowntime/countdowntime.js') ?>"></script>
<!--===============================================================================================-->
	<script src="<?= site_url('html/js/main.js') ?>"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<script type="text/javascript">
		$("#add-contact-form").submit(function( event ) {
		  	var first_name = $('#first_name').val();
		  	var last_name = $('#last_name').val();
		  	var email = $('#email').val();
		  	var mobile_no = $('#mobile_no').val();
		  	var landline_no = $('#landline_no').val();
			//alert(first_name);
			if (first_name == '') {
				swal('Please enter First Name is required');
				$("#first_name").focus();
				return false;
			}
			if (last_name == '') {
				swal('Please enter Last Name is required');
				$("#last_name").focus();
				return false;
			}
			if (email != '') {
				var c = validateEmail(email,'Email ID','email_id');
				if (c == false) {
					$("#email").focus();
					return c;
				}
			}
			if (mobile_no != '') {
				var d = validateContact(mobile_no,'Mobile Number');
				if (d == false) {
					$("#mobile_no").focus();
					return d;
				}
			}
			if (landline_no != '') {
				var e = validateContact(landline_no,'Landline Number');
				if (e == false) {
					$("#landline_no").focus();
					return e;
				}
			}
			

		});
		function validateEmail(val, field, id)
		{
		    var email = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
		    if (val.length > 0) {
		        if (val.match(email))
		        {
		            return true;
		        } else
		        {
		            swal("Please Enter valid " + field);
		            return false;
		           
		        }
		    } else
		    {
		        swal("Please Enter Valid " + field);
		        return false;
		    }
		}
		function validateContact(val, field)
			{
			    var mobile = /^\+?\d+$/;
			    var no = val;
			    if (no.match(mobile))
			    {
			        if ((no.length >= 10) && (no.length <= 15))
			        {
			            return true;
			        } else
			        {
			            swal("Please enter " + field + " of digits should not exceed 15");
			            return false;
			        }
			    } else
			    {
			        swal("Please enter " + field + " of digits should be number");
			        return false;
			    }
			}
	</script>

</body>
</html>