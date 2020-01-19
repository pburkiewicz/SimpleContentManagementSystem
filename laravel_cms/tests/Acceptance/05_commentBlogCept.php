<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('add, edit, delete comment');

$I->amOnPage("/john_doe/tytul_strony/blog/1");

$I->click("Add comment");
$I->seeCurrentUrlEquals("/john_doe/tytul_strony/blog/1/comments/create");
$I->fillField("#contents","komentarz pod postem od anonimowego uzytkownika");
$I->click("Add comment");

$I->amOnPage('/login');
$I->fillField('email', 'john.doe@gmail.com');
$I->fillField('password', '12345678');
$I->click('#login');
$I->seeCurrentUrlEquals('/john_doe');
$I->click("Manage your website");
$I->click("tytul_strony - blog");
$I->click("show");
$I->seeInCurrentUrl("/john_doe/tytul_strony/blog/1");

$I->click("Add comment");
$I->seeCurrentUrlEquals("/john_doe/tytul_strony/blog/1/comments/create");
$I->fillField("#contents","komentarz pod postem od zalogowanego uzytkownika");
$I->click("Add comment");

$I->seeInCurrentUrl("/john_doe/tytul_strony/blog/1");
$I->see("Anonymous user");
$I->see("komentarz pod postem od anonimowego uzytkownika");
$I->see("johny");
$I->see("komentarz pod postem od zalogowanego uzytkownika");
$I->click("edit comment");
$I->seeInCurrentUrl("/john_doe/tytul_strony/blog/1/comments/2/edit");
$I->fillField("#contents","zmieniony komentarz");
$I->click("Edit comment");
$I->seeInCurrentUrl("/john_doe/tytul_strony/blog/1");
$I->see("zmieniony komentarz");
$I->seelink("johny","/john_doe");
$I->dontSee("komentarz pod postem od zalogowanego uzytkownika");
$I->click("#delete_comment");
$I->dontSee("zmieniony komentarz");

