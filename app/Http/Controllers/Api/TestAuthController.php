<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class TestAuthController extends Controller
{
    public int $id = 1;
    private string $host = 'localhost';
    private string $dbName = 'app';
    private string $userName = 'root';
    private string $password = '';
    public function test()
    {
        $connect = mysqli_connect(
            "$this->host",
            "$this->userName",
            "$this->password",
            "$this->dbName");

        $sql = "SELECT name, email, created_at FROM users WHERE id = $this->id";

        $res = mysqli_query($connect, $sql)->fetch_object();

        return json_encode($res);
    }

}



