=== SitePoint Random Hello Bar ===
Contributors: sitepointdevs
Tags: ads, advertising, marketing, products
Requires at least: 3.0
Tested up to: 4.3
Stable tag: 1.0.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Randomly (with weighting) shows a hello bar message on page scroll.

== Description ==

As descibed in-depth on [SitePoint](http://www.sitepoint.com/sitepoint-random-hello-bar-wordpress-plugin/) a hello bar is a thin bar of content that slides into view once the user scrolls past a set point on a page.
The message content is up to you, but is ideal for advertising, product annoncements or other messages.

This plugin provides an admin interface to create multiple hello bar messages that can then be randomly displayed on user facing pages.

By setting weightings for each message you can determine how often each is displayed. On each page load a message is randomly selected
(respecting the weightings given). A random number is generated client side before fetching the message content to ensure it is compatible
with caching services such as W3 Total Cache.

All the required javascript and css is included in the plugin and can be set to enqueue via settings.
Alternatively you can roll your own. To help with that the core javascript has been extracted into the [sp-hello-bar](https://www.npmjs.com/package/sp-hello-bar)
npm module for you to include in your own scripts.

== Installation ==

1. Upload the entire `/sp-random-hello-bar/` folder to the `/wp-content/plugins/` directory.
1. Activate the plugin through the 'Plugins' menu in WordPress.
1. Navigate to the **SP Random Hello Bar** section of the *Settings* menu. At `example.com` this page would be found at `http://example.com/wp-admin/options-general.php?page=sp-random-hello-bar`.
1. Enable the hello bar to display in pages.
1. Select which javascript, if any, you would like to enqueue.
1. Select if you would like to enqueue basic css styles fror the hello bar.
1. Enter content for one or more hello bars and set a weighting.

== Frequently Asked Questions ==

= Can I use the javascript module without npm? =

Sure. The plugin contains the SpHelloBar source as an ES6 Module at `src/js/SpHelloBar.js` and as a common.js module at `lib/SpHelloBar.js`.

= Does the javascript require other libraries such as jQuery to function? =

The SpHelloBar module does not have any external dependencies but it would then be up to you to provide a throttle function and to load the hello bar content into the page (usually via ajax).
However the Basic and Basic with storage scripts assume that jquery and underscore have been enqueued. Those two libraries are enqueued in the default setup of WordPress unless you have dequeued them.

= Can I customise the content? =

Go for it. The basic scripts assume the default css class names are being used but the only one that is required is `.SpHelloBar`.
The javascript has been designed to be as flexible as possible so see the [docs](https://github.com/sitepoint/sp-random-hello-bar#constructor) for all the options that can be overridden
when writing your own script.

= How did you build something so wonderful? =

I'm glad you asked. You can read about how it was put together on [SitePoint](http://www.sitepoint.com/sitepoint-random-hello-bar-wordpress-plugin/).


== Screenshots ==

1. **Hello Bar in use** - An example hello bar being displayed on the Twenty Fifteen theme.
2. **SP Random Hello Bar Submenu**
3. **Settings** - Quickly enable the hello bar feature and chose what js/css to enqueue.
4. **Content** - Add as many hello bars as you wish.

== Changelog ==

= 0.0.1 =
* Submitted to WordPress for approval

= 0.0.2 =
* Added assets

= 1.0.0 =
* Ready for use
