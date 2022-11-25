<?php

namespace App\Http\Livewire\User\Forms;

use App\Command\User\UpdateUserCommand;
use App\Command\User\UpdateUserHandler;
use App\Models\User;
use App\Queries\User\ViewUserByIdHandler;
use App\Queries\User\ViewUserByIdQuery;
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
        'firstName' => 'string|max:255',
        'lastName' => 'string|max:255',
        'photo' => 'nullable|image',
        'removePhoto' => 'nullable',
    ];

    public function updatedPhoto(): void
    {
        $photo = Image::make($this->photo);
        $photo->fit(User::IMAGE_WIDTH, User::IMAGE_HEIGHT, function ($constraint) {
            $constraint->upsize();
        });

        $path = implode('/', [$this->photo->getPath(), $this->photo->getFilename()]);
        $photo->save($path);
    }

    public function mount(ViewUserByIdHandler $viewUserByIdHandler): void
    {
        $user = $viewUserByIdHandler->handle(new ViewUserByIdQuery($this->userId));

        if ($user === null) {
            redirect()->route('welcome');
        }

        $this->user = $user;
        $this->firstName = $user->first_name;
        $this->lastName = $user->last_name;
    }

    public function update(UpdateUserHandler $updateUserHandler)
    {
        $this->authorize('update', $this->user);

        $validatedData = $this->validate();

        $user = $updateUserHandler->handle(new UpdateUserCommand(
            $this->user,
            $validatedData['firstName'],
            $validatedData['lastName'],
            $validatedData['removePhoto'] ? null : $this->resolvePhoto($validatedData['photo']),
        ));

        return redirect()
            ->route('user.show', [$user])
            ->with('success', trans('User updated!'));
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
