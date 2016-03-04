<?php

use Symfony\Component\HttpKernel\Exception\HttpException as HttpKernelException;
use Illuminate\Foundation\Testing\HttpException as TestingHttpException;

class Uuid_Version4_ControllerTest extends TestCase
{
    /**
     * @dataProvider getValidPaths
     * @param string $path
     */
    public function testValidPaths($path)
    {
        $this->visit($path)->assertResponseOk();
    }

    /**
     * @return string[]
     */
    public function getValidPaths()
    {
        return [
            ['/4'],
            ['4'],
            ['4/'],
            ['/4/']
        ];
    }

    /**
     * @dataProvider getPathsWithExtraParameters
     * @param string $path
     */
    public function testInvalidPathsExtraParameters($path)
    {
        $exceptionThrownFlag = false;

        try {
            $this->visit($path);
        } catch (TestingHttpException $e) {
            $exceptionThrownFlag = true;
            /* @var HttpKernelException */
            $previousException = $e->getPrevious();
            $this->assertEquals(
                'UUID v4 does not require any parameter.',
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
    public function getPathsWithExtraParameters()
    {
        return [
            ['/4/s/'],
            ['4/whatever/'],
            ['4/3'],
            ['/4/-']
        ];
    }
}
