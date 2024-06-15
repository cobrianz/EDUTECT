function toggleSubtopics(element) {
    const subtopics = element.querySelector('.subtopics');
    const icon = element.querySelector('i');
    if (subtopics.style.display === 'none' || subtopics.style.display === '') {
        subtopics.style.display = 'block';
        icon.classList.remove('fa-chevron-down');
        icon.classList.add('fa-chevron-up');
    } else {
        subtopics.style.display = 'none';
        icon.classList.remove('fa-chevron-up');
        icon.classList.add('fa-chevron-down');
    }
}

function toggleAside() {
    var aside = document.getElementById("courseOutline");
    aside.classList.toggle("active");
}

const navLinks = document.getElementById('nav_links');

function pop() {
    navLinks.style.display = "flex";
}