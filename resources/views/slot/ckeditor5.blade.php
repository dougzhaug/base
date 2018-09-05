@push('head')
    @parent
    <script src="https://cdn.ckeditor.com/ckeditor5/11.0.1/classic/ckeditor.js"></script>
@endpush

<textarea name="content" id="editor" rows="100" cols="800">This is my textarea to be replaced with CKEditor.</textarea>

@push('footer')
    @parent
    <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .then( editor => {
                console.log( editor );
            } )
            .catch( error => {
                console.error( error );
            } );
    </script>
@endpush