// Hamburger Menu animation
const hamburger = document.querySelector(".hamburger");
const navMenu = document.querySelector(".nav-menu");

hamburger.addEventListener("click", () => {
     hamburger.classlist.toggle("active")
     navMenu.classlist.toggle("active")
})

document.querySelectorAll(".hamburger").forEach(n => n.addEventListener("click", () =>{
    hamburger.classlist.remove("active");
    navMenu.classlist.remove("active");
}))

// script.js
document.addEventListener("DOMContentLoaded", function() {
    var form = document.getElementById('reviewForm');
    form.onsubmit = function(e) {
        e.preventDefault();

        // Fetch form data
        var formData = new FormData(form);

        // AJAX request to server
        fetch('post_review.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            // Add the new review to the 'reviews' div
            var reviewsDiv = document.getElementById('reviews');
            var newReview = `<p><strong>${formData.get('username')}</strong>: ${formData.get('comment')}<br><em>Just now</em></p>`;
            reviewsDiv.innerHTML = newReview + reviewsDiv.innerHTML;

            // Optionally, clear the form fields
            form.reset();
        })
        .catch(error => {
            console.error('Error:', error);
        });
    };
});
