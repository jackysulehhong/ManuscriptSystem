<?php
require 'vendor/autoload.php';

use Goutte\Client;

$client = new Client();

$crawler = $client->request('GET', 'https://digital.nhs.uk/data-and-information/publications/statistical/compendium-mortality/current/mortality-from-breast-cancer/mortality-from-breast-cancer-crude-death-rate-by-age-group-3-year-average-f');
/*
$links = $crawler->evaluate('//div[@id="article-section"]/div[@id="list"]');
$link2 = $crawler->selectLink('Security Advisories')->link();
echo $link2;
foreach ($links as $link) {
echo $link->textContent.PHP_EOL;
}*/
//https://hackernoon.com/php-web-scraping-using-goutte-6u1a3uwv
//https://symfony.com/doc/current/components/dom_crawler.html#node-traversing
//https://stackoverflow.com/questions/29073923/issue-with-scraping-a-list-to-get-href-using-goutte-and-php
$csv = [];

$crawler->filter('.article-section>.list>li>a')->each(function ($node) {
 //This additional check is to determine we only get repo name
 $link = $node->attr('href');
 if (str_ends_with($link, ".csv")) {
  $GLOBALS['csv'][] = $link;
 };
});
if (!empty($csv)) {
 $url = $csv[0];
 //https://www.geeksforgeeks.org/download-file-from-url-using-php/
 // Use basename() function to return the base name of file
 $file_name = basename($url);

 // Use file_get_contents() function to get the file
 // from url and use file_put_contents() function to
 // save the file by using base name
 if (file_put_contents($file_name, file_get_contents($url))) {
  echo "File downloaded successfully";
 } else {
  echo "File downloading failed.";
 }
} else {
 echo "No data found!";
}