<div id="forms">
	<div class="form" id="login">
		<form action="index.php" method="POST">
			<input type="text" name="l_user" maxlength="50" placeholder="Username or Email"></input>
			<input type="password" name="l_password" maxlength="50" placeholder="Password"></input>
			<br /><br />
			<input type="submit" name="login" value="Log in"></input>	
		<a href="#">forgot your password?</a>
		</form>
	</div>

	<div class="form" id="signup" accept-charset="utf-8">
		<form action="index.php" method="POST">
			<div id="reg_user_datas">
				<input type="text" name="r_username" maxlength="15" placeholder="Username" autocomplete="off"></input>
				<input type="text" name="r_email" maxlength="50" placeholder="Email" autocomplete="off"></input>
			    <div id="X1" class="error errorBox"></div>
			</div>
			<div id="reg_passwords">
				<input type="password" name="r_password" maxlength="50" placeholder="Password"></input>
				<input type="password" name="r_password_again" maxlength="50" placeholder="Password again"></input>
				<div id="X2" class="error errorBox"></div>
			</div>

			<input class="error disabled" type="submit" name="signup" disabled="disabled" value="Sign Up" autocomplete="off" ></input>
		</form>
	</div>

	<br />
	<div id="or" class="clickString">or register</div>
	<div id="form_error"></div>
</div>

