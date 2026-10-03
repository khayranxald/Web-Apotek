<?php

namespace App\Services;

use App\Models\Prescription;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class PrescriptionService
{
    protected const MAX_FILE_SIZE_KB = 5120; // 5MB

    protected const ALLOWED_MIMES = ['jpg', 'jpeg', 'png', 'pdf'];

    public function upload(User $user, UploadedFile $file): Prescription
    {
        $this->validateFile($file);

        $extension = $file->getClientOriginalExtension();
        $filename = Str::uuid() . '.' . $extension;
        $path = $file->storeAs('resep/' . $user->id, $filename, 'prescriptions');

        return Prescription::create([
            'user_id' => $user->id,
            'file_path' => $path,
            'original_filename' => $file->getClientOriginalName(),
            'status' => 'pending',
            'expires_at' => now()->addDays(30),
        ]);
    }

    protected function validateFile(UploadedFile $file): void
    {
        $extension = strtolower($file->getClientOriginalExtension());

        if (!in_array($extension, self::ALLOWED_MIMES)) {
            throw ValidationException::withMessages([
                'file' => 'Format file harus JPG, PNG, atau PDF.',
            ]);
        }

        if ($file->getSize() > self::MAX_FILE_SIZE_KB * 1024) {
            throw ValidationException::withMessages([
                'file' => 'Ukuran file maksimal 5MB.',
            ]);
        }

        // Validasi tambahan: pastikan MIME type asli file sesuai (bukan hanya ekstensi nama file)
        $realMimeType = $file->getMimeType();
        $allowedMimeTypes = [
            'image/jpeg',
            'image/png',
            'application/pdf',
        ];

        if (!in_array($realMimeType, $allowedMimeTypes)) {
            throw ValidationException::withMessages([
                'file' => 'File tidak valid atau rusak.',
            ]);
        }
    }

    public function delete(Prescription $prescription): void
    {
        Storage::disk('prescriptions')->delete($prescription->file_path);
        $prescription->delete();
    }
}