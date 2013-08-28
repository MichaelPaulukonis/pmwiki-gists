/*
  jakefile.js for pmwiki-gists.php

  TODO: project-path should come from an external config file
  only default path-values should be committed to repo
  TODO: alternate paths should be available, so changes can be pushed to test installs
  
  */

var path = require('path');

// it would be nicer if this were in (an) external config(s)
//var target = "c:/dev/xampp/htdocs/projects/pmwikitest/cookbook";

var target = "c:/dev/xampp/htdocs/projects/xrad/projects/xradiograph.com/wiki/cookbook";

desc('This is a simple complete-project copy.');
task('default', [], function () {
    jake.cpR("pmwiki-gists.php", target);
    });