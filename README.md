pmwiki-gists
============

Easily embed gists into your [pmwiki](http://www.pmwiki.org/wiki/) pages using only the gist ID.

Inspired by, and uses the javascript code from https://github.com/blairvanderhoof/gist-embed


## Markup examples

Working markup can be seen at http://www.xradiograph.com/PmWikiDevelopment/PmWikiGistsExamples


* Gist options:
### Loading a gist with undeclared id
* `(:gist 5457595 :)`
### Loading a gist with declared id parameter
* `(:gist id=5457595 :)`
### Loading a gist with all line numbers removed
* `(:gist id=5457605 hide_line_nbrs=true :)`
### Loading a gist with footer removed
* `(:gist id=5457619 hide_footer=true:)`
### Loading a gist with both footer and line numbers removed
* `(:gist id=5457629 hide_line_nbrs=true hide_footer=true:)`
### Loading a gist with multiple files
* `(:gist id=5457635:)`
### Loading a single file from a gist (example-file2.html)
* `(:gist id="5457644" file="example-file2.html":)`
### Loading a single line number from a gist (line 2)
* `(:gist id=5457662 line=2:)`
### Loading a range of line numbers from a gist (line 2 through 4)
* `(:gist id=5457652 line="2-4":)`
### Loading a single line and a range of line numbers from a gist (line 1 and line 3 through 4)
* `(:gist id=5457665 line="1,3-4":)`
### Loading a list of line numbers from a gist (line 2, 3, 4)
* `(:gist id=5457668 line="2,3,4":)`
### Don't load code element without a valid id attribute
* `(:gist 6361091a :)`


