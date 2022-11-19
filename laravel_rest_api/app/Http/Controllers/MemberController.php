<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    // will have to work on the controller later. obviosuly

    public function add_member()
    {
        $device = new Device();
        $device->name = 'laptop';

        $member =  new Member();
        $member->name = 'Rahim';

        $member->save();

        $member->device()->save($device);
    }
}
