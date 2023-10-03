<x-mail::message>
# Contact Form Submission

We have received a new contact form submission.

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
