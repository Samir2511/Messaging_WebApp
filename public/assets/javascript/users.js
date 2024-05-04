// const searchBar = document.querySelector(".search input"),
//     searchIcon = document.querySelector(".search button"),
//     usersList = document.querySelector(".users-list");
//
// searchIcon.onclick = ()=>{
//     searchBar.classList.toggle("show");
//     searchIcon.classList.toggle("active");
//     searchBar.focus();
//     if(searchBar.classList.contains("active")){
//         searchBar.value = "";
//         searchBar.classList.remove("active");
//     }
// }
//
//
// searchBar.onkeyup = () => {
//     let searchTerm = searchBar.value;
//     if (searchTerm != "") {
//         searchBar.classList.add("active");
//     } else {
//         searchBar.classList.remove("active");
//     }
//
//     // Construct the URL with the search term as a query parameter
//     let url = userSearchURI + '?searchTerm=' + encodeURIComponent(searchTerm);
//
//     let xhr = new XMLHttpRequest();
//     xhr.open("GET", url, true);
//
//     // Set the CSRF token as a header
//     xhr.setRequestHeader("X-CSRF-TOKEN", document.querySelector('meta[name="csrf-token"]').content);
//
//     xhr.onload = () => {
//         console.log(xhr.responseText);
//         if (xhr.readyState === XMLHttpRequest.DONE) {
//             if (xhr.status === 200) {
//                 let data = xhr.response;
//                 usersList.innerHTML = data;
//             }
//         }
//     }
//
//     xhr.send();
// }


// searchBar.onkeyup = () => {
//     let searchTerm = searchBar.value;
//     if (searchTerm != "") {
//         searchBar.classList.add("active");
//     } else {
//         searchBar.classList.remove("active");
//     }
//
//     let xhr = new XMLHttpRequest();
//     xhr.open("GET", userSearchURI, true);
//
//     // Set the CSRF token as a header
//     xhr.setRequestHeader("X-CSRF-TOKEN", document.querySelector('meta[name="csrf-token"]').content);
//     xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
//
//     xhr.onload = () => {
//         console.log(xhr.responseText);
//         if (xhr.readyState === XMLHttpRequest.DONE) {
//             if (xhr.status === 200) {
//                 let data = xhr.response;
//                 usersList.innerHTML = data;
//             }
//         }
//     }
//
//     xhr.send("searchTerm=" + searchTerm);
// }





// function fetchUserList() {
//     let xhr = new XMLHttpRequest();
//     xhr.open("GET", "/users/all", true);
//     xhr.onload = function() {
//         if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
//             let data = xhr.responseText;
//             document.querySelector(".users-list").innerHTML = data;
//         }
//     };
//     xhr.send();
// }
//
// setInterval(fetchUserList, 500);

// ---------------------------------------------------------------------------------------

const searchBar = document.querySelector(".search input");
const searchIcon = document.querySelector(".search button");
const usersList = document.querySelector(".users-list");

// Function to handle search
function handleSearch() {
    let searchTerm = searchBar.value.trim();
    if (searchTerm !== "") {
        searchBar.classList.add("active");

        // Construct the URL with the search term as a query parameter
        let url = userSearchURI + '?searchTerm=' + encodeURIComponent(searchTerm);

        let xhr = new XMLHttpRequest();
        xhr.open("GET", url, true);

        // Set the CSRF token as a header if needed
        // xhr.setRequestHeader("X-CSRF-TOKEN", document.querySelector('meta[name="csrf-token"]').content);

        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    let data = xhr.response;
                    usersList.innerHTML = data;
                }
            }
        }

        xhr.send();
    } else {
        // If search term is empty, clear the users list
        usersList.innerHTML = "";
        searchBar.classList.remove("active");
    }
}

// Function to fetch all users
function fetchUserList() {
    let xhr = new XMLHttpRequest();
    xhr.open("GET", "/users/all", true);
    xhr.onload = function() {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            let data = xhr.responseText;
            // Only update the users list if the search input is not active
            if (!searchBar.classList.contains("active")) {
                usersList.innerHTML = data;
            }
        }
    };
    xhr.send();
}

// Event listener for search icon click
searchIcon.onclick = () => {
    searchBar.classList.toggle("show");
    searchIcon.classList.toggle("active");
    searchBar.focus();
    if (searchBar.classList.contains("active")) {
        searchBar.value = "";
        handleSearch();
    } else {
        fetchUserList(); // Show all users when closing the search
    }
}

// Event listener for search input keyup
searchBar.onkeyup = () => {
    handleSearch();
}

// Fetch all users initially
fetchUserList();

// Refresh the users list periodically
setInterval(fetchUserList, 500);

