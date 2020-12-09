@component('mail::message')
# Introduction

You data has been expoted, please check your account.

@component('mail::button', ['url' => 'https://www.herculesprojects.net/dashboard/clients'])
Check
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
