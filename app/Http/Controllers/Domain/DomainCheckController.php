<?php

namespace App\Http\Controllers\Domain;

use App\Http\Controllers\Controller;
use App\Models\Domain;
use Illuminate\Http\Request;

class DomainCheckController extends Controller
{
    public function index(Request $request, Domain $domain)
    {
        $this->authorize('view', $domain);

        $checks = $domain->checks()
            ->orderByDesc('checked_at')
            ->paginate(25);

        return view('domains.checks.index', compact('domain', 'checks'));
    }
}

