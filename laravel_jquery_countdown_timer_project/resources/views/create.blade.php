@extends('layout.app')

@section('main-content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="mt-3 text-center">Create CountDown Timer</h2>
                <form>
                    <div class="mb-3">
                        <label for="launch_date" class="form-label">Select Date Time <span class="text-danger">*</span></label>
                        <input type="datetime-local" class="form-control" id="launch_date" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Status <span
                                class="text-danger">*</span></label>
                        <select class="form-select" aria-label="Default select example">
                            <option value="0">Inactive</option>
                            <option value="1">Active</option>
                        </select>
                    </div>
                    <div class="d-grid gap-2">
                        <input type="submit" class="btn btn-primary" value="Save"/>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
