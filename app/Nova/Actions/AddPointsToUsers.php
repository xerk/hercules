<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Actions\Action;
use Illuminate\Support\Collection;
use Laravel\Nova\Fields\ActionFields;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class AddPointsToUsers extends Action
{
    use InteractsWithQueue, Queueable;


    /**
     * Get the displayable name of the action.
     *
     * @return string
     */
    public function name()
    {
        return __('Action Points');
    }

    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        foreach ($models as $model) {
            if (($model->point + $fields->amount) >= 0) {
                $model->point = $model->point + $fields->amount;
            } else {
                $model->point = 0;
            }
            $model->save();
        }

        return Action::message('Awasome Points updated!');
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        return [
            Text::make('Amount'),
        ];
    }
}
