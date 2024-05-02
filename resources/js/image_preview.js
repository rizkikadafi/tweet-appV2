const image = document.getElementById('image')

image.addEventListener('change', function() {
    const fileInfo = this.files[0];

    const fr = new FileReader();
    const imgPreview = document.querySelector('.img-preview')
    fr.onload = function() { imgPreview.src = this.result; };
    fr.readAsDataURL(fileInfo);
});

// const alertPlaceholder = document.getElementById('upload-alert')
// const appendAlert = (message, type) => {
//     const wrapper = document.createElement('div')
//     wrapper.innerHTML = [
//         `<div class="alert alert-${type} alert-dismissible" role="alert">`,
//         `   <div>${message}</div>`,
//         '   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>',
//         '</div>'
//     ].join('')

//     alertPlaceholder.append(wrapper)
// }

// function previewImg() {
//     const image = document.getElementById('image')
//     const imgPreview = document.querySelector('.img-preview')

//     const fr = new FileReader();
//     fr.readAsDataURL(image.files[0]);
//     fr.onload = function() { imgPreview.src = this.result; };
// }

