document.addEventListener('DOMContentLoaded', function() {
    const friendsTab = document.getElementById('friends-tab');
    const followersTab = document.getElementById('followers-tab');
    const followingTab = document.getElementById('following-tab');
    const friendsList = document.getElementById('friends-list');
    const followersList = document.getElementById('followers-list');
    const followingList = document.getElementById('following-list');

    friendsTab.addEventListener('click', function() {
        friendsTab.classList.add('active');
        friendsList.classList.remove('d-none');

        followersTab.classList.remove('active');
        followersList.classList.add('d-none');

        followingTab.classList.remove('active');
        followingList.classList.add('d-none');
    });

    followersTab.addEventListener('click', function() {
        followersTab.classList.add('active');
        followersList.classList.remove('d-none');

        followingTab.classList.remove('active');
        followingList.classList.add('d-none');

        friendsTab.classList.remove('active');
        friendsList.classList.add('d-none');
    });

    followingTab.addEventListener('click', function() {
        followingTab.classList.add('active');
        followingList.classList.remove('d-none');

        followersTab.classList.remove('active');
        followersList.classList.add('d-none');

        friendsTab.classList.remove('active');
        friendsList.classList.add('d-none');

    });
});
