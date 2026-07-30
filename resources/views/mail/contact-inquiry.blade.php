<x-mail::message>
<div class="inquiry-icon" aria-hidden="true">&#9993;</div>

# New project inquiry

Hi Techibytes Media team,

{{ $name }} submitted a new inquiry through the website. The project details are below.

<x-mail::panel>
**Inquiry details**

**Name:** {{ $name }}
**Email:** [{{ $email }}](mailto:{{ $email }})
**Service:** {{ $service ?: 'Not specified' }}
**Budget:** {{ $budget ?: 'Not specified' }}
</x-mail::panel>

**Project brief**

<div class="message-copy">{{ $message }}</div>

Reply directly to this email to contact {{ $name }}.

Thanks,
**Techibytes Media**
</x-mail::message>
