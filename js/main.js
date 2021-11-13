$(document).ready(function () {
  $("#book-list").on("click", function () {
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
  });

  $("#btn-add-new").on("click", function () {
    $(".modal-title").html("Add film");
    $("#table-manager").modal("show");
  });

  $("#table-manager").on("hidden.bs.modal", function () {
    $("#show-content").fadeOut();
    $("#edit-content").fadeIn();
    $("#edit-row-id").val(0);
    $("#name").val("");
    $("#author").val("");
    $("#btn-manage")
      .attr("value", "Add New")
      .attr("onclick", "manageData('addNew')")
      .fadeIn();
  });
});

function manageData(key) {
  var name = $("#name").val();
  var author = $("#author").val();
  var year = $("#year").val();
  var numberOfPages = $("#num-pages").val();
  var select = document.getElementById("select");
  var selectedValue = select.options[select.selectedIndex].value;

  // var editRowId = $("#edit-row-id").val();

  console.log(name, author, year, numberOfPages, selectedValue);

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
