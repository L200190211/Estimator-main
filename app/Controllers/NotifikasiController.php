<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use \App\Models\Notifikasi;

class NotifikasiController extends BaseController
{
    function __construct()
    {
        $this->notifikasi = new Notifikasi();
    }

    public function index()
    {
        $data = [
            'title' => 'Notifikasi',
            'notifikasi' => $this->notifikasi->getNotifikasi()->getResult(),
            'unread' => count($this->notifikasi->getCountUnread()->getResult())
        ];
        return view('admin/notifikasi/index', $data);
    }

    public function sudahdibaca()
    {
        $this->notifikasi->set('isRead', 1);
        $this->notifikasi->where('isRead',0);
        $this->notifikasi->update();
    }
}
