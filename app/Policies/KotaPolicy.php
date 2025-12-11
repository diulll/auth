<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Kota;
use Illuminate\Auth\Access\HandlesAuthorization;

class KotaPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any kotas.
     *
     * @param \App\Models\User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the kota.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Kota $kota
     * @return mixed
     */
    public function view(User $user, Kota $kota)
    {
        return TRUE;
    }

    /**
     * Determine whether the user can create kotas.
     *
     * @param \App\Models\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->id > 0;
    }

    /**
     * Determine whether the user can update the kota.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Kota $kota
     * @return mixed
     */
    public function update(User $user, Kota $kota)
    {
        return $user->id == $kota->user_id;
    }

    /**
     * Determine whether the user can delete the kota.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Kota $kota
     * @return mixed
     */
    public function delete(User $user, Kota $kota)
    {
        return $user->id == $kota->user_id;
    }

    /**
     * Determine whether the user can restore the kota.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Kota $kota
     * @return mixed
     */
    public function restore(User $user, Kota $kota)
    {
        return $user->id == $kota->user_id;
    }

    /**
     * Determine whether the user can permanently delete the kota.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Kota $kota
     * @return mixed
     */
    public function forceDelete(User $user, Kota $kota)
    {
        return $user->id == $kota->user_id;
    }
}

