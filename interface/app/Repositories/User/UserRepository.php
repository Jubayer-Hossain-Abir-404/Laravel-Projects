<?php 

namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\User\UserInterface as UserInterface;

class UserRepository implements UserInterface
{
    public $user;

    function __construct (User $user)
    {
        $this->user = $user;
    }

    public function getAll ()
    {
        return $this->user->get();
    }

    public function find ($id)
    {
        return $this->user->find($id);
    }

    public function delete ($id)
    {
        return $this->user->delete($id);
    }
}