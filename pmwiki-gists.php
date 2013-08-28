<?php if (!defined('PmWiki')) exit();
/*
Embed gists into your pmwiki pages with the markup (:gist <id> :)

Copyright 2013 Michael Paulukonis http://michaelpaulukonis.com

Uses code from https://github.com/blairvanderhoof/gist-embed


This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published
by the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.
*/

$RecipeInfo['pmwiki-gists']['Version'] = '2013-08-27';


Markup('gist', 'directives',
       '/\\(:gist(\\s+.*?)?:\\)/ei',
       "IncludeGist(PSS('$1'))");

function IncludeGist($arg) {

    global $HTMLFooterFmt;
    $HTMLFooterFmt['gist'] = '<script>window.jQuery || document.write("<script src=\'//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js\'>\x3C/script>")</script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/gist-embed/1.3/gist-embed.min.js"></script>';

    $gist = sprintf('<code data-gist-id="%s"></code>', trim($arg));

    return $gist;
}