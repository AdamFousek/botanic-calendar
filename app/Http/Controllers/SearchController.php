<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Queries\Group\ViewGroup;
use App\Queries\Group\ViewGroupHandler;
use App\Queries\Project\ViewProject;
use App\Queries\Project\ViewProjectHandler;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function __construct(
        private readonly ViewProjectHandler $viewProjectHandler,
        private readonly ViewGroupHandler $viewGroupHandler,
    ) {
    }

    public function index(Request $request)
    {
        $search = $request->query('search', '');

        $projects = $this->viewProjectHandler->handle(new ViewProject(
            searchQuery: $search !== '' ? $search : null,
        ));

        $groups = $this->viewGroupHandler->handle(new ViewGroup(
            query: $search !== '' ? $search : null,
        ));

        $data = [
            'projects' => $projects,
            'groups' => $groups,
            'searchQuery' => $search,
        ];

        return view('search.index', $data);
    }
}
