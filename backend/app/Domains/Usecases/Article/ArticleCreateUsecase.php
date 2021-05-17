<?php

namespace App\Domains\Usecases\Article;

use App\Domains\Entities\Article;
use App\Domains\Entities\Photo;
use App\Domains\Repositories\ArticleRepository;
use App\Domains\Repositories\PhotoRepository;
use App\Http\Dto\Article\CreateArticleDto;
use Exception;

class ArticleCreateUsecase
{
    private ArticleRepository $articleRepository;
    private PhotoRepository $photoRepository;

    public function __construct(ArticleRepository $articleRepository, PhotoRepository $photoRepository)
    {
        $this->articleRepository = $articleRepository;
        $this->photoRepository = $photoRepository;
    }

    public function execute(CreateArticleDto $createArticleDto): int
    {
        try {
            $this->articleRepository->beginTransaction();

            // 記事の登録
            $createArticle = new Article($createArticleDto);
            $article = $this->articleRepository->create($createArticle);

            // ファイル名をハッシュ化し、Photo Entityに変換
            $photos = [];
            foreach ($createArticleDto->files as $index => $e) {
                $ext = $e['photo']->guessExtension();
                $pathname = $e['photo']->getPathName();
                $filename = $article->id . '/' . hash_file('md5', $pathname) . '.' . $ext;
                $path = $e['photo']->storeAs('photos', $filename);
                array_push($photos, new Photo((object) ["article_id" => $article->id, "url" => "/" . $path]));
            }

            // 画像の登録
            $thumbnail_id = $this->photoRepository->createValues($photos);

            // サムネイル画像の登録
            $this->articleRepository->updateThumbnailId($article->id, $thumbnail_id);

            $this->articleRepository->commit();
            return $article->id;
        } catch (Exception $e) {
            $this->articleRepository->rollBack();
            throw $e;
        }
    }
}
