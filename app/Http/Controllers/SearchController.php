<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Queries\Group\ViewGroupHandler;
use App\Queries\Group\ViewGroupQuery;
use App\Queries\Project\ViewProjectHandler;
use App\Queries\Project\ViewProjectQuery;
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

        $projects = $this->viewProjectHandler->handle(new ViewProjectQuery(
            query: $search !== '' ? $search : null,
        ));

        $groups = $this->viewGroupHandler->handle(new ViewGroupQuery(
            query: $search !== '' ? $search : null,
        ));

        $data = [
            'projects' => $projects,
            'groups' => $groups,
            'searchQuery' => $search,
        ];

        return view('pages.search.index', $data);
    }
}
