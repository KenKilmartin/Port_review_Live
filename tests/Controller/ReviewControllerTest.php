<?php


namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class ReviewControllerTest extends WebTestCase
{

    const REVIEW_ID = '1';

    public function testReviewPageStatusOkay()
    {
        //arrange
        $url = '/review/';
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
     * @dataProvider basicPagesTextProvider
     */
    public function testReviewPagesContainBasicText($url, $exepctedLowercaseText)
    {
        // Arrange
        $httpMethod = 'GET';
        $client = static::createClient();

        // Act
        $client->request($httpMethod, $url);
        $content = $client->getResponse()->getContent();
        $statusCode = $client->getResponse()->getStatusCode();

        // to lower case
        $contentLowerCase = strtolower($content);

        // Assert - status code 200
        $this->assertSame(Response::HTTP_OK, $statusCode);
        // Assert - expected content
        $this->assertContains(
            $exepctedLowercaseText,
            $contentLowerCase
        );
    }
    public function basicPagesTextProvider()
    {
        return [

            ['/review/'.self::REVIEW_ID, 'review'],
            ['/review/'.self::REVIEW_ID.'/edit', 'edit review'],
            ['/review/'.self::REVIEW_ID, 'place of purchase'],
            ['/review/new', 'create new review'],
            ['review/upVote/'.self::REVIEW_ID, 'review'],
            ['review/downVote/'.self::REVIEW_ID, 'review'],


        ];
    }

}