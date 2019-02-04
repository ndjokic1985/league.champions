<?php


namespace App\Services;


use App\Repositories\MatchResultRepository;

class MatchResultService {

    protected $matchResultRepository;

    public function __construct(MatchResultRepository $matchResultRepository) {
        $this->matchResultRepository = $matchResultRepository;
    }

    public function index() {
        return $this->matchResultRepository->index();
    }

}
