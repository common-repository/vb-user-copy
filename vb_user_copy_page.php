<div class="wrap">
	<h2>vBulletin User Transfer</h2>
	<form name="vb_transfer_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
		<input type="hidden" name="vb_transfer_options">
		<h4>Database Settings</h4>
		<!-- NOT IMPLEMENTED
		<p>Database host:<input type="text" name="vb_transfer_dbhost" value="<?php echo $vb_dbhost; ?>" size="20"></p>
		<p>Database name:<input type="text" name="vb_transfer_dbname" value="<?php echo $vb_dbname; ?>" size="20"></p>
		<p>Database user:<input type="text" name="vb_transfer_dbuser" value="<?php echo $vb_dbuser; ?>" size="20"></p>
		<p>Database password:<input type="text" name="vb_transfer_dbpwd" value="<?php echo $vb_dbpwd; ?>" size="20"></p>
		-->
		<p>vBulletin Prefix:<input type="text" name="vb_transfer_dbprfx" value="<?php echo $vb_dbprfx; ?>" size="20"></p>
		<div class="submit">
		<input type="submit" name="Submit" value="Save" />
		</div>
	</form>
	<hr>
	<form name="vb_transfer_users" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
		<input type="hidden" name="vb_user_import">
		<div class="submit">
		<input type="submit" name="Submit" value="Import Users" />
		</div>
	</form>
</div>