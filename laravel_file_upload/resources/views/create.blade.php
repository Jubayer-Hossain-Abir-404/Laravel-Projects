<h1>Upload File</h1>

<form action="{{ route('store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="text" name="name" placeholder="give a name to the file">
    <input type="file" name="file" />
    <button>Submit</button>
</form>