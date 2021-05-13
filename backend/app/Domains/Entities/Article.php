<?php

namespace App\Domains\Entities;

class Article extends BaseEntity
{
    private int $id;
    private string $title;
    private string $body;
    private int $thumbnail_id;
    private string $thumbnail_url;
    private string $username;
    private int $user_id;
    private array $photos = [];
    private array $tags = [];

    function __construct(?object $obj = null)
    {
        if ($obj === null) return;

        foreach ($obj as $key => $value) {
            if (!property_exists($this, $key) || is_null($value)) {
                continue;
            }

            switch ($key) {
                case "id":
                    $this->setId($obj->$key);
                    break;
                case "title":
                    $this->setTitle($obj->$key);
                    break;
                case "body":
                    $this->setBody($obj->$key);
                    break;
                case "thumbnail_id":
                    $this->setThumbnailId($obj->$key);
                    break;
                case "thumbnail_url":
                    $this->setThumbnailUrl($obj->$key);
                    break;
                case "username":
                    $this->setUsername($obj->$key);
                    break;
                case "user_id":
                    $this->setUserId($obj->$key);
                    break;
                case "photos":
                    $this->setPhotos($obj->$key);
                    break;
                case "tags":
                    $this->setTags($obj->$key);
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
        return $this->title;
    }

    public function setId($id)
    {
        if (!is_numeric($id)) {
            $this->illegalAssignment("Article", "id", $id);
        }

        if (!is_int($id)) {
            $id = (int) $id;
        }
        $this->id = $id;
    }

    public function setTitle(string $title)
    {
        if (empty($title) || mb_strlen($title, "UTF-8") > 30) {
            $this->illegalAssignment("Article", "title", $title);
        }
        $this->title = $title;
    }

    public function setBody(string $body)
    {
        if (empty($body) || mb_strlen($body, "UTF-8") > 200) {
            $this->illegalAssignment("Article", "body", $body);
        }
        $this->body = $body;
    }

    public function setThumbnailId($thumbnail_id)
    {
        if (!is_numeric($thumbnail_id)) {
            $this->illegalAssignment("Article", "thumbnail_id", $thumbnail_id);
        }

        if (!is_int($thumbnail_id)) {
            $thumbnail_id = (int) $thumbnail_id;
        }
        $this->thumbnail_id = $thumbnail_id;
    }

    public function setThumbnailUrl(string $thumbnail_url)
    {
        $this->thumbnail_url = $thumbnail_url;
    }

    public function setUsername(string $username)
    {
        $this->username = $username;
    }

    public function setUserId($user_id)
    {
        if (!is_numeric($user_id)) {
            $this->illegalAssignment("Article", "user_id", $user_id);
        }

        if (!is_int($user_id)) {
            $user_id = (int) $user_id;
        }
        $this->user_id = $user_id;
    }

    public function setPhotos(array $photos)
    {
        if (!is_array($photos)) {
            $this->illegalAssignment("Article", "photos", $photos);
        }
        $this->photos = $photos;
    }

    public function setTags(array $tags)
    {
        if (!is_array($tags)) {
            $this->illegalAssignment("Article", "tags", $tags);
        }
        $this->tags = $tags;
    }
}
