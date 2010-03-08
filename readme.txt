=== Simple Twitter Connect ===
Contributors: Otto
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=otto%40ottodestruct%2ecom
Tags: twitter, connect, simple, otto, otto42, javascript
Requires at least: 2.9
Tested up to: 2.9.2
Stable tag: 0.3.1

== Description ==

Simple Twitter Connect is a series of plugins that let you add any sort of Twitter functionality you like to a WordPress blog. This lets you have an integrated site without a lot of coding, and still letting you customize it exactly the way you'd like.

First, you activate and set up the base plugin, which makes your site have basic Twitter functionality. Then, each of the add-on plugins will let you add small pieces of specific Twitter-related functionality, one by one.

Requires WordPress 2.9 and PHP 5. 

**Current add-ons**

* Login using Twitter
* Comment using Twitter credentials
* Users can auto-tweet their comments

**Coming soon** 

* Auto-tweet new posts to an account
* (Got more ideas? Tell me!)

If you have suggestions for a new add-on, feel free to email me at otto@ottodestruct.com .

Want regular updates? Become a fan of my sites on Facebook!
http://www.facebook.com/apps/application.php?id=116002660893
http://www.facebook.com/apps/application.php?id=334947428931

Or follow my sites on Twitter!
http://twitter.com/ottodestruct

== Installation ==

1. Upload the files to the `/wp-content/plugins/simple-twitter-connect/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress

== Frequently Asked Questions ==

= Whoa, what's with all these plugins? =

The principle behind this plugin is to enable small pieces of Twitter functionality, one at a time.

Thus, you have the base plugin, which does nothing except to enable your site for Twitter OAuth in general. It's required by all the other plugins.

Then you have individual plugins, one for each piece of functionality. One for enabling comments, one for adding Login, etc. These are all smaller and simpler, for the most part, because they don't have to add all the Twitter connections stuff that the base plugin adds.

= The comments plugin isn't working! =

You have to modify your theme to use the comments plugin.

In your comments.php file (or wherever your comments form is), you need to do the following.

1. Find the three inputs for the author, email, and url information. They need to have those ID's on the inputs (author, email, url). This is what the default theme and all standardized themes use, but some may be slightly different. You'll have to alter them to have these ID's in that case.

2. Just before the first input, add this code:
[div id="comment-user-details"]
[?php do_action('alt_comment_login'); ?]

(Replace the []'s with normal html greater/less than signs).

3. Just below the last input (not the comment text area, just the name/email/url inputs, add this:
[/div]

That will add the necessary pieces to allow the script to work.

Hopefully, a future version of WordPress will make this simpler.

= Twitter Avatars look wrong. =

Twitter avatars use slightly different code than other avatars. They should style the same, but not all themes will have this working properly, due to various theme designs and such. 

However, it is almost always possible to correct this with some simple CSS adjustments. For this reason, they are given a special "twitter-avatar" class, for you to use to style them as you need. Just use .twitter-avatar in your CSS and add styling rules to correct those specific avatars.

= Why can't I email people who comment using Twitter? =

Twitter offers no way to get a valid email address for a user. So the comments plugin uses a fake address of the twitter's username @fake.twitter.com. The "fake" is the giveaway here.

= When users connect using Twitter on the Comments section, there's a delay before their info appears. =

Yes. In order to make the plugin more compatible with caching plugins like WP-Super-Cache, the data for a Twitter connect account is retreived from the server using an AJAX request. This means that there will be a slight delay while the data is retrieved, but the page has already been loaded and displayed. Most of the time this will not be noticable.

= Why does the settings screen warn me that I don't have a URL shortener plugin? =

Simple Twitter Connect does not implement a URL shortening service in favor of letting other plugins implement one for it. A shortener plugin should implement the "get_permalink" function for it to be detected. 

The WordPress.com stats plugin implements this, and it provides shortlinks to "wp.me" URLs. If you wish to use another shortener plugin, tell that plugin's author to implement this same standard, and the plugin will automatically be detected and used by Simple Twitter Connect.

The standard is "function get_shortlink($post_id)" where the function returns the shortlink as a string. This should be trivally easy to implement for any plugin author.

== Screenshots ==

1. Login screen showing both Simple Facebook Connect and Simple Twitter Connect login buttons.
2. Twitter Connect on My Profile screen.
3. Simple Facebook Connect and Simple Twitter Connect button on comments form.
4. Login info (before styling) after using Twitter connect button on comments form.

== Upgrade Notice ==

== Changelog ==

= 0.4 =
* Warning about shortlinks.

= 0.3.1 =
* Fixed error in 0.3 that caused comments to not load on some server configurations.

= 0.3 =
* Fix logout bug and comments bug.
* Remove person extensions. They don't work right anyway. Revisit later.
* Add urlencoding to fix login for some odd server configurations.

= 0.2 =
* Login security issue fixed.
* Logout link added to comments.
* Minor internal design changes.

= 0.1 =

* Initial release
