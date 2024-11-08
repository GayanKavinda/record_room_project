@extends('layouts.app')  <!-- Ensure this is extending your layout -->

@section('content')  <!-- Ensure you are defining content here -->
    <div class="container">
        <h2>Stored Files</h2>
        @if ($storedFiles->isEmpty())
            <p>No stored files found.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>File Number</th>
                        <th>Status</th>
                        <th>Rack Letter</th>
                        <th>Sub Rack</th>
                        <th>Cell Number</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($storedFiles as $file)
                        <tr>
                            <td>{{ $file->file_no }}</td>
                            <td>{{ $file->status }}</td>
                            <td>{{ $file->rack_letter }}</td>
                            <td>{{ $file->sub_rack }}</td>
                            <td>{{ $file->cell_number }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
