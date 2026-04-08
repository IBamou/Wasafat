<?php
namespace App\Models;

use App\Configs\Database;
use App\Helpers\ValidationHelper;
use PDO;
use PDOException;
use Exception;

class AuthModel extends Database {

    public $error = false;
    public $validationModel;

    public $hasRun = false;

    public function __construct() {
        parent::__construct();   
        $this->validationModel = new ValidationHelper();
    }


    public function verifyLogInData($email, $password) {
        try {
            // fetch the user by email
            $query = "SELECT id, email, password FROM users WHERE email = :email LIMIT 1";
            $stmt = $this->db   ->prepare($query);
            $stmt->bindValue(':email', $email, PDO::PARAM_STR);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                // check if blocked
                // if ($user['status'] === 'blocked') {
                //     return [
                //         'success' => false,
                //         'email' => true,
                //         'password' => false,
                //         'blocked' => true
                //     ];
                // }

                // verify password
                if (password_verify($password, $user['password'])) {
                    return [
                        'success' => true,
                        'user_id' => $user['id'],
                        'email' => true,
                        'password' => true,
                        'blocked' => false
                    ];
                } else {
                    return [
                        'success' => false,
                        'email' => true,
                        'password' => false,
                        'blocked' => false
                    ];
                }
            } else {
                return [
                    'success' => false,
                    'email' => false,
                    'password' => false,
                    'blocked' => false
                ];
            }

        } catch (PDOException $e) {
            return [
                'success' => false,
                'error' => $e->getMessage(),
                'blocked' => false
            ];
        }
    }
    public function createSession($userInfo) {
        $_SESSION['user'] = $userInfo;
    }

    public function closeSession() {
        $_SESSION = [];
        session_destroy();
    }
}
