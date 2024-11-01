=== Sponsor Flipwall Shortcode ===
Contributors: atlanticbt, zaus
Donate link: http://atlanticbt.com
Tags: flipwall, sponsor flipwall, jquery, tiles
Requires at least: 2.8
Tested up to: 3.3.3
Stable tag: trunk
License: GPLv2 or later

Creates a cool sponsor wall with flip effect; instead of complicated post management, embed tiles anywhere with shortcodes!

== Description ==

Creates a cool sponsor wall with flip effect; instead of complicated post management, embed tiles anywhere with shortcodes!

Creates a two-sided square with a "logo side" and a "detail side".  Logo side will display a scaled image, while the detail side will show a name, description, and website link.

Based on awesome script [Sponsor Flip Wall with jQuery & CSS][] by Martin Angelov.  Not related to plugin [WP Sponsor Flip Wall][], which creates a content type in order to display tiles.


[Sponsor Flip Wall with jQuery & CSS]: http://tutorialzine.com/2010/03/sponsor-wall-flip-jquery-css/ "Original Inspiration"
[WP Sponsor Flip Wall]: http://wordpress.org/extend/plugins/wp-sponsor-flip-wall/ "You're going down!"

== Installation ==

1. Unzip, upload plugin folder to your plugins directory (`/wp-content/plugins/`)
2. Activate plugin
3. Add flipwall tile shortcode anywhere you need it.

== Frequently Asked Questions ==

= How do I make a flipwall tile? =

Use the shortcode!

= What is the shortcode? =

Use the following format:

    [flipwall
        id="image-name"
        title="Sponsor Name"
        url="http://whatever.com"
        linktext="Instead of whatever.com"
        image="url to image"
        text="description if singleline"
        class="optional tile class"
        target="_blank"
        ]
        Description with <em>HTML</em>
    [/flipwall]

where

* *id* = a unique identifier; if not provided just increments `flipwall-#`
* *title* = the name to display at the top of the "detail side"
* *url* = external link on "detail side"
* *linktext* = if provided, the text of the external link (instead of just showing the URL)
* *image* = url of the image for the "logo side"; if not provided will just display text "More about $title"
* *text* = optional - you can use this for a simpler shortcode if the description is just one line
* *class* = optional class to apply to the tile
* *target* = optional - set the link target (like _blank for new window)

Pretty much all of the attributes are optional:

    [flipwall]This tile has no attributes, just a description[/flipwall]
    
    [flipwall text="This is just a one-liner"]

But your resulting tiles wouldn't be very useful.

_Please note:_ if using the single-line version with `text`, you must either list all of them as such or list them at the end (due to the way shortcodes are closed in WP)

Also, if you want to use the default container, just wrap everything inside

    [flipwallgroup] ... [/flipwallgroup]

which will automatically clearfix the tiles.

= Can I change the defaults? =

Only one simple hook available:

* `add_filter('abtSponsorFlipwall_localize', YOURFN);`
    change the base javascript variables used by the flipwall init script:
    * `stylesheet`: replace the default stylesheet with your own to change the default appearance of tiles
    * `speed`: change the flip speed (from 350 ms)
    * `direction`: change the flip direction (from 'lr')

== Screenshots ==

1. Example shortcodes in different formats, with wrapper
2. Resulting front-end view of the shortcodes in screenshot 1

== Changelog ==

= 1.2.1 =

* just correcting the readme typo; shortcode for wrapper is `flipwallgroup`, *not* `flipwall-group` as pointed out by Chris Etzel.

= 1.2 =

* Added `target` attribute
* added handler check to ignore click behavior for links (i.e. tiles don't flip on link click)
* some attribute escaping

= 1.1 = 
Cleaned it up, screenshots, namespace changes, more options

= 1.0 =
Wrote it

== Upgrade Notice ==

= 1.2 =

Added handler check to ignore flip when clicking on links.  Please make sure this works in your browser.


== About AtlanticBT ==

From [About AtlanticBT][].

= Our Story =

> Atlantic Business Technologies, Inc. has been in existence since the relative infancy of the Internet.  Since March of 1998, Atlantic BT has become one of the largest and fastest growing web development companies in Raleigh, NC.  While our original business goal was to develop new software and systems for the medical and pharmaceutical industries, we quickly expanded into a business that provides fully customized, functional websites and Internet solutions to small, medium and larger national businesses.

> Our President, Jon Jordan, founded Atlantic BT on the philosophy that Internet solutions should be customized individually for each client's specialized needs.  Today we have expanded his vision to provide unique custom solutions to a growing account base of more than 600 clients.  We offer end-to-end solutions for all clients including professional business website design, e-commerce and programming solutions, business grade web hosting, web strategy and all facets of internet marketing.

= Who We Are =

> The Atlantic BT Team is made up of friendly and knowledgeable professionals in every department who, with their own unique talents, share a wealth of industry experience.  Because of this, Atlantic BT always has a specialist on hand to address each client's individual needs.  Due to the fact that the industry is constantly changing, all of our specialists continuously study the latest trends in all aspects of internet technology.   Thanks to our ongoing research in the web designing, programming, hosting and internet marketing fields, we are able to offer our clients the most recent and relevant ideas, suggestions and services.

[About AtlanticBT]: http://www.atlanticbt.com/company "The Company Atlantic BT"
[WP-Dev-Library]: http://wordpress.org/extend/plugins/wp-dev-library/ "Wordpress Developer Library Plugin"
