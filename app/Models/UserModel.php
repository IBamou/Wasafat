<?php
namespace App\Models;

use App\Configs\Database;
use PDO;
use Exception;

class UserModel extends Database {


    public function __construct() {
        parent::__construct();   
    }

    public function getUsers() {
        try {
            $query = 'SELECT id, name, email, role, created_at FROM users ORDER BY created_at DESC';
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function findByEmail(string $email) {
        try {
            if ($email) {
                $query = 'SELECT id, name, email, created_at FROM users WHERE email = :email';
                $stmt = $this->db->prepare($query);
                $stmt->bindParam(':email', $email);
                $stmt->execute();
                return $stmt->fetch(PDO::FETCH_ASSOC);
            } 
        } catch (Exception $e) {
            return null;
        }
    }

    public function findById(int $id) {
        try {
            $query = 'SELECT id, name, email, created_at FROM users WHERE id = :id';
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }


    public function emailExists(string $email): bool {
        try {
            $query = 'SELECT id FROM users WHERE email = :email';
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            return $stmt->fetch() !== false;
        } catch (Exception $e) {
            return false;
        }
    }


    public function addUser(string $name, string $email, string $password) {
        try {
            // Check if email already exists
            if ($this->emailExists($email)) {
                return false;
            }
            
            $query = 'INSERT INTO users (name, email, password, created_at) 
                       VALUES (:name, :email, :password, NOW())';
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);
            $stmt->execute();
            return true;
            } catch (Exception $e) {
                echo $e->getMessage();
        }
    }

    public function updateUser(int $id, array $data) {
        try {
            $query = 'UPDATE users SET name = :name, email = :email WHERE id = :id';
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':name', $data['name']);
            $stmt->bindParam(':email', $data['email']);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return true;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }


    public function changePassword(array $data) {
        try {
            // First verify current password
            $query = 'SELECT password FROM users WHERE id = :id';
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $data['id'], PDO::PARAM_INT);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if (!$user || !password_verify($data['currentPassword'], $user['password'])) {
                return false;
            }
            
            // Update to new password
            $hashedPassword = password_hash($data['newPassword'], PASSWORD_DEFAULT);
            $query = 'UPDATE users SET password = :password WHERE id = :id';
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':password', $hashedPassword);
            $stmt->bindParam(':id', $data['id'], PDO::PARAM_INT);
            $stmt->execute();
            
            return true;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
