<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function add_author(){
        $author = new Author();
        $author->username = 'rahim';
        $author->password = 'rahim12';

        $author->save();
    }
}
