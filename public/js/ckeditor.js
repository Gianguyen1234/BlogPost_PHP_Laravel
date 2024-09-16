import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

ClassicEditor
    .create(document.querySelector('#content'), {
        toolbar: {
            items: [
                'heading', '|',
                'bold', 'italic', 'underline', '|',
                'link', 'imageUpload', 'blockQuote', 'insertTable', 'mediaEmbed', '|',
                'undo', 'redo'
            ]
        },
       
    })
    .catch(error => {
        console.error(error);
    });