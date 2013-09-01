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

function IncludeGist($inp) {

    global $HTMLFooterFmt;
    $HTMLFooterFmt['gist'] = '<script>window.jQuery || document.write("<script src=\'//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js\'>\x3C/script>")</script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/gist-embed/1.3/gist-embed.min.js"></script>';

    // TODO: parse-args

    // if no named args, and is_numeric($arg)
    // then assume args in the id
    $inp = trim($inp);
    $undefined = 'undefined';

    $defaults = array('id'=>$undefined);

    /*
      TODO: implement the following
      hide line numbers
      remove footer
      single file from gist with multiple files (note: must have sample gist with multiple files for testing and demo)
      single lineNbr
      range of lineNbrs
      single lineNbr _and_ range of lineNbrs
      list of lineNbrs (not nesc. contiguous)
      no ID supplied at all..... ???

     */

    $args = array_merge($defaults, ParseArgs($inp));
    $gistId = $args['id'];

    if ($gistId == $undefined) {
        $gistId = $inp;
    }

    $gist = sprintf('<code data-gist-id="%s"></code>', $gistId);

    return $gist;
}