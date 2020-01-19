<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('edit and delete post');

$I->amOnPage("/john_doe/tytul_strony/gallery/2");
$I->dontSeeLink('edit');
$I->dontSeeElement("#delete_post");

$I->amOnPage('/login');
$I->fillField('email', 'john.doe@gmail.com');
$I->fillField('password', '12345678');
$I->click('#login');
$I->amOnPage("/john_doe/tytul_strony/gallery/2");

$I->click("edit");
$I->seeCurrentUrlEquals("/john_doe/tytul_strony/gallery/2/edit");
$I->fillField('title', 'tytul2');

//change path to dzik.jpg

$I->fillField('image', '/home/student/php_2019_laravel_cms/laravel_cms/tests/Acceptance/dzik.jpg');
$I->fillField("description",'to jest dzik');
$I->click("Publish");

$I->seeCurrentUrlEquals("/john_doe/tytul_strony/gallery/2");
$I->dontSee("tytul_posta");
$I->seeElement("img");
$I->dontSeeInSource('alt="lwy.jpg"');
$I->dontSee('to jest obrazek przedstawiajacy lwy');

$I->see("tytul2");
$I->seeElement("img");
$I->seeInSource('alt="dzik.jpg"');
$I->see('to jest dzik');

$I->click("#delete_post");
$I->seeCurrentUrlEquals("/john_doe/tytul_strony/gallery");
$I->see("No posts.");

