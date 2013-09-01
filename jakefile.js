/*
  jakefile.js for pmwiki-gists.php

  TODO: project-path should come from an external config file
  only default path-values should be committed to repo
  TODO: alternate paths should be available, so changes can be pushed to test installs

  */

var path = require('path');
var fs = require('fs');
var config = require('./config');

// it would be nicer if this were in (an) external config(s)
// var targetWikiTest = "c:/dev/xampp/htdocs/projects/pmwikitest/cookbook";
// var targetXrad = "c:/dev/xampp/htdocs/projects/xrad/projects/xradiograph.com/wiki/cookbook";

desc('This is a simple complete-project copy.');
task('default', [], function () {
    push(config.target[wikitest]);
    });


desc('Push the project (no ignore) to the config location passed in..');
task('push', [], function (location) {
    console.log(location);
    if (config.target[location] == undefined) {
        console.error(location + ' is not a valid location. Try one of the following:');
        console.log(config.target);
        return;
    }
    // console.log(config.target[location]);
    push(config.target[location]);
    });



var push = function(target) {
    // TODO: this is more complicated
    // we want to ignore things. or only hit certain things. :::sigh:::
    jake.mkdirP(target);
    jake.cpR("./", target);
    };


desc('List the config file');
task('dump', [], function() {
    console.log(config);
    });



desc('Zip up the project.');
task('zip', [], function() {
    var AdmZip = require('adm-zip');
    var zip = new AdmZip();
    zip.addLocalFile('pmwiki-gists.php');
    zip.writeZip('pmwiki-gists.zip');
    });
