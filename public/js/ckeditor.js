// select option mutile 
new MultiSelectTag('tags')

// editor wysiwyg
ClassicEditor.create(document.querySelector('#description'))
    .catch(error => {
        console.error(error);
    });
