function openModal() {
    document.getElementById('editModal').style.display = "block";
  }
  
  function closeModal() {
    document.getElementById('editModal').style.display = "none";
  }
  
  // Close the modal when clicking outside of it
  window.onclick = function(event) {
    if (event.target == document.getElementById('editModal')) {
      document.getElementById('editModal').style.display = "none";
    }
  }
  function confirmDelete() {
    if (confirm("Are you sure you want to delete this item?")) {
      
      alert("Item deleted successfully."); 
    } else {
      alert("Delete operation canceled.");
    }
  }



document.addEventListener('DOMContentLoaded', function() {
    var modal = document.getElementById("contact-modal");
    var btn = document.getElementById("contact-link");
    var span = document.getElementsByClassName("close")[0];

    btn.onclick = function() {
        modal.style.display = "block";
    }

    span.onclick = function() {
        modal.style.display = "none";
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
});

const list = document.querySelector('ul');
const exit = document.querySelector('.exit-icon');
const menuIcon = document.querySelector('.menu-icon');

if (menuIcon) {
    menuIcon.addEventListener('click', () => {
        list.classList.add('active');
        menuIcon.style.display = 'none';
        exit.style.display = 'inline-block';
    })
}

if (exit) {
    exit.addEventListener('click', () => {
        list.classList.remove('active');
        exit.style.display = 'none';
        menuIcon.style.display = 'inline-block';
    })
}