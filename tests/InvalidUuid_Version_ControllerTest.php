<?php

use Symfony\Component\HttpKernel\Exception\HttpException as HttpKernelException;
use Illuminate\Foundation\Testing\HttpException as TestingHttpException;

class InvalidUuid_Version_ControllerTest extends TestCase
{
    /**
     * @dataProvider getPathsInvalidUuidVersion
     * @param string $path
     */
    public function testInvalidPathsInvalidUuidVersion($path)
    {
        $exceptionThrownFlag = false;

        try {
            $this->visit($path);
        } catch (TestingHttpException $e) {
            $exceptionThrownFlag = true;
            /* @var HttpKernelException */
            $previousException = $e->getPrevious();
            $this->assertContains(
                'Invalid UUID version requested:',
                $previousException->getMessage()
            );
            $this->assertInstanceOf(
                HttpKernelException::class,
                $previousException
            );
            $this->assertEquals(400, $previousException->getStatusCode());
        }

        $this->assertTrue($exceptionThrownFlag);
    }

    /**
     * @return string[]
     */
    public function getPathsInvalidUuidVersion()
    {
        return [
            ['/asdfadsf'],
            ['asdfad'],
            ['0'],
            ['/0'],
            ['999'],
            ['/999']
        ];
    }
}
