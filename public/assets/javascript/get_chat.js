// document.addEventListener("DOMContentLoaded", function() {
//     var xhr = new XMLHttpRequest();
//     xhr.open("POST", chatRetrieveURI, true);
//     xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
//     xhr.onreadystatechange = function() {
//         if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
//             // Request completed successfully, handle the response
//             var response = xhr.responseText;
//             var chatBox = document.querySelector(".chat-box");
//             chatBox.innerHTML = response; // Insert the response into the chat box
//             // Optionally, you can update the UI or perform other actions based on the response
//
//         }
//     };
//     xhr.send();
// });

// ---------------------------------------------------------------------------------------
// var chatBox = document.querySelector(".chat-box");
// const form = document.querySelector(".typing-area");
// const sendBtn = form.querySelector("button");


chatBox.onmouseenter = ()=>{
    chatBox.classList.add("active");
}

// chatBox.onmouseleave = ()=>{
//     chatBox.classList.remove("active");
// }

// formz.onmouseenter = ()=>{
//     chatBox.classList.remove("active");
// }


function scrollToBottom() {
    chatBox.scrollTop = chatBox.scrollHeight;
}
// document.addEventListener("DOMContentLoaded", function() {
    setInterval(() => {
        let xhr = new XMLHttpRequest();
        xhr.open("GET", chatRetrieveURI, true);
        // const csrfToken = document.querySelector('input[name="_token"]').value;
        // xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                let data = xhr.response;
                if (xhr.status === 200) {
                    chatBox.innerHTML = data;
                    if (!chatBox.classList.contains("active")) {
                        scrollToBottom();
                    }
                }
            }
        }
        xhr.send();
    }, 50);
// });
