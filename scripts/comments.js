let commentsButtons = document.querySelectorAll(".comment-box-post-button .post-button");
for(let i = 0; i < commentsButtons.length; i++){
    let commentButton = commentsButtons[i];
    commentButton.addEventListener("click", handleCommentButtonClick);
}

async function handleCommentButtonClick(e){
    try{
        
        let username = "Laura James";
        let commentButton = e.currentTarget;
        let parentDiv = commentButton.closest(".comment-box-post-button");
        let comment = parentDiv.querySelector(".comment-box").value;
        let postId = parentDiv.getAttribute("data-post-id");
        let formData = new FormData();
        formData.append("comment", comment);
        formData.append("username", username);
        formData.append("postId", postId);
        let serverResponse = await fetch(`php/API.php?action=addComment`, {
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
        alert("Error when publishing comment.");
    }
}

