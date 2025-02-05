<x-mail::message>
    @php
        $groupedData = $data->groupBy('date');
    @endphp
 
    @foreach($groupedData as $date => $entries)
        <h2 class="date-header">{{ $date }}</h2>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Room</th>
                    <th>Teacher</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                </tr>
            </thead>
            <tbody>
                @foreach($entries as $entry)
                    <tr>
                        <td>{{ $entry['name'] }}</td>
                        <td>{{ $entry['room'] }}</td>
                        <td>{{ $entry['teacher'] }}</td>
                        <td>{{ $entry['time_start'] }}</td>
                        <td>{{ $entry['time_end'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endforeach
</x-mail::message>