<?php


namespace App\Tests\Controller;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class SecurityControllerTest extends WebTestCase
{
    /**
     * this just checks that the login page works
     */
    public function testLoginPageStatusOkay()
    {
        //arrange
        $url = '/login';
        $httpMethod = 'GET';
        $client = static::createClient();
        $expectedResult = Response::HTTP_OK;

        //assert
        $client->request($httpMethod,$url);
        $resultStatusCode = $client->getResponse()->getStatusCode();

        //act
        $this->assertEquals($expectedResult,$resultStatusCode);



    }

    /**
     * this tests for the correct password
     */
    public function testLoginOnRightPassword()
    {

        $url = '/login';
        $httpMethod = 'GET';
        $client = static::createClient();
        $crawler = $client->request($httpMethod, $url);

        // Act
        $button = $crawler->selectButton('login');

        $form = $button->form();

        // set some values
        $form['_username'] = "admin";
        $form['_password'] = "admin";

        // submit the form
        $crawler = $client->submit($form);

        $expectedURL = '/';
        $content = $client->getResponse()->getContent();

        // Assert
        $this->assertContains($expectedURL, $content);
    }

    /**
     * this tests for the wrong password
     */
    public function testLoginOnWrongPassword()
    {

        $url = '/login';
        $httpMethod = 'GET';
        $client = static::createClient();
        $crawler = $client->request($httpMethod, $url);

        // Act
        $button = $crawler->selectButton('login');

        $form = $button->form();

        // set some values
        $form['_username'] = "admin";
        $form['_password'] = "pass";

        // submit the form
        $crawler = $client->submit($form);

        $expectedURL = '/login';
        $content = $client->getResponse()->getContent();

        // Assert
        $this->assertContains($expectedURL, $content);
    }


}










