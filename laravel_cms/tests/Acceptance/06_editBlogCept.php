<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('edit and delete post');

$I->amOnPage("/john_doe/tytul_strony/blog/1");
$I->dontSeeLink('edit');
$I->dontSeeElement("#delete_post");

$I->amOnPage('/login');
$I->fillField('email', 'john.doe@gmail.com');
$I->fillField('password', '12345678');
$I->click('#login');
$I->amOnPage("/john_doe/tytul_strony/blog/1");

$I->click("edit");
$I->seeCurrentUrlEquals("/john_doe/tytul_strony/blog/1/edit");
$I->fillField('title', 'tytul2');
$I->fillField('contents', 'inna tresc posta: Litwo! Ojczyzno moja! Ty jesteś jak zdrowie. Nazywał się kiedyś demokratą. Bo nie szukać prawodawstwa w kuca. Obaczcież, co gród.');

//change path to dzik.jpg

//$I->fillField('image', '/home/student/php_2019_laravel_cms/laravel_cms/tests/Acceptance/dzik.jpg');
//$I->fillField("description",'to jest dzik');
$I->click("Publish");

$I->seeCurrentUrlEquals("/john_doe/tytul_strony/blog/1");
$I->dontSee("tytul_posta");
$I->dontSee('tresc posta: Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed et pulvinar ex. Pellentesque semper augue nisl, vel porttitor erat dictum.');
$I->seeElement("img");
//$I->dontSeeInSource('alt="lwy.jpg"');
//$I->dontSee('to jest obrazek przedstawiajacy lwy');

$I->see("tytul2");
$I->see('inna tresc posta: Litwo! Ojczyzno moja! Ty jesteś jak zdrowie. Nazywał się kiedyś demokratą. Bo nie szukać prawodawstwa w kuca. Obaczcież, co gród.');
$I->seeElement("img");
//$I->seeInSource('alt="dzik.jpg"');
//$I->see('to jest dzik');

$I->click("#delete_post");
$I->seeCurrentUrlEquals("/john_doe/tytul_strony/blog");
$I->see("No posts.");


