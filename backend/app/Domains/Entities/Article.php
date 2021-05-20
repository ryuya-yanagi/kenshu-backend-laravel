<?php

namespace App\Domains\Entities;

class Article extends BaseEntity
{
    private int $id;
    private string $title;
    private string $body;
    private int $user_id;
    private int $thumbnail_id;
    private array $photos = [];
    private array $tags = [];
    private ?User $user = null;
    private ?Photo $thumbnail = null;

    function __construct(?object $obj = null)
    {
        if ($obj === null) return;

        foreach ($obj as $key => $value) {
            if (!property_exists($this, $key) || is_null($value)) {
                continue;
            }

            switch ($key) {
                case "id":
                    $this->setId($value);
                    break;
                case "title":
                    $this->setTitle($value);
                    break;
                case "body":
                    $this->setBody($value);
                    break;
                case "thumbnail_id":
                    $this->setThumbnailId($value);
                    break;
                case "thumbnail":
                    $this->setThumbnail((object) $value);
                    break;
                case "user":
                    $this->setUser((object) $value);
                    break;
                case "user_id":
                    $this->setUserId($value);
                    break;
                case "photos":
                    $this->setPhotos($value);
                    break;
                case "tags":
                    $this->setTags($value);
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
        if (mb_strlen($title, "UTF-8") < 4 || mb_strlen($title, "UTF-8") > 50) {
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

    public function setThumbnail(object $obj)
    {
        $this->thumbnail = new Photo($obj);
    }

    public function setUser(object $obj)
    {
        $this->user = new User($obj);
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
        $this->photos = array_map(function ($photo) {
            return new Photo((object) $photo);
        }, $photos);
    }

    public function setTags(array $tags)
    {
        if (!is_array($tags)) {
            $this->illegalAssignment("Article", "tags", $tags);
        }
        $this->tags = array_map(function ($tag) {
            return new Tag((object) $tag);
        }, $tags);
    }
}
