<?php
namespace App\Repository;

interface PromotionRepositoryInterface{
    // index
    public function index();

    // store PromotionRepository
    public function storePromotion($request);

    // create promotion
    public function createPromotion();

    // delete all promotion
    public function deletePromotion($request);

}
