<?php

namespace App\Services\Auth;

use App\Domain\Session;
use App\Exceptions\InvalidCredentialsException;
use App\Repositories\Employees\EmployeeRepository;
use App\Repositories\SessionRepository;
use App\Utilities\FCTokenGenerator;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    /**
     * @var EmployeeRepository
     */
    private $employeeRepository;

    /**
     * @var SessionRepository
     */
    private $session;

    /**
     * AuthService constructor.
     * @param EmployeeRepository $employeeRepository
     * @param SessionRepository $session
     */
    public function __construct(EmployeeRepository $employeeRepository, SessionRepository $session)
    {
        $this->employeeRepository = $employeeRepository;
        $this->session = $session;
    }

    /**
     * @param $email
     * @param $password
     * @return mixed
     * @throws InvalidCredentialsException
     */
    public function login($email, $password)
    {
        $employee = $this->employeeRepository->findWhere(['email' => $email]);

        if (!Hash::check($password, optional($employee)->password)) {
            throw new InvalidCredentialsException();
        }

        $sessionId = FCTokenGenerator::uuid($employee->email);

        $this->session->set(['session_id' => $sessionId, 'session_info' => '', 'expired_at' => Session::ONE_MONTH]);

        return [
            'session_id' => $sessionId,
            'account' => $employee,
        ];
    }

    /**
     * @param $sessionId
     * @return void
     */
    public function logout($sessionId)
    {
        $session = $this->session->findWhere('session_id', '=', $sessionId);

        return $session->delete();
    }
}
