<?php
/**
 * Created by PhpStorm.
 * User: abjurstrom
 * Date: 1/2/14
 * Time: 3:52 PM
 */

$output = array();

$output[] = getcwd();
chdir('/home/public/gitest/ecc');
$output[] = getcwd();
$output[] = shell_exec('git reset --hard HEAD');
$output[] = shell_exec('git pull https://github.com/abjurstrom/ecc.git master');

echo '<pre>';
print_r($output);
echo '</pre>';