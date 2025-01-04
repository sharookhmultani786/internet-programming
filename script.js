const pro=document.getElementById("profile-card");
pro.addEventListener("dblclick", function () {
    fetch("profile.json")
        .then(response => response.json())
        .then(data => {
            document.getElementById("img").src = data.profilePicture;
            document.getElementById("name").textContent = data.name;
            document.getElementById("bio").textContent = data.bio;
            document.getElementById("whats").href = data.socialLinks.whatsapp;
            document.getElementById("insta").href = data.socialLinks.instagram;
            document.getElementById("facebook").id="Github";
            document.getElementById("Github").textContent="Github";
            document.getElementById("Github").href = data.socialLinks.github;
        })
        .catch(error => {
            console.error("Error loading profile data:", error);
        });
});