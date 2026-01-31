<?php

namespace App\Services\Domain;

use App\Models\Domain;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class DomainService
{
    public function paginateForUser(User $user, int $perPage = 15): LengthAwarePaginator
    {
        return Domain::query()
            ->where('user_id', $user->id)
            ->orderByDesc('id')
            ->paginate($perPage);
    }

    public function createForUser(User $user, array $data): Domain
    {
        $domain = new Domain($data);
        $domain->user()->associate($user);
        $domain->save();

        return $domain;
    }

    public function update(Domain $domain, array $data): Domain
    {
        $domain->fill($data);
        $domain->save();

        return $domain;
    }

    public function delete(Domain $domain): void
    {
        $domain->delete();
    }
}

