<div class="wrap">

	<?php include 'dd.php'; ?>

	<div id="icon-plugins" class="icon32"></div>
	<h2>Easy Google Analytics Code</h2>
	
	<?php

	if (isset($_POST['code']))
	{
		$code = mysql_real_escape_string($_POST['code']);
	
		$wpdb->query("update ".$wpdb->prefix."dd_easy_anal set `value`='$code' where `variable`='code'");

		echo '<div class="updated"><p>Your Google Analytics code has been updated.</p></div>';
	}
	
	$code = stripslashes($wpdb->get_var( $wpdb->prepare("select `value` from ".$wpdb->prefix."dd_easy_anal where `variable`='code'")));

	?>
	
	<p>Enter your Google Analytics code in the textarea below.</p>

	<form method="post">

	<table class="form-table">
	
	<tr valign="top">
	<th scope="row">Google Analytics Code</th>
	<td><textarea name="code" rows="15" cols="120"><?php echo $code; ?></textarea></td>
	</tr>
	
	</table>

	<p class="submit">
	<input type="submit" value="Submit" class="button-primary" />
	</p>

	</form>

</div>