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
use Laravel\Nova\Fields\Password;
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
     * Get the displayable label of the resource.
     *
     * @return string
     */
    public static function label()
    {
        return __('Users');
    }

    /**
     * Get the displayable singular label of the resource.
     *
     * @return string
     */
    public static function singularLabel()
    {
        return __('User');
    }

    /**
     * Get the text for the create resource button.
     *
     * @return string|null
     */
    public static function createButtonLabel()
    {
        return __('Create User');
    }

    /**
     * Get the text for the update resource button.
     *
     * @return string|null
     */
    public static function updateButtonLabel()
    {
        return __('Save Changes');
    }

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

            Avatar::make(__('Profile'), 'profile_photo_path')->maxWidth(50),
            // Gravatar::make()->maxWidth(50),

            Text::make(__('Name'), 'name')
                ->sortable()
                ->rules('required', 'max:255'),

            // Text::make('Username')
            //     ->sortable()
            //     ->rules('max:255')
            //     ->creationRules('unique:users,username')
            //     ->updateRules('unique:users,username,{{resourceId}}'),

            Text::make(__('Email'), 'email')
                ->sortable()
                ->rules('required', 'email', 'max:254')
                ->creationRules('unique:users,email')
                ->updateRules('unique:users,email,{{resourceId}}'),
                
                Password::make(__('Password'), 'password')
                ->onlyOnForms()
                ->creationRules('required', 'string', 'min:8')
                ->updateRules('nullable', 'string', 'min:8'),

                Number::make(__('Point'), 'point')
                        ->sortable()
                    ->rules('numeric'),

                Select::make(__('Membership'), 'membership')->options([
                    'bronze' => 'Bronze',
                    'silver' => 'Silver',
                    'gold' => 'Gold (VIP)',
                ])->displayUsingLabels(),
                
                
                Text::make(__('Phone Number'), 'phone')->textAlign('left'),
                
                Country::make(__('Country'), 'country')->hideFromIndex(),
                
                Select::make(__('Locale'), 'locale')->options([
                    'en' => 'English',
                    'ar' => 'Arabic',
                ])->displayUsingLabels(),

                new Panel(__('Additional Information'), $this->addtionalFields()),
            ];

    }

    public function addtionalFields() {
        return [

            Text::make(__('Serial Number'), 'serial_number')->hideFromIndex(),

            Select::make(__('Serial Type'), 'serial_type')->options([
                'monthly' => 'Monthly',
                'lifetime' => 'Lifetime',
            ])->displayUsingLabels()->hideFromIndex(),

            Date::make(__('Serial Date'), 'serial_date')->hideFromIndex(),
            
            Text::make(__('Link'), 'link')->hideFromIndex(),

            Date::make(__('Last Seen'), 'last_seen')->hideFromIndex(),
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
