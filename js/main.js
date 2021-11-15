$(document).ready(function () {
  $("#btn-add-new").on("click", function () {
    $(".modal-title").html("Add film");
    $("#table-manager").modal("show");
  });

  $("#table-manager").on("hidden.bs.modal", function () {
    $("#show-content").fadeOut();
    $("#edit-content").fadeIn();
    $("#name").val("");
    $("#author").val("");
    $("#btn-manage")
      .attr("value", "Add New")
      .attr("onclick", "manageData('addNew')")
      .fadeIn();
  });

  getAllBooks();
});

function manageData(key) {
  var name = $("#name").val();
  var author = $("#author").val();
  var year = $("#year").val();
  var numberOfPages = $("#num-pages").val();
  var select = document.getElementById("select");
  var selectedValue = select.options[select.selectedIndex].value;

  if (
    isNotEmpty($("#name")) &&
    isNotEmpty($("#author")) &&
    isNotEmpty($("#year")) &&
    isNotEmpty($("#num-pages"))
  ) {
    $.ajax({
      url: "handler.php",
      method: "POST",
      dataType: "text",
      data: {
        key: key,
        name: name,
        author: author,
        year: year,
        numberOfPages: numberOfPages,
        selectedValue: selectedValue,
      },
      success: function (response) {
        if (response != "success") alert(response);
        else {
          getAllBooks();
          location.reload();
          $("#name").val("");
          $("#author").val("");
          $("#year").val("");
          $("#num-pages").val("");
          $("#table-manager").modal("hide");
          $("#btn-manage")
            .attr("value", "Add")
            .attr("onclick", "manageData('addNew')");
        }
      },
    });
  }
}

function isNotEmpty(element) {
  if (element.val() === "") {
    element.css("border", "1px solid red");
    return false;
  } else {
    element.css("border", "");
  }

  return true;
}

function getAllBooks() {
  $.ajax({
    url: "handler.php",
    method: "POST",
    dataType: "text",
    data: {
      key: "getAllBooks",
    },
    success: function (response) {
      if (response == "success") {
        console.log("success");
      }
    },
  });
}

function viewOrEdit(bookId, type) {
  $.ajax({
    url: "handler.php",
    method: "POST",
    dataType: "json",
    data: {
      key: "getBookById",
      bookId: bookId,
    },
    success: function (response) {
      var select = document.getElementById("select");
      if (type == "view") {
        $("#edit-content").css("display", "none");
        $("#show-content").fadeIn();
        $("#year-view").html(response.year);
        $("#num-pages-view").html(response.numberOfPages);
        $("#category-view").html(select.options[response.category].text);
        $("#btn-manage").css("display", "none");
        $("#btn-close-view").fadeIn();
      } else {
        $("#edit-content").fadeIn();
        $("#name").val(response.name);
        $("#author").val(response.author);
        $("#year").val(response.year);
        $("#num-pages").val(response.numberOfPages);
        select.selectedIndex = response.category;
        $("#btn-close").fadeIn();
        $("#btn-manage")
          .attr("value", "Edit")
          .attr("onclick", "manageData('update')");
      }

      $(".modal-title").html(response.name);
      $("#table-manager").modal("show");
    },
  });
}
