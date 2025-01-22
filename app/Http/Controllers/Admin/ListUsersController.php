<?php

namespace Expose\Server\Http\Controllers\Admin;

use Expose\Server\Contracts\UserRepository;
use Illuminate\Http\Request;
use Ratchet\ConnectionInterface;

class ListUsersController extends AdminController
{
    protected $keepConnectionOpen = true;

    /** @var UserRepository */
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function handle(Request $request, ConnectionInterface $httpConnection)
    {
        $this->userRepository
            ->paginateUsers($request->get('search', ''), 20, (int) $request->get('page', 1))
            ->then(function ($paginated) use ($httpConnection) {
                try {
                $httpConnection->send(
                    respond_html($this->getBlade($httpConnection, 'server.users.index', ['paginated' => $paginated]))
                );
                }
                catch (\Exception $e) {
                    dump($e);
                }

                $httpConnection->close();
            });
    }
}
