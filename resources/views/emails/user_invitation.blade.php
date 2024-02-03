<x-mail::message>

Dear {{ $name }},

You have been added by your Company as an employee on the Affinity software. <br>
To discuss further and receive your login details, please see your Company Super Admin.


In the meantime, please find the details of your account below:

|  |  |
| ----------- | ----------- |
| **Name** | {{ $name }} |
| **Email** | {{ $email }} |
| **Password** | {{ $password }} |
| **Company Name** | {{ $company_name }} |


@component('components.button-link', ['href' => $url])
    Login
@endcomponent

<br>
Thank you {{ config('app.name') }}.
</x-mail::message>
