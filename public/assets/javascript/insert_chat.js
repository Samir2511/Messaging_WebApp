const form = document.querySelector(".typing-area");
const inputField = form.querySelector(".input-field");
const sendBtn = form.querySelector("button");
const chatBox = document.querySelector(".chat-box");

form.addEventListener("submit", function(event) {
    event.preventDefault();
});

inputField.focus();
inputField.onkeyup = () => {
    if (inputField.value != "") {
        sendBtn.classList.add("active");
    } else {
        sendBtn.classList.remove("active");
    }
}



sendBtn.onclick = ()=>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", chatStoreURI, true);

    // Set the request header for CSRF token
    const csrfToken = document.querySelector('input[name="_token"]').value;
    xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);

    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200){
                inputField.value = "";
                scrollToBottom();
                sendBtn.classList.remove("active");
        }
    }
    let formData = new FormData(form);
    xhr.send(formData);
}


function scrollToBottom(){
    chatBox.scrollTop = chatBox.scrollHeight;
}

