Hello {{ $contact->name }}! We would like to invite you to event: <br><br>

{{ $data->title }}.<br><br>

Please click the link to register: <br><br>

<a href="{{ route('invitation.register',[$data->id, $contact->hashcode]) }}">Register for this event</a>
