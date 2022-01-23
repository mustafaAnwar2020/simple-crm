@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">Deleted clients</div>

        <div class="card-body">
            {{-- @if (session('status'))
            <div class="alert alert-danger" role="alert">
                {{ session('status') }}
            </div>
        @endif --}}

            <table class="table table-responsive-sm table-striped">
                <thead>
                    <tr>
                        <th>Company</th>
                        <th>VAT</th>
                        <th>Address</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($clients as $client)
                        <tr>
                            <td>{{ $client->copmany_name }}</td>
                            <td>{{ $client->copmany_vat }}</td>
                            <td>{{ $client->copmany_address }}</td>
                            <td>
                                <a class="btn btn-xs btn-success" href="{{ route('clients.restore', $client->id) }}">
                                    Restore
                                </a>

                                <form action="{{ route('clients.delete', $client->id) }}" method="POST"
                                    onsubmit="return confirm('Are your sure?');" style="display: inline-block;">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="submit" class="btn btn-xs btn-danger" value="Delete">
                                </form>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- {{ $clients->withQueryString()->links() }} --}}
        </div>
    </div>

@endsection
