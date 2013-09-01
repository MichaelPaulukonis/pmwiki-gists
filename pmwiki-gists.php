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

    // if no named args, and is_numeric($arg)
    // then assume args in the id
    $inp = trim($inp);
    $undefined = 'undefined';

    $defaults = array('id'=>$undefined, 'hide_line_nbrs'=>$undefined,
                      'hide_footer'=>$undefined, 'line'=>$undefined,
                      'file'=>$undefined);

    /*
      TODO: implement the following
      DONE: hide line numbers - data-gist-hide-line-numbers="true"
      DONE: remove footer - data-gist-hide-footer="true"
      DONE: single file from gist with multiple files (note: must have sample gist with multiple files for testing and demo)
        data-gist-file="example-file2.html"
      DONE: single lineNbr - data-gist-line="2"
      DONE: range of lineNbrs - data-gist-line="2-4"
      DONE: single lineNbr _and_ range of lineNbrs - data-gist-line="1,3-4"
      DONE: list of lineNbrs (not nesc. contiguous) - data-gist-line="2,3,4"
      DONE: no [valid] ID supplied at all..... ???

     */

    $args = array_merge($defaults, ParseArgs($inp));
    $gistId = $args['id'];
    $hideLineNbrs = $args['hide_line_nbrs'];
    $line = $args['line'];
    $hidefooter = $args['hide_footer'];
    $file = $args['file'];
    $params = [];

    sms('inp: ' . $inp);
    sms('line: ' . $line);

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


// Debug function
function sms($text,$switch=0){
	global $MessagesFmt;
	if ($switch == true || is_array($text)) {
		$MessagesFmt[] = "<pre>" . print_r($text,true) . "</pre>\n";
	} else {
		$MessagesFmt[] = $text . "<br />\n";
	}
}