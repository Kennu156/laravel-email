<x-mail::message>
    @foreach ($data as $day)
        <p>{{$day[0]['date']}}</p>
        <p>{{$day[0]['name']}}</p>

    @endforeach
</x-mail::message>