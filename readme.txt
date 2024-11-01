=== vB User Copy ===
Contributors: Arimil
Donate link: http://arch-games.com
Tags: vB, vBulletin, vbulletin, vb, transfer, user, users
Requires at least: 3.1
Tested up to: 3.1
Stable tag: trunk

Converts vBulletin users to WordPress users.

== Description ==

This plugin converts vBulletin users and makes them Wordpress accounts. If you run the importer and remove this plugin users that you have imported that have not logged in will be unable to log in. 

== Installation ==

1. Upload the vb-user-copy folder to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Set your vBulletin table prefix in 'Settings' -> 'vB User Copy'.
1. Save your table prefix and click the import users button.

== Frequently Asked Questions ==

= Can I import users from another database? =

It currently is not supported, this is only able to import users if Wordpress is installed in the same database.

= Can I drop the vBulletin user table after I run this? =

This currently doesn't copy users passwords to Wordpress and check them there, it checks their password after grabbing it from the vBulletin user table. So, no but this isn't that hard to implement if you'd be interested in me adding this let me know.

= Is this a Wordpress/vBulletin bridge? =

No, it only copies users from vBulletin to Wordpress. If someone were to register on the forums after doing the user import they would not have a Wordpress account unless you ran the importer again. **I don't recommend running the importer more than once**. You should make a custom registration page and point both Wordpress and vBulletin to that page. Which would then add their user data to both databases.

== Screenshots ==

== Changelog ==

= 0.8 =
* Fixed a bug where one of the queries was not using the user specified prefix. - Thanks Thirdstyle

= 0.7 =
* Code cleaned up, no new features.

= 0.6 =
* First release, plugin includes basic functionality.

== Upgrade Notice ==

= 0.6 =
* Initial Release