<?php

use Symfony\Component\HttpKernel\Exception\HttpException as HttpKernelException;
use Illuminate\Foundation\Testing\HttpException as TestingHttpException;

class Uuid_Version3_ControllerTest extends TestCase
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
     * @return array
     */
    public function getValidPaths()
    {
        $paths = [];
        foreach ($this->getValidNameSpaces() as $nameSpace) {
            $paths[] = ["/3/{$nameSpace}/s"];
            $paths[] = ["3/{$nameSpace}/d"];
            $paths[] = ["3/{$nameSpace}/x/"];
            $paths[] = ["/3/{$nameSpace}/./"];
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
                'UUID v3 requires a name space and string.',
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
     * @return array
     */
    public function getPathsWithInsufficientParameters()
    {
        $paths = [];
        foreach ($this->getValidNameSpaces() as $nameSpace) {
            $paths[] = ["3/{$nameSpace}"];
            $paths[] = ["3/{$nameSpace}/"];
            $paths[] = ["/3/{$nameSpace}"];
            $paths[] = ["/3/{$nameSpace}/"];
            $paths[] = ["3/"];
            $paths[] = ["/3"];
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
                'UUID v3 only requires a name space and string.',
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
     * @return array
     */
    public function getPathsWithExtraParameters()
    {
        $paths = [];
        foreach ($this->getValidNameSpaces() as $nameSpace) {
            $paths[] = ["/3/{$nameSpace}/s/s"];
            $paths[] = ["3/{$nameSpace}/random/a/b/c"];
            $paths[] = ["3/{$nameSpace}/3/3/3"];
            $paths[] = ["/3/{$nameSpace}/./-"];
        }

        return $paths;
    }

    /**
     * @dataProvider getPathsWithInvalidNameSpace
     * @param string $path
     */
    public function testInvalidNameSpace($path)
    {
        $exceptionThrownFlag = false;

        try {
            $this->visit($path);
        } catch (TestingHttpException $e) {
            $exceptionThrownFlag = true;
            /* @var HttpKernelException */
            $previousException = $e->getPrevious();
            $this->assertContains(
                'Invalid name space',
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
     * @return array
     */
    public function getPathsWithInvalidNameSpace()
    {
        return [
            ["/3/YOLO/s"],
            ["/3/BBQ/s"],
        ];
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
