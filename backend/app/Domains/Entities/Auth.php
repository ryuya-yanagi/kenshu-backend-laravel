<?php

namespace App\Domains\Entities;

use RuntimeException;

class Auth extends BaseEntity
{
    private int $id;
    private string $name;
    private string $password;
    private string $password_hash;

    function __construct(object $obj)
    {
        foreach ($obj as $key => $value) {
            if (!property_exists($this, $key) || is_null($value)) {
                continue;
            }
            switch ($key) {
                case "id":
                    $this->setId($value);
                    break;
                case "name":
                    $this->setName($value);
                    break;
                case "password":
                    $this->setPassword($value);
                    break;
                case "password_hash":
                    $this->setPasswordHash($value);
                    break;
                case "created_at":
                    $this->created_at = $value;
                    break;
                case "updated_at":
                    $this->updated_at = $value;
                    break;
            }
        }
    }

    public function __get($name)
    {
        return isset($this->$name) ? $this->$name : null;
    }

    public function __toString()
    {
        return $this->name;
    }

    public function setId($id)
    {
        if (!is_numeric($id)) {
            $this->illegalAssignment("Auth", "id", $id);
        }

        if (!is_int($id)) {
            $id = (int) $id;
        }
        $this->id = $id;
    }

    public function setName(string $name)
    {
        if (mb_strlen($name, "UTF-8") < 4 || mb_strlen($name, "UTF-8") > 50) {
            $this->illegalAssignment("Auth", "name", $name);
        }
        $this->name = $name;
    }

    public function setPassword(string $password)
    {
        if (mb_strlen($password, "UTF-8") < 6) {
            $this->illegalAssignment("Auth", "password", $password);
        }
        $this->password = $password;
    }

    public function setPasswordHash(string $password_hash)
    {
        if (empty($password_hash)) {
            $this->illegalAssignment("Auth", "password_hash", $password_hash);
        }
        $this->password_hash = $password_hash;
    }

    /**
     * $this->passwordをハッシュ化し、$this->password_hashに代入
     * 
     */
    public function hash_pass()
    {
        if (empty($this->password)) {
            throw new RuntimeException("Password empty!");
        }

        $this->password_hash = password_hash($this->password, PASSWORD_DEFAULT);
    }

    /**
     * パスワードが一致するか検証
     * 
     * @param string $password
     * @return bool
     */
    public function verify_pass(string $password): bool
    {
        return password_verify($password, $this->password_hash);
    }
}
