<h1>
    Files
</h1>

<a href="{{ route('create') }}">Upload File</a>

<table>
    <thead>
        <tr>
            <th>#</th>
            <th>File Name</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($files as $file)
            <tr>
                <td>{{ $file->id }}</td>
                <td>
                    <a href="{{ asset('files/'. $file->file) }}">{{ $file->name }}</a>
                    {{-- <img src="{{ asset('files/'. $file->file) }}" width="120px" height="60px"/> --}}
                    {{-- {{ $file->name }} --}}
                </td>
                <td>
                    <a href="{{ route('edit', $file->id) }}">Edit</a>
                </td>
                <td>
                    <a href="{{ route('delete', $file->id) }}">Delete</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>