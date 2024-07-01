<?php

namespace Tests\Traits;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

trait TestUnitMiddlewares
{
    /**
     * The middleware.
     */
    protected $middleware;

    /**
     * The dummy request.
     *
     * @var \Illuminate\Http\Request
     */
    protected $request;

    /**
     * The closure next.
     *
     * @var \Closure
     */
    protected $next;

    /**
     * The abstract middleware method.
     *
     * @return string
     */
    abstract protected function middleware(): string;

    /**
     * Setup new test environments.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $middleware = $this->middleware();

        $this->middleware = new $middleware();

        $this->request = Request::create('/', 'GET');

        $this->next = function () {
            return new Response("Next middleware");
        };
    }
}
