<?php session_start() ?>
<div class="container-fluid">
	<form action="" id="login-frm">
		<div class="form-group">
			<label for="" class="control-label">Email</label>
			<input type="email" name="username" required="" class="form-control">
		</div>
		<div class="form-group">
			<label for="" class="control-label">Password</label>
			<input type="password" name="password" required="" class="form-control">
			<small><a href="index.php?page=signup" id="new_account">Create New Account</a></small>
		</div>
		<button class="button btn btn-info btn-sm">Login</button>
		<div class="d-flex justify-content-between">
							<a href="..//alumni/admin/login.php">Admin</a>
							<button class="btn-sm btn-block btn-wave col-md-4 btn-primary">Login</button>
						</div>
	</form>
</div>

<style>
	#uni_modal .modal-footer {
		display: none;
	}
</style>

<script>
	$('#login-frm').submit(function(e) {
		e.preventDefault()
		$('#login-frm button[type="submit"]').attr('disabled', true).html('Logging in...');
		if ($(this).find('.alert-danger').length > 0)
			$(this).find('.alert-danger').remove();
		$.ajax({
			url: 'admin/ajax.php?action=login2',
			method: 'POST',
			data: $(this).serialize(),
			error: err => {
				console.log(err)
				$('#login-frm button[type="submit"]').removeAttr('disabled').html('Login');

			},
			success: function(resp) {
				if (resp == 1) {
					location.href = '<?php echo isset($_GET['redirect']) ? $_GET['redirect'] : 'index.php?page=home' ?>';
				} else if (resp == 2) {
					$('#login-frm').prepend('<div class="alert alert-danger">Your account is not yet verified.</div>')
					$('#login-frm button[type="submit"]').removeAttr('disabled').html('Login');
				} else {
					$('#login-frm').prepend('<div class="alert alert-danger">Email or password is incorrect.</div>')
					$('#login-frm button[type="submit"]').removeAttr('disabled').html('Login');
				}
			}
		})
	})

	$(document).keydown(function(event) {
		// Check if the key pressed is 'H' and the Shift key is pressed
		if (event.key === 'H' && event.shiftKey || event.key === 'h' && event.shiftKey) {
			// Redirect to the homepage
			window.location.href = '';
		}
		// Check if the key pressed is 'A' and the Shift key is pressed
		else if (event.key === 'A' && event.shiftKey || event.key === 'a' && event.shiftKey) {
			// Redirect to the admin page
			window.location.href = 'admin/index.php';
		}
	});
</script>