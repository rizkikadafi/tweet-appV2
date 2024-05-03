import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common = {
    'X-Requested-With': 'XMLHttpRequest',
    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
};

document.addEventListener('click', (event) => {
    const targetBtn = event.target;
    if (targetBtn.classList.contains('like-btn')) {
        const dataPostId = targetBtn.dataset.postId
        const likesCount = document.querySelector(`.like-count[data-post-id="${dataPostId}"]`)
        targetBtn.classList.replace('like-btn', 'unlike-btn')
        targetBtn.classList.replace('bi-heart', 'bi-heart-fill');
        targetBtn.classList.add('text-danger');
        likesCount.innerHTML = parseInt(likesCount.textContent) + 1

        axios.post(`/posts/like/${targetBtn.dataset.postId}`)
            .then((response) => {
                console.log(response);
            }).catch((error) => {
                console.log(error);
            });

    } else if (targetBtn.classList.contains('unlike-btn')) {
        const dataPostId = targetBtn.dataset.postId
        const likesCount = document.querySelector(`.like-count[data-post-id="${dataPostId}"]`)
        targetBtn.classList.replace('unlike-btn', 'like-btn')
        targetBtn.classList.replace('bi-heart-fill', 'bi-heart');
        targetBtn.classList.remove('text-danger');
        likesCount.innerHTML = parseInt(likesCount.textContent) - 1

        axios.post(`/posts/unlike/${targetBtn.dataset.postId}`)
            .then((response) => {
                console.log(response);
            }).catch((error) => {
                console.log(error);
            });
    }
});

