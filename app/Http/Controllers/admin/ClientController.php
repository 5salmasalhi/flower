<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use App\Models\Client;

class ClientController extends AdminController
{
    public function index()
    {
        $clients = Client::orderBy('name')->paginate(15);
        return $this->render('admin.client.index', compact('clients'));
    }
}
