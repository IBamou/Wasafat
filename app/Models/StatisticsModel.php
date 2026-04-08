<?php
namespace App\Models;

use App\Configs\Database;
use PDO;
use PDOException;
class StatisticsModel extends Database {
    public function __construct() {
        parent::__construct();
    }

}



