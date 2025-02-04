<x-mail::message>
    @foreach ($data as $day)
        <p>{{$day[0]['date']}}</p>
        

    @endforeach
</x-mail::message>