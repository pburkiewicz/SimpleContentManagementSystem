<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('create, edit and delete blank page');

$I->amOnPage('/login');
$I->fillField('email', 'john.doe@gmail.com');
$I->fillField('password', '12345678');
$I->click('#login');

$I->click('Create a page.');
$I->seeCurrentUrlEquals("/john_doe/pages/create");
$I->selectOption('page_type',"blank");

$I->click("Add page");
$I->seeCurrentUrlEquals("/john_doe/pages/create");

$I->fillField('page_name', 'spacja spacja');
$I->selectOption('page_type',"blank");
$I->click("Add page");
$I->see("The page name may only contain letters, numbers, dashes and underscores.");
$I->seeCurrentUrlEquals("/john_doe/pages/create");

$I->fillField('page_name', '*+-%=:;');
$I->selectOption('page_type',"blank");
$I->click("Add page");
$I->see("The page name may only contain letters, numbers, dashes and underscores.");
$I->seeCurrentUrlEquals("/john_doe/pages/create");

$I->fillField('page_name', '\\/');
$I->selectOption('page_type',"blank");
$I->click("Add page");
$I->see("The page name may only contain letters, numbers, dashes and underscores.");
$I->seeCurrentUrlEquals("/john_doe/pages/create");

$I->fillField('page_name', "''\"\"");
$I->selectOption('page_type',"blank");
$I->click("Add page");
$I->see("The page name may only contain letters, numbers, dashes and underscores.");
$I->seeCurrentUrlEquals("/john_doe/pages/create");

$I->fillField('page_name', '?!.,');
$I->selectOption('page_type',"blank");
$I->click("Add page");
$I->see("The page name may only contain letters, numbers, dashes and underscores.");
$I->seeCurrentUrlEquals("/john_doe/pages/create");

$I->fillField('page_name', '$@');
$I->selectOption('page_type',"blank");
$I->click("Add page");
$I->see("The page name may only contain letters, numbers, dashes and underscores.");
$I->seeCurrentUrlEquals("/john_doe/pages/create");

$I->fillField('page_name', '(){}[]');
$I->selectOption('page_type',"blank");
$I->click("Add page");
$I->see("The page name may only contain letters, numbers, dashes and underscores.");
$I->seeCurrentUrlEquals("/john_doe/pages/create");

$I->fillField('page_name', 'john_doe');
$I->selectOption('page_type',"blank");
$I->click("Add page");
$I->see("The page name has already been taken.");
$I->seeCurrentUrlEquals("/john_doe/pages/create");

$I->fillField('page_name', 'tytul_str');
$I->selectOption('page_type',"blank");
$I->click("Add page");

$I->seeCurrentUrlEquals("/john_doe/tytul_str/blank");
$I->click("Create your own HTML");

$I->seeCurrentUrlEquals("/john_doe/tytul_str/blank/create");
$I->click("Publish");
$I->seeCurrentUrlEquals("/john_doe/tytul_str/blank/create");
$I->fillField('contents',"kod html");
$I->click("Publish");

$I->see("kod html");
$I->seeCurrentUrlEquals("/john_doe/tytul_str/blank");
$I->click("Edit your HTML");
$I->seeCurrentUrlEquals("/john_doe/tytul_str/blank/1/edit");

//kod html from plik.html

$I->fillField('contents',"<html><body><h1>Main heading</h1><p>Be <b>bold</b> in stating your key points. Put them in a list: </p><ul><li>The first item in your list</li><li>The second item; <i>italicize</i> key words</li><li>element</li><li>element</li><li>element</li><li><ol><li>The first item in your list</li><li>The second item; <i>italicize</i> key words</li><li>element</li><li>element</li><li>element</li></ol></li></ul><p>Improve your image by including an image. </p><p><img src=\"https://ocdn.eu/pulscms-transforms/1/zOkktkqTURBXy81ZWIzZWU2MDIzZjVkOTM4OGRiN2IwNWQwNTYxODEyMy5qcGVnkpUCzQPAAMLDlQIAzQPAwsM\" alt=\"kitty\"></p>.Break up your page with a horizontal rule or two. </p><hr><p>Finally, link to <a href=\"https://pl.wikipedia.org/wiki/Kleczanów\">another page</a> </p></html>");

$I->click("Publish");
$I->dontSee("kod html");
$I->seeCurrentUrlEquals("/john_doe/tytul_str/blank");

$I->see("Main heading");
$I->seeElement("img");
$I->seeInSource('alt="kitty"');
$I->see('Break up your page with a horizontal rule or two');
$I->seeLink('another page');

$I->click("Home");
$I->click("Manage your website");
$I->click('#delete_post');
$I->dontSee("tytul_str - blank");


