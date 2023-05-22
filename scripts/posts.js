let heartIcons = document.querySelectorAll(".heart-bookmark .fa-heart");
for(let i = 0; i < heartIcons.length; i++){
    let heartIcon = heartIcons[i];
    heartIcon.addEventListener("click", handleHeartIconClick);
}

let bookmarkIcons = document.querySelectorAll(".heart-bookmark .fa-bookmark");
for(let i = 0; i < bookmarkIcons.length; i++){
    let bookmarkIcon = bookmarkIcons[i];
    bookmarkIcon.addEventListener("click", handleBookmarkIconClick);
}

let postButton = document.querySelector("#post-publish");
postButton.addEventListener("click", handlePostButtonClick)

async function handlePostButtonClick(e){
    try{
        let postTitle = document.querySelector("#post-title").value;
        let postDescription = document.querySelector("#post-content").value;
        let username = "Laura James";
        let picture = document.querySelector("#upload-image").files[0];
        let formData = new FormData();
        formData.append("title", postTitle);
        formData.append("description", postDescription);
        formData.append("username", username);
        formData.append("picture", picture);
        let serverResponse = await fetch(`php/API.php?action=addPost`, {
            method: "POST",
            body: formData
        });
        let responseData = await serverResponse.json();
        if(responseData.success){
            location.reload();
        }
        else{
            alert(responseData.error);
        }
    }
    catch(ex){
        alert("Error when publishing post.");
    }
}

async function handleHeartIconClick(e){
    let heartIcon = e.currentTarget;
    let parentDiv = heartIcon.closest(".heart-bookmark");
    let totalHearts = parentDiv.querySelector(".total-hearts");
    let postId = parentDiv.getAttribute("data-post-id");
    let isCurrentlyHearted = heartIcon.classList.contains("fa-solid");
    try { 
        let serverResponse = await fetch(`php/API.php?action=togglePostHeart&id=${postId}&heart=${isCurrentlyHearted ? 0 : 1}`);
        let responseData = await serverResponse.json();
        if(!responseData.success){ 
            alert(`Error liking post: ${responseData.reason}`);
            return;
        }
        if(isCurrentlyHearted){
            heartIcon.classList.remove("fa-solid");
            heartIcon.classList.add("fa-regular");
        }
        else {
            heartIcon.classList.remove("fa-regular");
            heartIcon.classList.add("fa-solid");
        }
        totalHearts.innerHTML = responseData.result;
    }
    catch(e) {
        alert("Error when hearting post");
    }
}

async function handleBookmarkIconClick(e){
    let bookmarkIcon = e.currentTarget;
    let parentDiv = bookmarkIcon.closest(".heart-bookmark");
    let totalBookmarks = parentDiv.querySelector(".total-bookmarks");
    let postId = parentDiv.getAttribute("data-post-id");
    let isCurrentlyBookmarked = bookmarkIcon.classList.contains("fa-solid");
    try { 
        let serverResponse = await fetch(`php/API.php?action=togglePostBookmark&id=${postId}&bookmark=${isCurrentlyBookmarked ? 0 : 1}`);
        let responseData = await serverResponse.json();
        if(!responseData.success){ 
            alert(`Error liking post: ${responseData.reason}`);
            return;
        }
        if(isCurrentlyBookmarked){
            bookmarkIcon.classList.remove("fa-solid");
            bookmarkIcon.classList.add("fa-regular");
        }
        else {
            bookmarkIcon.classList.remove("fa-regular");
            bookmarkIcon.classList.add("fa-solid");
        }
        totalBookmarks.innerHTML = responseData.result;
    }
    catch(e) {
        alert("Error when bookmarking post");
    }
}

var inputFile = document.getElementById('upload-image');
inputFile.addEventListener('change', showFileName);

function showFileName(e) {
    var infoArea = document.getElementById('upload-image-name');
    var input = e.srcElement;
    var fileName = input.files[0].name;
    infoArea.innerHTML = fileName;
}