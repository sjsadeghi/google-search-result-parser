<?php
require('core/Parser.php');

$parser = new Parser('sajjad sadeghi', 20);
$result = $parser->parse();
echo "<pre>";
var_dump($result);
