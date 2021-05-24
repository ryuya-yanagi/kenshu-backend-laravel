<?php

namespace App\Usecases\Article;

use App\Domains\Entities\Article;
use App\Domains\Entities\Photo;
use App\Domains\Repositories\ArticleRepository;
use App\Domains\Repositories\PhotoRepository;
use App\Domains\Uploaders\ImageUploader;
use App\Http\Dto\Article\CreateArticleDto;
use Exception;

class ArticleCreateUsecase
{
    private ArticleRepository $articleRepository;
    private PhotoRepository $photoRepository;
    private ImageUploader $imageUploader;

    public function __construct(ArticleRepository $articleRepository, PhotoRepository $photoRepository, ImageUploader $imageUploader)
    {
        $this->articleRepository = $articleRepository;
        $this->photoRepository = $photoRepository;
        $this->imageUploader = $imageUploader;
    }

    public function execute(CreateArticleDto $cad): int
    {
        try {
            $this->articleRepository->beginTransaction();

            // 記事の登録
            $article = $this->articleRepository->create(new Article($cad));

            // ファイルをアップロードし、Photo Entityに変換
            if (count($cad->files)) {
                $photos = [];
                foreach ($cad->files as $index => $e) {
                    $path = $this->imageUploader->upload($e['photo'], $article->id);
                    array_push($photos, new Photo((object) ["article_id" => $article->id, "url" => $path]));
                }

                // 画像の登録
                $thumbnail_id = $this->photoRepository->createValues($photos);

                // サムネイル画像の登録
                $this->articleRepository->updateThumbnailId($article->id, $thumbnail_id);
            }

            // タグの関連づけ
            if (count($cad->tags)) {
                foreach ($cad->tags as $tag_id) {
                    $this->articleRepository->attachTag($article->id, $tag_id);
                }
            }

            $this->articleRepository->commit();
            return $article->id;
        } catch (Exception $e) {
            $this->articleRepository->rollBack();
            throw $e;
        }
    }
}
