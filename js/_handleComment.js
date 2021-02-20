$(document).ready(function () {
  // if the user clicks on the like button ...
  $(".Clike-btn").on("click", function () {
    var c_id = $(this).data("id");
    console.log(c_id);
    $clicked_btn = $(this);
    if ($clicked_btn.hasClass("bi bi-hand-thumbs-up")) {
      Caction = "like";
      console.log(Caction);
    } else if ($clicked_btn.hasClass("bi bi-hand-thumbs-up-fill")) {
      Caction = "unlike";
    }
    $.ajax({
      url: "thread.php",
      type: "post",
      data: {
        Caction: Caction,
        c_id: c_id,
      },
      success: function (database) {
        var text = database.split("<epsilon>");
        text = text[2];
        console.log(text);
        res = JSON.parse(text);
        if (Caction == "like") {
          $clicked_btn.removeClass("bi bi-hand-thumbs-up");
          $clicked_btn.addClass("bi bi-hand-thumbs-up-fill");
        } else if (Caction == "unlike") {
          $clicked_btn.removeClass("bi bi-hand-thumbs-up-fill");
          $clicked_btn.addClass("bi bi-hand-thumbs-up");
        }
        // display the number of likes and dislikes
        $clicked_btn.siblings("span.Clikes").text(res.Clikes);
        $clicked_btn.siblings("span.Cdislikes").text(res.Cdislikes);
        $clicked_btn.siblings("span.Cvotes").text(res.Cvotes);
        // change button styling of the other button if user is reacting the second time to post
        $clicked_btn
          .siblings("i.bi.bi-hand-thumbs-down-fill")
          .removeClass("bi bi-hand-thumbs-down-fill")
          .addClass("bi bi-hand-thumbs-down");
      },
    });
  });
  // if the user clicks on the dislike button ...
  $(".Cdislike-btn").on("click", function () {
    var c_id = $(this).data("id");
    $clicked_btn = $(this);
    if ($clicked_btn.hasClass("bi bi-hand-thumbs-down")) {
      Caction = "dislike";
    } else if ($clicked_btn.hasClass("bi bi-hand-thumbs-down-fill")) {
      Caction = "undislike";
    }
    $.ajax({
      url: "thread.php",
      type: "post",
      data: {
        Caction: Caction,
        c_id: c_id,
      },
      success: function (database) {
        var text = database.split("<epsilon>");
        text = text[2];
        console.log(text);
        res = JSON.parse(text);
        if (Caction == "dislike") {
          $clicked_btn.removeClass("bi bi-hand-thumbs-down");
          $clicked_btn.addClass("bi bi-hand-thumbs-down-fill");
        } else if (Caction == "undislike") {
          $clicked_btn.removeClass("bi bi-hand-thumbs-down-fill");
          $clicked_btn.addClass("bi bi-hand-thumbs-down");
        }
        // display the number of likes and dislikes
        $clicked_btn.siblings("span.Clikes").text(res.Clikes);
        $clicked_btn.siblings("span.Cdislikes").text(res.Cdislikes);
        $clicked_btn.siblings("span.Cvotes").text(res.Cvotes);
        // change button styling of the other button if user is reacting the second time to post
        $clicked_btn
          .siblings("i.bi.bi-hand-thumbs-up-fill")
          .removeClass("bi bi-hand-thumbs-up-fill")
          .addClass("bi bi-hand-thumbs-up");
      },
    });
  });
});
