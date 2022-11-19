<h1>Edit File</h1>


<form action="{{ route('update', $file->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="text" name="name" value="{{ $file->name }}">
    <input type="file" name="file">

    <input type="hidden" name="old_file" value="{{ $file->file }}">

    <button>Update</button>
</form>