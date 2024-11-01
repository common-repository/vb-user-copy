<?php
	if(isset($_POST['vb_transfer_options'])){
		update_option('vb_dbhost', $_POST['vb_transfer_dbhost']);
		update_option('vb_dbname', $_POST['vb_transfer_dbname']);
		update_option('vb_dbuser', $_POST['vb_transfer_dbuser']);
		update_option('vb_dbpwd', $_POST['vb_transfer_dbpwd']);
		update_option('vb_dbprfx', $_POST['vb_transfer_dbprfx']);
		echo '<div class="updated"><p><strong>Options saved</strong></p></div>';
	}
	$vb_dbhost = get_option('vb_dbhost');
	$vb_dbname = get_option('vb_dbname');
	$vb_dbuser = get_option('vb_dbuser');
	$vb_dbpwd = get_option('vb_dbpwd');
	$vb_dbprfx = get_option('vb_dbprfx');
	//Start User Import
	if (isset($_POST['vb_user_import'])){
		global $wpdb;
		$tablecheck = @$wpdb->get_results("SELECT * FROM ".get_option('vb_dbprfx')."user");
		if ($tablecheck){
			$limit = (isset($_POST['limit']) ? $_POST['limit'] : 0);
			$users = $wpdb->get_results("SELECT username, email, joindate, password FROM `".get_option('vb_dbprfx')."user` LIMIT ".$limit.", 100");
			if ($users){
				echo '<div class="wrap">';
				foreach ($users as $user){
					$name = $wpdb->get_results("SELECT `user_login` FROM `".$wpdb->prefix."users` WHERE `user_login` = '$user->username'");
					if (!$name){
						wp_insert_user(array( 'ID' => '', 'user_login' => $user->username, 'user_pass' => '', 'user_nicename' => $user->username, 'user_email' => $user->email,  'user_url' => '', 'user_registered' => date('Y-m-d H:i:s', $user->joindate), 'user_activation_key' => '', 'user_status' => '', 'display_name' => $user->username));
						echo $user->username.' added successfully.<br>';
					}
					else{
						echo $user->username.' already exists.<br>';
					}
				}
				echo '</div>';
?>
			<script type="text/javascript">
			onload = function(){
				document.getElementsByName("vb_transfer_users")[0].submit();
			}
			</script>
			<form name="vb_transfer_users" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
				<input type="hidden" name="vb_user_import">
				<input type="hidden" name="limit" value="<?php echo $limit + 100; ?>">
				<div class="submit">
				<input type="submit" name="Submit" value="Import Users" />
				</div>
			</form>
<?php
			}
			else{
			echo '<div class="updated"><p><strong>Users imported successfully.</strong></p></div>';
			include (plugin_dir_path(__FILE__) . '/vb_user_copy_page.php');
			}
		}
		else{
			echo '<div class="error"><p><strong>The table '.get_option('vb_dbprfx').'user doesn\'t exist.</strong></p></div>';
			include (plugin_dir_path(__FILE__) . '/vb_user_copy_page.php');		
		}
	}
	//End User Import
	else{
		include (plugin_dir_path(__FILE__) . '/vb_user_copy_page.php');
	}
?>