<?php

namespace App\Http\Livewire\User\Forms;

use App\Command\User\UpdateUserCommand;
use App\Command\User\UpdateUserHandler;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Livewire\Component;
use Livewire\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class EditUser extends Component
{
    use WithFileUploads;
    use AuthorizesRequests;

    private const PHOTO_PATH = '/photo/';

    public int $userId;

    public string $firstName;

    public string $lastName;

    /** @var TemporaryUploadedFile */
    public $photo;

    public User $user;

    public bool $removePhoto = false;

    protected array $rules = [
        'user.first_name' => 'string|max:255',
        'user.last_name' => 'string|max:255',
        'photo' => 'nullable|image',
        'removePhoto' => 'nullable',
    ];

    public function mount(User $user): void
    {
        $this->user = $user;
    }

    public function update(UpdateUserHandler $updateUserHandler)
    {
        $this->authorize('update', $this->user);

        $validatedData = $this->validate();

        $user = $updateUserHandler->handle(new UpdateUserCommand(
            $this->user,
            $validatedData['removePhoto'] ? null : $this->resolvePhoto($validatedData['photo']),
        ));

        return redirect()
            ->route('user.show', [$user])
            ->with('success', trans('User updated!'));
    }

    public function updatedPhoto(): void
    {
        $photo = Image::make($this->photo);
        $photo->fit(User::IMAGE_WIDTH, User::IMAGE_HEIGHT, function ($constraint) {
            $constraint->upsize();
        });

        $path = implode('/', [$this->photo->getPath(), $this->photo->getFilename()]);
        $photo->save($path);
    }

    private function resolvePhoto(mixed $photo): ?string
    {
        if (! $photo instanceof TemporaryUploadedFile) {
            return $this->user->image_path;
        }

        $resizedPhoto = Image::make($photo);
        $resizedPhoto->fit(User::IMAGE_WIDTH, User::IMAGE_HEIGHT, function ($constraint) {
            $constraint->upsize();
        });
        $path = self::PHOTO_PATH.$this->user->username.'.'.$photo->extension();

        $photo->delete();
        Storage::disk('public')->put($path, $resizedPhoto->encode(), 'public');

        return Storage::disk('public')->url($path);
    }
}
