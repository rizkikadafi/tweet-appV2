import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common = {
    'X-Requested-With': 'XMLHttpRequest',
    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
};

const followersCount = document.getElementById('followers-count');

document.addEventListener('click', (event) => {
    const targetBtn = event.target;
    if (targetBtn.id === 'follow-btn') {
        targetBtn.classList.replace('btn-outline-primary', 'btn-outline-secondary');
        targetBtn.id = 'following-btn';
        targetBtn.innerHTML = 'Following';
        followersCount.innerHTML = parseInt(followersCount.textContent) + 1

        axios.post(`/users/follow/${targetBtn.dataset.friendId}`)
            .then((response) => {
                console.log(response);
            }).catch((error) => {
                console.log(error);
            });

    } else if (targetBtn.id === 'following-btn') {
        targetBtn.classList.replace('btn-outline-secondary', 'btn-outline-primary');
        targetBtn.id = 'follow-btn';
        targetBtn.innerHTML = 'Follow';
        followersCount.innerHTML = parseInt(followersCount.textContent) - 1

        axios.post(`/users/unfollow/${targetBtn.dataset.friendId}`)
            .then((response) => {
                console.log(response);
            }).catch((error) => {
                console.log(error);
            });
    } else if (targetBtn.id == 'followback-btn') {
        targetBtn.classList.replace('btn-outline-primary', 'btn-outline-secondary');
        targetBtn.id = 'following-btn';
        targetBtn.innerHTML = 'Following';
        followersCount.innerHTML = parseInt(followersCount.textContent) + 1

        axios.post(`/users/follow/${targetBtn.dataset.friendId}`)
            .then((response) => {
                console.log(response);
            }).catch((error) => {
                console.log(error);
            });
    }
});

