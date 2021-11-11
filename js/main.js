$(document).ready(function () {
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
  var selectedValue = select.options[select.selectedIndex].text;

  var editRowID = $("#edit-row-id").val();

  // ovde CHECKPOINT
  console.log(name, author, year, numberOfPages, selectedValue, editRowID);

  if (
    isNotEmpty($("#name")) &&
    isNotEmpty($("#author")) &&
    isNotEmpty($("#year")) &&
    isNotEmpty($("#num-pages"))
  ) {
    console.log("TEST");
    /*
    $.ajax({
      url: "execute.php",
      method: "POST",
      dataType: "text",
      data: {
        key: key,
        name: name.val(),
        description: description.val(),
        year: year.val(),
        rowID: editRowID.val(),
      },
      success: function (response) {
        if (response != "success") alert(response);
        else {
          location.reload();
          name.val("");
          description.val("");
          year.val("");
          $("#tableManager").modal("hide");
          $("#manageBtn")
            .attr("value", "Add")
            .attr("onclick", "manageData('addNew')");
        }
      },
    });*/
  }
}

function isNotEmpty(caller) {
  if (caller.val() === "") {
    caller.css("border", "1px solid red");
    return false;
  } else {
    caller.css("border", "");
  }

  return true;
}
