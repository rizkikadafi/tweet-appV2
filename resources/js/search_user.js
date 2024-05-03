import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common = {
    'X-Requested-With': 'XMLHttpRequest',
    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
};

document.addEventListener('DOMContentLoaded', function() {
    const searchUserInput = document.getElementById('search-user')
    const searchResults = document.getElementById('search-results')
    searchUserInput.addEventListener('keyup', function() {
        const keyword = searchUserInput.value;
        searchResults.innerHTML = `
            <li class="list-group-item placeholder-glow">
              <div class="user">
                <div class="row align-items-center">
                  <div class="col-1 me-3">
                    <img class="rounded-circle placeholder" width="40" height="40">
                  </div>
                  <div class="col">
                    <span class="d-block mb-2 placeholder"></span>
                    <div class="row">
                      <div class="col-4">
                        <a href="" class="text-white d-block placeholder"></a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </li>
        `
        axios.post('/search-user', { keyword: keyword })
            .then(response => {
                const users = response.data.users

                let results = ``

                users.forEach(user => {
                    results += `${createUserElement(user)}`
                });

                searchResults.innerHTML = results
                // console.log(results)

            }).catch(error => {
                console.error(error);
            });
    })

})

function createUserElement(user) {
    return `
        <li class="list-group-item">
            <div class="user">
                <div class="row align-items-center">
                    <div class="col-1 me-3">
                        <img class="rounded-circle" width="40" height="40" src="/${user.avatar}">
                    </div>
                    <div class="col">
                        <span class="d-block text-white fw-bold">${user.name}</span>
                        <a href="/${user.username}" class="link-underline link-underline-opacity-0 text-secondary">@${user.username}</a>
                    </div>
                </div>
            </div>
        </li>
    `;
}
