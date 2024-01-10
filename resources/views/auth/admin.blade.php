@extends('layouts.dashboard')



@section('dashboard-content')

<div class="card bg-black text-white p-2">
    <div class="card-header">Users</div>
    <div class="card-body">
        <div class=" d-flex flex-column input-group mb-3">
            {{-- @foreach ($allusers as $user)
                                <div class="form-group mb-3">
                                    <form action="{{ ('update') }}" method="post">
            <div class="d-flex flex-row">
                <input value="{{ $user->username }}" class="">

                </input>


            </div>
            </form>
        </div>
        @endforeach --}}
        <table class="table table-striped table-dark">
            <thead>
                <tr>
                    <th scope="col">RaceName</th>
                    <th scope="col">Name</th>
                    <th scope="col">Score</th>
                    <th scope="col">Image</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($scores as $index => $score)

                <tr>
                    <th scope="row">{{ $score->race_name }}</th>
                    <td>{{ $score->user->username }}</td>
                    <form action="{{ route('scores.edit')}}" method="POST">
                        @csrf
                        <td>
                            <input type="text" value="{{ $score->score }}" />
                        </td>
                        <td>
                            <img src="data:image/png;base64,{{ $score->image }}" alt="User Image" width="50" height="50">
                        </td>
                        <td>
                            <button type="submit" method="POST" action="" class="m-2 bg-dark text-white">Verander</button>
                        </td>
                    </form>
                    <form action="">
                        <td>
                            @csrf
                            @method('DELETE')
                            <button type="" method="POST" action="{{ route('scores.delete') }}" class="m-2 bg-dark text-white">Verwijder</button>
                        </td>
                    </form>
                </tr>


                @endforeach
            </tbody>
        </table>

    </div>
</div>

@endsection