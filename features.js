$(document).ready(function() {
    // Smooth scrolling for navigation links
    $('.navbar-nav li a').click(function(event) {
      if (this.hash !== "") {
        event.preventDefault();
        const hash = this.hash;
        $('html, body').animate({
          scrollTop: $(hash).offset().top - 50
        }, 800);
      }
    });
  });

  
  