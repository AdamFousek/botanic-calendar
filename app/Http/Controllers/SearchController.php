<?php

namespace App\Http\Controllers;

use App\Command\Group\ViewGroup;
use App\Command\Group\ViewGroupHandler;
use App\Command\Project\ViewProject;
use App\Command\Project\ViewProjectHandler;
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
