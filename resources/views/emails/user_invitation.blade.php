<x-mail::message>

Dear {{ $name }},

You have been added by your Company as an employee on the Affinity software. <br>
To discuss further on your user level, please see your Company Super Admin.


In the meantime, please find the details of your account below;<br>
(it is always recommended to change your password as soon as you have logged in):

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
