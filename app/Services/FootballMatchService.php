<?php


namespace App\Services;


use App\Repositories\FootballMatchRepository;
use Illuminate\Http\Request;

class FootballMatchService
{

    protected $footballMatchRepository;

    public function __construct(FootballMatchRepository $footballMatchRepository
    ) {
        $this->footballMatchRepository = $footballMatchRepository;
    }

    public function index()
    {
        return $this->footballMatchRepository->all();
    }

    public function create(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $destinationPath = 'uploads';
            $file->move($destinationPath, $file->getClientOriginalName());
            $content = file_get_contents($destinationPath . '/' . $file->getClientOriginalName());
            $matches = json_decode($content, true);
            foreach ($matches as $match) {
                $this->footballMatchRepository->create($match);
            }
        } elseif ($request->all()) {
            $this->footballMatchRepository->create($request->all());
        }

    }

    public function update(Request $request, $id)
    {
        $attributes = $request->all();
        return $this->footballMatchRepository->update($id, $attributes);
    }

    public function show($id)
    {
        $this->footballMatchRepository->show($id);
    }

}
