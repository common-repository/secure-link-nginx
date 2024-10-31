=== Secure Link for Nginx ===
Contributors: mhansent
Donate link:
Tags: shortcode, link
Requires at least: 4.6
Tested up to: 4.9
Stable tag: 20181121
Requires PHP: 5.2.4
License: GPLv3 or later
License URI: https://www.gnu.org/licenses/gpl.html

Secure Link for Nginx is a shortcode plugin for Wordpress to embed hash code for
links/files that want to be protected

== Description ==

[Secure Link for Nginx](https://gitlab.com/mhansent/secure-link-nginx) is a
shortcode plugin for Wordpress to embed hash code for link that want to be
protected. Protectition based on client IP and user agent. This plugin must be
use when nginx web server already configured with
[secure link module](http://nginx.org/en/docs/http/ngx_http_secure_link_module.html)

#### Using shortcode
Shortcode can be use with parameter or without it. Suppose you want to protect
img.png file under /secure folder, using with parameter:
```
<img class="" src="/secure/img.png[sln_create slfile='/secure/img.png']" />
```
using it whitout parameter:
```
<img class="" src="[sln_create]/secure/img.png[/sln_create]" />
```

== Installation ==

We use this asumption when configuring nginx and using this plugin at wordpress
post:
- Folder that want to secure is /secure under wordpress folder

1. Upload the plugin files to the `/wp-content/plugins/secure-link-nginx`
   directory, or install this Secure Link fo Nginx plugin through the WordPress
   plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress
3. Configure nginx as a below

#### Nginx configuration
Under your wordpress configuration at nginx, add this configuration:

```
location /secure {
	secure_link $arg_sln;
	secure_link_md5 "$uri$remote_addr$http_user_agent";

	if ($secure_link = "") { return 403; }
	if ($secure_link = "0") { return 410; }
}
```
