// Initial setup
const sideMenu = document.querySelector("aside");
const menuBtn = document.querySelector("#menu-btn");
const themeToggler = document.querySelector(".theme-toggler");


// Change theme
themeToggler.addEventListener("click", () => {
  document.body.classList.toggle("dark-theme-variables");

  themeToggler.querySelector("span:nth-child(1)").classList.toggle("active");
  themeToggler.querySelector("span:nth-child(2)").classList.toggle("active");

  // Save theme preference in local storage
  if (document.body.classList.contains("dark-theme-variables")) {
    localStorage.setItem("theme", "dark");
  } else {
    localStorage.setItem("theme", "light");
  }
});

// Load theme preference from local storage
document.addEventListener("DOMContentLoaded", () => {
  const theme = localStorage.getItem("theme");
  if (theme === "dark") {
    document.body.classList.add("dark-theme-variables");
    themeToggler.querySelector("span:nth-child(1)").classList.add("active");
    themeToggler.querySelector("span:nth-child(2)").classList.remove("active");
  }
});

document.addEventListener('DOMContentLoaded', function() {
  const links = document.querySelectorAll('.sidebar a');
  const sections = document.querySelectorAll('.content-section');

  links.forEach((link, index) => {
      if (index === links.length - 1) return; // Skip the last link

      link.addEventListener('click', function(e) {
          e.preventDefault();

          // Remove 'active' class from all links
          links.forEach(link => link.classList.remove('active'));

          // Add 'active' class to the clicked link
          this.classList.add('active');

          // Hide all sections
          sections.forEach(section => section.style.display = 'none');

          // Show the corresponding section
          const sectionId = this.id.replace('-link', '-content');
          document.getElementById(sectionId).style.display = 'block';
      });
  });

  // Show the dashboard content by default
  document.getElementById('dashboard-content').style.display = 'block';
});

