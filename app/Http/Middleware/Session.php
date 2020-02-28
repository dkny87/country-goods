<?php

namespace App\Http\Middleware;

use App\Exceptions\InvalidSessionTokenException;
use App\Repositories\SessionRepository;
use Closure;
use Illuminate\Http\Request;

class Session
{
    /**
     * @var SessionRepository
     */
    private $session;

    /**
     * SessionMiddleware constructor.
     * @param SessionRepository $session
     */
    public function __construct(SessionRepository $session)
    {
        $this->session = $session;
    }

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     * @throws InvalidSessionTokenException
     */
    public function handle($request, Closure $next)
    {
        $sessionId = $request->header('x-http-token');

        if (empty($sessionId)) {
            throw new InvalidSessionTokenException();
        }

        $session = $this->session->get($sessionId);

        if (empty($session['Item'])) {
            throw new InvalidSessionTokenException();
        }

        return $next($request);
    }
}
