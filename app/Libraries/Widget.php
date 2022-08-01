<?php 
namespace App\Libraries;
use \App\Models\Notifikasi;

class Widget
{
    function __construct()
    {
        $this->notifikasi = new Notifikasi();
    }

    public function Notifikasi()
    {
        $data = [
            'notifikasi' => $this->notifikasi->getNotifikasi()->getResult(),
            'unread' => count($this->notifikasi->getCountUnread()->getResult())
        ];
        return view('widget/notifikasi',$data);
    }
}