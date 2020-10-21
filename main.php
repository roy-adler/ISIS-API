<?php
require_once 'webscraper.php'; // for website crawling
$login_site = "https://shibboleth.tubit.tu-berlin.de/idp/profile/SAML2/Redirect/SSO?execution=e1s2";
$webscraper = new Webscraper($login_site);
$curled_text = $webscraper->curl();
echo $curled_text;
