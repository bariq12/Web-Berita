<?php

namespace App\Filament\Auth\Pages;

use App\Models\User;
use Filament\Auth\Pages\Register as BaseRegister;
use Filament\Auth\Http\Responses\Contracts\RegistrationResponse;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class Register extends BaseRegister
{
    protected function getFormSchema(): array
    {
        return [
            $this->getNameFormComponent(),
            $this->getEmailFormComponent(),
            $this->getPasswordFormComponent(),
            $this->getPasswordConfirmationFormComponent(),

            FileUpload::make('avatar')
                ->image()
                ->directory('news/authors')
                ->disk('public')
                ->visibility('public')
                ->required(),

            Textarea::make('bio')
                ->rows(3)
                ->maxLength(500),
        ];
    }

    public function register(): ?RegistrationResponse
    {
        $data = $this->form->getState();

        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        $user->author()->create([
            'username' => Str::slug($data['name']),
            'avatar'   => $data['avatar'],
            'bio'      => $data['bio'],
        ]);

        event(new Registered($user));

        Auth::login($user);

        return app(RegistrationResponse::class);
    }
}
