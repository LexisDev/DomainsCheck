<?php

namespace App\Http\Controllers\Domain;

use App\Http\Controllers\Controller;
use App\Http\Requests\Domain\StoreDomainRequest;
use App\Http\Requests\Domain\UpdateDomainRequest;
use App\Models\Domain;
use App\Services\Domain\DomainService;
use Illuminate\Http\Request;

class DomainController extends Controller
{
    /**
     * @var DomainService
     */
    private $domainService;

    public function __construct(DomainService $domainService)
    {
        $this->domainService = $domainService;
    }

    public function index(Request $request)
    {
        $domains = $this->domainService->paginateForUser($request->user());

        return view('domains.index', compact('domains'));
    }

    public function create()
    {
        return view('domains.create');
    }

    public function store(StoreDomainRequest $request)
    {
        $domain = $this->domainService->createForUser($request->user(), $request->validated());

        return redirect()
            ->route('domains.edit', $domain)
            ->with('status', 'Домен добавлен.');
    }

    public function edit(Domain $domain)
    {
        $this->authorize('update', $domain);

        return view('domains.edit', compact('domain'));
    }

    public function update(UpdateDomainRequest $request, Domain $domain)
    {
        $this->authorize('update', $domain);

        $this->domainService->update($domain, $request->validated());

        return redirect()
            ->route('domains.edit', $domain)
            ->with('status', 'Изменения сохранены.');
    }

    public function destroy(Request $request, Domain $domain)
    {
        $this->authorize('delete', $domain);

        $this->domainService->delete($domain);

        return redirect()
            ->route('domains.index')
            ->with('status', 'Домен удалён.');
    }
}

