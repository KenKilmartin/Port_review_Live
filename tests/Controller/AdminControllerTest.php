<?php


namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class AdminControllerTest extends WebTestCase
{
    const ADMIN_ID = '1';
    /**
     * http found is for 302 so that means that was redirected due to fact not loged in
     */
    public function testIfNotLoggedInAndTryAccessAdminPage()
    {
        $url = '/myadmin';
        $httpMethod = 'GET';
        $client = static::createClient();

        $expectedResult = Response::HTTP_FOUND;

        //assert
        $client->request($httpMethod,$url);
        $resultStatusCode = $client->getResponse()->getStatusCode();

        //act
        $this->assertEquals($expectedResult,$resultStatusCode);

    }

    /**
     * @dataProvider adminPagesTextProvider
     * @param $url
     * @param $expectedLowercaseText
     */
    public function testAdminPagesContainBasicText($url, $expectedLowercaseText)
    {

        $client= $this->login();
        $httpMethod = 'GET';

        // Arrange


        // Act
        $client->request($httpMethod, $url);
        $content = $client->getResponse()->getContent();
        $statusCode = $client->getResponse()->getStatusCode();

        // to lower case
        $contentLowerCase = strtolower($content);

        $this->assertSame(Response::HTTP_OK, $statusCode);
        // Assert - expected content
        $this->assertContains(
            $expectedLowercaseText,
            $contentLowerCase
        );
    }

    public function adminPagesTextProvider()
    {
        return [
            ['/myadmin', 'admin home'],
            ['/makeReviewPublic/'.self::ADMIN_ID,'admin home'],
            ['/makePortPublic/'.self::ADMIN_ID,'admin home']


        ];
    }

    public function login()
    {

        $urlL = '/login';
        $httpMethod = 'GET';
        $client = static::createClient();
        $crawler = $client->request($httpMethod, $urlL);

        // Act
        $button = $crawler->selectButton('login');

        $form = $button->form();

        // set some values
        $form['_username'] = "admin";
        $form['_password'] = "admin";

        // submit the form
        $client->submit($form);

        return $client;
    }



}
