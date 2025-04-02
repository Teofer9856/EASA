<form method="POST" action="{{$route}}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <label for="uploadFile" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center me-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
        <i class="fa-solid fa-upload"></i>
        <span class="ml-2">Import</span>
        <input type="file" id="uploadFile" name="uploadFile" class="hidden" oninput="submit()"/>
    </label>
</form>
<script>
    let file = document.getElementById('uploadFile');

    /* file.addEventListener('change', (e) => {
        e.submit();
    }) */
    function submit(){
        file.submit();
    }
</script>