<x-mail::message>
# Demo Form Submission

We have received a new form submission for booking a demo of the affinity application.

Please find the details below:

|  |  |
| ----------- | ----------- |
| **Name** | {{ $name }} |
| **Email** | {{ $email }} |
| **Telephone** | {{ $tel }} |
| **Message** | {{ $message }} |

<br>
Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
