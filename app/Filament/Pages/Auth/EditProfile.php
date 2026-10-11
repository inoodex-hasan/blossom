<?php

namespace App\Filament\Pages\Auth;

use App\Services\ImageService;
use Filament\Auth\Pages\EditProfile as BaseEditProfile;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Component;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Http\UploadedFile;

class EditProfile extends BaseEditProfile
{
    protected static ?string $title = 'Profile Settings';

    public function getTitle(): string | Htmlable
    {
        return 'Profile Settings';
    }

    public static function getLabel(): string
    {
        return 'Profile Settings';
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['password'] = null;
        $data['passwordConfirmation'] = null;
        $data['currentPassword'] = null;

        return $data;
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Profile Information')
                    ->description('Update your public account name, email address, and profile photo.')
                    ->icon('heroicon-o-user-circle')
                    ->schema([
                        $this->getAvatarFormComponent(),
                        $this->getNameFormComponent(),
                        $this->getEmailFormComponent(),
                    ]),

                Section::make('Update Password')
                    ->description('Ensure your account is using a long, random password to stay secure.')
                    ->icon('heroicon-o-key')
                    ->schema([
                        $this->getPasswordFormComponent(),
                        $this->getPasswordConfirmationFormComponent(),
                        $this->getCurrentPasswordFormComponent(),
                    ]),
            ]);
    }

    protected function getAvatarFormComponent(): Component
    {
        return FileUpload::make('avatar')
            ->label('Profile Photo')
            ->avatar()
            ->image()
            ->circleCropper()
            ->directory('avatars')
            ->disk('public')
            ->visibility('public')
            ->maxSize(5120)
            ->saveUploadedFileUsing(function (UploadedFile $file): string {
                return app(ImageService::class)->storeAsWebp($file, 'avatars', 400, 90);
            })
            ->helperText('Upload a square profile photo (JPG, PNG, WebP up to 5MB). Auto-optimized to WebP.');
    }
}
