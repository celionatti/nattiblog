// Filter js
$(document).ready(function () {
  $(".filter-item").click(function () {
    const value = $(this).attr("data-filter");
    if (value == "all") {
      $(".post-box").show("1000");
    } else {
      $(".post-box")
        .not("." + value)
        .hide("1000");
      $(".post-box")
        .filter("." + value)
        .show("1000");
    }
  });

  // Add active to btn
  $(".filter-item").click(function () {
    $(this).addClass("active-filter").siblings().removeClass("active-filter");
  });

  // Contact Message.
  $(".contact_btn").click(function (e) {
    e.preventDefault();

    var email = $(".contact_email").val();

    if ($.trim(email).length == 0) {
      error_msg = "Please type E-Mail";
      $(".invalid-feedback").text(error_msg);
    } else {
      error_msg = "";
      $(".invalid-feedback").text(error_msg);
    }

    if (error_msg != "") {
      return false;
    } else {
      var data = {
        email: email,
        add_subscribers: true,
      };

      $.ajax({
        type: "POST",
        url: "/home/subscribers",
        data: data,
        success: function (response) {
          alert(response);
          $(".contact_email").val("");
        },
      });
    }
  });
});

//Header Background Change on scroll.
let header = document.querySelector("header");

window.addEventListener("scroll", () => {
  header.classList.toggle("shadow", window.scrollY > 0);
});
