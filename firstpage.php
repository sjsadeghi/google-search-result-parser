<?php
require('Parser.php');
// Create DOM from URL
$parser=new Parser(urlencode('sajjad sadeghi'),20);
$result=$parser->parse();
echo "<pre>";
var_dump($result);
