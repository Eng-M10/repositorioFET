document.getElementById("view-documents").addEventListener("click", function() {
    document.querySelector(".add-document-form").style.display = "none";
    document.querySelector(".edit-document-form").style.display = "none";
    document.querySelector(".profile-info-form").style.display = "none";
    document.querySelector(".add-article-form").style.display="none";
    document.querySelector(".document-list").style.display="block"
});

document.getElementById("add-document").addEventListener("click", function() {
    document.querySelector(".add-document-form").style.display = "block";
    document.querySelector(".edit-document-form").style.display = "none";
    document.querySelector(".profile-info-form").style.display = "none";
    document.querySelector(".add-article-form").style.display="none";
    document.querySelector(".document-list").style.display="none"
});

document.getElementById("profile-info").addEventListener("click", function() {
    document.querySelector(".add-document-form").style.display = "none";
    document.querySelector(".edit-document-form").style.display = "none";
    document.querySelector(".add-article-form").style.display="none";
    document.querySelector(".profile-info-form").style.display = "block";
    document.querySelector(".document-list").style.display="none"
});
document.getElementById("add-article").addEventListener("click", function() {
    document.querySelector(".add-document-form").style.display = "none";
    document.querySelector(".edit-document-form").style.display = "none";
    document.querySelector(".profile-info-form").style.display = "none";
    document.querySelector(".document-list").style.display="none";
    document.querySelector(".add-article-form").style.display="block";
});
document.getElementById("backTo").addEventListener("click", function() {
    window.location.href = "http://localhost/repositorioFET/index.php";

});


