@extends('layout')
@section('content')

<main>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="content">
                    <div class="text-end p-2">
                        <button type="button" class="ms-auto btn btn-sm btn-primary" data-bs-toggle="modal"
                            data-bs-target="#exampleModal" title="Add Friend">Add Friend</button>
                    </div>

                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Sl.</th>
                                <th scope="col">Image</th>
                                <th scope="col">Name</th>
                                <th scope="col">Address</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $friends = DB::table('friends')->get();
                            $i = 1;
                            @endphp
                            @foreach ($friends as $item)
                            <tr>
                                <th>{{ $i++ }}</th>
                                <td>
                                    <img src="{{ $item->image }}" alt="" style="width: 50px;">
                                </td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->address }}</td>
                                <td>
                                    <a href="{{ route('edit.friends', $item->id ) }}" class="btn btn-sm btn-primary"
                                        title="Edit Friend"><i class="fa-regular fa-pen-to-square"></i></a>
                                    <a href="{{ route('delete.friend', $item->id) }}" class="btn btn-sm btn-danger"
                                        title="Delete Friend"><i class="fa-regular fa-trash-can"></i> </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('add.friends') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label"><strong>Friends Name </strong> </label>
                        <input type="text" name="name" class="form-control" id="name"
                            placeholder="Enter Your Friends Name">
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label"> <strong> Friends Address</strong> </label>
                        <input type="text" name="address" class="form-control" id="address"
                            placeholder="Enter Your Friends Address">
                        @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label"><strong>Friends Image</strong></label>
                        <input type="file" name="image" class="form-control" id="image">
                        @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection
