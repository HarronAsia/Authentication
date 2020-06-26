@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Profile Page -->
        <a href="javascript:history.back()" class="btn btn-primary">Back</a>
        <form action="/admin/{{$user->id}}/update " method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="photo">User Image</label>
                <input type="file" class="form-control" name="photo" required>
            </div>

            <div class="form-group">
                <label for="name">User name</label>
                <input class="form-control" name="name" placeholder="Enter User Name" value="{{ $user->name}}" required>
            </div>

            <div class="form-group">
                <label for="name">User email</label>
                <input class="form-control" name="email" placeholder="Enter User Name" value="{{ $user->email}}" required>
            </div>

            <div class="form-group">
                <label for="name">User password</label>
                <input class="form-control" name="password" placeholder="Enter User Name" value="{{ $user->password}}" required>
            </div>

            <div class="form-group">
                <label for="dob">User Birthday</label>
                <input type="date" class="form-control" name="dob" placeholder="Enter User DOB" value="{{ $user->dob }}" required>
            </div>

            <div class="form-group">
                <label for="number">User Phone Number</label>
                <input type="tel" class="form-control" name="number" placeholder="Enter User Phone Number" value="{{ $user->number }}" required>
            </div>

            <div class="form-group">
                <label for="role" class="col-md-4 control-label">User Type:</label>
                    <select class="form-control" name="role" id="role">
                        <option value="admin">Admin</option>
                        <option value="manager">Manager</option>
                        <option value="member">Member</option>
                    </select>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-default">Submit</button>
            </div>
        </form>
        <!-- Profile Page -->
    </div>
</div>

@endsection