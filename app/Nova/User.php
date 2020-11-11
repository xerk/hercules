<?php

namespace App\Nova;

use Laravel\Nova\Panel;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Avatar;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Country;
use Laravel\Nova\Fields\Gravatar;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\Fields\Sparkline;
use App\Nova\Actions\AddPointsToUsers;

class User extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\User::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'name', 'email',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),

            Avatar::make('Profile', 'profile_photo_path')->maxWidth(50),
            // Gravatar::make()->maxWidth(50),

            Text::make('Name')
                ->sortable()
                ->rules('required', 'max:255'),

            // Text::make('Username')
            //     ->sortable()
            //     ->rules('max:255')
            //     ->creationRules('unique:users,username')
            //     ->updateRules('unique:users,username,{{resourceId}}'),

            Text::make('Email')
                ->sortable()
                ->rules('required', 'email', 'max:254')
                ->creationRules('unique:users,email')
                ->updateRules('unique:users,email,{{resourceId}}'),
                
                Password::make('Password')
                ->onlyOnForms()
                ->creationRules('required', 'string', 'min:8')
                ->updateRules('nullable', 'string', 'min:8'),

                Number::make('Point')
                        ->sortable()
                    ->rules('numeric'),

                Select::make('Membership')->options([
                    'bronze' => 'Bronze',
                    'silver' => 'Silver',
                    'gold' => 'Gold (VIP)',
                ])->displayUsingLabels(),
                
                
                Text::make('Phone Number', 'phone')->textAlign('left'),
                
                Country::make('Country')->hideFromIndex(),
                
                new Panel('Addtional Information', $this->addtionalFields()),
            ];

    }

    public function addtionalFields() {
        return [

            Text::make('Serial Number', 'serial_number')->hideFromIndex(),

            Select::make('Serial Type')->options([
                'monthly' => 'Monthly',
                'lifetime' => 'Lifetime',
            ])->displayUsingLabels()->hideFromIndex(),

            Date::make('Serial Date')->hideFromIndex(),
            
            Text::make('Link', 'link')->hideFromIndex(),

            Date::make('Last Seen', 'last_seen')->hideFromIndex(),

        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [
            new AddPointsToUsers
        ];
    }
}
