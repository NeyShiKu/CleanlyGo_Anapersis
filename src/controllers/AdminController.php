<?php
namespace NeyShiKu\CleanlyGo\Controllers;

use NeyShiKu\CleanlyGo\Core\Logger;
use NeyShiKu\CleanlyGo\Core\Controller;
use NeyShiKu\CleanlyGo\Models\Admin;

class AdminController extends Controller {
    public function dashboard() {
        if (session_status() === PHP_SESSION_NONE) {
            require __DIR__ . '/../../config/session.php';
        }

        try {
            $admin = new Admin($_SESSION['id_user']);
            $result = $admin->dashboard();
            $nama = $admin->getNama();
        } catch (\Throwable $th) {
            $this->view('admin/dashboard');
        }

        $this->view('admin/dashboard', [...$result, 'nama' => $nama]);

        $log = Logger::getLogger();
        $log->info('AdminController dashboard');
    }
}