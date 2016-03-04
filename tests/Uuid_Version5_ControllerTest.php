<?php

use Symfony\Component\HttpKernel\Exception\HttpException as HttpKernelException;
use Illuminate\Foundation\Testing\HttpException as TestingHttpException;

class Uuid_Version5_ControllerTest extends TestCase
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
        $paths = [];
        foreach ($this->getValidNameSpaces() as $nameSpace) {
            $paths[] = ["/5/{$nameSpace}/s"];
            $paths[] = ["5/{$nameSpace}/d"];
            $paths[] = ["5/{$nameSpace}/x/"];
            $paths[] = ["/5/{$nameSpace}/./"];
        }

        return $paths;
    }

    /**
     * @dataProvider getPathsWithInsufficientParameters
     * @param string $path
     */
    public function testInvalidPathsInsufficientParameters($path)
    {
        $exceptionThrownFlag = false;

        try {
            $this->visit($path);
        } catch (TestingHttpException $e) {
            $exceptionThrownFlag = true;
            /* @var HttpKernelException */
            $previousException = $e->getPrevious();
            $this->assertEquals(
                'UUID v5 requires a name space and string.',
                $previousException->getMessage()
            );
            $this->assertInstanceOf(
                HttpKernelException::class,
                $previousException
            );
            $this->assertEquals(400, $previousException->getStatusCode());
        }

        $this->assertTrue($exceptionThrownFlag, 'HTTP exception thrown check.');
    }

    /**
     * @return string[]
     */
    public function getPathsWithInsufficientParameters()
    {
        $paths = [];
        foreach ($this->getValidNameSpaces() as $nameSpace) {
            $paths[] = ["5/{$nameSpace}"];
            $paths[] = ["5/{$nameSpace}/"];
            $paths[] = ["/5/{$nameSpace}"];
            $paths[] = ["/5/{$nameSpace}/"];
            $paths[] = ["5/"];
            $paths[] = ["/5"];
        }

        return $paths;
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
                'UUID v5 only requires a name space and string.',
                $previousException->getMessage()
            );
            $this->assertInstanceOf(
                HttpKernelException::class,
                $previousException
            );
            $this->assertEquals(400, $previousException->getStatusCode());
        }

        $this->assertTrue($exceptionThrownFlag, 'HTTP exception thrown check.');
    }

    /**
     * @return string[]
     */
    public function getPathsWithExtraParameters()
    {
        $paths = [];
        foreach ($this->getValidNameSpaces() as $nameSpace) {
            $paths[] = ["/5/{$nameSpace}/s/s"];
            $paths[] = ["5/{$nameSpace}/random/a/b/c"];
            $paths[] = ["5/{$nameSpace}/3/3/3"];
            $paths[] = ["/5/{$nameSpace}/./-"];
        }

        return $paths;
    }

    public function getValidNameSpaces()
    {
        return [
            \App\Http\Controllers\NameSpacedUuid_Controller::NS_DNS,
            \App\Http\Controllers\NameSpacedUuid_Controller::NS_OID,
            \App\Http\Controllers\NameSpacedUuid_Controller::NS_URL,
            \App\Http\Controllers\NameSpacedUuid_Controller::NS_X500,
        ];
    }
}
