<?php if (!defined('PmWiki')) exit();
/*
Embed gists into your pmwiki pages with the markup (:gist is=<gist-id> :)

Copyright 2013 Michael Paulukonis http://michaelpaulukonis.com

Uses code from https://github.com/blairvanderhoof/gist-embed
Actually, it's pretty much of a PmWiki markup-wrapper for gist-embed.
All rights respective to gist-embed remain with the project authors.

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published
by the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.
*/

$RecipeInfo['pmwiki-gists']['Version'] = '2013-09-01';


Markup('gist', 'directives',
       '/\\(:gist(\\s+.*?)?:\\)/ei',
       "IncludeGist(PSS('$1'))");

function IncludeGist($inp) {

    $inp = trim($inp);
    $undefined = 'undefined';

    $defaults = array('id'=>$undefined, 'hide_line_nbrs'=>$undefined,
                      'hide_footer'=>$undefined, 'line'=>$undefined,
                      'file'=>$undefined);

    $args = array_merge($defaults, ParseArgs($inp));
    $gistId = $args['id'];
    $hideLineNbrs = $args['hide_line_nbrs'];
    $line = $args['line'];
    $hidefooter = $args['hide_footer'];
    $file = $args['file'];
    $params = array();

    //sms('inp: ' . $inp);

    if ($gistId == $undefined) {
        $gistId = $inp;
    }

    if ($hideLineNbrs == 'true') {
        array_push($params, 'data-gist-hide-line-numbers="true"');
    }

    if ($hidefooter == 'true') {
        array_push($params, 'data-gist-hide-footer="true"');
    }

    if ($line != $undefined) {
        array_push($params, sprintf('data-gist-line="%s"', $line));
    }

    if ($file != $undefined) {
        array_push($params, sprintf('data-gist-file="%s"', $file));
    }


    if (is_numeric($gistId)) {

        array_push($params, sprintf('data-gist-id="%s"', $gistId));

        $gist = sprintf('<code %s></code>', implode($params, ' ') );

        global $HTMLFooterFmt;
        $HTMLFooterFmt['gist'] = '<script>window.jQuery || document.write("<script src=\'//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js\'>\x3C/script>")</script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/gist-embed/1.3/gist-embed.min.js"></script>';

    }

    return $gist;
}


// Debug function - dumps to the (:messages:) markup, if present
function sms($text,$switch=0){
	global $MessagesFmt;
	if ($switch == true || is_array($text)) {
		$MessagesFmt[] = "<pre>" . print_r($text,true) . "</pre>\n";
	} else {
		$MessagesFmt[] = $text . "<br />\n";
	}
}