<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Althinect\FilamentSpatieRolesPermissions\FilamentSpatieRolesPermissionsPlugin;
use Filament\Navigation\NavigationBuilder;
use Filament\Navigation\NavigationGroup;
use App\Filament\Resources\UptdResource;
use App\Filament\Resources\JabatanResource;
use App\Filament\Resources\PegawaiResource;
use App\Filament\Resources\TargetResource;
use App\Filament\Resources\PerusahaanResource;
use App\Filament\Resources\SetorbbmResource;
use App\Filament\Resources\SetorprResource;
use App\Filament\Resources\UserResource;
use Filament\Navigation\NavigationItem;
use Filament\Pages\Dashboard;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->sidebarCollapsibleOnDesktop()
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->registration()
            ->profile()
            ->colors([
                'primary' => Color::Blue,
            ])
            ->databaseNotifications()
            ->brandLogo(asset('images/Logo.png'))
            ->darkModeBrandLogo(asset('images/dark-Logo.png'))
            ->favicon(asset('images/favicon.png'))
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                // Widgets\AccountWidget::class,
                // Widgets\FilamentInfoWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->plugin(FilamentSpatieRolesPermissionsPlugin::make())
            ->authMiddleware([
                Authenticate::class,
            ]);

            // ->navigation(function (NavigationBuilder $builder): NavigationBuilder {
            //     return $builder->groups([
            //         NavigationGroup::make()
            //             ->items([
            //                 NavigationItem::make('Dashboard')
            //                 ->icon('heroicon-o-home')
            //                 ->isActiveWhen(fn (): bool => request()->routeIs('filament.admin.page.dashboard'))
            //                 ->url(fn (): string => Dashboard::getUrl()),
            //             ]),
            //         NavigationGroup::make('Manage Unit')
            //             ->items([
            //                 ...UptdResource::getNavigationItems(),
            //                 ...PegawaiResource::getNavigationItems(),
            //                 ...JabatanResource::getNavigationItems(),
            //                 ...TargetResource::getNavigationItems(),
            //             ]),
            //         NavigationGroup::make('Manage PBB KB')
            //             ->items([
            //                 ...PerusahaanResource::getNavigationItems(),
            //                 ...SetorbbmResource::getNavigationItems(),
            //             ]),
            //         NavigationGroup::make('Manage Pajak Rokok')
            //             ->items([
            //                 ...SetorprResource::getNavigationItems(),
            //             ]),
            //         NavigationGroup::make('Setting')
            //             ->items([
            //                 ...UserResource::getNavigationItems(),
            //                 NavigationItem::make('Roles')
            //                     ->icon('heroicon-o-user-group')
            //                     ->isActiveWhen(fn (): bool => request()->routeIs([
            //                         'filament.admin.rescources.roles.index',
            //                         'filament.admin.rescources.roles.create',
            //                         'filament.admin.rescources.roles.view',
            //                         'filament.admin.rescources.roles.edit',
            //                     ]))
            //                     ->url(fn (): string => '/admin/roles'),
            //                 NavigationItem::make('Permissions')
            //                     ->icon('heroicon-o-lock-closed')
            //                     ->isActiveWhen(fn (): bool => request()->routeIs([
            //                         'filament.admin.rescources.roles.index',
            //                         'filament.admin.rescources.roles.create',
            //                         'filament.admin.rescources.roles.view',
            //                         'filament.admin.rescources.roles.edit',
            //                     ]))
            //                     ->url(fn (): string => '/admin/permissions'),
            //             ]),
            //     ]);
            // });
    }
}
