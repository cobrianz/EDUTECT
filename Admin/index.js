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

  // Hide all sections initially
  sections.forEach(section => section.style.display = 'none');

  // Retrieve the active link from localStorage
  let activeLinkId = localStorage.getItem('activeLinkId');
  let activeLink;
  let activeSection;

  if (activeLinkId) {
    // Find the corresponding link and section
    activeLink = document.getElementById(activeLinkId);
    const activeSectionId = activeLinkId.replace('-link', '-content');
    activeSection = document.getElementById(activeSectionId);

    // Set the active link
    if (activeLink) {
      activeLink.classList.add('active');
    }
  } else {
    // If no active link in localStorage, check for any active class
    activeLink = Array.from(links).find(link => link.classList.contains('active'));

    // If no active class found, set the dashboard as active
    if (!activeLink) {
      const dashboardLink = document.getElementById('dashboard-link');
      if (dashboardLink) {
        activeLink = dashboardLink;
        activeLinkId = activeLink.id;
        localStorage.setItem('activeLinkId', activeLinkId);
      }
    }

    // Set the active link
    if (activeLink) {
      activeLink.classList.add('active');
    }
  }

  // Show the corresponding section
  if (activeLink) {
    const activeSectionId = activeLinkId.replace('-link', '-content');
    activeSection = document.getElementById(activeSectionId);
    if (activeSection) {
      activeSection.style.display = 'flex';
      activeSection.style.flexDirection = 'column';
      activeSection.style.gap = '2rem';
    }
  }

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
      const section = document.getElementById(sectionId);
      if (section) {
        section.style.display = 'flex';
        section.style.flexDirection = 'column';
        section.style.gap = '2rem';
      }

      // Store the active link ID in localStorage
      localStorage.setItem('activeLinkId', this.id);
    });
  });
});

const messageForm = document.getElementById('message-form');

function pop(userId) {
    if (userId) {
        document.getElementById('user_id').value = userId;
        messageForm.classList.add('active');
    } else {
        messageForm.classList.remove('active');
        messageForm.reset();
    }
}

const adminForm = document.getElementById('formContainer');
const adminDetails = document.getElementById('admin_details');
const admin = document.getElementById('addAdmin');

function popform(){
  adminForm.classList.remove('active');
  addAdmin.reset();
  }
  
  function addAdmin(){
  adminForm.classList.toggle('active');

}

function ShowAdmin(){
  adminDetails.classList.toggle('active');
}


