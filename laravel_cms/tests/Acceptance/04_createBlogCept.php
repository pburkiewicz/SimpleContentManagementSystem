<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('create page and add post');

$I->amOnPage('/login');
$I->fillField('email', 'john.doe@gmail.com');
$I->fillField('password', '12345678');
$I->click('#login');

$I->click('Create a page.');
$I->seeCurrentUrlEquals("/john_doe/pages/create");
//$I->fillField('page_type', 'blog');
$I->selectOption('page_type',"blog");
$I->fillField('page_name', 'tytul_strony');
$I->click("Add page");

$I->seeCurrentUrlEquals("/john_doe/tytul_strony/blog");
$I->see("No posts.");
$I->click("Create new...");

$I->seeCurrentUrlEquals("/john_doe/tytul_strony/blog/create");
$I->fillField('title', 'tytul_posta');
$I->fillField('contents', 'tresc posta: Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed et pulvinar ex. Pellentesque semper augue nisl, vel porttitor erat dictum. ');
//$I->fillField('image', 'lwy.jpg');
$I->fillField("description",'to jest obrazek przedstawiajacy lwy');
$I->click("Publish");

$I->seeCurrentUrlEquals("/john_doe/tytul_strony/blog/1");
$I->see("tytul_posta");
$I->see('tresc posta: Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed et pulvinar ex. Pellentesque semper augue nisl, vel porttitor erat dictum. ');
//$I->see('lwy.jpg');
//$I->see('to jest obrazek przedstawiajacy lwy');
$I->seeLink('edit');
//$I->see('Delete');
$I->see("Comments");
$I->seeLink("Add comment");
$I->see("No comments.");
//$I->click("Delete");


