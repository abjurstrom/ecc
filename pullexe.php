<?php
/**
 * Created by PhpStorm.
 * User: abjurstrom
 * Date: 1/2/14
 * Time: 3:52 PM
 */

$output = array();
$return_status = array();
$output[] = getcwd();
chdir('/home/public/gitest/ecc');
$output[] = getcwd();

passthru('git reset --hard HEAD', $return_status['reset']);
passthru('git pull https://github.com/abjurstrom/ecc.git master', $return_status['pull']);

echo '<pre>';
print_r($output);
echo PHP_EOL;
var_dump($return_status['reset']);
echo PHP_EOL;
var_dump($return_status['pull']);
echo '</pre>';