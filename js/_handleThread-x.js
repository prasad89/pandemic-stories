$(document).ready(function () {
  // if the user clicks on the like button ...
  $(".like-btn").on("click", function () {
    var th_th_id = $(this).data("id");
    var user = $(this).data("uid");
    console.log(th_th_id);
    console.log(user);
    if (user == -1) {
      alert("Please login first!");
      return;
    }
    $clicked_btn = $(this);
    if ($clicked_btn.hasClass("bi bi-hand-thumbs-up")) {
      action = "like";
      // console.log(action);
    } else if ($clicked_btn.hasClass("bi bi-hand-thumbs-up-fill")) {
      action = "unlike";
    }
    $.ajax({
      url: "threadlist.php",
      type: "post",
      data: {
        action: action,
        th_th_id: th_th_id,
      },
      success: function (database) {
        var text = database.split("<epsilon>");
        text = text[1];
        console.log(text);
        res = JSON.parse(text);
        if (action == "like") {
          $clicked_btn.removeClass("bi bi-hand-thumbs-up");
          $clicked_btn.addClass("bi bi-hand-thumbs-up-fill");
        } else if (action == "unlike") {
          $clicked_btn.removeClass("bi bi-hand-thumbs-up-fill");
          $clicked_btn.addClass("bi bi-hand-thumbs-up");
        }
        // display the number of likes and dislikes
        $clicked_btn.siblings("span.likes").text(res.likes);
        $clicked_btn.siblings("span.dislikes").text(res.dislikes);
        $clicked_btn.siblings("span.votes").text(res.votes);
        // change button styling of the other button if user is reacting the second time to post
        $clicked_btn
          .siblings("i.bi.bi-hand-thumbs-down-fill")
          .removeClass("bi bi-hand-thumbs-down-fill")
          .addClass("bi bi-hand-thumbs-down");
      },
    });
  });
  // if the user clicks on the dislike button ...
  $(".dislike-btn").on("click", function () {
    var th_th_id = $(this).data("id");
    var user = $(this).data("uid");
    console.log(th_th_id);
    console.log(user);
    if (user == -1) {
      alert("Please login first!");
      return;
    }
    $clicked_btn = $(this);
    if ($clicked_btn.hasClass("bi bi-hand-thumbs-down")) {
      action = "dislike";
    } else if ($clicked_btn.hasClass("bi bi-hand-thumbs-down-fill")) {
      action = "undislike";
    }
    $.ajax({
      url: "threadlist.php",
      type: "post",
      data: {
        action: action,
        th_th_id: th_th_id,
      },
      success: function (database) {
        var text = database.split("<epsilon>");
        text = text[1];
        console.log(text);
        res = JSON.parse(text);
        if (action == "dislike") {
          $clicked_btn.removeClass("bi bi-hand-thumbs-down");
          $clicked_btn.addClass("bi bi-hand-thumbs-down-fill");
        } else if (action == "undislike") {
          $clicked_btn.removeClass("bi bi-hand-thumbs-down-fill");
          $clicked_btn.addClass("bi bi-hand-thumbs-down");
        }
        // display the number of likes and dislikes
        $clicked_btn.siblings("span.likes").text(res.likes);
        $clicked_btn.siblings("span.dislikes").text(res.dislikes);
        $clicked_btn.siblings("span.votes").text(res.votes);
        // change button styling of the other button if user is reacting the second time to post
        $clicked_btn
          .siblings("i.fas.fa-thumbs-up")
          .removeClass("bi bi-hand-thumbs-up-fill")
          .addClass("bi bi-hand-thumbs-up");
      },
    });
  });
  // if the user clicks on the marked button ...
  $(".marked-btn").on("click", function () {
    var th_th_id = $(this).data("id");
    var user = $(this).data("uid");
    console.log(th_th_id);
    console.log(user);
    if (user == -1) {
      alert("Please login first!");
      return;
    }
    $clicked_btn = $(this);
    if ($clicked_btn.hasClass("bi bi-bookmark")) {
      action = "mark";
    } else if ($clicked_btn.hasClass("bi bi-bookmark-fill")) {
      action = "unmark";
    }
    console.log("marked!");
    console.log("action " + action);
    $.ajax({
      url: "index.php",
      type: "post",
      data: {
        action: action,
        th_th_id: th_th_id,
      },
      success: function () {
        console.log(action);
        if (action == "mark") {
          $clicked_btn.removeClass("bi bi-bookmark");
          $clicked_btn.addClass("bi bi-bookmark-fill");
        } else if (action == "unmark") {
          $clicked_btn.removeClass("bi bi-bookmark-fill");
          $clicked_btn.addClass("bi bi-bookmark");
        }
      },
    });
  });

  // if the user clicks on the follow button ...
  $(".follow-btn").on("click", function () {
    var th_th_id = $(this).data("id");
    var user = $(this).data("uid");
    console.log(th_th_id);
    console.log(user);
    if (user == -1) {
      alert("Please login first!");
      return;
    }
    $clicked_btn = $(this);
    if ($clicked_btn.hasClass("bi bi-bookmark")) {
      action = "follow";
    } else if ($clicked_btn.hasClass("bi bi-bookmark-fill")) {
      action = "unfollow";
    }
    $.ajax({
      url: "index.php",
      type: "post",
      data: {
        action: action,
        th_th_id: th_th_id,
      },
      success: function () {
        console.log(action);
        if (action == "follow") {
          $clicked_btn.removeClass("bi bi-bookmark");
          $clicked_btn.addClass("bi bi-bookmark-fill");
        } else if (action == "unfollow") {
          $clicked_btn.removeClass("bi bi-bookmark-fill");
          $clicked_btn.addClass("bi bi-bookmark");
        }
      },
    });
  });
});
