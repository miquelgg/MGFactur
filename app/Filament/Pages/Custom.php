<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

use Filament\Actions\Action;
use Filament\Support\Enums\Size;
use Filament\Support\Enums\IconPosition;

    
class Custom extends Page
{
    protected string $view = 'filament.pages.custom';

    protected function getActions(): array
    {
        return [
            Action::make('customAction')
                ->label('Custom Action')
                ->icon('heroicon-m-pencil-square')
                ->iconPosition(IconPosition::After)
                ->color('info')
                #->disabled()
                #->size(Size::Large)
                ->size(Size::Small)
                ->button()
                #->link()
                #->badge(fn () => 5)
                #->badge()
                #->iconButton()
                ->action(fn () => $this->handleCustomAction()),
        ];
    }

    protected function handleCustomAction(): void
    {
        // Handle the custom action logic here
    }
}
