<x-mail::message>
# Thank You!!!

Dear {{ $name }},

Thank you for taking the time to contact us. We have received your message and appreciate your interest in our products/services.

Our Sales team is diligently reviewing your inquiry, and we will get back to you shortly with a detailed response.<br>
Your satisfaction is important to us, and we aim to provide you with the best possible assistance.

In the meantime, please find the details of your submission below:

|  |  |
| ----------- | ----------- |
| **Name** | {{ $name }} |
| **Email** | {{ $email }} |
| **Telephone** | {{ $tel }} |
| **Message** | {{ $message }} |

<br>
Thank you once again for choosing {{ config('app.name') }}.
We look forward to serving you and addressing your needs.
</x-mail::message>
