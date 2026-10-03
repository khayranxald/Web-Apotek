<?php

namespace App\Policies;

use App\Models\Prescription;
use App\Models\User;

class PrescriptionPolicy
{
    /**
     * Customer hanya bisa lihat resepnya sendiri.
     * Pharmacist & Admin/Super Admin bisa lihat semua resep.
     */
    public function view(User $user, Prescription $prescription): bool
    {
        if ($user->hasAnyRole(['pharmacist', 'admin', 'super_admin'])) {
            return true;
        }

        return $user->id === $prescription->user_id;
    }

    /**
     * Sama seperti view() — dipakai khusus untuk endpoint download file.
     */
    public function download(User $user, Prescription $prescription): bool
    {
        return $this->view($user, $prescription);
    }

    /**
     * Hanya pharmacist yang boleh mereview (approve/reject) resep.
     */
    public function review(User $user, Prescription $prescription): bool
    {
        return $user->hasRole('pharmacist');
    }

    /**
     * Customer hanya bisa menghapus resep miliknya sendiri, dan hanya kalau statusnya masih pending.
     */
    public function delete(User $user, Prescription $prescription): bool
    {
        if ($user->id !== $prescription->user_id) {
            return false;
        }

        return $prescription->isEditableByOwner();
    }
}