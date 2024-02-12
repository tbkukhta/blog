$(function () {
    let objects = [
        {
            name: '#description',
            toolbar: {
                items: ['heading', '|', 'alignment', '|', 'bold', 'italic', '|', 'undo', 'redo'],
            },
        },
        {
            name: '#content',
            toolbar: {
                items: [
                    'heading',
                    '|',
                    'bold',
                    'italic',
                    'link',
                    'bulletedList',
                    'numberedList',
                    '|',
                    'outdent',
                    'indent',
                    'alignment',
                    '|',
                    'blockQuote',
                    'insertTable',
                    'CKFinder',
                    'undo',
                    'redo',
                ]
            },
            image: {
                toolbar: [
                    'imageTextAlternative',
                    'imageStyle:inline',
                    'imageStyle:block',
                ],
            },
        },
    ];
    objects.forEach((object) => {
        ClassicEditor.create(document.querySelector(object.name), {
            ckfinder: {
                uploadUrl: '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json'
            },
            language: 'en',
            toolbar: object.toolbar,
            image: object.image ?? {},
        }).catch(function (error) {
            console.error(error);
        });
    });
    CKFinder.config({
        connectorPath: '/ckfinder/connector',
    });
});
